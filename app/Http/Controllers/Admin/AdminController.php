<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDesign;
use App\Models\Payment;
use App\Models\RsvpResponse;
use App\Models\PrintOrder;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    // Removed constructor as middleware is applied in routes file
    //

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Gather statistics for the dashboard
        $stats = [
            'users' => User::count(),
            'designs' => UserDesign::count(),
            'payments' => Payment::count(),
            'rsvp_responses' => RsvpResponse::count(),
            'print_orders' => PrintOrder::count(),
        ];

        // Get recent users (last 5)
        $recentUsers = User::latest()->take(5)->get();

        // Get recent orders (last 5)
        $recentOrders = PrintOrder::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentOrders'));
    }
}