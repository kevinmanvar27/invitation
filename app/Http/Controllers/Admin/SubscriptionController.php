<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subscriptions = Subscription::with('user')->paginate(25);
        
        // Get statistics
        $totalSubscriptions = Subscription::count();
        $activeSubscriptions = Subscription::where('status', 'active')->count();
        $mrr = Subscription::where('status', 'active')->sum('price');
        
        // Calculate churn rate (simplified)
        $cancelledSubscriptions = Subscription::where('status', 'cancelled')->count();
        $churnRate = $totalSubscriptions > 0 ? round(($cancelledSubscriptions / $totalSubscriptions) * 100, 1) : 0;
        
        // Calculate average revenue per user
        $avgRevenue = $totalSubscriptions > 0 ? round($mrr / $totalSubscriptions, 2) : 0;
        
        return view('admin.subscriptions.index', compact('subscriptions', 'totalSubscriptions', 'activeSubscriptions', 'mrr', 'churnRate', 'avgRevenue'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subscriptions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'plan_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:active,inactive,cancelled',
            'auto_renewal' => 'boolean',
        ]);

        Subscription::create([
            'user_id' => $request->user_id,
            'plan_name' => $request->plan_name,
            'price' => $request->price,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'auto_renewal' => $request->auto_renewal ?? false,
        ]);

        return redirect()->route('admin.subscriptions.index')
            ->with('success', 'Subscription created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        $subscription->load('user');
        return view('admin.subscriptions.show', compact('subscription'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription)
    {
        // Fixed: Pass users and subscription to the view
        $users = User::all();
        return view('admin.subscriptions.edit', compact('subscription', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscription $subscription)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'plan_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:active,inactive,cancelled',
            'auto_renewal' => 'boolean',
        ]);

        $subscription->update([
            'user_id' => $request->user_id,
            'plan_name' => $request->plan_name,
            'price' => $request->price,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'auto_renewal' => $request->auto_renewal ?? false,
        ]);

        return redirect()->route('admin.subscriptions.index')
            ->with('success', 'Subscription updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return redirect()->route('admin.subscriptions.index')
            ->with('success', 'Subscription deleted successfully.');
    }
}