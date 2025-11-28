<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    /**
     * Show the admin login form
     */
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    /**
     * Handle admin login request
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            // Check if user is admin
            if (Auth::user()->isAdmin()) {
                return redirect()->intended('/admin');
            } else {
                // If not admin, logout and redirect to home with error
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                return back()->withErrors([
                    'email' => 'You do not have admin access.',
                ])->withInput($request->only('email'));
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }
}