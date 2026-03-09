<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Application;
use App\Models\Review;
use App\Services\AuditLogService;
use App\Services\StateMachineService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    protected StateMachineService $stateMachine;

    protected AuditLogService $auditLog;

    public function __construct(StateMachineService $stateMachine, AuditLogService $auditLog)
    {
        $this->stateMachine = $stateMachine;
        $this->auditLog = $auditLog;
    }

    /**
     * Display a listing of site visits requiring review for the current officer.
     */
    public function index()
    {
        $applications = Application::with('developer')
            ->where('officer_id', Auth::id())
            ->whereIn('status', ['SITE_VISIT_IN_PROGRESS', 'REVIEW_COMPLETED'])
            ->latest()
            ->paginate(15);

        return view('reviews.index', compact('applications'));
    }

    /**
     * Show the form for creating a new review for an application.
     */
    public function create(Request $request)
    {
        $applicationId = $request->query('application_id');
        $application = Application::with('siteVisits', 'developer')->findOrFail($applicationId);

        if ($application->status !== 'SITE_VISIT_IN_PROGRESS') {
            abort(403, 'Application is not ready for review.');
        }

        return view('reviews.create', compact('application'));
    }

    /**
     * Store a newly created review in storage.
     */
    public function store(StoreReviewRequest $request)
    {
        DB::beginTransaction();
        try {
            $application = Application::findOrFail($request->validated('application_id'));

            if ($application->status !== 'SITE_VISIT_IN_PROGRESS') {
                abort(403, 'Invalid state for review submission.');
            }

            $data = $request->validated();
            $data['officer_id'] = Auth::id();
            $isSubmitted = $request->has('submit_review'); // Check if submitting vs saving draft
            $data['is_submitted'] = $isSubmitted;

            $review = Review::create($data);

            if ($isSubmitted) {
                $this->stateMachine->transitionTo(
                    $application,
                    'REVIEW_COMPLETED',
                    'Review completed by Officer '.Auth::user()->name.'. Recommendation: '.$data['recommendation']
                );
            }

            DB::commit();

            $msg = $isSubmitted ? 'Review submitted successfully.' : 'Review draft saved.';

            return redirect()->route('applications.show', $application)->with('success', $msg);

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()->with('error', 'Error saving review: '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        $review->load(['application.developer', 'officer']);

        return view('reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        // Only allow edits if still in progress and not submitted
        if ($review->is_submitted || $review->application->status !== 'SITE_VISIT_IN_PROGRESS') {
            abort(403, 'Cannot edit a submitted review.');
        }

        return view('reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        DB::beginTransaction();
        try {
            if ($review->is_submitted || $review->application->status !== 'SITE_VISIT_IN_PROGRESS') {
                abort(403, 'Cannot update a submitted review.');
            }

            $data = $request->validated();
            $isSubmitted = $request->has('submit_review');
            $data['is_submitted'] = $isSubmitted;

            $review->update($data);

            if ($isSubmitted) {
                $this->stateMachine->transitionTo(
                    $review->application,
                    'REVIEW_COMPLETED',
                    'Review completed by Officer '.Auth::user()->name.'. Recommendation: '.$data['recommendation']
                );
            }

            DB::commit();

            return redirect()->route('applications.show', $review->application)->with('success', 'Review updated.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withInput()->with('error', 'Error updating review: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        abort(403);
    }
}
