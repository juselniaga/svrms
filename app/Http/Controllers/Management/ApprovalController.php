<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;
use App\Services\ApprovalService;

class ApprovalController extends Controller
{
    protected ApprovalService $approvalService;

    public function __construct(ApprovalService $approvalService)
    {
        $this->approvalService = $approvalService;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $stats = $this->approvalService->calculateStats($search);
        $tasksTodo = $this->approvalService->getTasksTodo();
        $applications = $this->approvalService->getSearchableApplications($search);

        return view('management.approval.index', compact('stats', 'tasksTodo', 'applications'));
    }

    public function show(Application $application)
    {
        $application->load(['developer', 'site', 'review.officer', 'siteVisits.officer', 'verifications.assistantDirector']);
        return view('management.approval.show', compact('application'));
    }

    public function update(Request $request, Application $application)
    {
        $validated = $request->validate([
            'action' => 'required|in:APPROVED,RETURNED,REJECTED',
            'remarks_json' => 'nullable|json',
            'remark' => 'nullable|string',
        ]);

        $remarks = json_decode($validated['remarks_json'] ?? '[]', true);
        $finalRemark = $validated['remark'] ?? null;

        $this->approvalService->processApproval($application, $validated['action'], $remarks, $finalRemark);

        $message = $this->getSuccessMessage($validated['action'], count($remarks));
        return redirect()->route('approval.dashboard')->with('success', $message);
    }

    private function getSuccessMessage(string $action, int $remarkCount): string
    {
        return match($action) {
            'APPROVED' => "Application has been APPROVED successfully with {$remarkCount} remark(s).",
            'RETURNED' => "Application has been returned to the assigned Officer with {$remarkCount} remark(s).",
            'REJECTED' => "Application has been officially rejected with {$remarkCount} remark(s).",
        };
    }
}
