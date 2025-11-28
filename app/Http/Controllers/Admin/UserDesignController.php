<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserDesign;
use App\Models\User;
use App\Models\Template;
use Illuminate\Http\Request;

class UserDesignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $designs = UserDesign::with('user', 'template')->paginate(10);
        return view('admin.designs.index', compact('designs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $templates = Template::all();
        return view('admin.designs.create', compact('users', 'templates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'template_id' => 'required|exists:templates,id',
            'design_name' => 'required|string|max:255',
            'is_completed' => 'boolean',
            'status' => 'required|string|max:50',
        ]);

        UserDesign::create([
            'user_id' => $request->user_id,
            'template_id' => $request->template_id,
            'design_name' => $request->design_name,
            'is_completed' => $request->is_completed ?? false,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.designs.index')->with('success', 'Design created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserDesign $userDesign)
    {
        $userDesign->load('user', 'template', 'customization', 'sharedInvitations', 'downloads');
        return view('admin.designs.show', compact('userDesign'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserDesign $userDesign)
    {
        $users = User::all();
        $templates = Template::all();
        return view('admin.designs.edit', compact('userDesign', 'users', 'templates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserDesign $userDesign)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'template_id' => 'required|exists:templates,id',
            'design_name' => 'required|string|max:255',
            'is_completed' => 'boolean',
            'status' => 'required|string|max:50',
        ]);

        $userDesign->update([
            'user_id' => $request->user_id,
            'template_id' => $request->template_id,
            'design_name' => $request->design_name,
            'is_completed' => $request->is_completed ?? false,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.designs.index')->with('success', 'Design updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserDesign $userDesign)
    {
        $userDesign->delete();
        return redirect()->route('admin.designs.index')->with('success', 'Design deleted successfully.');
    }
}