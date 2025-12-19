<x-admin-layout>
    <x-slot name="header">
        <nav aria-label="Breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.designs.index') }}">User Designs</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Design</li>
            </ol>
        </nav>
    </x-slot>

    @push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Great+Vibes&display=swap" rel="stylesheet">
    <style>
        /* FULL SCREEN EDITOR - Hide admin layout */
        .admin-sidebar,
        .admin-navbar,
        .page-header,
        .breadcrumb {
            display: none !important;
        }
        
        .admin-main {
            margin-left: 0 !important;
            padding-top: 0 !important;
        }
        
        .admin-content {
            padding: 0 !important;
            height: 100vh !important;
            overflow: hidden;
        }
        
        body {
            overflow: hidden;
        }

        /* Editor Layout */
        .editor-wrapper {
            display: flex;
            height: 100vh;
            width: 100vw;
            background: var(--neutral-100);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999;
        }

        /* Left Sidebar - Tools */
        .editor-sidebar {
            width: 72px;
            background: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 16px 0;
            border-right: 1px solid var(--neutral-200);
            position: relative;
            z-index: 101;
        }
        
        .sidebar-tools-group {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar-logo {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 24px;
        }

        .sidebar-tool {
            width: 48px;
            height: 48px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: var(--neutral-500);
            cursor: pointer;
            border-radius: var(--radius-md);
            margin-bottom: 8px;
            transition: var(--transition-fast);
            font-size: 10px;
            gap: 4px;
        }

        .sidebar-tool:hover {
            background: var(--primary-50);
            color: var(--primary-600);
        }

        .sidebar-tool.active {
            background: var(--primary-500);
            color: #fff;
        }

        .sidebar-tool i {
            font-size: 18px;
        }

        /* Properties Panel */
        .properties-panel {
            width: 0;
            min-width: 0;
            background: #fff;
            border-right: 1px solid var(--neutral-200);
            display: flex;
            flex-direction: column;
            overflow: hidden;
            transition: width 0.3s ease, min-width 0.3s ease, opacity 0.3s ease;
            position: absolute;
            left: 72px;
            top: 0;
            bottom: 0;
            z-index: 100;
            opacity: 0;
            pointer-events: none;
        }
        
        .properties-panel.visible {
            width: 300px;
            min-width: 300px;
            opacity: 1;
            pointer-events: auto;
            box-shadow: var(--shadow-lg);
        }
        
        .properties-panel .panel-content {
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.2s ease 0.1s, visibility 0.2s ease 0.1s;
        }
        
        .properties-panel.visible .panel-content {
            opacity: 1;
            visibility: visible;
        }

        .panel-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--neutral-200);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            background: var(--neutral-50);
        }

        .panel-title {
            color: var(--neutral-800);
            font-weight: 600;
            font-size: 14px;
        }

        .panel-content {
            flex: 1;
            overflow-y: auto;
            padding: 16px;
        }

        .panel-section {
            margin-bottom: 20px;
        }

        .panel-section-title {
            color: var(--neutral-500);
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            color: var(--neutral-700);
            font-size: 12px;
            font-weight: 500;
            margin-bottom: 6px;
            display: block;
        }

        .editor-wrapper .form-control,
        .editor-wrapper .form-select {
            background: #fff;
            border: 1px solid var(--neutral-300);
            color: var(--neutral-800);
            font-size: 13px;
            padding: 10px 12px;
            border-radius: var(--radius-md);
        }

        .editor-wrapper .form-control:focus,
        .editor-wrapper .form-select:focus {
            background: #fff;
            border-color: var(--primary-500);
            color: var(--neutral-800);
            box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.15);
        }

        /* Canvas Area */
        .canvas-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: var(--neutral-100);
            overflow: hidden;
            position: relative;
        }

        /* Top Toolbar */
        .editor-top-toolbar {
            height: 52px;
            background: #fff;
            border-bottom: 1px solid var(--neutral-200);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        .toolbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .toolbar-center {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .toolbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .toolbar-btn {
            height: 36px;
            padding: 0 14px;
            border-radius: var(--radius-md);
            border: 1px solid var(--neutral-300);
            background: #fff;
            color: var(--neutral-600);
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: var(--transition-fast);
        }

        .toolbar-btn:hover {
            background: var(--neutral-100);
            color: var(--neutral-800);
            border-color: var(--neutral-400);
        }

        .toolbar-btn.back-btn {
            background: var(--neutral-800);
            border-color: var(--neutral-800);
            color: #fff;
            text-decoration: none;
        }

        .toolbar-btn.back-btn:hover {
            background: var(--neutral-700);
            border-color: var(--neutral-700);
            color: #fff;
        }

        .toolbar-btn.primary {
            background: var(--primary-500);
            border-color: var(--primary-500);
            color: #fff;
        }

        .toolbar-btn.primary:hover {
            background: var(--primary-600);
            border-color: var(--primary-600);
        }

        .toolbar-divider {
            width: 1px;
            height: 24px;
            background: var(--neutral-300);
        }

        /* Text Formatting Toolbar */
        .format-toolbar {
            height: 48px;
            background: var(--neutral-50);
            border-bottom: 1px solid var(--neutral-200);
            display: none;
            align-items: center;
            padding: 0 20px;
            gap: 8px;
        }

        .format-toolbar.active {
            display: flex;
        }

        .format-btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--neutral-300);
            border-radius: var(--radius-sm);
            background: #fff;
            color: var(--neutral-600);
            cursor: pointer;
            transition: var(--transition-fast);
        }

        .format-btn:hover {
            background: var(--primary-50);
            color: var(--primary-600);
            border-color: var(--primary-300);
        }

        .format-btn.active {
            background: var(--primary-500);
            color: #fff;
            border-color: var(--primary-500);
        }

        .format-select {
            height: 32px;
            padding: 0 10px;
            border: 1px solid var(--neutral-300);
            border-radius: var(--radius-sm);
            background: #fff;
            color: var(--neutral-700);
            font-size: 13px;
            cursor: pointer;
        }

        .format-select:focus {
            outline: none;
            border-color: var(--primary-500);
        }

        .format-input {
            width: 60px;
            height: 32px;
            padding: 0 8px;
            border: 1px solid var(--neutral-300);
            border-radius: var(--radius-sm);
            background: #fff;
            color: var(--neutral-700);
            font-size: 13px;
            text-align: center;
        }

        .format-input:focus {
            outline: none;
            border-color: var(--primary-500);
        }

        .color-picker-wrapper {
            position: relative;
            width: 32px;
            height: 32px;
        }

        .color-picker {
            width: 32px;
            height: 32px;
            padding: 0;
            border: 1px solid var(--neutral-300);
            border-radius: var(--radius-sm);
            cursor: pointer;
            background: transparent;
        }

        .color-picker::-webkit-color-swatch-wrapper {
            padding: 2px;
        }

        .color-picker::-webkit-color-swatch {
            border: none;
            border-radius: 4px;
        }

        /* Canvas Workspace */
        .canvas-workspace {
            flex: 1;
            overflow: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: var(--neutral-200);
            background-image: 
                linear-gradient(45deg, var(--neutral-300) 25%, transparent 25%),
                linear-gradient(-45deg, var(--neutral-300) 25%, transparent 25%),
                linear-gradient(45deg, transparent 75%, var(--neutral-300) 75%),
                linear-gradient(-45deg, transparent 75%, var(--neutral-300) 75%);
            background-size: 20px 20px;
            background-position: 0 0, 0 10px, 10px -10px, -10px 0px;
        }

        .design-canvas {
            width: 800px;
            height: 600px;
            background: #fff;
            box-shadow: var(--shadow-xl);
            position: relative;
            transform-origin: center center;
            border-radius: var(--radius-sm);
        }

        /* Canvas Elements */
        .canvas-element {
            position: absolute;
            cursor: move;
            user-select: none;
            border: 2px solid transparent;
            transition: border-color 0.15s ease;
        }

        .canvas-element:hover {
            border-color: var(--primary-300);
        }

        .canvas-element.selected {
            border-color: var(--primary-500);
        }

        .canvas-element.dragging {
            opacity: 0.8;
            cursor: grabbing !important;
            z-index: 1000;
        }

        .canvas-element.text-element {
            padding: 8px 12px;
            min-width: 100px;
            min-height: 30px;
            outline: none;
        }

        .canvas-element.text-element:focus {
            outline: none;
            border-color: var(--primary-500);
            cursor: text;
            user-select: text;
        }

        .canvas-element.image-element {
            overflow: hidden;
        }

        .canvas-element.image-element img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            pointer-events: none;
        }

        /* Resize Handles */
        .resize-handle {
            position: absolute;
            width: 10px;
            height: 10px;
            background: #fff;
            border: 2px solid var(--primary-500);
            border-radius: 2px;
            z-index: 10;
        }

        .resize-handle.nw { top: -5px; left: -5px; cursor: nw-resize; }
        .resize-handle.ne { top: -5px; right: -5px; cursor: ne-resize; }
        .resize-handle.sw { bottom: -5px; left: -5px; cursor: sw-resize; }
        .resize-handle.se { bottom: -5px; right: -5px; cursor: se-resize; }
        .resize-handle.n { top: -5px; left: 50%; transform: translateX(-50%); cursor: n-resize; }
        .resize-handle.s { bottom: -5px; left: 50%; transform: translateX(-50%); cursor: s-resize; }
        .resize-handle.e { right: -5px; top: 50%; transform: translateY(-50%); cursor: e-resize; }
        .resize-handle.w { left: -5px; top: 50%; transform: translateY(-50%); cursor: w-resize; }

        /* Layers Panel */
        .layers-panel {
            width: 260px;
            background: #fff;
            border-left: 1px solid var(--neutral-200);
            display: flex;
            flex-direction: column;
        }

        .layer-item {
            display: flex;
            align-items: center;
            padding: 10px 16px;
            border-bottom: 1px solid var(--neutral-100);
            cursor: pointer;
            transition: var(--transition-fast);
            gap: 10px;
        }

        .layer-item:hover {
            background: var(--neutral-50);
        }

        .layer-item.selected {
            background: var(--primary-50);
            border-left: 3px solid var(--primary-500);
        }

        .layer-icon {
            width: 32px;
            height: 32px;
            background: var(--neutral-100);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--neutral-500);
            font-size: 14px;
            flex-shrink: 0;
        }

        .layer-item.selected .layer-icon {
            background: var(--primary-100);
            color: var(--primary-600);
        }

        .layer-info {
            flex: 1;
            min-width: 0;
        }

        .layer-name {
            font-size: 13px;
            font-weight: 500;
            color: var(--neutral-800);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .layer-type {
            font-size: 11px;
            color: var(--neutral-500);
        }

        .layer-actions {
            display: flex;
            gap: 4px;
            opacity: 0;
            transition: var(--transition-fast);
        }

        .layer-item:hover .layer-actions {
            opacity: 1;
        }

        .layer-action-btn {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: transparent;
            color: var(--neutral-400);
            cursor: pointer;
            border-radius: var(--radius-sm);
            font-size: 12px;
        }

        .layer-action-btn:hover {
            background: var(--neutral-200);
            color: var(--neutral-700);
        }

        .layer-action-btn.danger:hover {
            background: var(--danger-light);
            color: var(--danger);
        }

        .empty-layers {
            padding: 40px 20px;
            text-align: center;
            color: var(--neutral-400);
        }

        .empty-layers i {
            font-size: 48px;
            margin-bottom: 16px;
            color: var(--neutral-300);
        }

        .empty-layers p {
            font-size: 13px;
            line-height: 1.6;
        }

        /* Modal Styling */
        .modal-content {
            background: #fff;
            border: none;
            border-radius: var(--radius-lg);
        }

        .modal-header {
            background: var(--neutral-50);
            border-bottom: 1px solid var(--neutral-200);
            padding: 16px 20px;
            border-radius: var(--radius-lg) var(--radius-lg) 0 0;
        }

        .modal-title {
            color: var(--neutral-800);
            font-weight: 600;
        }

        .modal-body {
            padding: 24px;
        }

        .upload-area {
            border: 2px dashed var(--neutral-300);
            border-radius: var(--radius-lg);
            padding: 40px;
            text-align: center;
            cursor: pointer;
            transition: var(--transition-fast);
            background: var(--neutral-50);
        }

        .upload-area:hover {
            border-color: var(--primary-500);
            background: var(--primary-50);
        }

        .upload-area i {
            font-size: 48px;
            color: var(--primary-500);
            margin-bottom: 16px;
        }

        .upload-area p {
            color: var(--neutral-600);
            margin-bottom: 8px;
        }

        .upload-area span {
            color: var(--primary-600);
            font-weight: 500;
        }
        
        .upload-area.drag-over {
            border-color: var(--primary-500);
            background: var(--primary-100);
        }

        /* Zoom Controls */
        .zoom-controls {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--neutral-100);
            padding: 4px 10px;
            border-radius: var(--radius-md);
            border: 1px solid var(--neutral-300);
        }

        .zoom-level {
            color: var(--neutral-700);
            font-size: 12px;
            font-weight: 500;
            min-width: 45px;
            text-align: center;
        }

        /* Custom scrollbar */
        .panel-content::-webkit-scrollbar,
        .canvas-workspace::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .panel-content::-webkit-scrollbar-track,
        .canvas-workspace::-webkit-scrollbar-track {
            background: var(--neutral-100);
        }

        .panel-content::-webkit-scrollbar-thumb,
        .canvas-workspace::-webkit-scrollbar-thumb {
            background: var(--neutral-300);
            border-radius: 4px;
        }

        .panel-content::-webkit-scrollbar-thumb:hover,
        .canvas-workspace::-webkit-scrollbar-thumb:hover {
            background: var(--neutral-400);
        }

        /* Layer Reorder Buttons */
        .layer-reorder-btns {
            display: flex;
            flex-direction: column;
            gap: 2px;
            margin-right: 4px;
        }

        .layer-reorder-btn {
            width: 18px;
            height: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: transparent;
            color: var(--neutral-400);
            cursor: pointer;
            border-radius: 2px;
            font-size: 9px;
            padding: 0;
        }

        .layer-reorder-btn:hover {
            background: var(--neutral-200);
            color: var(--neutral-700);
        }

        /* Bring to Front / Send to Back buttons in layer actions */
        .layer-order-btns {
            display: flex;
            gap: 2px;
            margin-right: 4px;
        }

        .layer-order-btn {
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: transparent;
            color: var(--neutral-400);
            cursor: pointer;
            border-radius: var(--radius-sm);
            font-size: 10px;
        }

        .layer-order-btn:hover {
            background: var(--primary-50);
            color: var(--primary-600);
        }

        /* Design title in toolbar */
        .design-title-display {
            color: var(--neutral-600);
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .design-title-display i {
            color: var(--primary-500);
        }
    </style>
    @endpush

    <div class="editor-wrapper">
        <!-- Left Sidebar - Tools -->
        <div class="editor-sidebar" id="editorSidebar">
            <div class="sidebar-logo">
                <i class="fas fa-gem" style="font-size: 16px;"></i>
            </div>
            
            <!-- Tools group - hover on these shows properties panel -->
            <div class="sidebar-tools-group" id="sidebarToolsGroup">
                <div class="sidebar-tool active" data-tool="select" title="Select">
                    <i class="fas fa-mouse-pointer"></i>
                    <span>Select</span>
                </div>
                
                <div class="sidebar-tool" data-tool="text" title="Add Text">
                    <i class="fas fa-font"></i>
                    <span>Text</span>
                </div>
                
                <div class="sidebar-tool" data-tool="image" title="Upload Image">
                    <i class="fas fa-image"></i>
                    <span>Image</span>
                </div>
                
                <div class="sidebar-tool" data-tool="shapes" title="Shapes">
                    <i class="fas fa-shapes"></i>
                    <span>Shapes</span>
                </div>
            </div>
            
            <div style="flex: 1;"></div>
            
            <div class="sidebar-tool" onclick="window.location.href='{{ route('admin.designs.index') }}'" title="Back">
                <i class="fas fa-arrow-left"></i>
                <span>Back</span>
            </div>
        </div>

        <!-- Properties Panel (Shows on sidebar tools hover) -->
        <div class="properties-panel" id="propertiesPanel">
            <div class="panel-header">
                <span class="panel-title">Design Settings</span>
            </div>
            <div class="panel-content">
                <form id="designForm">
                    @csrf
                    <div class="panel-section">
                        <div class="panel-section-title">Basic Info</div>
                        
                        <div class="form-group">
                            <label class="form-label">Design Name <span class="text-danger">*</span></label>
                            <input type="text" name="design_name" id="design_name" class="form-control" placeholder="My Wedding Invitation" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">User <span class="text-danger">*</span></label>
                            <select name="user_id" id="user_id" class="form-select" required>
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Template <span class="text-danger">*</span></label>
                            <select name="template_id" id="template_id" class="form-select" required>
                                <option value="">Select Template</option>
                                @foreach($templates as $template)
                                    <option value="{{ $template->id }}">{{ $template->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="panel-section">
                        <div class="panel-section-title">Status</div>
                        
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select name="status" id="status" class="form-select">
                                <option value="draft">Draft</option>
                                <option value="completed">Completed</option>
                                <option value="published">Published</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <div class="form-check form-switch">
                                <input type="hidden" name="is_completed" value="0">
                                <input class="form-check-input" type="checkbox" name="is_completed" id="is_completed" value="1">
                                <label class="form-check-label" for="is_completed">Mark as Completed</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel-section">
                        <div class="panel-section-title">Canvas Size</div>
                        
                        <div class="row g-2">
                            <div class="col-6">
                                <label class="form-label">Width</label>
                                <input type="number" id="canvasWidth" class="form-control" value="800">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Height</label>
                                <input type="number" id="canvasHeight" class="form-control" value="600">
                            </div>
                        </div>
                    </div>
                    
                    <input type="hidden" name="canvas_data" id="canvas_data">
                </form>
            </div>
        </div>

        <!-- Main Canvas Area -->
        <div class="canvas-container">
            <!-- Top Toolbar -->
            <div class="editor-top-toolbar">
                <div class="toolbar-left">
                    <a href="{{ route('admin.designs.index') }}" class="toolbar-btn back-btn" title="Back to Designs">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <div class="toolbar-divider"></div>
                    <button class="toolbar-btn" onclick="undo()" title="Undo (Ctrl+Z)">
                        <i class="fas fa-undo"></i>
                    </button>
                    <button class="toolbar-btn" onclick="redo()" title="Redo (Ctrl+Y)">
                        <i class="fas fa-redo"></i>
                    </button>
                    <div class="toolbar-divider"></div>
                    <div class="zoom-controls">
                        <button class="format-btn" onclick="zoomOut()" title="Zoom Out">
                            <i class="fas fa-minus"></i>
                        </button>
                        <span class="zoom-level" id="zoomLevel">100%</span>
                        <button class="format-btn" onclick="zoomIn()" title="Zoom In">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                
                <div class="toolbar-center">
                    <span class="design-title-display">
                        <i class="fas fa-palette"></i>
                        <span id="designTitle">Untitled Design</span>
                    </span>
                </div>
                
                <div class="toolbar-right">
                    <button class="toolbar-btn" onclick="previewDesign()">
                        <i class="fas fa-eye"></i>
                        Preview
                    </button>
                    <button class="toolbar-btn primary" onclick="saveDesign()">
                        <i class="fas fa-save"></i>
                        Save Design
                    </button>
                </div>
            </div>

            <!-- Text Formatting Toolbar -->
            <div class="format-toolbar" id="formatToolbar">
                <select class="format-select" id="fontFamily" onchange="updateTextStyle('fontFamily', this.value)">
                    <option value="Inter">Inter</option>
                    <option value="Arial">Arial</option>
                    <option value="Georgia">Georgia</option>
                    <option value="Times New Roman">Times New Roman</option>
                    <option value="Verdana">Verdana</option>
                    <option value="Courier New">Courier New</option>
                    <option value="Playfair Display">Playfair Display</option>
                    <option value="Dancing Script">Dancing Script</option>
                    <option value="Great Vibes">Great Vibes</option>
                </select>
                
                <input type="number" class="format-input" id="fontSize" value="24" min="8" max="200" onchange="updateTextStyle('fontSize', this.value + 'px')">
                
                <div class="toolbar-divider"></div>
                
                <button class="format-btn" onclick="toggleTextStyle('bold')" id="boldBtn" title="Bold">
                    <i class="fas fa-bold"></i>
                </button>
                <button class="format-btn" onclick="toggleTextStyle('italic')" id="italicBtn" title="Italic">
                    <i class="fas fa-italic"></i>
                </button>
                <button class="format-btn" onclick="toggleTextStyle('underline')" id="underlineBtn" title="Underline">
                    <i class="fas fa-underline"></i>
                </button>
                
                <div class="toolbar-divider"></div>
                
                <button class="format-btn" onclick="setTextAlign('left')" title="Align Left">
                    <i class="fas fa-align-left"></i>
                </button>
                <button class="format-btn" onclick="setTextAlign('center')" title="Align Center">
                    <i class="fas fa-align-center"></i>
                </button>
                <button class="format-btn" onclick="setTextAlign('right')" title="Align Right">
                    <i class="fas fa-align-right"></i>
                </button>
                
                <div class="toolbar-divider"></div>
                
                <div class="color-picker-wrapper">
                    <input type="color" class="color-picker" id="textColor" value="#000000" onchange="updateTextStyle('color', this.value)" title="Text Color">
                </div>
                
                <div class="toolbar-divider"></div>
                
                <button class="format-btn" onclick="duplicateElement()" title="Duplicate">
                    <i class="fas fa-copy"></i>
                </button>
                
                <div class="toolbar-divider"></div>
                
                <button class="format-btn" onclick="bringToFront()" title="Bring to Front">
                    <i class="fas fa-layer-group"></i>
                </button>
                <button class="format-btn" onclick="sendToBack()" title="Send to Back">
                    <i class="fas fa-layer-group" style="transform: rotate(180deg);"></i>
                </button>
                
                <div class="toolbar-divider"></div>
                
                <button class="format-btn" onclick="deleteSelectedElement()" title="Delete" style="color: var(--danger);">
                    <i class="fas fa-trash"></i>
                </button>
            </div>

            <!-- Canvas Workspace -->
            <div class="canvas-workspace" id="canvasWorkspace">
                <div class="design-canvas" id="designCanvas">
                    <!-- Elements will be added here dynamically -->
                </div>
            </div>
        </div>

        <!-- Layers Panel -->
        <div class="layers-panel">
            <div class="panel-header">
                <span class="panel-title">Layers</span>
                <button class="format-btn" onclick="addTextElement()" title="Add Text">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
            <div class="panel-content" id="layersList">
                <div class="empty-layers">
                    <i class="fas fa-layer-group"></i>
                    <p>No elements yet.<br>Add text or images to get started.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Upload Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="upload-area" id="uploadArea" onclick="document.getElementById('imageInput').click()">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Drag and drop an image here, or</p>
                        <span>Click to browse</span>
                    </div>
                    <input type="file" id="imageInput" accept="image/*" style="display: none;" onchange="handleImageUpload(event)">
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // State Management
        let elements = [];
        let selectedElement = null;
        let elementCounter = 0;
        let zoom = 1;
        let isDragging = false;
        let isResizing = false;
        let dragOffset = { x: 0, y: 0 };
        let history = [];
        let historyIndex = -1;

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            setupEventListeners();
            updateDesignTitle();
            setupDragAndDrop();
            saveState();
        });

        function setupEventListeners() {
            // Design name change
            document.getElementById('design_name').addEventListener('input', updateDesignTitle);
            
            // Properties panel hover behavior
            const sidebarToolsGroup = document.getElementById('sidebarToolsGroup');
            const propertiesPanel = document.getElementById('propertiesPanel');
            let panelHideTimeout = null;
            
            // Show panel on sidebar tools hover
            sidebarToolsGroup.addEventListener('mouseenter', function() {
                clearTimeout(panelHideTimeout);
                propertiesPanel.classList.add('visible');
            });
            
            sidebarToolsGroup.addEventListener('mouseleave', function() {
                panelHideTimeout = setTimeout(() => {
                    if (!propertiesPanel.matches(':hover')) {
                        propertiesPanel.classList.remove('visible');
                    }
                }, 100);
            });
            
            // Keep panel open when hovering on it
            propertiesPanel.addEventListener('mouseenter', function() {
                clearTimeout(panelHideTimeout);
                propertiesPanel.classList.add('visible');
            });
            
            propertiesPanel.addEventListener('mouseleave', function() {
                propertiesPanel.classList.remove('visible');
            });
            
            // Sidebar tools
            document.querySelectorAll('.sidebar-tool[data-tool]').forEach(tool => {
                tool.addEventListener('click', function() {
                    const toolType = this.dataset.tool;
                    
                    document.querySelectorAll('.sidebar-tool').forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    
                    switch(toolType) {
                        case 'text':
                            addTextElement();
                            break;
                        case 'image':
                            openImageModal();
                            break;
                        case 'shapes':
                            addShapeElement();
                            break;
                    }
                });
            });
            
            // Canvas click to deselect
            document.getElementById('designCanvas').addEventListener('click', function(e) {
                if (e.target === this) {
                    deselectAll();
                }
            });
            
            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                if (e.ctrlKey || e.metaKey) {
                    if (e.key === 'z') {
                        e.preventDefault();
                        undo();
                    } else if (e.key === 'y') {
                        e.preventDefault();
                        redo();
                    } else if (e.key === 's') {
                        e.preventDefault();
                        saveDesign();
                    } else if (e.key === 'd' && selectedElement) {
                        e.preventDefault();
                        duplicateElement();
                    }
                }
                
                if (e.key === 'Delete' && selectedElement) {
                    deleteSelectedElement();
                }
                
                if (e.key === 'Escape') {
                    deselectAll();
                }
            });
            
            // Canvas size change
            document.getElementById('canvasWidth').addEventListener('change', updateCanvasSize);
            document.getElementById('canvasHeight').addEventListener('change', updateCanvasSize);
        }

        function setupDragAndDrop() {
            const uploadArea = document.getElementById('uploadArea');
            
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, preventDefaults, false);
            });
            
            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }
            
            ['dragenter', 'dragover'].forEach(eventName => {
                uploadArea.addEventListener(eventName, () => {
                    uploadArea.classList.add('drag-over');
                }, false);
            });
            
            ['dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, () => {
                    uploadArea.classList.remove('drag-over');
                }, false);
            });
            
            uploadArea.addEventListener('drop', handleDrop, false);
        }

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length > 0 && files[0].type.startsWith('image/')) {
                processImageFile(files[0]);
            }
        }

        function updateDesignTitle() {
            const name = document.getElementById('design_name').value || 'Untitled Design';
            document.getElementById('designTitle').textContent = name;
        }

        function updateCanvasSize() {
            const width = document.getElementById('canvasWidth').value;
            const height = document.getElementById('canvasHeight').value;
            const canvas = document.getElementById('designCanvas');
            canvas.style.width = width + 'px';
            canvas.style.height = height + 'px';
        }

        // Element Creation
        function addTextElement() {
            saveState();
            
            const id = 'element_' + (++elementCounter);
            const element = {
                id: id,
                type: 'text',
                x: 100,
                y: 100,
                content: 'Double click to edit',
                styles: {
                    fontFamily: 'Inter',
                    fontSize: '24px',
                    fontWeight: 'normal',
                    fontStyle: 'normal',
                    textDecoration: 'none',
                    textAlign: 'left',
                    color: '#000000'
                }
            };
            
            elements.push(element);
            renderElement(element);
            selectElement(id);
            updateLayersList();
        }

        function addShapeElement() {
            saveState();
            
            const id = 'element_' + (++elementCounter);
            const element = {
                id: id,
                type: 'shape',
                x: 150,
                y: 150,
                width: 100,
                height: 100,
                shapeType: 'rectangle',
                styles: {
                    backgroundColor: 'var(--primary-500)',
                    borderRadius: '8px'
                }
            };
            
            elements.push(element);
            renderElement(element);
            selectElement(id);
            updateLayersList();
        }

        function openImageModal() {
            const modal = new bootstrap.Modal(document.getElementById('imageModal'));
            modal.show();
        }

        function handleImageUpload(event) {
            const file = event.target.files[0];
            if (file) {
                processImageFile(file);
            }
        }

        function processImageFile(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                saveState();
                
                const id = 'element_' + (++elementCounter);
                const element = {
                    id: id,
                    type: 'image',
                    x: 100,
                    y: 100,
                    width: 200,
                    height: 200,
                    src: e.target.result
                };
                
                elements.push(element);
                renderElement(element);
                selectElement(id);
                updateLayersList();
                
                // Close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('imageModal'));
                if (modal) modal.hide();
            };
            reader.readAsDataURL(file);
        }

        function renderElement(element) {
            const canvas = document.getElementById('designCanvas');
            const div = document.createElement('div');
            div.id = element.id;
            div.className = 'canvas-element ' + element.type + '-element';
            div.style.left = element.x + 'px';
            div.style.top = element.y + 'px';
            
            // Set z-index based on array position
            const index = elements.findIndex(el => el.id === element.id);
            div.style.zIndex = index + 1;
            
            if (element.type === 'text') {
                div.contentEditable = false;
                div.textContent = element.content;
                Object.assign(div.style, element.styles);
                
                div.addEventListener('dblclick', function(e) {
                    e.stopPropagation();
                    this.contentEditable = true;
                    this.focus();
                    document.execCommand('selectAll', false, null);
                });
                
                div.addEventListener('blur', function() {
                    this.contentEditable = false;
                    const el = elements.find(e => e.id === element.id);
                    if (el) {
                        el.content = this.textContent;
                        updateLayersList();
                    }
                });
                
                div.addEventListener('input', function() {
                    const el = elements.find(e => e.id === element.id);
                    if (el) {
                        el.content = this.textContent;
                    }
                });
            } else if (element.type === 'image') {
                div.style.width = element.width + 'px';
                div.style.height = element.height + 'px';
                const img = document.createElement('img');
                img.src = element.src;
                div.appendChild(img);
            } else if (element.type === 'shape') {
                div.style.width = element.width + 'px';
                div.style.height = element.height + 'px';
                Object.assign(div.style, element.styles);
            }
            
            // Add event listeners
            div.addEventListener('mousedown', function(e) {
                if (e.target.classList.contains('resize-handle')) return;
                
                selectElement(element.id);
                startDrag(e, element.id);
            });
            
            canvas.appendChild(div);
        }

        function selectElement(id) {
            deselectAll();
            
            selectedElement = id;
            const div = document.getElementById(id);
            if (div) {
                div.classList.add('selected');
                addResizeHandles(div);
                
                const element = elements.find(e => e.id === id);
                if (element && element.type === 'text') {
                    document.getElementById('formatToolbar').classList.add('active');
                    updateFormatToolbar(element);
                } else {
                    document.getElementById('formatToolbar').classList.add('active');
                }
            }
            
            updateLayersList();
        }

        function deselectAll() {
            document.querySelectorAll('.canvas-element').forEach(el => {
                el.classList.remove('selected');
                el.querySelectorAll('.resize-handle').forEach(h => h.remove());
            });
            
            selectedElement = null;
            document.getElementById('formatToolbar').classList.remove('active');
            updateLayersList();
        }

        function addResizeHandles(element) {
            const handles = ['nw', 'ne', 'sw', 'se', 'n', 's', 'e', 'w'];
            handles.forEach(pos => {
                const handle = document.createElement('div');
                handle.className = 'resize-handle ' + pos;
                handle.addEventListener('mousedown', function(e) {
                    e.stopPropagation();
                    startResize(e, element.id, pos);
                });
                element.appendChild(handle);
            });
        }

        // Drag and Resize
        function startDrag(e, elementId) {
            isDragging = true;
            const element = document.getElementById(elementId);
            const canvas = document.getElementById('designCanvas');
            const canvasRect = canvas.getBoundingClientRect();
            
            dragOffset = {
                x: (e.clientX - canvasRect.left) / zoom - parseInt(element.style.left),
                y: (e.clientY - canvasRect.top) / zoom - parseInt(element.style.top)
            };
            
            document.addEventListener('mousemove', handleDrag);
            document.addEventListener('mouseup', stopDrag);
        }

        function handleDrag(e) {
            if (!isDragging || !selectedElement) return;
            
            const canvas = document.getElementById('designCanvas');
            const canvasRect = canvas.getBoundingClientRect();
            const element = document.getElementById(selectedElement);
            
            let newX = (e.clientX - canvasRect.left) / zoom - dragOffset.x;
            let newY = (e.clientY - canvasRect.top) / zoom - dragOffset.y;
            
            element.style.left = newX + 'px';
            element.style.top = newY + 'px';
            
            const el = elements.find(el => el.id === selectedElement);
            if (el) {
                el.x = newX;
                el.y = newY;
            }
        }

        function stopDrag() {
            if (isDragging) {
                saveState();
            }
            isDragging = false;
            document.removeEventListener('mousemove', handleDrag);
            document.removeEventListener('mouseup', stopDrag);
        }

        let resizeHandle = '';
        let resizeStart = { x: 0, y: 0, width: 0, height: 0, left: 0, top: 0 };

        function startResize(e, elementId, handle) {
            isResizing = true;
            resizeHandle = handle;
            const element = document.getElementById(elementId);
            
            resizeStart = {
                x: e.clientX,
                y: e.clientY,
                width: parseInt(element.style.width) || element.offsetWidth,
                height: parseInt(element.style.height) || element.offsetHeight,
                left: parseInt(element.style.left),
                top: parseInt(element.style.top)
            };
            
            document.addEventListener('mousemove', handleResize);
            document.addEventListener('mouseup', stopResize);
        }

        function handleResize(e) {
            if (!isResizing || !selectedElement) return;
            
            const element = document.getElementById(selectedElement);
            const dx = (e.clientX - resizeStart.x) / zoom;
            const dy = (e.clientY - resizeStart.y) / zoom;
            
            let newWidth = resizeStart.width;
            let newHeight = resizeStart.height;
            let newLeft = resizeStart.left;
            let newTop = resizeStart.top;
            
            if (resizeHandle.includes('e')) newWidth = resizeStart.width + dx;
            if (resizeHandle.includes('w')) {
                newWidth = resizeStart.width - dx;
                newLeft = resizeStart.left + dx;
            }
            if (resizeHandle.includes('s')) newHeight = resizeStart.height + dy;
            if (resizeHandle.includes('n')) {
                newHeight = resizeStart.height - dy;
                newTop = resizeStart.top + dy;
            }
            
            if (newWidth > 20) {
                element.style.width = newWidth + 'px';
            }
            if (newHeight > 20) {
                element.style.height = newHeight + 'px';
            }
            
            const el = elements.find(el => el.id === selectedElement);
            if (el) {
                el.width = parseInt(element.style.width);
                el.height = parseInt(element.style.height);
                el.x = parseInt(element.style.left);
                el.y = parseInt(element.style.top);
            }
        }

        function stopResize() {
            if (isResizing) {
                saveState();
            }
            isResizing = false;
            document.removeEventListener('mousemove', handleResize);
            document.removeEventListener('mouseup', stopResize);
        }

        // Text Formatting
        function updateFormatToolbar(element) {
            if (element.styles) {
                document.getElementById('fontFamily').value = element.styles.fontFamily || 'Inter';
                document.getElementById('fontSize').value = parseInt(element.styles.fontSize) || 24;
                document.getElementById('textColor').value = element.styles.color || '#000000';
                
                document.getElementById('boldBtn').classList.toggle('active', element.styles.fontWeight === 'bold');
                document.getElementById('italicBtn').classList.toggle('active', element.styles.fontStyle === 'italic');
                document.getElementById('underlineBtn').classList.toggle('active', element.styles.textDecoration === 'underline');
            }
        }

        function updateTextStyle(property, value) {
            if (!selectedElement) return;
            
            const element = elements.find(e => e.id === selectedElement);
            const div = document.getElementById(selectedElement);
            
            if (element && element.type === 'text') {
                element.styles[property] = value;
                div.style[property] = value;
                saveState();
            }
        }

        function toggleTextStyle(style) {
            if (!selectedElement) return;
            
            const element = elements.find(e => e.id === selectedElement);
            const div = document.getElementById(selectedElement);
            
            if (element && element.type === 'text') {
                switch(style) {
                    case 'bold':
                        element.styles.fontWeight = element.styles.fontWeight === 'bold' ? 'normal' : 'bold';
                        div.style.fontWeight = element.styles.fontWeight;
                        document.getElementById('boldBtn').classList.toggle('active');
                        break;
                    case 'italic':
                        element.styles.fontStyle = element.styles.fontStyle === 'italic' ? 'normal' : 'italic';
                        div.style.fontStyle = element.styles.fontStyle;
                        document.getElementById('italicBtn').classList.toggle('active');
                        break;
                    case 'underline':
                        element.styles.textDecoration = element.styles.textDecoration === 'underline' ? 'none' : 'underline';
                        div.style.textDecoration = element.styles.textDecoration;
                        document.getElementById('underlineBtn').classList.toggle('active');
                        break;
                }
                saveState();
            }
        }

        function setTextAlign(align) {
            if (!selectedElement) return;
            
            const element = elements.find(e => e.id === selectedElement);
            const div = document.getElementById(selectedElement);
            
            if (element && element.type === 'text') {
                element.styles.textAlign = align;
                div.style.textAlign = align;
                saveState();
            }
        }

        // Layer Management
        function updateLayersList() {
            const list = document.getElementById('layersList');
            
            if (elements.length === 0) {
                list.innerHTML = `
                    <div class="empty-layers">
                        <i class="fas fa-layer-group"></i>
                        <p>No elements yet.<br>Add text or images to get started.</p>
                    </div>
                `;
                return;
            }
            
            // Render layers in reverse order (top layer first)
            list.innerHTML = [...elements].reverse().map((el, reverseIndex) => {
                const actualIndex = elements.length - 1 - reverseIndex;
                const isSelected = el.id === selectedElement;
                const icon = el.type === 'text' ? 'fa-font' : el.type === 'image' ? 'fa-image' : 'fa-shapes';
                const name = el.type === 'text' ? (el.content.substring(0, 20) + (el.content.length > 20 ? '...' : '')) : 
                            el.type === 'image' ? 'Image' : 'Shape';
                
                return `
                    <div class="layer-item ${isSelected ? 'selected' : ''}" onclick="selectElement('${el.id}')">
                        <div class="layer-reorder-btns">
                            <button class="layer-reorder-btn" onclick="event.stopPropagation(); moveLayerUp('${el.id}')" title="Move Up">
                                <i class="fas fa-chevron-up"></i>
                            </button>
                            <button class="layer-reorder-btn" onclick="event.stopPropagation(); moveLayerDown('${el.id}')" title="Move Down">
                                <i class="fas fa-chevron-down"></i>
                            </button>
                        </div>
                        <div class="layer-icon">
                            <i class="fas ${icon}"></i>
                        </div>
                        <div class="layer-info">
                            <div class="layer-name">${name}</div>
                            <div class="layer-type">${el.type.charAt(0).toUpperCase() + el.type.slice(1)}</div>
                        </div>
                        <div class="layer-actions">
                            <div class="layer-order-btns">
                                <button class="layer-order-btn" onclick="event.stopPropagation(); bringElementToFront('${el.id}')" title="Bring to Front">
                                    <i class="fas fa-arrow-up"></i>
                                </button>
                                <button class="layer-order-btn" onclick="event.stopPropagation(); sendElementToBack('${el.id}')" title="Send to Back">
                                    <i class="fas fa-arrow-down"></i>
                                </button>
                            </div>
                            <button class="layer-action-btn" onclick="event.stopPropagation(); duplicateElementById('${el.id}')" title="Duplicate">
                                <i class="fas fa-copy"></i>
                            </button>
                            <button class="layer-action-btn danger" onclick="event.stopPropagation(); deleteElementById('${el.id}')" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
            }).join('');
        }

        function moveLayerUp(id) {
            const index = elements.findIndex(el => el.id === id);
            if (index < elements.length - 1) {
                saveState();
                [elements[index], elements[index + 1]] = [elements[index + 1], elements[index]];
                updateZIndices();
                updateLayersList();
            }
        }

        function moveLayerDown(id) {
            const index = elements.findIndex(el => el.id === id);
            if (index > 0) {
                saveState();
                [elements[index], elements[index - 1]] = [elements[index - 1], elements[index]];
                updateZIndices();
                updateLayersList();
            }
        }

        function bringElementToFront(id) {
            const index = elements.findIndex(el => el.id === id);
            if (index !== -1 && index < elements.length - 1) {
                saveState();
                const element = elements.splice(index, 1)[0];
                elements.push(element);
                updateZIndices();
                updateLayersList();
            }
        }

        function sendElementToBack(id) {
            const index = elements.findIndex(el => el.id === id);
            if (index !== -1 && index > 0) {
                saveState();
                const element = elements.splice(index, 1)[0];
                elements.unshift(element);
                updateZIndices();
                updateLayersList();
            }
        }

        function bringToFront() {
            if (selectedElement) {
                bringElementToFront(selectedElement);
            }
        }

        function sendToBack() {
            if (selectedElement) {
                sendElementToBack(selectedElement);
            }
        }

        function updateZIndices() {
            elements.forEach((el, index) => {
                const div = document.getElementById(el.id);
                if (div) {
                    div.style.zIndex = index + 1;
                }
            });
        }

        function duplicateElement() {
            if (selectedElement) {
                duplicateElementById(selectedElement);
            }
        }

        function duplicateElementById(id) {
            const element = elements.find(e => e.id === id);
            if (element) {
                saveState();
                
                const newId = 'element_' + (++elementCounter);
                const newElement = JSON.parse(JSON.stringify(element));
                newElement.id = newId;
                newElement.x += 20;
                newElement.y += 20;
                
                elements.push(newElement);
                renderElement(newElement);
                selectElement(newId);
                updateLayersList();
            }
        }

        function deleteSelectedElement() {
            if (selectedElement) {
                deleteElementById(selectedElement);
            }
        }

        function deleteElementById(id) {
            saveState();
            
            const index = elements.findIndex(e => e.id === id);
            if (index !== -1) {
                elements.splice(index, 1);
                const div = document.getElementById(id);
                if (div) div.remove();
                
                if (selectedElement === id) {
                    selectedElement = null;
                    document.getElementById('formatToolbar').classList.remove('active');
                }
                
                updateZIndices();
                updateLayersList();
            }
        }

        // Zoom
        function zoomIn() {
            if (zoom < 2) {
                zoom += 0.1;
                updateZoom();
            }
        }

        function zoomOut() {
            if (zoom > 0.25) {
                zoom -= 0.1;
                updateZoom();
            }
        }

        function updateZoom() {
            const canvas = document.getElementById('designCanvas');
            canvas.style.transform = `scale(${zoom})`;
            document.getElementById('zoomLevel').textContent = Math.round(zoom * 100) + '%';
        }

        // History (Undo/Redo)
        function saveState() {
            const state = JSON.stringify(elements);
            
            // Remove any states after current index
            history = history.slice(0, historyIndex + 1);
            
            history.push(state);
            historyIndex = history.length - 1;
            
            // Limit history size
            if (history.length > 50) {
                history.shift();
                historyIndex--;
            }
        }

        function undo() {
            if (historyIndex > 0) {
                historyIndex--;
                restoreState(history[historyIndex]);
            }
        }

        function redo() {
            if (historyIndex < history.length - 1) {
                historyIndex++;
                restoreState(history[historyIndex]);
            }
        }

        function restoreState(state) {
            elements = JSON.parse(state);
            
            // Clear canvas
            const canvas = document.getElementById('designCanvas');
            canvas.innerHTML = '';
            
            // Re-render all elements
            elements.forEach(el => renderElement(el));
            
            selectedElement = null;
            document.getElementById('formatToolbar').classList.remove('active');
            updateLayersList();
        }

        // Save Design
        function saveDesign() {
            const designName = document.getElementById('design_name').value;
            const userId = document.getElementById('user_id').value;
            const templateId = document.getElementById('template_id').value;
            
            if (!designName || !userId || !templateId) {
                alert('Please fill in all required fields (Design Name, User, and Template)');
                // Show properties panel
                document.getElementById('propertiesPanel').classList.add('visible');
                return;
            }
            
            const canvasData = {
                width: parseInt(document.getElementById('canvasWidth').value),
                height: parseInt(document.getElementById('canvasHeight').value),
                elements: elements
            };
            
            document.getElementById('canvas_data').value = JSON.stringify(canvasData);
            
            // Prepare form data
            const formData = new FormData(document.getElementById('designForm'));
            formData.append('name', designName);
            
            // Submit via AJAX
            fetch('{{ route("admin.designs.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Design saved successfully!');
                    window.location.href = '{{ route("admin.designs.index") }}';
                } else {
                    alert('Error saving design: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error saving design. Please try again.');
            });
        }

        function previewDesign() {
            const canvas = document.getElementById('designCanvas');
            const previewWindow = window.open('', '_blank');
            previewWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Design Preview</title>
                    <style>
                        body {
                            margin: 0;
                            padding: 40px;
                            background: #f5f5f5;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            min-height: 100vh;
                        }
                        .preview-canvas {
                            background: white;
                            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
                            position: relative;
                        }
                        .preview-element {
                            position: absolute;
                        }
                        .preview-element img {
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                        }
                    </style>
                </head>
                <body>
                    <div class="preview-canvas" style="width: ${canvas.style.width}; height: ${canvas.style.height};">
                        ${elements.map((el, index) => {
                            if (el.type === 'text') {
                                return `<div class="preview-element" style="left: ${el.x}px; top: ${el.y}px; z-index: ${index + 1}; font-family: ${el.styles.fontFamily}; font-size: ${el.styles.fontSize}; font-weight: ${el.styles.fontWeight}; font-style: ${el.styles.fontStyle}; text-decoration: ${el.styles.textDecoration}; text-align: ${el.styles.textAlign}; color: ${el.styles.color}; padding: 8px 12px;">${el.content}</div>`;
                            } else if (el.type === 'image') {
                                return `<div class="preview-element" style="left: ${el.x}px; top: ${el.y}px; width: ${el.width}px; height: ${el.height}px; z-index: ${index + 1};"><img src="${el.src}"></div>`;
                            } else if (el.type === 'shape') {
                                return `<div class="preview-element" style="left: ${el.x}px; top: ${el.y}px; width: ${el.width}px; height: ${el.height}px; z-index: ${index + 1}; background-color: ${el.styles.backgroundColor}; border-radius: ${el.styles.borderRadius};"></div>`;
                            }
                            return '';
                        }).join('')}
                    </div>
                </body>
                </html>
            `);
            previewWindow.document.close();
        }

        // Initialize with empty state
        saveState();
    </script>
    @endpush
</x-admin-layout>