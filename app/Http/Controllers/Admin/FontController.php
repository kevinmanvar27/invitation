<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Font;
use Illuminate\Http\Request;

class FontController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fonts = Font::paginate(25);
        return view('admin.fonts.index', compact('fonts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.fonts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'font_family' => 'required|string|max:255',
            'file_path' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ]);

        Font::create([
            'name' => $request->name,
            'font_family' => $request->font_family,
            'file_path' => $request->file_path,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('admin.fonts.index')
            ->with('success', 'Font created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Font $font)
    {
        return view('admin.fonts.show', compact('font'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Font $font)
    {
        return view('admin.fonts.edit', compact('font'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Font $font)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'font_family' => 'required|string|max:255',
            'file_path' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ]);

        $font->update([
            'name' => $request->name,
            'font_family' => $request->font_family,
            'file_path' => $request->file_path,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('admin.fonts.index')
            ->with('success', 'Font updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Font $font)
    {
        $font->delete();

        return redirect()->route('admin.fonts.index')
            ->with('success', 'Font deleted successfully.');
    }
}