<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Application;
use App\Models\Site;

class SiteRegistrationController extends Controller
{
    /**
     * Show the form for registering the physical Site for an application.
     */
    public function create(Application $application): View
    {
        if ($application->officer_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this application.');
        }

        // Load relationships needed for context
        $application->load('developer');

        return view('officer.site-registration.create', compact('application'));
    }

    /**
     * Store the new Site.
     */
    public function store(Request $request, Application $application)
    {
        if ($application->officer_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this application.');
        }

        $validated = $request->validate([
            'mukim' => 'required|string|max:255',
            'bpk' => 'nullable|string|max:255',
            'luas' => 'required|numeric',
            'google_lat' => 'nullable|numeric',
            'google_long' => 'nullable|numeric',
            'lot' => 'required|string|max:255',
            'lembaran' => 'nullable|string|max:255',
            'kategori_tanah' => 'nullable|string|max:255',
            'status_tanah' => 'nullable|string|max:255',
        ]);

        \Illuminate\Support\Facades\DB::transaction(function () use ($validated, $application) {
            $application->site()->create([
                'mukim' => $validated['mukim'],
                'bpk' => $validated['bpk'],
                'luas' => $validated['luas'],
                'google_lat' => $validated['google_lat'],
                'google_long' => $validated['google_long'],
                'lot' => $validated['lot'],
                'lembaran' => $validated['lembaran'],
                'kategori_tanah' => $validated['kategori_tanah'],
                'status_tanah' => $validated['status_tanah'],
                'status' => 'REGISTERED',
                'is_active' => true,
            ]);

            // Log action
            $application->auditLogs()->create([
                'user_id' => auth()->id(),
                'action' => 'SITE_REGISTERED',
                'description' => "Officer registered Site Information (Lot: {$validated['lot']}).",
                'created_at' => now(),
            ]);
        });

        // After registering the site, go straight to the site visit form
        return redirect()->route('officer.site-visit.create', $application->application_id)
            ->with('success', 'Site Information registered securely. You may now perform the Site Visit.');
    }
}
