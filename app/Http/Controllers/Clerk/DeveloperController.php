<?php

namespace App\Http\Controllers\Clerk;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Developer;

class DeveloperController extends Controller
{
    public function create(Request $request)
    {
        $email = $request->old('email') ?? $request->query('email') ?? '';
        $name = $request->old('name') ?? $request->query('name') ?? '';
        return view('clerk.developers.create', compact('email', 'name'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:developers',
            'tel' => 'required|string|max:50',
            'address1' => 'required|string|max:255',
            'poskod' => 'required|string|max:10',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
        ]);

        $developer = Developer::create($validated);

        return redirect()->route('clerk.applications.create-details', $developer->developer_id)
                         ->with('success', 'Developer registered successfully! Now register the application.');
    }
}
