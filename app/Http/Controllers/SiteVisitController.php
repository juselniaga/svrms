<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSiteVisitRequest;
use App\Http\Requests\UpdateSiteVisitRequest;
use App\Models\Application;
use App\Models\SiteVisit;
use App\Services\AuditLogService;
use App\Services\StateMachineService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SiteVisitController extends Controller
{
    protected StateMachineService $stateMachine;

    protected AuditLogService $auditLog;

    public function __construct(StateMachineService $stateMachine, AuditLogService $auditLog)
    {
        $this->stateMachine = $stateMachine;
        $this->auditLog = $auditLog;
    }

    /**
     * Display a listing of site visits for the officer.
     */
    public function index()
    {
        $siteVisits = SiteVisit::with(['application.developer', 'officer'])
            ->where('officer_id', Auth::id())
            ->latest()
            ->paginate(15);

        return view('site_visits.index', compact('siteVisits'));
    }

    /**
     * Show the form for creating a new site visit (often scoped to an application)
     */
    public function create(Request $request)
    {
        $applicationId = $request->query('application_id');
        $application = Application::findOrFail($applicationId);

        // Ensure application is in correct state
        if ($application->status !== 'RECORDED' && $application->status !== 'SITE_VISIT_IN_PROGRESS') {
            abort(403, 'Application is not ready for a site visit.');
        }

        return view('site_visits.create', compact('application'));
    }

    /**
     * Store a newly created site visit and handle file arrays.
     */
    public function store(StoreSiteVisitRequest $request)
    {
        DB::beginTransaction();
        try {
            $application = Application::findOrFail($request->validated('application_id'));

            $data = $request->validated();
            $data['officer_id'] = Auth::id();

            // Handle Photo Arrays
            $photoFields = ['photos_north', 'photos_south', 'photos_east', 'photos_west', 'attachments'];
            foreach ($photoFields as $field) {
                if ($request->hasFile($field)) {
                    $paths = [];
                    foreach ($request->file($field) as $file) {
                        $paths[] = $file->store("site_visits/{$application->application_id}/{$field}", 'public');
                    }
                    $data[$field] = $paths;
                }
            }

            $siteVisit = SiteVisit::create($data);

            // Transition Application State if it hasn't been transitioned yet
            if ($application->status === 'RECORDED') {
                $this->stateMachine->transitionTo(
                    $application,
                    'SITE_VISIT_IN_PROGRESS',
                    'Site Visit initiated by Officer '.Auth::user()->name
                );
            }

            DB::commit();

            return redirect()->route('site-visits.show', $siteVisit)->with('success', 'Site Visit Report Created.');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()->with('error', 'Error creating report: '.$e->getMessage());
        }
    }

    /**
     * Display the specified site visit.
     */
    public function show(SiteVisit $siteVisit)
    {
        $siteVisit->load(['application', 'officer']);

        return view('site_visits.show', compact('siteVisit'));
    }

    /**
     * Show the form for editing the specified site visit.
     */
    public function edit(SiteVisit $siteVisit)
    {
        return view('site_visits.edit', compact('siteVisit'));
    }

    /**
     * Update the specified site visit.
     */
    public function update(UpdateSiteVisitRequest $request, SiteVisit $siteVisit)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();

            // Handle appending new Photos to existing Arrays
            $photoFields = ['photos_north', 'photos_south', 'photos_east', 'photos_west', 'attachments'];
            foreach ($photoFields as $field) {
                if ($request->hasFile($field)) {
                    $paths = $siteVisit->$field ?? []; // Get existing array
                    foreach ($request->file($field) as $file) {
                        $paths[] = $file->store("site_visits/{$siteVisit->application_id}/{$field}", 'public');
                    }
                    $data[$field] = $paths;
                }
            }

            $siteVisit->update($data);

            DB::commit();

            return redirect()->route('site-visits.show', $siteVisit)->with('success', 'Site Visit Report Updated.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()->with('error', 'Error updating report: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SiteVisit $siteVisit)
    {
        abort(403);
    }
}
