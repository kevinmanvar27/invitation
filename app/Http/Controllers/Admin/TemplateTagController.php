<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TemplateTag;
use App\Models\TemplateCategory;
use Illuminate\Http\Request;

class TemplateTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = TemplateTag::with('category')->paginate(10);
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = TemplateCategory::all();
        return view('admin.tags.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:template_categories,id',
            'tag_name' => 'required|string|max:255',
        ]);

        TemplateTag::create([
            'category_id' => $request->category_id,
            'tag_name' => $request->tag_name,
        ]);

        return redirect()->route('admin.tags.index')->with('success', 'Tag created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $templateTag = TemplateTag::with('category')->findOrFail($id);
        return view('admin.tags.show', compact('templateTag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $templateTag = TemplateTag::with('category')->findOrFail($id);
        $categories = TemplateCategory::all();
        return view('admin.tags.edit', compact('templateTag', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:template_categories,id',
            'tag_name' => 'required|string|max:255',
        ]);

        $templateTag = TemplateTag::findOrFail($id);
        
        $templateTag->update([
            'category_id' => $request->category_id,
            'tag_name' => $request->tag_name,
        ]);

        return redirect()->route('admin.tags.index')->with('success', 'Tag updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $templateTag = TemplateTag::findOrFail($id);
        $templateTag->delete();
        return redirect()->route('admin.tags.index')->with('success', 'Tag deleted successfully.');
    }
}