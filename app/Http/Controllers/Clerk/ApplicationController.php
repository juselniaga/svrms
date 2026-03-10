<?php

namespace App\Http\Controllers\Clerk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    // Step 1: Show form to check Developer
    public function create()
    {
        return view('clerk.applications.create-check');
    }

    // Process Step 1
    public function checkDeveloper(Request $request)
    {
        $request->validate(['developer_query' => 'required|string']);
        $query = $request->developer_query;
        
        $developers = \App\Models\Developer::where('email', $query)
            ->orWhere('name', 'like', "%{$query}%")
            ->get(); // Change from first() to get() to fetch multiple

        if ($developers->isNotEmpty()) {
            // Found one or more matching developers, show them on the same view
            return view('clerk.applications.create-check', compact('developers', 'query'));
        } else {
            // Not Exists => Goto Register Developer
            $isEmail = filter_var($query, FILTER_VALIDATE_EMAIL);
            $inputData = $isEmail ? ['email' => $query] : ['name' => $query];

            return redirect()->route('clerk.developers.create')
                             ->with('warning', 'Developer not found. Please register the developer first.')
                             ->withInput($inputData);
        }
    }

    // Step 2: Show Application form for known developer
    public function createDetails(\App\Models\Developer $developer)
    {
        $officers = \App\Models\User::where('role', \App\Enums\UserRole::Officer)->where('is_active', true)->get();
        return view('clerk.applications.create-details', compact('developer', 'officers'));
    }

    // Process Step 2
    public function store(Request $request, \App\Models\Developer $developer)
    {
        $validated = $request->validate([
            'application.tajuk' => 'required|string|max:255',
            'application.lokasi' => 'required|string',
            'application.no_fail' => 'required|string|max:100',
            'application.officer_id' => 'required|exists:users,user_id',
        ]);

        $year = now()->year;
        $count = \App\Models\Application::whereYear('created_at', $year)->count() + 1;
        $referenceNo = sprintf('SVRMS-%s-%04d', $year, $count);

        $application = new \App\Models\Application($validated['application']);
        $application->reference_no = $referenceNo;
        $application->status = 'RECORDED';
        $application->developer_id = $developer->developer_id;
        $application->save();

        return redirect()->route('clerk.dashboard')->with('success', 'Application registered successfully.');
    }

    // Step 3: Show Edit form for Application
    public function edit(\App\Models\Application $application)
    {
        $application->load('developer');
        $officers = \App\Models\User::where('role', \App\Enums\UserRole::Officer)->where('is_active', true)->get();
        return view('clerk.applications.edit', compact('application', 'officers'));
    }

    // Process Step 3: Update Application
    public function update(Request $request, \App\Models\Application $application)
    {
        $validated = $request->validate([
            'application.tajuk' => 'required|string|max:255',
            'application.lokasi' => 'required|string',
            'application.no_fail' => 'required|string|max:100',
            'application.officer_id' => 'required|exists:users,user_id',
        ]);

        $application->update($validated['application']);

        return redirect()->route('clerk.dashboard')->with('success', 'Application updated successfully.');
    }
}
