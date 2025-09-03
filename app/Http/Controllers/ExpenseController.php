<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'employee_id' => 'nullable|exists:employees,id',
            'date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'receipt' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);
        $recent = auth()->user()->expenses()->where('employee_id', $request->employee_id)
            ->where('date', '>', now()->subWeeks(2))->exists();
        if ($recent) {
            return back()->with('warning', 'Recent payment detected!');
        }
        if ($request->hasFile('receipt')) {
            $validated['receipt_path'] = $request->file('receipt')->store('receipts', 'public');
        }
        auth()->user()->expenses()->create($validated);
        return redirect()->route('expenses.index')->with('success', 'Expense added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
