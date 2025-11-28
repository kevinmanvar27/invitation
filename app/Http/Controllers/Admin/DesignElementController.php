<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DesignElement;
use Illuminate\Http\Request;

class DesignElementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $elements = DesignElement::paginate(25);
        return view('admin.elements.index', compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.elements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:icon,graphic,border,background',
            'category' => 'required|string|max:100',
            'file_path' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ]);

        DesignElement::create([
            'name' => $request->name,
            'type' => $request->type,
            'category' => $request->category,
            'file_path' => $request->file_path,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('admin.elements.index')
            ->with('success', 'Design element created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DesignElement $designElement)
    {
        return view('admin.elements.show', compact('designElement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DesignElement $designElement)
    {
        return view('admin.elements.edit', compact('designElement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DesignElement $designElement)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:icon,graphic,border,background',
            'category' => 'required|string|max:100',
            'file_path' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ]);

        $designElement->update([
            'name' => $request->name,
            'type' => $request->type,
            'category' => $request->category,
            'file_path' => $request->file_path,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('admin.elements.index')
            ->with('success', 'Design element updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DesignElement $designElement)
    {
        $designElement->delete();

        return redirect()->route('admin.elements.index')
            ->with('success', 'Design element deleted successfully.');
    }
}