<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = UserProfile::with('user')->paginate(25);
        
        // Get statistics
        $totalProfiles = UserProfile::count();
        $completeProfiles = UserProfile::whereNotNull('wedding_date')
            ->whereNotNull('partner_name')
            ->count();
        $incompleteProfiles = $totalProfiles - $completeProfiles;
        
        // Calculate percentages
        $completePercentage = $totalProfiles > 0 ? round(($completeProfiles / $totalProfiles) * 100) : 0;
        $incompletePercentage = 100 - $completePercentage;
        
        return view('admin.user-profiles.index', compact('profiles', 'totalProfiles', 'completeProfiles', 'incompleteProfiles', 'completePercentage', 'incompletePercentage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::select('id', 'name', 'email')->get();
        return view('admin.user-profiles.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'bio' => 'nullable|string|max:1000',
            'wedding_date' => 'nullable|date',
            'partner_name' => 'nullable|string|max:255',
            'preferences' => 'nullable|array',
        ]);

        // Handle preferences properly to avoid double encoding
        $data = $request->except('preferences');
        if ($request->has('preferences')) {
            $data['preferences'] = $request->preferences;
        }

        UserProfile::create($data);

        return redirect()->route('admin.user-profiles.index')
            ->with('success', 'User profile created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserProfile $userProfile)
    {
        $userProfile->load('user');
        return view('admin.user-profiles.show', compact('userProfile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserProfile $userProfile)
    {
        $users = User::select('id', 'name', 'email')->get();
        return view('admin.user-profiles.edit', compact('userProfile', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserProfile $userProfile)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'bio' => 'nullable|string|max:1000',
            'wedding_date' => 'nullable|date',
            'partner_name' => 'nullable|string|max:255',
            'preferences' => 'nullable|array',
        ]);

        // Handle preferences properly to avoid double encoding
        $data = $request->except('preferences');
        if ($request->has('preferences')) {
            $data['preferences'] = $request->preferences;
        }

        $userProfile->update($data);

        return redirect()->route('admin.user-profiles.index')
            ->with('success', 'User profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProfile $userProfile)
    {
        $userProfile->delete();

        return redirect()->route('admin.user-profiles.index')
            ->with('success', 'User profile deleted successfully.');
    }
}