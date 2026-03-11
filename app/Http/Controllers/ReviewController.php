<?php

namespace App\Http\Controllers;

use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        $review->load(['application.developer', 'officer']);

        return view('reviews.show', compact('review'));
    }
}
