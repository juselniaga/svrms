<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Application;
use App\Models\SiteVisit;

class SiteVisitController extends Controller
{
    /**
     * Show the form for creating or editing a Site Visit for a specific application.
     */
    public function create(Application $application): View
    {
        // Load relationships needed for context
        $application->load(['developer', 'site']);

        // Retrieve existing draft if available, else initialize a new one for binding
        $siteVisit = $application->siteVisits()->latest()->first() ?? new SiteVisit();

        return view('officer.site-visit.create', compact('application', 'siteVisit'));
    }

    /**
     * Store or update the Site Visit, including draft and final submission.
     */
    public function store(Request $request, Application $application)
    {
        $validated = $request->validate([
            'submit_action' => 'required|in:draft,submit',
            'visit_date' => 'required|date',
            
            // Site Conditions
            'activity' => 'nullable|string|max:255',
            'facility' => 'nullable|string|max:255',
            
            // Infrastructure
            'entrance_way' => 'nullable|string|max:255',
            'parit' => 'nullable|string|max:255',
            'tree' => 'nullable|integer',
            'topography' => 'nullable|string',
            
            // Verify
            'land_use_zone' => 'nullable|string|max:255',
            'density' => 'nullable|string|max:255',
            'recommend_road' => 'nullable|boolean',
            
            // Other
            'anjakan' => 'nullable|string|max:255',
            'social_facility' => 'nullable|string|max:255',

            // Findings & Photos
            'finding_north' => 'nullable|string',
            'photos_north.*' => 'nullable|image|max:10240',
            'findings_south' => 'nullable|string',
            'photos_south.*' => 'nullable|image|max:10240',
            'findings_east' => 'nullable|string',
            'photo_east.*' => 'nullable|image|max:10240',
            'finding_west' => 'nullable|string',
            'photo_west.*' => 'nullable|image|max:10240',
            'location_data' => 'nullable|string',
        ]);

        $isSubmit = $validated['submit_action'] === 'submit';

        // Internal helper to handle multiple file uploads
        $uploadPhotos = function ($files) {
            $paths = [];
            if ($files) {
                foreach ($files as $file) {
                    $paths[] = $file->store('photos', 'public');
                }
            }
            return count($paths) > 0 ? $paths : null;
        };

        \Illuminate\Support\Facades\DB::transaction(function () use ($request, $validated, $application, $uploadPhotos, $isSubmit) {
            
            // Fetch the existing draft or create a new site visit instance
            $siteVisit = $application->siteVisits()->latest()->first();
            if (!$siteVisit) {
                $siteVisit = new SiteVisit([
                    'application_id' => $application->application_id, 
                    'officer_id' => auth()->id()
                ]);
            }

            $siteVisit->visit_date = $validated['visit_date'];
            
            // Group 1: Site Conditions
            $siteVisit->activity = $validated['activity'] ?? null;
            $siteVisit->facility = $validated['facility'] ?? null;
            
            // Group 2: Infrastructure
            $siteVisit->entrance_way = $validated['entrance_way'] ?? null;
            $siteVisit->parit = $validated['parit'] ?? null;
            $siteVisit->tree = $validated['tree'] ?? null;
            $siteVisit->topography = $validated['topography'] ?? null;
            
            // Group 3: Verify
            $siteVisit->land_use_zone = $validated['land_use_zone'] ?? null;
            $siteVisit->density = $validated['density'] ?? null;
            $siteVisit->recommend_road = $request->has('recommend_road') ? true : false;
            
            // Group 4: Other
            $siteVisit->anjakan = $validated['anjakan'] ?? null;
            $siteVisit->social_facility = $validated['social_facility'] ?? null;

            // Group 5: Findings & Photos
            $siteVisit->finding_north = $validated['finding_north'] ?? null;
            if ($request->hasFile('photos_north')) {
                $siteVisit->photos_north = $uploadPhotos($request->file('photos_north'));
            }

            $siteVisit->findings_south = $validated['findings_south'] ?? null;
            if ($request->hasFile('photos_south')) {
                $siteVisit->photos_south = $uploadPhotos($request->file('photos_south'));
            }

            $siteVisit->findings_east = $validated['findings_east'] ?? null;
            if ($request->hasFile('photo_east')) {
                $siteVisit->photo_east = $uploadPhotos($request->file('photo_east'));
            }

            $siteVisit->finding_west = $validated['finding_west'] ?? null;
            if ($request->hasFile('photo_west')) {
                $siteVisit->photo_west = $uploadPhotos($request->file('photo_west'));
            }
            
            // Location
            if (!empty($validated['location_data'])) {
                $siteVisit->location_data = $validated['location_data'];
            }

            $siteVisit->status = $isSubmit ? 'COMPLETED' : 'DRAFT';
            
            $siteVisit->save();

            // Only transition Application status if finally submitted
            if ($isSubmit) {
                $application->status = 'SITE_VISIT_IN_PROGRESS';
                $application->save();

                $application->auditLogs()->create([
                    'user_id' => auth()->id(),
                    'action' => 'SITE_INVESTIGATION_COMPLETED',
                    'description' => "Officer formally submitted Site Investigation.",
                    'remarks' => "Location Data: " . ($siteVisit->location_data ?? 'None'),
                    'created_at' => now(),
                ]);
            }
        });

        if ($isSubmit) {
            return redirect()->route('officer.dashboard')
                ->with('success', 'Site Investigation submitted successfully. Application status is now Site Visit In Progress.');
        } else {
            return back()->with('success', 'Draft saved successfully. You can return later to complete it.');
        }
    }
}
