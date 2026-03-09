<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApprovalRequest;
use App\Models\Application;
use App\Models\Approval;
use App\Services\AuditLogService;
use App\Services\StateMachineService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApprovalController extends Controller
{
    protected StateMachineService $stateMachine;

    protected AuditLogService $auditLog;

    public function __construct(StateMachineService $stateMachine, AuditLogService $auditLog)
    {
        $this->stateMachine = $stateMachine;
        $this->auditLog = $auditLog;
    }

    /**
     * Display a listing of applications pending Director approval.
     */
    public function index()
    {
        $applications = Application::with('developer')
            ->whereIn('status', ['PENDING_APPROVAL', 'APPROVED', 'REJECTED'])
            ->latest()
            ->paginate(15);

        return view('approvals.index', compact('applications'));
    }

    /**
     * Show the form for creating a new approval (Director logic).
     */
    public function create(Request $request)
    {
        $applicationId = $request->query('application_id');
        $application = Application::with(['siteVisits', 'reviews', 'verifications', 'developer'])->findOrFail($applicationId);

        if ($application->status !== 'PENDING_APPROVAL') {
            abort(403, 'Application is not ready for final approval.');
        }

        return view('approvals.create', compact('application'));
    }

    /**
     * Store a newly created approval in storage.
     */
    public function store(StoreApprovalRequest $request)
    {
        DB::beginTransaction();
        try {
            $application = Application::findOrFail($request->validated('application_id'));

            if ($application->status !== 'PENDING_APPROVAL') {
                abort(403, 'Invalid state for approval.');
            }

            $data = $request->validated();
            $data['director_id'] = Auth::id();

            $approval = Approval::create($data);

            // Transition based on decision
            $nextState = $data['decision'] === 'APPROVED' ? 'APPROVED' : 'REJECTED';

            $this->stateMachine->transitionTo(
                $application,
                $nextState,
                'Final Decision by Director '.Auth::user()->name.'. Decision: '.$data['decision']
            );

            DB::commit();

            return redirect()->route('applications.show', $application)->with('success', 'Final decision recorded successfully. Application is now '.$nextState);

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()->with('error', 'Error recording decision: '.$e->getMessage());
        }
    }

    /**
     * Display the specified approval.
     */
    public function show(Approval $approval)
    {
        $approval->load(['application.developer', 'director']);

        return view('approvals.show', compact('approval'));
    }

    /**
     * Show the form for editing (Not allowed for final approvals usually).
     */
    public function edit(Approval $approval)
    {
        abort(403, 'Final approvals cannot be edited.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Approval $approval)
    {
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Approval $approval)
    {
        abort(403);
    }
}
