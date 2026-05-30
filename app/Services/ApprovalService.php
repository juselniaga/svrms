<?php

namespace App\Services;

use App\Models\Application;

class ApprovalService
{
    protected StateMachineService $stateMachineService;
    protected AuditLogService $auditLogService;

    public function __construct(StateMachineService $stateMachineService, AuditLogService $auditLogService)
    {
        $this->stateMachineService = $stateMachineService;
        $this->auditLogService = $auditLogService;
    }

    /**
     * Calculate statistics for applications (total, recorded, in_progress, approved, rejected, late)
     */
    public function calculateStats(string $search = null): array
    {
        $baseQuery = Application::with('developer')->whereYear('created_at', date('Y'));

        $allApps = $baseQuery->get();

        return [
            'total' => $allApps->count(),
            'recorded' => $allApps->where('status', 'RECORDED')->count(),
            'in_progress' => $allApps->whereIn('status', [
                'SITE_VISIT_IN_PROGRESS',
                'PENDING_VERIFICATION',
                'VERIFIED',
                'PENDING_APPROVAL'
            ])->count(),
            'approved' => $allApps->where('status', 'APPROVED')->count(),
            'rejected' => $allApps->where('status', 'REJECTED')->count(),
            'late' => $allApps->filter(function ($app) {
                return $app->created_at->diffInDays(now()) > 14
                    && $app->status !== 'APPROVED'
                    && $app->status !== 'REJECTED';
            })->count(),
        ];
    }

    /**
     * Get applications awaiting director action (VERIFIED status)
     */
    public function getTasksTodo()
    {
        return Application::with('developer', 'review', 'verification')
            ->where('status', 'VERIFIED')
            ->latest()
            ->get();
    }

    /**
     * Get searchable list of applications with pagination
     */
    public function getSearchableApplications(string $search = null, int $page = 10)
    {
        return Application::with('developer')
            ->whereYear('created_at', date('Y'))
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('reference_no', 'like', "%{$search}%")
                        ->orWhere('tajuk', 'like', "%{$search}%")
                        ->orWhereHas('developer', function ($devQuery) use ($search) {
                            $devQuery->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->paginate($page);
    }

    /**
     * Format remarks array into remarks_history format with user metadata
     */
    public function formatRemarksHistory(array $remarks): array
    {
        return array_map(function ($remark) {
            return [
                'text' => $remark,
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
                'created_at' => now()->format('d M Y, H:i A'),
                'updated_at' => now()->format('d M Y, H:i A'),
            ];
        }, $remarks);
    }

    /**
     * Generate approval decision text
     */
    public function generateApprovalDecision(Application $app, string $action): string
    {
        $directorName = auth()->user()->name;
        $currentDate = now()->format('Y-m-d');
        $currentTime = now()->format('H:i:s');

        return "{$app->reference_no}, approved by {$directorName}, {$currentDate} and {$currentTime} {$action}.";
    }

    /**
     * Process approval: validate status, create approval record, update application status, create audit log
     */
    public function processApproval(Application $application, string $action, array $remarks, ?string $finalRemark = null): bool
    {
        // Check if application is VERIFIED or has a verified verification record
        $latestVerification = $application->verifications()->latest('created_at')->first();
        $canApprove = $application->status === 'VERIFIED' ||
                      ($latestVerification && in_array($latestVerification->verification_status, ['VERIFIED', 'REJECTED']));

        if (!$canApprove) {
            throw new \Exception('This application is not verified and ready for approval.');
        }

        \Illuminate\Support\Facades\DB::transaction(function () use ($application, $action, $remarks, $finalRemark) {
            // Format remarks with user metadata
            $remarksHistory = $this->formatRemarksHistory($remarks);
            $decisionText = $this->generateApprovalDecision($application, $action);

            // Create approval record
            $application->approval()->create([
                'director_id' => auth()->id(),
                'approval_status' => $action,
                'remarks' => $finalRemark ?? (count($remarks) > 0 ? $remarks[0] : null),
                'remarks_history' => count($remarksHistory) > 0 ? $remarksHistory : null,
                'decision' => $decisionText,
                'approved_at' => now(),
            ]);

            // Ensure application is marked as VERIFIED if not already
            if ($application->status !== 'VERIFIED') {
                $application->status = 'VERIFIED';
                $application->save();
            }

            // Determine new application status after approval action
            $newStatus = $action === 'RETURNED' ? 'SITE_VISIT_IN_PROGRESS' : $action;

            // Update application status to final state
            $application->status = $newStatus;
            $application->save();

            // Create audit log
            $remarksPreview = $finalRemark ?? (count($remarks) > 0
                ? implode('; ', array_slice($remarks, 0, 2))
                : 'No remarks provided.');

            $application->auditLogs()->create([
                'user_id' => auth()->id(),
                'action' => 'APPROVAL_' . $action,
                'description' => "Director updated status to {$newStatus}. Added " . count($remarks) . " remark(s). Final remark: " . ($finalRemark ? 'Yes' : 'No'),
                'remarks' => $remarksPreview,
                'created_at' => now()
            ]);
        });

        return true;
    }
}
