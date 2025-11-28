<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SharedInvitation;
use Illuminate\Http\Request;

class SharedInvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sharedInvitations = SharedInvitation::with('user', 'design')->paginate(25);
        return view('admin.shared-invitations.index', compact('sharedInvitations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shared-invitations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'design_id' => 'required|exists:user_designs,id',
            'share_method' => 'required|string|max:50',
            'share_link' => 'required|string|max:500',
            'status' => 'required|in:active,inactive,expired',
        ]);

        SharedInvitation::create([
            'user_id' => $request->user_id,
            'design_id' => $request->design_id,
            'share_method' => $request->share_method,
            'share_link' => $request->share_link,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.shared-invitations.index')
            ->with('success', 'Shared invitation created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SharedInvitation $sharedInvitation)
    {
        $sharedInvitation->load('user', 'design');
        return view('admin.shared-invitations.show', compact('sharedInvitation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SharedInvitation $sharedInvitation)
    {
        return view('admin.shared-invitations.edit', compact('sharedInvitation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SharedInvitation $sharedInvitation)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'design_id' => 'required|exists:user_designs,id',
            'share_method' => 'required|string|max:50',
            'share_link' => 'required|string|max:500',
            'status' => 'required|in:active,inactive,expired',
        ]);

        $sharedInvitation->update([
            'user_id' => $request->user_id,
            'design_id' => $request->design_id,
            'share_method' => $request->share_method,
            'share_link' => $request->share_link,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.shared-invitations.index')
            ->with('success', 'Shared invitation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SharedInvitation $sharedInvitation)
    {
        $sharedInvitation->delete();

        return redirect()->route('admin.shared-invitations.index')
            ->with('success', 'Shared invitation deleted successfully.');
    }
}