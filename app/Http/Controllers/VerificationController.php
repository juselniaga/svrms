<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVerificationRequest;
use App\Models\Application;
use App\Models\Verification;
use App\Services\AuditLogService;
use App\Services\StateMachineService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VerificationController extends Controller
{
    protected StateMachineService $stateMachine;

    protected AuditLogService $auditLog;

    public function __construct(StateMachineService $stateMachine, AuditLogService $auditLog)
    {
        $this->stateMachine = $stateMachine;
        $this->auditLog = $auditLog;
    }

    /**
     * Display a listing of applications pending verification.
     */
    public function index()
    {
        $applications = Application::with('developer')
            ->whereIn('status', ['REVIEW_COMPLETED', 'PENDING_VERIFICATION', 'VERIFIED'])
            ->latest()
            ->paginate(15);

        return view('verifications.index', compact('applications'));
    }

    /**
     * Show the form for creating a new verification (Assistant Director logic).
     */
    public function create(Request $request)
    {
        $applicationId = $request->query('application_id');
        $application = Application::with(['siteVisits', 'reviews', 'developer'])->findOrFail($applicationId);

        if ($application->status !== 'REVIEW_COMPLETED') {
            abort(403, 'Application is not ready for verification.');
        }

        return view('verifications.create', compact('application'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVerificationRequest $request)
    {
        DB::beginTransaction();
        try {
            $application = Application::findOrFail($request->validated('application_id'));

            if ($application->status !== 'REVIEW_COMPLETED') {
                abort(403, 'Invalid state for verification.');
            }

            $data = $request->validated();
            $data['assistant_director_id'] = Auth::id();

            $verification = Verification::create($data);

            // Determine next state based on the Assistant Director's decision
            $nextState = $data['status'] === 'VERIFIED' ? 'PENDING_APPROVAL' : 'REJECTED';

            $this->stateMachine->transitionTo(
                $application,
                $nextState,
                'Verification completed by Asst. Director '.Auth::user()->name.'. Decision: '.$data['status'].'. Remarks: '.($data['remarks'] ?? 'None')
            );

            DB::commit();

            return redirect()->route('applications.show', $application)->with('success', 'Verification recorded successfully. Application moved to '.$nextState);

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()->with('error', 'Error recording verification: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Verification $verification)
    {
        $verification->load(['application.developer', 'assistantDirector']);

        return view('verifications.show', compact('verification'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Verification $verification)
    {
        abort(403, 'Verifications cannot be edited once submitted.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Verification $verification)
    {
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Verification $verification)
    {
        abort(403);
    }
}
