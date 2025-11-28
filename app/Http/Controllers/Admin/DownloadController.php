<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $downloads = Download::with('user', 'design')->paginate(25);
        return view('admin.downloads.index', compact('downloads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.downloads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'design_id' => 'required|exists:user_designs,id',
            'file_format' => 'required|string|max:10',
            'file_size' => 'required|integer|min:0',
            'ip_address' => 'required|ip',
        ]);

        Download::create([
            'user_id' => $request->user_id,
            'design_id' => $request->design_id,
            'file_format' => $request->file_format,
            'file_size' => $request->file_size,
            'ip_address' => $request->ip_address,
        ]);

        return redirect()->route('admin.downloads.index')
            ->with('success', 'Download record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Download $download)
    {
        $download->load('user', 'design');
        return view('admin.downloads.show', compact('download'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Download $download)
    {
        return view('admin.downloads.edit', compact('download'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Download $download)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'design_id' => 'required|exists:user_designs,id',
            'file_format' => 'required|string|max:10',
            'file_size' => 'required|integer|min:0',
            'ip_address' => 'required|ip',
        ]);

        $download->update([
            'user_id' => $request->user_id,
            'design_id' => $request->design_id,
            'file_format' => $request->file_format,
            'file_size' => $request->file_size,
            'ip_address' => $request->ip_address,
        ]);

        return redirect()->route('admin.downloads.index')
            ->with('success', 'Download record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Download $download)
    {
        $download->delete();

        return redirect()->route('admin.downloads.index')
            ->with('success', 'Download record deleted successfully.');
    }
}