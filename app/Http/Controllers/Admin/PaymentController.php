<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with('user')->paginate(25);
        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.payments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:50',
            'gateway' => 'required|string|max:50',
            'status' => 'required|in:pending,completed,failed,refunded',
            'transaction_id' => 'required|string|max:255',
        ]);

        Payment::create([
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'gateway' => $request->gateway,
            'status' => $request->status,
            'transaction_id' => $request->transaction_id,
        ]);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        $payment->load('user');
        return view('admin.payments.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        return view('admin.payments.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:50',
            'gateway' => 'required|string|max:50',
            'status' => 'required|in:pending,completed,failed,refunded',
            'transaction_id' => 'required|string|max:255',
        ]);

        $payment->update([
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'gateway' => $request->gateway,
            'status' => $request->status,
            'transaction_id' => $request->transaction_id,
        ]);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment deleted successfully.');
    }
}