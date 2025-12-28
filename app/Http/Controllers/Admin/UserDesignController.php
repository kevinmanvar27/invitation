<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserDesign;
use App\Models\User;
use Illuminate\Http\Request;

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
        }

        $design->update([
            'user_id' => $request->user_id,
            'design_name' => $request->design_name,
            'canvas_data' => $canvasData,
            'is_completed' => $request->is_completed ?? false,
            'status' => $request->status,
        ]);

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
}