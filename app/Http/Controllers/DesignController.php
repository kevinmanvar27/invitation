<?php

namespace App\Http\Controllers;

use App\Models\UserDesign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesignController extends Controller
{
    /**
     * Display a listing of public designs.
     * Shows completed designs (status = 'completed')
     */
    public function index(Request $request)
    {
        $query = UserDesign::where('status', 'completed');
        
        // Filter by category if provided
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }
        
        // Search by name
        if ($request->filled('search')) {
            $query->where('design_name', 'like', '%' . $request->search . '%');
        }
        
        $designs = $query->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        
        // Get all unique categories for filter dropdown
        $categories = UserDesign::where('status', 'completed')
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->pluck('category')
            ->filter()
            ->values();
        
        // If no categories in DB, provide default categories
        if ($categories->isEmpty()) {
            $categories = collect([
                'wedding',
                'birthday',
                'anniversary',
                'baby-shower',
                'graduation',
                'corporate',
                'invitation',
                'event'
            ]);
        }
        
        return view('designs.index', compact('designs', 'categories'));
    }

    /**
     * Display the specified design.
     */
    public function show(UserDesign $design)
    {
        // Only show completed designs
        if ($design->status !== 'completed') {
            abort(404);
        }
        
        // Load user relationship
        $design->load('user');
        
        return view('designs.show', compact('design'));
    }

    /**
     * Use a template - creates a copy of the design for the authenticated user.
     */
    public function useTemplate(UserDesign $design)
    {
        // Only allow using completed designs as templates
        if ($design->status !== 'completed') {
            abort(404);
        }

        // Create a copy of the design for the current user
        $newDesign = UserDesign::create([
            'user_id' => Auth::id(),
            'category_id' => $design->category_id,
            'design_name' => $design->design_name . ' - My Copy',
            'category' => $design->category,
            'canvas_data' => $design->canvas_data, // Copy all canvas data including elements
            'thumbnail_path' => null, // User will generate their own thumbnail
            'is_completed' => false,
            'status' => 'draft',
        ]);

        // Redirect to the editor with the new design
        return redirect()->route('editor.show', $newDesign)
            ->with('success', 'Template copied successfully! You can now customize your design.');
    }
}
