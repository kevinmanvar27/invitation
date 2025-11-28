<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrintOrder;
use Illuminate\Http\Request;

class PrintOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $printOrders = PrintOrder::with('user', 'design')->paginate(25);
        return view('admin.print-orders.index', compact('printOrders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.print-orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'design_id' => 'required|exists:user_designs,id',
            'quantity' => 'required|integer|min:1',
            'paper_type' => 'required|string|max:50',
            'size' => 'required|string|max:50',
            'delivery_address' => 'required|string',
            'status' => 'required|in:pending,processing,printed,shipped,delivered',
        ]);

        PrintOrder::create([
            'user_id' => $request->user_id,
            'design_id' => $request->design_id,
            'quantity' => $request->quantity,
            'paper_type' => $request->paper_type,
            'size' => $request->size,
            'delivery_address' => $request->delivery_address,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.print-orders.index')
            ->with('success', 'Print order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PrintOrder $printOrder)
    {
        $printOrder->load('user', 'design');
        return view('admin.print-orders.show', compact('printOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrintOrder $printOrder)
    {
        return view('admin.print-orders.edit', compact('printOrder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrintOrder $printOrder)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'design_id' => 'required|exists:user_designs,id',
            'quantity' => 'required|integer|min:1',
            'paper_type' => 'required|string|max:50',
            'size' => 'required|string|max:50',
            'delivery_address' => 'required|string',
            'status' => 'required|in:pending,processing,printed,shipped,delivered',
        ]);

        $printOrder->update([
            'user_id' => $request->user_id,
            'design_id' => $request->design_id,
            'quantity' => $request->quantity,
            'paper_type' => $request->paper_type,
            'size' => $request->size,
            'delivery_address' => $request->delivery_address,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.print-orders.index')
            ->with('success', 'Print order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrintOrder $printOrder)
    {
        $printOrder->delete();

        return redirect()->route('admin.print-orders.index')
            ->with('success', 'Print order deleted successfully.');
    }
}