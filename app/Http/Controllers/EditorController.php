<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;

class EditorController extends Controller
{
    /**
     * Show the editor for a specific template.
     */
    public function show(Template $template)
    {
        return view('editor.show', compact('template'));
    }
}
