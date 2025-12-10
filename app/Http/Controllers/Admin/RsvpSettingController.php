<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RsvpSetting;
use App\Models\UserDesign;
use App\Models\User;
use Illuminate\Http\Request;

class RsvpSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rsvpSettings = RsvpSetting::with(['design', 'user'])->paginate(25);
        return view('admin.rsvp-settings.index', compact('rsvpSettings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $designs = UserDesign::all();
        $users = User::all();
        return view('admin.rsvp-settings.create', compact('designs', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'design_id' => 'required|exists:user_designs,id',
            'user_id' => 'required|exists:users,id',
            'rsvp_enabled' => 'boolean',
            'deadline' => 'nullable|date',
            'max_guests_per_invite' => 'nullable|integer|min:1',
            'collect_meal_preferences' => 'boolean',
            'custom_questions' => 'nullable|json',
        ]);

        RsvpSetting::create([
            'design_id' => $request->design_id,
            'user_id' => $request->user_id,
            'rsvp_enabled' => $request->boolean('rsvp_enabled'),
            'deadline' => $request->deadline,
            'max_guests_per_invite' => $request->max_guests_per_invite,
            'collect_meal_preferences' => $request->boolean('collect_meal_preferences'),
            'custom_questions' => $request->custom_questions ? json_decode($request->custom_questions, true) : null,
        ]);

        return redirect()->route('admin.rsvp-settings.index')
            ->with('success', 'RSVP setting created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RsvpSetting $rsvpSetting)
    {
        $rsvpSetting->load(['design', 'user']);
        return view('admin.rsvp-settings.show', compact('rsvpSetting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RsvpSetting $rsvpSetting)
    {
        $rsvpSetting->load(['design', 'user']);
        $designs = UserDesign::all();
        $users = User::all();
        return view('admin.rsvp-settings.edit', compact('rsvpSetting', 'designs', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RsvpSetting $rsvpSetting)
    {
        $request->validate([
            'design_id' => 'required|exists:user_designs,id',
            'user_id' => 'required|exists:users,id',
            'rsvp_enabled' => 'boolean',
            'deadline' => 'nullable|date',
            'max_guests_per_invite' => 'nullable|integer|min:1',
            'collect_meal_preferences' => 'boolean',
            'custom_questions' => 'nullable|json',
        ]);

        $rsvpSetting->update([
            'design_id' => $request->design_id,
            'user_id' => $request->user_id,
            'rsvp_enabled' => $request->boolean('rsvp_enabled'),
            'deadline' => $request->deadline,
            'max_guests_per_invite' => $request->max_guests_per_invite,
            'collect_meal_preferences' => $request->boolean('collect_meal_preferences'),
            'custom_questions' => $request->custom_questions ? json_decode($request->custom_questions, true) : null,
        ]);

        return redirect()->route('admin.rsvp-settings.index')
            ->with('success', 'RSVP setting updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RsvpSetting $rsvpSetting)
    {
        $rsvpSetting->delete();

        return redirect()->route('admin.rsvp-settings.index')
            ->with('success', 'RSVP setting deleted successfully.');
    }
}