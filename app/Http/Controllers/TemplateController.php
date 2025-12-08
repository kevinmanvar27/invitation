<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $templates = Template::where('is_active', true)
            ->with('category') // Eager load category
            ->orderBy('downloads_count', 'desc')
            ->paginate(12);

        return view('templates.index', compact('templates'));
    }
}