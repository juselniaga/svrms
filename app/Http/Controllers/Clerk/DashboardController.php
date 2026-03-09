<?php

namespace App\Http\Controllers\Clerk;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $search = $request->input('search');

        $baseQuery = \App\Models\Application::with('developer')->whereYear('created_at', date('Y'));

        // Stats calculation 
        $allApps = $baseQuery->get();
        $stats = [
            'total' => $allApps->count(),
            'recorded' => $allApps->where('status', 'RECORDED')->count(),
            'in_progress' => $allApps->whereIn('status', ['SITE_VISIT_IN_PROGRESS', 'PENDING_VERIFICATION', 'VERIFIED', 'PENDING_APPROVAL'])->count(),
            'late' => $allApps->filter(function ($app) {
                return $app->created_at->diffInDays(now()) > 14 && $app->status !== 'APPROVED' && $app->status !== 'REJECTED' && $app->status !== 'FILED';
            })->count(),
        ];

        // Task Todo: Applications waiting for Clerk ACTION (Printing & Filing)
        $tasksTodo = \App\Models\Application::with(['developer', 'officer'])
            ->whereIn('status', ['APPROVED', 'REJECTED'])
            ->latest()
            ->get();
        
        // All Applications (Paginated & Searchable)
        $applications = \App\Models\Application::with(['developer', 'officer'])
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
        
        
        return view('clerk.dashboard', compact('applications', 'stats', 'tasksTodo'));
    }
}
