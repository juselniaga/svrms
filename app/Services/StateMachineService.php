<?php

namespace App\Services;

use App\Models\Application;
use Exception;
use Illuminate\Support\Facades\DB;

class StateMachineService
{
    protected AuditLogService $auditLogService;

    // The rigid state flow as per context.md
    public const STATES = [
        'RECORDED',
        'SITE_VISIT_IN_PROGRESS',
        'REVIEW_COMPLETED',
        'PENDING_VERIFICATION',
        'VERIFIED',
        'PENDING_APPROVAL',
        'APPROVED',   // Terminal or branches to FILED
        'REJECTED',   // Terminal or branches to FILED
        'FILED',       // Terminal
    ];

    public function __construct(AuditLogService $auditLogService)
    {
        $this->auditLogService = $auditLogService;
    }

    /**
     * Get allowed next states for a given state.
     */
    public function getAllowedTransitions(string $currentState): array
    {
        return match ($currentState) {
            'RECORDED' => ['SITE_VISIT_IN_PROGRESS'],
            'SITE_VISIT_IN_PROGRESS' => ['REVIEW_COMPLETED'],
            'REVIEW_COMPLETED' => ['PENDING_VERIFICATION'],
            'PENDING_VERIFICATION' => ['VERIFIED', 'REVIEW_COMPLETED'], // Can return for amendment
            'VERIFIED' => ['PENDING_APPROVAL'],
            'PENDING_APPROVAL' => ['APPROVED', 'REJECTED'],
            'APPROVED', 'REJECTED' => ['FILED'],
            'FILED' => [], // Terminal state, cannot transition further
            default => []
        };
    }

    /**
     * Check if a transition is valid.
     */
    public function canTransition(Application $application, string $targetState): bool
    {
        $allowed = $this->getAllowedTransitions($application->status);

        return in_array($targetState, $allowed);
    }

    /**
     * Transition the application to a new state, enforcing rules and creating an audit log.
     * Use DB Transaction to guarantee atomic changes.
     */
    public function transitionTo(Application $application, string $targetState, ?string $remarks = null): Application
    {
        if (! $this->canTransition($application, $targetState)) {
            throw new Exception("Invalid state transition from {$application->status} to {$targetState}");
        }

        DB::beginTransaction();

        try {
            $previousState = $application->status;

            // 1. Update the Application Model
            $application->status = $targetState;
            // Get original/changes before save
            $original = $application->getOriginal();
            $application->save();
            $changes = $application->getChanges();

            // 2. Perform snapshot differencing
            $snapshotOld = [];
            $snapshotNew = [];
            foreach ($changes as $key => $value) {
                if (array_key_exists($key, $original)) {
                    $snapshotOld[$key] = $original[$key];
                    $snapshotNew[$key] = $value;
                }
            }

            // 3. Log the transition
            $this->auditLogService->logTransition(
                $application,
                'status_transition',
                $previousState,
                $targetState,
                $snapshotOld,
                $snapshotNew,
                $remarks ?? "Status changed to {$targetState}"
            );

            DB::commit();

            return $application;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
