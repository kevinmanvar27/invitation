<?php

namespace App\Http\Controllers;

use App\Models\UserDesign;
use App\Models\UserDesignElement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditorController extends Controller
{
    /**
     * Show the editor for a specific design.
     */
    public function show(UserDesign $design)
    {
        // Ensure the user owns this design
        if ($design->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this design.');
        }
        
        // If design has canvas_data with elements, use template editor
        // This is for designs copied from templates
        if ($design->canvas_data && isset($design->canvas_data['elements']) && count($design->canvas_data['elements']) > 0) {
            return view('editor.template-editor', compact('design'));
        }
        
        return view('editor.show', compact('design'));
    }
    
    /**
     * Create a new blank design and redirect to editor.
     */
    public function create()
    {
        $userDesign = UserDesign::create([
            'user_id' => Auth::id(),
            'design_name' => 'Untitled Design',
            'is_completed' => false,
            'status' => 'draft',
        ]);
        
        return redirect()->route('editor.show', $userDesign);
    }
    
    /**
     * Save the user's design.
     */
    public function saveDesign(Request $request, UserDesign $design)
    {
        // Ensure the user owns this design
        if ($design->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this design.');
        }
        
        // Check if this is a canvas_data save (template editor) or elements save (old editor)
        if ($request->has('canvas_data')) {
            // Template editor save - save entire canvas_data
            $request->validate([
                'design_name' => 'sometimes|string|max:255',
                'canvas_data' => 'required|array',
            ]);
            
            $updateData = ['canvas_data' => $request->canvas_data];
            
            if ($request->has('design_name')) {
                $updateData['design_name'] = $request->design_name;
            }
            
            $design->update($updateData);
            
            return response()->json([
                'success' => true,
                'message' => 'Design saved successfully',
                'design_id' => $design->id
            ]);
        }
        
        // Old editor save - save individual elements
        $request->validate([
            'design_name' => 'sometimes|string|max:255',
            'elements' => 'required|array',
        ]);
        
        // Update design name if provided
        if ($request->has('design_name')) {
            $design->update(['design_name' => $request->design_name]);
        }
        
        // Delete existing elements and recreate
        $design->elements()->delete();
        
        // Save each design element
        foreach ($request->elements as $elementData) {
            UserDesignElement::create([
                'user_design_id' => $design->id,
                'element_type' => $elementData['type'],
                'content' => $elementData['content'] ?? null,
                'position_x' => $elementData['x'] ?? 0,
                'position_y' => $elementData['y'] ?? 0,
                'width' => $elementData['width'] ?? 100,
                'height' => $elementData['height'] ?? 100,
                'rotation' => $elementData['rotation'] ?? 0,
                'z_index' => $elementData['zIndex'] ?? 0,
                'styles' => $elementData['styles'] ?? null,
            ]);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'Design saved successfully',
            'design_id' => $design->id
        ]);
    }
    
    /**
     * Upload an image for the design.
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Store the image in the public/images/designs directory
        $path = $request->file('image')->store('images/designs', 'public');
        
        // Generate the full URL to the image
        $imageUrl = asset('storage/' . $path);
        
        return response()->json([
            'success' => true,
            'message' => 'Image uploaded successfully',
            'image_url' => $imageUrl
        ]);
    }
}
