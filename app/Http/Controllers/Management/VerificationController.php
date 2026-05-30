<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Verification;
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
        $application->load(['developer', 'site', 'review.officer', 'siteVisits.officer', 'verifications.assistantDirector']);
        return view('management.verification.show', compact('application'));
    }

    /**
     * Store a new verification
     */
    public function store(Request $request, Application $application)
    {
        if ($application->status !== 'PENDING_VERIFICATION') {
            abort(403, 'This application is not pending verification.');
        }

        $validated = $request->validate([
            'action' => 'required|in:VERIFIED,RETURNED,REJECTED',
            'remarks_json' => 'nullable|json',
        ]);

        $remarks = $validated['remarks_json'] ? json_decode($validated['remarks_json'], true) : [];

        // Validate that required actions have remarks
        if (in_array($validated['action'], ['RETURNED', 'REJECTED']) && empty($remarks)) {
            return redirect()->back()->withErrors(['remarks' => 'Remarks are required for this action']);
        }

        \Illuminate\Support\Facades\DB::transaction(function () use ($validated, $remarks, $application) {

            // Convert remarks array to remark_history format (with user metadata)
            $remarkHistory = [];
            foreach ($remarks as $remark) {
                $remarkHistory[] = [
                    'text' => $remark,
                    'user_id' => auth()->id(),
                    'user_name' => auth()->user()->name,
                    'created_at' => now()->format('d M Y, H:i A'),
                    'updated_at' => now()->format('d M Y, H:i A'),
                ];
            }

            // Create new verification record
            $application->verifications()->create([
                'assistant_director_id' => auth()->id(),
                'verification_status' => $validated['action'],
                'remarks' => count($remarks) > 0 ? $remarks[0] : null,
                'remark_history' => count($remarkHistory) > 0 ? $remarkHistory : null,
                'verified_at' => now(),
            ]);

            // Determine new application status based on last verification
            $lastVerification = $application->verifications()->latest()->first();
            $newStatus = 'VERIFIED';

            if ($lastVerification->verification_status === 'RETURNED') {
                $newStatus = 'SITE_VISIT_IN_PROGRESS'; // Send back to officer
            }

            // Update application status
            $application->status = $newStatus;
            $application->save();

            // Create Audit Trail
            $remarksPreview = count($remarks) > 0 ? implode('; ', array_slice($remarks, 0, 2)) : 'No remarks provided.';
            $application->auditLogs()->create([
                'user_id' => auth()->id(),
                'action' => 'VERIFICATION_' . $validated['action'],
                'description' => "Assistant Director added verification: {$validated['action']}. Added " . count($remarks) . " remark(s). Application status updated to {$newStatus}.",
                'remarks' => $remarksPreview,
                'created_at' => now()
            ]);
        });

        $message = match($validated['action']) {
            'VERIFIED' => 'Verification record created with ' . count($remarks) . ' remark(s) and application has been forwarded to the Director.',
            'RETURNED' => 'Verification record created with ' . count($remarks) . ' remark(s) and application has been returned to the Officer for amendment.',
            'REJECTED' => 'Verification record created with ' . count($remarks) . ' remark(s). Application sent to Director for final Rejection confirmation.',
        };

        return redirect()->back()->with('success', $message);
    }

    /**
     * Get verification details for editing (JSON response)
     */
    public function edit(Verification $verification)
    {
        return response()->json([
            'verify_id' => $verification->verify_id,
            'verification_status' => $verification->verification_status,
            'remarks' => $verification->remarks,
        ]);
    }

    /**
     * Update an existing verification
     */
    public function update(Request $request, Verification $verification)
    {
        $application = $verification->application;

        $validated = $request->validate([
            'action' => 'required|in:VERIFIED,RETURNED,REJECTED',
            'remarks' => 'required_if:action,RETURNED,REJECTED|nullable|string',
        ]);

        \Illuminate\Support\Facades\DB::transaction(function () use ($validated, $verification, $application) {

            // Update verification record
            $verification->update([
                'verification_status' => $validated['action'],
                'remarks' => $validated['remarks'],
                'verified_at' => now(),
            ]);

            // Determine new application status based on latest verification
            $latestVerification = $application->verifications()->latest()->first();
            $newStatus = 'VERIFIED';

            if ($latestVerification->verification_status === 'RETURNED') {
                $newStatus = 'SITE_VISIT_IN_PROGRESS';
            }

            // Update application status
            $application->status = $newStatus;
            $application->save();

            // Create Audit Trail
            $application->auditLogs()->create([
                'user_id' => auth()->id(),
                'action' => 'VERIFICATION_UPDATED',
                'description' => "Assistant Director updated verification to: {$validated['action']}. Application status updated to {$newStatus}.",
                'remarks' => $validated['remarks'] ?? 'No remarks provided.',
                'created_at' => now()
            ]);
        });

        $message = 'Verification record has been updated successfully.';
        return redirect()->back()->with('success', $message);
    }

    /**
     * Delete a verification record
     */
    public function destroy(Verification $verification)
    {
        $application = $verification->application;
        $verifyId = $verification->verify_id;

        \Illuminate\Support\Facades\DB::transaction(function () use ($verification, $application) {

            // Delete the verification record
            $verification->delete();

            // If this was the last verification, reset application status back to PENDING_VERIFICATION
            if ($application->verifications()->count() === 0) {
                $application->status = 'PENDING_VERIFICATION';
            } else {
                // Update application status based on remaining latest verification
                $latestVerification = $application->verifications()->latest()->first();
                $newStatus = 'VERIFIED';

                if ($latestVerification->verification_status === 'RETURNED') {
                    $newStatus = 'SITE_VISIT_IN_PROGRESS';
                }

                $application->status = $newStatus;
            }

            $application->save();

            // Create Audit Trail
            $application->auditLogs()->create([
                'user_id' => auth()->id(),
                'action' => 'VERIFICATION_DELETED',
                'description' => "Assistant Director deleted verification record #{$verifyId}. Application status updated to {$application->status}.",
                'remarks' => 'Verification record was deleted.',
                'created_at' => now()
            ]);
        });

        return redirect()->back()->with('success', 'Verification record has been deleted successfully.');
    }

    /**
     * Submit verified application to Director for approval
     */
    public function submitToApproval(Request $request, Application $application)
    {
        // Check if application is in VERIFIED status
        if ($application->status !== 'VERIFIED') {
            abort(403, 'Application must be VERIFIED before submitting to approval.');
        }

        // Check if latest verification is VERIFIED
        $latestVerification = $application->verifications()->latest()->first();
        if (!$latestVerification || $latestVerification->verification_status !== 'VERIFIED') {
            abort(403, 'Latest verification must have VERIFIED status.');
        }

        \Illuminate\Support\Facades\DB::transaction(function () use ($application) {
            // Update application status to PENDING_APPROVAL
            $application->status = 'PENDING_APPROVAL';
            $application->save();

            // Create Audit Trail
            $application->auditLogs()->create([
                'user_id' => auth()->id(),
                'action' => 'SUBMITTED_TO_APPROVAL',
                'description' => "Assistant Director submitted application to Director for final approval.",
                'remarks' => 'Application forwarded to approval stage.',
                'created_at' => now()
            ]);
        });

        return redirect()->route('verification.dashboard')
            ->with('success', 'Application has been successfully submitted to the Director for final approval.');
    }

    /**
     * Add a remark to a verification
     */
    public function addRemark(Request $request, Verification $verification)
    {
        $validated = $request->validate([
            'remark_text' => 'required|string|max:1000',
        ]);

        try {
            // Get current remarks history or create new array
            $remarks = $verification->remark_history ?? [];

            // Add new remark with user metadata
            $remarks[] = [
                'text' => $validated['remark_text'],
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
                'created_at' => now()->format('d M Y, H:i A'),
                'updated_at' => now()->format('d M Y, H:i A'),
            ];

            // Update verification
            $verification->remark_history = $remarks;
            $verification->save();

            // Create Audit Trail
            $verification->application->auditLogs()->create([
                'user_id' => auth()->id(),
                'action' => 'REMARK_ADDED',
                'description' => "Assistant Director added a remark to verification record.",
                'remarks' => $validated['remark_text'],
                'created_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Remark added successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error adding remark: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get a specific remark for editing
     */
    public function getRemark(Verification $verification, $index)
    {
        try {
            $remarks = $verification->remark_history ?? [];

            if (!isset($remarks[$index])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Remark not found'
                ], 404);
            }

            $remark = $remarks[$index];

            return response()->json([
                'success' => true,
                'remark' => $remark
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving remark: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update a remark in a verification
     */
    public function updateRemark(Request $request, Verification $verification)
    {
        $validated = $request->validate([
            'remark_index' => 'required|integer|min:0',
            'remark_text' => 'required|string|max:1000',
        ]);

        try {
            $remarks = $verification->remark_history ?? [];
            $index = $validated['remark_index'];

            if (!isset($remarks[$index])) {
                return redirect()->back()->with('error', 'Remark not found');
            }

            // Check if user is the one who created the remark
            $currentUserId = auth()->id();
            $remarkUserId = $remarks[$index]['user_id'] ?? null;

            if ($currentUserId !== $remarkUserId && auth()->user()->role !== 'Admin') {
                return redirect()->back()->with('error', 'You can only edit your own remarks');
            }

            // Update remark
            $remarks[$index]['text'] = $validated['remark_text'];
            $remarks[$index]['updated_at'] = now()->format('d M Y, H:i A');

            $verification->remark_history = $remarks;
            $verification->save();

            // Create Audit Trail
            $verification->application->auditLogs()->create([
                'user_id' => auth()->id(),
                'action' => 'REMARK_UPDATED',
                'description' => "Assistant Director updated a remark in verification record.",
                'remarks' => $validated['remark_text'],
                'created_at' => now()
            ]);

            return redirect()->back()->with('success', 'Remark updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating remark: ' . $e->getMessage());
        }
    }

    /**
     * Delete a remark from a verification
     */
    public function deleteRemark(Request $request, Verification $verification)
    {
        $validated = $request->validate([
            'remark_index' => 'required|integer|min:0',
        ]);

        try {
            $remarks = $verification->remark_history ?? [];
            $index = $validated['remark_index'];

            if (!isset($remarks[$index])) {
                return redirect()->back()->with('error', 'Remark not found');
            }

            // Check if user is the one who created the remark
            $currentUserId = auth()->id();
            $remarkUserId = $remarks[$index]['user_id'] ?? null;

            if ($currentUserId !== $remarkUserId && auth()->user()->role !== 'Admin') {
                return redirect()->back()->with('error', 'You can only delete your own remarks');
            }

            $deletedRemark = $remarks[$index]['text'] ?? $remarks[$index];
            unset($remarks[$index]);

            // Re-index array
            $remarks = array_values($remarks);

            $verification->remark_history = count($remarks) > 0 ? $remarks : null;
            $verification->save();

            // Create Audit Trail
            $verification->application->auditLogs()->create([
                'user_id' => auth()->id(),
                'action' => 'REMARK_DELETED',
                'description' => "Assistant Director deleted a remark from verification record.",
                'remarks' => "Deleted remark: " . substr($deletedRemark, 0, 100),
                'created_at' => now()
            ]);

            return redirect()->back()->with('success', 'Remark deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting remark: ' . $e->getMessage());
        }
    }
}
