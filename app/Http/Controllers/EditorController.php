<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\UserDesign;
use App\Models\UserDesignElement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditorController extends Controller
{
    /**
     * Show the editor for a specific template.
     */
    public function show(Template $template)
    {
        return view('editor.show', compact('template'));
    }
    
    /**
     * Save the user's design.
     */
    public function saveDesign(Request $request, Template $template)
    {
        $request->validate([
            'design_name' => 'required|string|max:255',
            'elements' => 'required|array',
        ]);
        
        // Create or update the user design
        $userDesign = UserDesign::create([
            'user_id' => Auth::id(),
            'template_id' => $template->id,
            'design_name' => $request->design_name,
            'is_completed' => false,
            'status' => 'draft',
        ]);
        
        // Save each design element
        foreach ($request->elements as $elementData) {
            UserDesignElement::create([
                'user_design_id' => $userDesign->id,
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
            'design_id' => $userDesign->id
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
