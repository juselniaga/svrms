<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use \App\Models\Application;

class ReviewController extends Controller
{
    public function create(Application $application)
    {
        if ($application->officer_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this application.');
        }

        // Must be assigned to this officer, or allow them to take it
        $application->load(['developer', 'site', 'siteVisits.officer']);
        return view('officer.review.create', compact('application'));
    }

    public function store(Request $request, Application $application)
    {
        if ($application->officer_id !== auth()->id()) {
            abort(403, 'Unauthorized access to this application.');
        }

        $validated = $request->validate([
            'review_content' => 'required|string',
            'recommendation' => 'required|in:SUPPORTED,NOT_SUPPORTED',
            'self_check_1' => 'accepted',
            'self_check_2' => 'accepted',
            'self_check_3' => 'accepted',
        ]);

        \Illuminate\Support\Facades\DB::transaction(function () use ($validated, $application) {
            $application->review()->create([
                'officer_id' => auth()->id(),
                'review_content' => $validated['review_content'],
                'recommendation' => $validated['recommendation'],
                'self_check_completed' => true,
                'submitted_at' => now(),
            ]);

            $application->status = 'PENDING_VERIFICATION';
            $application->save();
        });

        return redirect()->route('officer.dashboard')->with('success', 'Review completed and application sent for verification.');
    }
}
