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
        $officerId = auth()->id();

        // 1. Calculate the required statistics for the officer's view
        $total = Application::where('officer_id', $officerId)->count();
        $pending = Application::where('officer_id', $officerId)->whereIn('status', ['RECORDED', 'SITE_VISIT_IN_PROGRESS', 'REVIEW_COMPLETED', 'PENDING_VERIFICATION'])->count();
        $approved = Application::where('officer_id', $officerId)->where('status', 'APPROVED')->count();
        $rejected = Application::where('officer_id', $officerId)->where('status', 'REJECTED')->count();
        
        $fourteenDaysAgo = now()->subDays(14);
        $late = Application::where('officer_id', $officerId)
                           ->where('created_at', '<', $fourteenDaysAgo)
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
            ->where('officer_id', $officerId)
            ->whereIn('status', ['RECORDED', 'SITE_VISIT_IN_PROGRESS'])
            ->orderBy('created_at', 'desc')
            ->get();

        // 3. Searchable All Applications List
        $search = $request->input('search');
        $allApplications = Application::with('developer', 'site')
            ->where('officer_id', $officerId)
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

        return view('officer.dashboard', compact('stats', 'applications', 'allApplications'));
    }
}
