<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Models\Application;
use App\Models\Developer;
use App\Services\AuditLogService;
use App\Services\StateMachineService;
use Illuminate\Support\Facades\DB;

class ApplicationController extends Controller
{
    protected StateMachineService $stateMachine;

    protected AuditLogService $auditLog;

    public function __construct(StateMachineService $stateMachine, AuditLogService $auditLog)
    {
        $this->stateMachine = $stateMachine;
        $this->auditLog = $auditLog;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = Application::with(['developer', 'officer'])->latest()->paginate(15);

        return view('applications.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('applications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApplicationRequest $request)
    {
        DB::beginTransaction();
        try {
            // 1. Create or Find Developer (simplified for this scope)
            $developer = Developer::create($request->validated('developer'));

            // 2. Create Application
            $appData = $request->validated('application');
            $appData['developer_id'] = $developer->developer_id;
            $appData['status'] = 'RECORDED'; // Initial state per specification

            $application = Application::create($appData);

            // 3. Log initial creation
            $this->auditLog->logTransition(
                $application,
                'create_application',
                null,
                $application->status,
                null,
                $application->toArray(),
                'Application created by Clerk'
            );

            DB::commit();

            return redirect()->route('applications.index')->with('success', 'Application Recorded Successfully');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()->with('error', 'Failed to record application: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        $application->load(['developer', 'site', 'auditLogs.user', 'officer']);

        return view('applications.show', compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        // Only allow edits in specific states (e.g RECORDED)
        if ($application->status !== 'RECORDED') {
            abort(403, 'Application cannot be edited at this stage.');
        }

        return view('applications.edit', compact('application'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApplicationRequest $request, Application $application)
    {
        DB::beginTransaction();
        try {
            $application->developer->update($request->validated('developer'));

            $application->fill($request->validated('application'));

            if ($application->isDirty()) {
                $this->auditLog->logModelChanges($application, 'update_application', 'Application updated by Clerk');
            }

            DB::commit();

            return redirect()->route('applications.show', $application)->with('success', 'Application Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()->with('error', 'Failed to update application: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        // Typically we soft delete or restrict this entirely.
        abort(403, 'Applications cannot be deleted. Instead, they should be rejected or filed.');
    }
}
