<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;

class ApprovalController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $baseQuery = Application::with('developer')->whereYear('created_at', date('Y'));

        // Stats calculation (same as assistant director)
        $allApps = $baseQuery->get();
        $stats = [
            'total' => $allApps->count(),
            'recorded' => $allApps->where('status', 'RECORDED')->count(),
            'in_progress' => $allApps->whereIn('status', ['SITE_VISIT_IN_PROGRESS', 'PENDING_VERIFICATION', 'VERIFIED', 'PENDING_APPROVAL'])->count(),
            'approved' => $allApps->where('status', 'APPROVED')->count(),
            'rejected' => $allApps->where('status', 'REJECTED')->count(),
            'late' => $allApps->filter(function ($app) {
                return $app->created_at->diffInDays(now()) > 14 && $app->status !== 'APPROVED' && $app->status !== 'REJECTED';
            })->count(),
        ];

        // Task Todo: Applications waiting for Director ACTION
        $tasksTodo = Application::with('developer', 'review', 'verification')
            ->where('status', 'VERIFIED')
            ->latest()
            ->get();

        // Searchable All Applications List
        $applications = Application::with('developer')
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
            ->paginate(10);

        return view('management.approval.index', compact('stats', 'tasksTodo', 'applications'));
    }

    public function show(Application $application)
    {
        $application->load(['developer', 'site', 'review.officer', 'siteVisits.officer', 'verification.assistantDirector']);
        return view('management.approval.show', compact('application'));
    }

    public function update(Request $request, Application $application)
    {
        if ($application->status !== 'VERIFIED') {
            abort(403, 'This application is not verified and ready for approval.');
        }

        $validated = $request->validate([
            'action' => 'required|in:APPROVED,RETURNED,REJECTED',
            'remarks' => 'required_if:action,RETURNED,REJECTED|nullable|string',
        ]);

        \Illuminate\Support\Facades\DB::transaction(function () use ($validated, $application) {
            
            // Format the decision string as requested
            $directorName = auth()->user()->name;
            $currentDate = now()->format('Y-m-d');
            $currentTime = now()->format('H:i:s');
            $decisionText = "{$application->reference_no}, approved by {$directorName}, {$currentDate} and {$currentTime} approved.";

            // Log the approval action
            $application->approval()->create([
                'director_id' => auth()->id(),
                'approval_status' => $validated['action'],
                'remarks' => $validated['remarks'],
                'decision' => $decisionText,
                'approved_at' => now(),
            ]);

            // Determine new application status
            $newStatus = $validated['action'];
            if ($validated['action'] === 'RETURNED') {
                $newStatus = 'SITE_VISIT_IN_PROGRESS'; // Send back to officer
            }

            // Update application status
            $application->status = $newStatus;
            $application->save();

            // Create Audit Trail
            $application->auditLogs()->create([
                'user_id' => auth()->id(),
                'action' => 'APPROVAL_' . $validated['action'],
                'description' => "Director updated status to {$newStatus}.",
                'remarks' => $validated['remarks'] ?? 'No remarks provided.',
                'created_at' => now()
            ]);
        });

        $message = match($validated['action']) {
            'APPROVED' => 'Application has been APPROVED successfully.',
            'RETURNED' => 'Application has been returned to the assigned Officer for amendment.',
            'REJECTED' => 'Application has been officially rejected.',
        };

        return redirect()->route('approval.dashboard')->with('success', $message);
    }
}
