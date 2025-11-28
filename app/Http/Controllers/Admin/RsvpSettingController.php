<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RsvpSetting;
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
        return view('admin.rsvp-settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'setting_name' => 'required|string|max:255',
            'setting_value' => 'required|string',
            'description' => 'nullable|string',
        ]);

        RsvpSetting::create([
            'setting_name' => $request->setting_name,
            'setting_value' => $request->setting_value,
            'description' => $request->description,
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
        return view('admin.rsvp-settings.edit', compact('rsvpSetting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RsvpSetting $rsvpSetting)
    {
        $request->validate([
            'setting_name' => 'required|string|max:255',
            'setting_value' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $rsvpSetting->update([
            'setting_name' => $request->setting_name,
            'setting_value' => $request->setting_value,
            'description' => $request->description,
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