<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BP;
use Illuminate\Http\Request;

class BPController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $bps = BP::query()
            ->when($search, function ($query, $search) {
                $query->where('id', 'like', "%{$search}%")
                    ->orWhere('bp_name', 'like', "%{$search}%")
                    ->orWhere('bp_short', 'like', "%{$search}%");
            })
            ->when($status !== null && $status !== '', function ($query, $status) {
                $query->where('status', (bool)$status);
            })
            ->latest()
            ->paginate(10);

        return view('admin.bps.index', compact('bps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.bps.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|string|unique:b_p_s,id',
            'bp_short' => 'required|string|max:10',
            'bp_name' => 'required|string|max:100',
            'status' => 'boolean',
        ]);

        BP::create($validated);

        return redirect()->route('admin.bps.index')
            ->with('success', 'Block Perancang registered successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BP $bp)
    {
        return view('admin.bps.show', compact('bp'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BP $bp)
    {
        return view('admin.bps.edit', compact('bp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BP $bp)
    {
        $validated = $request->validate([
            'id' => 'required|string|unique:b_p_s,id,' . $bp->id . ',id',
            'bp_short' => 'required|string|max:10',
            'bp_name' => 'required|string|max:100',
            'status' => 'boolean',
        ]);

        $bp->update($validated);

        return redirect()->route('admin.bps.index')
            ->with('success', 'Block Perancang updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BP $bp)
    {
        $bp->delete();

        return redirect()->route('admin.bps.index')
            ->with('success', 'Block Perancang deleted successfully.');
    }
}
