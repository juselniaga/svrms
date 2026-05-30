<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mukim;
use Illuminate\Http\Request;

class MukimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $mukims = Mukim::query()
            ->when($search, function ($query, $search) {
                $query->where('mukim_no', 'like', "%{$search}%")
                    ->orWhere('mukim', 'like', "%{$search}%")
                    ->orWhere('short_mukm', 'like', "%{$search}%");
            })
            ->when($status !== null && $status !== '', function ($query, $status) {
                $query->where('status', (bool)$status);
            })
            ->latest()
            ->paginate(10);

        return view('admin.mukims.index', compact('mukims'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.mukims.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mukim_no' => 'required|string|unique:mukims,mukim_no',
            'short_mukim' => 'required|string|max:10',
            'mukim' => 'required|string|max:100',
            'status' => 'boolean',
        ]);

        Mukim::create($validated);

        return redirect()->route('admin.mukims.index')
            ->with('success', 'Mukim registered successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mukim $mukim)
    {
        return view('admin.mukims.show', compact('mukim'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mukim $mukim)
    {
        return view('admin.mukims.edit', compact('mukim'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mukim $mukim)
    {
        $validated = $request->validate([
            'mukim_no' => 'required|string|unique:mukims,mukim_no,' . $mukim->id,
            'short_mukm' => 'required|string|max:10',
            'mukim' => 'required|string|max:100',
            'status' => 'boolean',
        ]);

        $mukim->update($validated);

        return redirect()->route('admin.mukims.index')
            ->with('success', 'Mukim updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mukim $mukim)
    {
        $mukim->delete();

        return redirect()->route('admin.mukims.index')
            ->with('success', 'Mukim deleted successfully.');
    }
}
