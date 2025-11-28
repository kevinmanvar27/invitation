<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RsvpResponse;
use Illuminate\Http\Request;

class RsvpResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rsvpResponses = RsvpResponse::with('sharedInvitation.design', 'sharedInvitation.user')->paginate(25);
        return view('admin.rsvp-responses.index', compact('rsvpResponses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.rsvp-responses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'shared_invitation_id' => 'required|exists:shared_invitations,id',
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'nullable|email|max:255',
            'guest_phone' => 'nullable|string|max:20',
            'response' => 'required|in:attending,not_attending,maybe',
            'plus_ones_count' => 'required|integer|min:0',
            'meal_preference' => 'nullable|string|max:255',
            'special_requests' => 'nullable|string|max:500',
        ]);

        RsvpResponse::create([
            'shared_invitation_id' => $request->shared_invitation_id,
            'guest_name' => $request->guest_name,
            'guest_email' => $request->guest_email,
            'guest_phone' => $request->guest_phone,
            'response' => $request->response,
            'plus_ones_count' => $request->plus_ones_count,
            'meal_preference' => $request->meal_preference,
            'special_requests' => $request->special_requests,
        ]);

        return redirect()->route('admin.rsvp-responses.index')
            ->with('success', 'RSVP response created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RsvpResponse $rsvpResponse)
    {
        $rsvpResponse->load('sharedInvitation.design', 'sharedInvitation.user');
        return view('admin.rsvp-responses.show', compact('rsvpResponse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RsvpResponse $rsvpResponse)
    {
        return view('admin.rsvp-responses.edit', compact('rsvpResponse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RsvpResponse $rsvpResponse)
    {
        $request->validate([
            'shared_invitation_id' => 'required|exists:shared_invitations,id',
            'guest_name' => 'required|string|max:255',
            'guest_email' => 'nullable|email|max:255',
            'guest_phone' => 'nullable|string|max:20',
            'response' => 'required|in:attending,not_attending,maybe',
            'plus_ones_count' => 'required|integer|min:0',
            'meal_preference' => 'nullable|string|max:255',
            'special_requests' => 'nullable|string|max:500',
        ]);

        $rsvpResponse->update([
            'shared_invitation_id' => $request->shared_invitation_id,
            'guest_name' => $request->guest_name,
            'guest_email' => $request->guest_email,
            'guest_phone' => $request->guest_phone,
            'response' => $request->response,
            'plus_ones_count' => $request->plus_ones_count,
            'meal_preference' => $request->meal_preference,
            'special_requests' => $request->special_requests,
        ]);

        return redirect()->route('admin.rsvp-responses.index')
            ->with('success', 'RSVP response updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RsvpResponse $rsvpResponse)
    {
        $rsvpResponse->delete();

        return redirect()->route('admin.rsvp-responses.index')
            ->with('success', 'RSVP response deleted successfully.');
    }
}