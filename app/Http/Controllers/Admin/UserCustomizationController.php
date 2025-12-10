<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserCustomization;
use App\Models\UserDesign;
use App\Models\User;
use Illuminate\Http\Request;

class UserCustomizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customizations = UserCustomization::with('design', 'user')->paginate(10);
        return view('admin.customizations.index', compact('customizations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $designs = UserDesign::all();
        $users = User::all();
        return view('admin.customizations.create', compact('designs', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'design_id' => 'required|exists:user_designs,id',
            'user_id' => 'required|exists:users,id',
            'bride_name' => 'nullable|string|max:255',
            'groom_name' => 'nullable|string|max:255',
            'wedding_date' => 'nullable|date',
            'wedding_time' => 'nullable|date_format:H:i',
            'venue' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:10',
            'wording_style' => 'nullable|string|max:50',
            'rsvp_enabled' => 'boolean',
            'rsvp_deadline' => 'nullable|date',
        ]);

        UserCustomization::create([
            'design_id' => $request->design_id,
            'user_id' => $request->user_id,
            'bride_name' => $request->bride_name,
            'groom_name' => $request->groom_name,
            'wedding_date' => $request->wedding_date,
            'wedding_time' => $request->wedding_time,
            'venue' => $request->venue,
            'language' => $request->language,
            'wording_style' => $request->wording_style,
            'rsvp_enabled' => $request->rsvp_enabled ?? false,
            'rsvp_deadline' => $request->rsvp_deadline,
        ]);

        return redirect()->route('admin.customizations.index')->with('success', 'Customization created successfully.');
    }

    /**
     * Display the specified resource.
     * Route parameter: {customization}
     */
    public function show(UserCustomization $customization)
    {
        $customization->load('design', 'user');
        return view('admin.customizations.show', compact('customization'));
    }

    /**
     * Show the form for editing the specified resource.
     * Route parameter: {customization}
     */
    public function edit(UserCustomization $customization)
    {
        $designs = UserDesign::all();
        $users = User::all();
        return view('admin.customizations.edit', compact('customization', 'designs', 'users'));
    }

    /**
     * Update the specified resource in storage.
     * Route parameter: {customization}
     */
    public function update(Request $request, UserCustomization $customization)
    {
        $request->validate([
            'design_id' => 'required|exists:user_designs,id',
            'user_id' => 'required|exists:users,id',
            'bride_name' => 'nullable|string|max:255',
            'groom_name' => 'nullable|string|max:255',
            'wedding_date' => 'nullable|date',
            'wedding_time' => 'nullable|date_format:H:i',
            'venue' => 'nullable|string|max:255',
            'language' => 'nullable|string|max:10',
            'wording_style' => 'nullable|string|max:50',
            'rsvp_enabled' => 'boolean',
            'rsvp_deadline' => 'nullable|date',
        ]);

        $customization->update([
            'design_id' => $request->design_id,
            'user_id' => $request->user_id,
            'bride_name' => $request->bride_name,
            'groom_name' => $request->groom_name,
            'wedding_date' => $request->wedding_date,
            'wedding_time' => $request->wedding_time,
            'venue' => $request->venue,
            'language' => $request->language,
            'wording_style' => $request->wording_style,
            'rsvp_enabled' => $request->rsvp_enabled ?? false,
            'rsvp_deadline' => $request->rsvp_deadline,
        ]);

        return redirect()->route('admin.customizations.index')->with('success', 'Customization updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * Route parameter: {customization}
     */
    public function destroy(UserCustomization $customization)
    {
        $customization->delete();
        return redirect()->route('admin.customizations.index')->with('success', 'Customization deleted successfully.');
    }
}