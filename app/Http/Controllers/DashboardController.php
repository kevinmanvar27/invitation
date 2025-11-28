<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\UserDesign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index()
    {
        $recentTemplates = Template::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        $recentDesigns = UserDesign::where('user_id', Auth::id())
            ->orderBy('updated_at', 'desc')
            ->limit(6)
            ->get();

        return view('dashboard.index', compact('recentTemplates', 'recentDesigns'));
    }
}
