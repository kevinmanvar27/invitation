<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Template;
use App\Models\TemplateCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $templates = Template::paginate(10);
        return view('admin.templates.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = TemplateCategory::select('id', 'name')->get();
        return view('admin.templates.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:templates',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:template_categories,id',
            'theme' => 'nullable|string|max:255',
            'style' => 'nullable|string|max:255',
            'orientation' => 'required|in:portrait,landscape',
            'is_premium' => 'boolean',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        // Generate slug from name if not provided
        $slug = $request->slug ?: Str::slug($request->name);

        Template::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'theme' => $request->theme,
            'style' => $request->style,
            'orientation' => $request->orientation,
            'is_premium' => $request->is_premium ?? false,
            'price' => $request->price,
            'is_active' => $request->is_active ?? true,
            'thumbnail_path' => '', // Will be updated when thumbnail is uploaded
            'preview_path' => '', // Will be updated when preview is uploaded
            'template_data' => [], // Empty array as default
        ]);

        return redirect()->route('admin.templates.index')->with('success', 'Template created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Template $template)
    {
        return view('admin.templates.show', compact('template'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Template $template)
    {
        $categories = TemplateCategory::select('id', 'name')->get();
        return view('admin.templates.edit', compact('template', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Template $template)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:templates,slug,'.$template->id,
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:template_categories,id',
            'theme' => 'nullable|string|max:255',
            'style' => 'nullable|string|max:255',
            'orientation' => 'required|in:portrait,landscape',
            'is_premium' => 'boolean',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        $template->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'theme' => $request->theme,
            'style' => $request->style,
            'orientation' => $request->orientation,
            'is_premium' => $request->is_premium ?? false,
            'price' => $request->price,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('admin.templates.index')->with('success', 'Template updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Template $template)
    {
        $template->delete();
        return redirect()->route('admin.templates.index')->with('success', 'Template deleted successfully.');
    }
}