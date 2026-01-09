<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserDesign;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class UserDesignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $designs = UserDesign::with('user')->paginate(10);
        return view('admin.designs.index', compact('designs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('admin.designs.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'design_name' => 'required|string|max:255',
            'is_completed' => 'boolean',
            'status' => 'required|string|max:50',
            'canvas_data' => 'nullable|string',
        ]);

        // Parse canvas_data if it's a JSON string
        $canvasData = null;
        if ($request->canvas_data) {
            $canvasData = json_decode($request->canvas_data, true);
            
            // Convert base64 images to file paths to reduce database size
            if ($canvasData && isset($canvasData['pages'])) {
                foreach ($canvasData['pages'] as $pageIndex => &$page) {
                    // Handle page background image
                    if (isset($page['background']['image']) && 
                        str_starts_with($page['background']['image'], 'data:image/')) {
                        $page['background']['image'] = $this->saveBase64Image(
                            $page['background']['image'], 
                            'backgrounds'
                        );
                    }
                    
                    // Handle element images
                    if (isset($page['elements'])) {
                        foreach ($page['elements'] as $elementIndex => &$element) {
                            if ($element['type'] === 'image' && 
                                isset($element['src']) && 
                                str_starts_with($element['src'], 'data:image/')) {
                                $element['src'] = $this->saveBase64Image(
                                    $element['src'], 
                                    'elements'
                                );
                            }
                            if ($element['type'] === 'frame' && 
                                isset($element['src']) && 
                                str_starts_with($element['src'], 'data:image/')) {
                                $element['src'] = $this->saveBase64Image(
                                    $element['src'], 
                                    'elements'
                                );
                            }
                        }
                    }
                }
            }
        }

        UserDesign::create([
            'user_id' => $request->user_id,
            'design_name' => $request->design_name,
            'canvas_data' => $canvasData,
            'is_completed' => $request->is_completed ?? false,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.designs.index')->with('success', 'Design created successfully.');
    }
    
    /**
     * Save base64 image to storage and return the public URL
     */
    private function saveBase64Image($base64String, $folder = 'designs')
    {
        try {
            // Extract the base64 data
            if (preg_match('/^data:image\/(\w+);base64,/', $base64String, $type)) {
                $base64String = substr($base64String, strpos($base64String, ',') + 1);
                $type = strtolower($type[1]); // jpg, png, gif
                
                // Decode base64
                $imageData = base64_decode($base64String);
                
                if ($imageData === false) {
                    return null;
                }
                
                // Generate unique filename
                $filename = $folder . '/' . uniqid() . '.' . $type;
                
                // Save to public storage
                Storage::disk('public')->put($filename, $imageData);
                
                // Return the public URL
                return asset('storage/' . $filename);
            }
            
            return null;
        } catch (\Exception $e) {
            Log::error('Failed to save base64 image: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Display the specified resource.
     * Route parameter: {design}
     */
    public function show(UserDesign $design)
    {
        $design->load('user', 'customization', 'sharedInvitations', 'downloads');
        return view('admin.designs.show', compact('design'));
    }

    /**
     * Show the form for editing the specified resource.
     * Route parameter: {design}
     */
    public function edit(UserDesign $design)
    {
        $users = User::all();
        return view('admin.designs.edit', compact('design', 'users'));
    }

    /**
     * Update the specified resource in storage.
     * Route parameter: {design}
     */
    public function update(Request $request, UserDesign $design)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'design_name' => 'required|string|max:255',
            'is_completed' => 'boolean',
            'status' => 'required|string|max:50',
            'canvas_data' => 'nullable|string',
        ]);

        // Parse canvas_data if it's a JSON string
        $canvasData = $design->canvas_data; // Keep existing if not provided
        if ($request->has('canvas_data') && $request->canvas_data) {
            $canvasData = json_decode($request->canvas_data, true);
            
            // Convert base64 images to file paths to reduce database size
            if ($canvasData && isset($canvasData['pages'])) {
                foreach ($canvasData['pages'] as $pageIndex => &$page) {
                    // Handle page background image
                    if (isset($page['background']['image']) && 
                        str_starts_with($page['background']['image'], 'data:image/')) {
                        $page['background']['image'] = $this->saveBase64Image(
                            $page['background']['image'], 
                            'backgrounds'
                        );
                    }
                    
                    // Handle element images
                    if (isset($page['elements'])) {
                        foreach ($page['elements'] as $elementIndex => &$element) {
                            if ($element['type'] === 'image' && 
                                isset($element['src']) && 
                                str_starts_with($element['src'], 'data:image/')) {
                                $element['src'] = $this->saveBase64Image(
                                    $element['src'], 
                                    'elements'
                                );
                            }
                            if ($element['type'] === 'frame' && 
                                isset($element['src']) && 
                                str_starts_with($element['src'], 'data:image/')) {
                                $element['src'] = $this->saveBase64Image(
                                    $element['src'], 
                                    'elements'
                                );
                            }
                        }
                    }
                }
            }
        }

        $design->update([
            'user_id' => $request->user_id,
            'design_name' => $request->design_name,
            'canvas_data' => $canvasData,
            'is_completed' => $request->is_completed ?? false,
            'status' => $request->status,
        ]);

        // Check if this is an AJAX request
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Design updated successfully.',
                'design' => $design
            ]);
        }

        return redirect()->route('admin.designs.index')->with('success', 'Design updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * Route parameter: {design}
     */
    public function destroy(UserDesign $design)
    {
        $design->delete();
        return redirect()->route('admin.designs.index')->with('success', 'Design deleted successfully.');
    }

    /**
     * Export designs to CSV.
     */
    public function export(Request $request)
    {
        $designs = UserDesign::with('user')->get();
        $filename = 'designs_' . date('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
        ];
        
        $callback = function() use ($designs) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Design Name', 'User', 'Status', 'Completed', 'Created At']);
            
            foreach ($designs as $design) {
                fputcsv($file, [
                    $design->id,
                    $design->design_name,
                    $design->user->name ?? 'N/A',
                    $design->status,
                    $design->is_completed ? 'Yes' : 'No',
                    $design->created_at
                ]);
            }
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    /**
     * Upload an image for use in the design editor.
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240', // Max 10MB
        ]);

        try {
            $image = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            // Store in public/uploads/design-images directory
            $path = $image->storeAs('uploads/design-images', $filename, 'public');
            
            // Return the public URL
            $url = asset('storage/' . $path);
            
            return response()->json([
                'success' => true,
                'url' => $url,
                'filename' => $filename
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload image: ' . $e->getMessage()
            ], 500);
        }
    }
}