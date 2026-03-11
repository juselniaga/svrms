<?php

namespace App\Http\Controllers;

use App\Models\SiteVisit;

class SiteVisitController extends Controller
{
    /**
     * Display the specified site visit.
     */
    public function show(SiteVisit $siteVisit)
    {
        $siteVisit->load(['application', 'officer']);

        return view('site_visits.show', compact('siteVisit'));
    }
}
