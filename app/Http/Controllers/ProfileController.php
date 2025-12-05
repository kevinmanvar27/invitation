<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\UserProfile;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile edit form.
     */
    public function edit()
    {
        $user = Auth::user();
        
        // Get or create user profile
        $userProfile = UserProfile::firstOrCreate(
            ['user_id' => $user->id],
            [
                'first_name' => $user->name,
                'last_name' => '',
                'phone' => '',
                'address' => '',
                'city' => '',
                'state' => '',
                'zip_code' => '',
                'country' => '',
                'bio' => '',
                'wedding_date' => null,
                'partner_name' => '',
                'preferences' => []
            ]
        );
        
        return view('profile.edit', compact('userProfile'));
    }
    
    /**
     * Update the user's profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $userProfile = UserProfile::firstOrCreate(['user_id' => $user->id]);
        
        $request->validate([
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
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $data = $request->only([
            'first_name', 'last_name', 'phone', 'address', 'city', 
            'state', 'zip_code', 'country', 'bio', 'wedding_date', 'partner_name'
        ]);
        
        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($userProfile->profile_picture) {
                Storage::disk('public')->delete($userProfile->profile_picture);
            }
            
            // Store new profile picture
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $data['profile_picture'] = $path;
        }
        
        $userProfile->update($data);
        
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
}