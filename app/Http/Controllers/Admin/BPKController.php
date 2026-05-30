<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BPK;
use App\Models\BP;
use Illuminate\Http\Request;

class BPKController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $bpks = BPK::with('bp')
            ->when($search, function ($query, $search) {
                $query->where('id', 'like', "%{$search}%")
                    ->orWhere('bpk_name', 'like', "%{$search}%")
                    ->orWhere('bpk_short', 'like', "%{$search}%");
            })
            ->when($status !== null && $status !== '', function ($query, $status) {
                $query->where('status', (bool)$status);
            })
            ->latest()
            ->paginate(10);

        return view('admin.bpks.index', compact('bpks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bps = BP::where('status', true)->get();
        return view('admin.bpks.create', compact('bps'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|string|unique:b_p_k_s,id',
            'bp_id' => 'required|string|exists:b_p_s,id',
            'bpk_short' => 'required|string|max:10',
            'bpk_name' => 'required|string|max:100',
            'status' => 'boolean',
        ]);

        BPK::create($validated);

        return redirect()->route('admin.bpks.index')
            ->with('success', 'Block Perancang Kecil registered successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BPK $bpk)
    {
        return view('admin.bpks.show', compact('bpk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BPK $bpk)
    {
        $bps = BP::where('status', true)->get();
        return view('admin.bpks.edit', compact('bpk', 'bps'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BPK $bpk)
    {
        $validated = $request->validate([
            'id' => 'required|string|unique:b_p_k_s,id,' . $bpk->id . ',id',
            'bp_id' => 'required|string|exists:b_p_s,id',
            'bpk_short' => 'required|string|max:10',
            'bpk_name' => 'required|string|max:100',
            'status' => 'boolean',
        ]);

        $bpk->update($validated);

        return redirect()->route('admin.bpks.index')
            ->with('success', 'Block Perancang Kecil updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BPK $bpk)
    {
        $bpk->delete();

        return redirect()->route('admin.bpks.index')
            ->with('success', 'Block Perancang Kecil deleted successfully.');
    }
}
