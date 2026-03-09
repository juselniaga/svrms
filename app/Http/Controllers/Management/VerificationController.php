<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Application;

class VerificationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $baseQuery = Application::with('developer')->whereYear('created_at', date('Y'));

        // Stats calculation
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

        // Task Todo: Applications waiting for Verification Assistant Director action
        $tasksTodo = Application::with('developer', 'review')
            ->where('status', 'PENDING_VERIFICATION')
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
            ->paginate(10); // Use pagination for "All Applications" list

        return view('management.verification.index', compact('stats', 'tasksTodo', 'applications'));
    }

    public function show(Application $application)
    {
        $application->load(['developer', 'site', 'review.officer', 'siteVisits.officer']);
        return view('management.verification.show', compact('application'));
    }

    public function update(Request $request, Application $application)
    {
        if ($application->status !== 'PENDING_VERIFICATION') {
            abort(403, 'This application is not pending verification.');
        }

        $validated = $request->validate([
            'action' => 'required|in:VERIFIED,RETURNED,REJECTED',
            'remarks' => 'required_if:action,RETURNED,REJECTED|nullable|string',
        ]);

        \Illuminate\Support\Facades\DB::transaction(function () use ($validated, $application) {
            
            // Log the verification action
            $application->verification()->create([
                'assistant_director_id' => auth()->id(),
                'verification_status' => $validated['action'],
                'remarks' => $validated['remarks'],
                'verified_at' => now(),
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
                'action' => 'VERIFICATION_' . $validated['action'],
                'description' => "Assistant Director updated status to {$newStatus}.",
                'remarks' => $validated['remarks'] ?? 'No remarks provided.',
                'created_at' => now()
            ]);
        });

        $message = match($validated['action']) {
            'VERIFIED' => 'Application has been successfully verified and sent to the Director.',
            'RETURNED' => 'Application has been returned to the assigned Officer for amendment.',
            'REJECTED' => 'Application has been officially rejected.',
        };

        return redirect()->route('verification.dashboard')->with('success', $message);
    }
}
