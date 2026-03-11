<?php

namespace App\Http\Controllers;


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
     * Display the specified resource.
     */
    public function show(Application $application)
    {
        $application->load(['developer', 'site', 'auditLogs.user', 'officer']);

        return view('applications.show', compact('application'));
    }


}
