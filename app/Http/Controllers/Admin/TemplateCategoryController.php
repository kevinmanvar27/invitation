<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TemplateCategory;
use Illuminate\Http\Request;

class TemplateCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = TemplateCategory::with('parent')->withCount('templates')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = TemplateCategory::all();
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:template_categories',
            'parent_id' => 'nullable|exists:template_categories,id',
            'order' => 'nullable|integer',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        TemplateCategory::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
            'order' => $request->order ?? 0,
            'icon' => $request->icon,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TemplateCategory $category)
    {
        $category->load('parent', 'children', 'templates');
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TemplateCategory $category)
    {
        $categories = TemplateCategory::where('id', '!=', $category->id)->get();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TemplateCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:template_categories,slug,'.$category->id,
            'parent_id' => 'nullable|exists:template_categories,id',
            'order' => 'nullable|integer',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'parent_id' => $request->parent_id,
            'order' => $request->order ?? 0,
            'icon' => $request->icon,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TemplateCategory $category)
    {
        // Check if category has templates
        if ($category->templates()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Cannot delete category with associated templates. Please move or delete templates first.');
        }

        // Check if category has child categories
        if ($category->children()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Cannot delete category with child categories. Please move or delete child categories first.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}