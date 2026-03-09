<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Application;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        // 1. Calculate the required statistics for the officer's view
        $total = Application::count();
        $pending = Application::whereIn('status', ['RECORDED', 'SITE_VISIT_IN_PROGRESS', 'REVIEW_COMPLETED', 'PENDING_VERIFICATION'])->count();
        $approved = Application::where('status', 'APPROVED')->count();
        $rejected = Application::where('status', 'REJECTED')->count();
        
        $fourteenDaysAgo = now()->subDays(14);
        $late = Application::where('created_at', '<', $fourteenDaysAgo)
                           ->whereNotIn('status', ['APPROVED', 'REJECTED'])
                           ->count();

        $stats = [
            'total' => $total,
            'pending' => $pending,
            'approved' => $approved,
            'rejected' => $rejected,
            'late' => $late,
        ];

        // 2. Fetch the Task Todo List
        // According to context and design, officers act on RECORDED or SITE_VISIT_IN_PROGRESS applications
        $applications = Application::with('developer', 'site')
            ->whereIn('status', ['RECORDED', 'SITE_VISIT_IN_PROGRESS'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('officer.dashboard', compact('stats', 'applications'));
    }
}
