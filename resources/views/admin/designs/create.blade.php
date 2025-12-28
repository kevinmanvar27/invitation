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
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Great+Vibes&family=Playfair+Display:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&family=Open+Sans:wght@300;400;500;600;700&family=Lato:wght@300;400;700&family=Poppins:wght@300;400;500;600;700&family=Raleway:wght@300;400;500;600;700&family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* FULL SCREEN EDITOR - Hide admin layout */
        .admin-sidebar,
        .admin-navbar,
        .page-header,
        .breadcrumb,
        .main-sidebar,
        .main-header,
        .main-footer,
        .content-header {
            display: none !important;
        }
        
        .admin-main,
        .content-wrapper {
            margin-left: 0 !important;
            padding-top: 0 !important;
            margin-top: 0 !important;
        }
        
        .admin-content,
        .content {
            padding: 0 !important;
            height: 100vh !important;
            overflow: hidden;
        }
        
        body {
            overflow: hidden;
        }

        /* CSS Variables */
        :root {
            --primary-50: #fef2f2;
            --primary-100: #fee2e2;
            --primary-200: #fecaca;
            --primary-300: #fca5a5;
            --primary-400: #f87171;
            --primary-500: #ef4444;
            --primary-600: #dc2626;
            --primary-700: #b91c1c;
            --neutral-50: #fafafa;
            --neutral-100: #f5f5f5;
            --neutral-200: #e5e5e5;
            --neutral-300: #d4d4d4;
            --neutral-400: #a3a3a3;
            --neutral-500: #737373;
            --neutral-600: #525252;
            --neutral-700: #404040;
            --neutral-800: #262626;
            --neutral-900: #171717;
            --success: #22c55e;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #3b82f6;
            --radius-sm: 4px;
            --radius-md: 8px;
            --radius-lg: 12px;
            --radius-xl: 16px;
            --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 15px rgba(0,0,0,0.1);
            --shadow-xl: 0 20px 25px rgba(0,0,0,0.15);
            --transition-fast: all 0.15s ease;
            --transition-normal: all 0.3s ease;
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
            background: #18181b;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 12px 0;
            position: relative;
            z-index: 101;
        }

        .sidebar-logo {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 20px;
            cursor: pointer;
        }

        .sidebar-tool {
            width: 52px;
            height: 52px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #a1a1aa;
            cursor: pointer;
            border-radius: var(--radius-md);
            margin-bottom: 4px;
            transition: var(--transition-fast);
            font-size: 9px;
            gap: 4px;
        }

        .sidebar-tool:hover {
            background: #27272a;
            color: #fff;
        }

        .sidebar-tool.active {
            background: var(--primary-500);
            color: #fff;
        }

        .sidebar-tool i {
            font-size: 18px;
        }

        .sidebar-divider {
            width: 36px;
            height: 1px;
            background: #3f3f46;
            margin: 8px 0;
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
            width: 320px;
            min-width: 320px;
            opacity: 1;
            pointer-events: auto;
            box-shadow: var(--shadow-xl);
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

        .panel-close {
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: transparent;
            color: var(--neutral-500);
            cursor: pointer;
            border-radius: var(--radius-sm);
        }

        .panel-close:hover {
            background: var(--neutral-100);
            color: var(--neutral-700);
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

        /* Panel Tabs */
        .panel-tabs {
            display: flex;
            border-bottom: 1px solid var(--neutral-200);
            padding: 0 16px;
            background: var(--neutral-50);
        }

        .panel-tab {
            padding: 12px 16px;
            font-size: 13px;
            font-weight: 500;
            color: var(--neutral-500);
            cursor: pointer;
            border-bottom: 2px solid transparent;
            margin-bottom: -1px;
            transition: var(--transition-fast);
        }

        .panel-tab:hover {
            color: var(--neutral-700);
        }

        .panel-tab.active {
            color: var(--primary-600);
            border-bottom-color: var(--primary-500);
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Search Box */
        .search-box {
            position: relative;
            margin-bottom: 16px;
        }

        .search-box input {
            width: 100%;
            padding: 10px 12px 10px 36px;
            border: 1px solid var(--neutral-300);
            border-radius: var(--radius-md);
            font-size: 13px;
            background: #fff;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary-500);
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .search-box i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--neutral-400);
            font-size: 14px;
        }

        /* Element Grid */
        .element-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        .element-item {
            aspect-ratio: 1;
            background: var(--neutral-100);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition-fast);
            border: 2px solid transparent;
            overflow: hidden;
        }

        .element-item:hover {
            border-color: var(--primary-300);
            transform: scale(1.02);
        }

        .element-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .element-item i {
            font-size: 24px;
            color: var(--neutral-500);
        }

        .element-item.shape-item {
            padding: 12px;
        }

        .element-item.shape-item svg {
            width: 100%;
            height: 100%;
        }

        /* Image Grid */
        .image-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
        }

        .image-item {
            aspect-ratio: 1;
            background: var(--neutral-100);
            border-radius: var(--radius-md);
            overflow: hidden;
            cursor: pointer;
            transition: var(--transition-fast);
            position: relative;
        }

        .image-item:hover {
            transform: scale(1.02);
            box-shadow: var(--shadow-md);
        }

        .image-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-item .image-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.5), transparent);
            opacity: 0;
            transition: var(--transition-fast);
            display: flex;
            align-items: flex-end;
            padding: 8px;
        }

        .image-item:hover .image-overlay {
            opacity: 1;
        }

        .image-item .image-credit {
            color: #fff;
            font-size: 10px;
            text-shadow: 0 1px 2px rgba(0,0,0,0.5);
        }

        /* Upload Area */
        .upload-area {
            border: 2px dashed var(--neutral-300);
            border-radius: var(--radius-lg);
            padding: 24px;
            text-align: center;
            cursor: pointer;
            transition: var(--transition-fast);
            background: var(--neutral-50);
            margin-bottom: 16px;
        }

        .upload-area:hover {
            border-color: var(--primary-500);
            background: var(--primary-50);
        }

        .upload-area.drag-over {
            border-color: var(--primary-500);
            background: var(--primary-100);
        }

        .upload-area i {
            font-size: 32px;
            color: var(--primary-500);
            margin-bottom: 8px;
        }

        .upload-area p {
            color: var(--neutral-600);
            font-size: 13px;
            margin: 0;
        }

        .upload-area span {
            color: var(--primary-600);
            font-weight: 500;
        }

        /* Color Swatches */
        .color-swatch {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            cursor: pointer;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }
        
        .color-swatch:hover {
            transform: scale(1.1);
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }

        /* Pages List */
        .pages-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        
        .page-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: var(--neutral-50);
            border: 2px solid transparent;
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: all 0.15s ease;
        }
        
        .page-item:hover {
            background: var(--neutral-100);
        }
        
        .page-item.active {
            background: var(--primary-50);
            border-color: var(--primary-500);
        }
        
        .page-thumbnail {
            width: 48px;
            height: 64px;
            background: white;
            border: 1px solid var(--neutral-200);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        
        .page-number {
            font-size: 16px;
            font-weight: 600;
            color: var(--neutral-400);
        }
        
        .page-info {
            flex: 1;
            min-width: 0;
        }
        
        .page-name-input {
            width: 100%;
            border: none;
            background: transparent;
            font-size: 13px;
            font-weight: 500;
            color: var(--neutral-800);
            padding: 2px 4px;
            border-radius: 4px;
        }
        
        .page-name-input:focus {
            outline: none;
            background: white;
            box-shadow: 0 0 0 2px var(--primary-200);
        }
        
        .page-elements {
            font-size: 11px;
            color: var(--neutral-500);
            display: block;
            margin-top: 2px;
        }
        
        .page-actions {
            display: flex;
            gap: 4px;
            opacity: 0;
            transition: opacity 0.15s ease;
        }
        
        .page-item:hover .page-actions {
            opacity: 1;
        }
        
        .page-action-btn {
            width: 28px;
            height: 28px;
            border: none;
            background: var(--neutral-200);
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--neutral-600);
            transition: all 0.15s ease;
        }
        
        .page-action-btn:hover {
            background: var(--neutral-300);
        }
        
        .page-action-btn.danger:hover {
            background: var(--danger-500);
            color: white;
        }
        
        .toolbar-btn.danger {
            background: var(--danger-50);
            color: var(--danger-600);
        }
        
        .toolbar-btn.danger:hover {
            background: var(--danger-100);
        }

        /* Page Indicator */
        .page-indicator {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            gap: 8px;
            background: white;
            padding: 8px 16px;
            border-radius: 24px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.15);
            z-index: 100;
        }
        
        .page-nav-btn {
            width: 32px;
            height: 32px;
            border: none;
            background: var(--neutral-100);
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--neutral-600);
            transition: all 0.15s ease;
        }
        
        .page-nav-btn:hover:not(:disabled) {
            background: var(--primary-100);
            color: var(--primary-600);
        }
        
        .page-nav-btn:disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }
        
        .page-nav-btn.add-page {
            background: var(--primary-500);
            color: white;
        }
        
        .page-nav-btn.add-page:hover {
            background: var(--primary-600);
        }
        
        .page-indicator-text {
            font-size: 13px;
            font-weight: 500;
            color: var(--neutral-700);
            min-width: 80px;
            text-align: center;
        }

        /* Uploaded Images */
        .uploaded-images {
            margin-top: 16px;
        }

        .uploaded-images-title {
            font-size: 12px;
            font-weight: 600;
            color: var(--neutral-600);
            margin-bottom: 8px;
        }

        /* Form Controls */
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
            width: 100%;
        }

        .editor-wrapper .form-control:focus,
        .editor-wrapper .form-select:focus {
            background: #fff;
            border-color: var(--primary-500);
            color: var(--neutral-800);
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15);
            outline: none;
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
            height: 56px;
            background: #fff;
            border-bottom: 1px solid var(--neutral-200);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        .toolbar-left,
        .toolbar-center,
        .toolbar-right {
            display: flex;
            align-items: center;
            gap: 8px;
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

        .toolbar-btn.icon-only {
            width: 36px;
            padding: 0;
            justify-content: center;
        }

        .toolbar-divider {
            width: 1px;
            height: 24px;
            background: var(--neutral-300);
        }

        /* Zoom Controls */
        .zoom-controls {
            display: flex;
            align-items: center;
            gap: 4px;
            background: var(--neutral-100);
            padding: 4px 8px;
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

        /* Design Title */
        .design-title-display {
            color: var(--neutral-600);
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .design-title-display i {
            color: var(--primary-500);
        }

        /* Context Toolbar (Format Toolbar) */
        .context-toolbar {
            height: 48px;
            background: #fff;
            border-bottom: 1px solid var(--neutral-200);
            display: none;
            align-items: center;
            padding: 0 20px;
            gap: 8px;
        }

        .context-toolbar.active {
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

        .format-btn.danger:hover {
            background: #fef2f2;
            color: var(--danger);
            border-color: #fecaca;
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

        /* Alignment Dropdown */
        .align-dropdown {
            position: relative;
        }

        .align-dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background: #fff;
            border: 1px solid var(--neutral-200);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-lg);
            padding: 8px;
            display: none;
            z-index: 1000;
            min-width: 200px;
        }

        .align-dropdown-menu.show {
            display: block;
        }

        .align-section {
            margin-bottom: 8px;
        }

        .align-section:last-child {
            margin-bottom: 0;
        }

        .align-section-title {
            font-size: 10px;
            font-weight: 600;
            color: var(--neutral-500);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
            padding: 0 4px;
        }

        .align-buttons {
            display: flex;
            gap: 4px;
        }

        .align-btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--neutral-200);
            border-radius: var(--radius-sm);
            background: #fff;
            color: var(--neutral-600);
            cursor: pointer;
            transition: var(--transition-fast);
        }

        .align-btn:hover {
            background: var(--primary-50);
            color: var(--primary-600);
            border-color: var(--primary-300);
        }

        /* Position Controls */
        .position-controls {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
        }

        .position-input-group {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .position-input-group label {
            font-size: 11px;
            font-weight: 600;
            color: var(--neutral-500);
            width: 16px;
        }

        .position-input-group input {
            flex: 1;
            height: 28px;
            padding: 0 8px;
            border: 1px solid var(--neutral-300);
            border-radius: var(--radius-sm);
            font-size: 12px;
            text-align: center;
        }

        .position-input-group input:focus {
            outline: none;
            border-color: var(--primary-500);
        }

        /* Canvas Workspace */
        .canvas-workspace {
            flex: 1;
            overflow: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            background: #e5e5e5;
            position: relative;
        }

        .design-canvas {
            width: 800px;
            height: 600px;
            background: #fff;
            box-shadow: var(--shadow-xl);
            position: relative;
            transform-origin: center center;
            border-radius: 2px;
        }

        /* Smart Guides */
        .smart-guide {
            position: absolute;
            background: var(--primary-500);
            z-index: 9999;
            pointer-events: none;
        }

        .smart-guide.horizontal {
            height: 1px;
            left: 0;
            right: 0;
        }

        .smart-guide.vertical {
            width: 1px;
            top: 0;
            bottom: 0;
        }

        .smart-guide-label {
            position: absolute;
            background: var(--primary-500);
            color: #fff;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 3px;
            white-space: nowrap;
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
        
        .canvas-element.multi-selected {
            border-color: #6366f1;
            border-style: dashed;
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.3);
        }
        
        .group-element {
            pointer-events: all;
        }
        
        .group-element:hover {
            border-color: rgba(99, 102, 241, 0.8) !important;
        }

        .canvas-element.dragging {
            opacity: 0.9;
            cursor: grabbing !important;
            z-index: 1000 !important;
        }

        .canvas-element.text-element {
            padding: 8px 12px;
            min-width: 50px;
            min-height: 24px;
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

        .canvas-element.shape-element {
            overflow: hidden;
        }

        .canvas-element.shape-element svg {
            width: 100%;
            height: 100%;
        }

        .canvas-element.frame-element {
            overflow: hidden;
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

        /* Rotation Handle */
        .rotate-handle {
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 20px;
            background: #fff;
            border: 2px solid var(--primary-500);
            border-radius: 50%;
            cursor: grab;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .rotate-handle i {
            font-size: 10px;
            color: var(--primary-500);
        }

        .rotate-handle:active {
            cursor: grabbing;
        }

        .rotate-line {
            position: absolute;
            top: -20px;
            left: 50%;
            width: 1px;
            height: 15px;
            background: var(--primary-500);
            z-index: 9;
        }

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
            padding: 10px 12px;
            border-bottom: 1px solid var(--neutral-100);
            cursor: pointer;
            transition: var(--transition-fast);
            gap: 8px;
        }

        .layer-item:hover {
            background: var(--neutral-50);
        }

        .layer-item.selected {
            background: var(--primary-50);
            border-left: 3px solid var(--primary-500);
        }
        
        .layer-item.multi-selected {
            background: rgba(99, 102, 241, 0.1);
            border-left: 3px solid #6366f1;
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
            overflow: hidden;
        }

        .layer-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
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
            font-size: 12px;
            font-weight: 500;
            color: var(--neutral-800);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .layer-type {
            font-size: 10px;
            color: var(--neutral-500);
        }

        .layer-actions {
            display: flex;
            gap: 2px;
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
            font-size: 11px;
        }

        .layer-action-btn:hover {
            background: var(--neutral-200);
            color: var(--neutral-700);
        }

        .layer-action-btn.danger:hover {
            background: #fef2f2;
            color: var(--danger);
        }

        .empty-layers {
            padding: 40px 20px;
            text-align: center;
            color: var(--neutral-400);
        }

        .empty-layers i {
            font-size: 40px;
            margin-bottom: 12px;
            color: var(--neutral-300);
        }

        .empty-layers p {
            font-size: 12px;
            line-height: 1.6;
            margin: 0;
        }

        /* Loading Spinner */
        .loading-spinner {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .loading-spinner i {
            font-size: 24px;
            color: var(--primary-500);
            animation: spin 1s linear infinite;
        }

        @@keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* Custom Scrollbar */
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

        /* Tooltip */
        [data-tooltip] {
            position: relative;
        }

        [data-tooltip]:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: var(--neutral-800);
            color: #fff;
            font-size: 11px;
            padding: 4px 8px;
            border-radius: var(--radius-sm);
            white-space: nowrap;
            margin-bottom: 4px;
            z-index: 1000;
        }

        /* Frames */
        .frame-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        .frame-item {
            aspect-ratio: 1;
            background: var(--neutral-100);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition-fast);
            border: 2px solid transparent;
            padding: 8px;
        }

        .frame-item:hover {
            border-color: var(--primary-300);
            transform: scale(1.02);
        }

        .frame-item svg {
            width: 100%;
            height: 100%;
            fill: var(--neutral-400);
        }

        /* Text Templates */
        .text-template-grid {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .text-template-item {
            padding: 12px 16px;
            background: var(--neutral-50);
            border: 1px solid var(--neutral-200);
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: var(--transition-fast);
        }

        .text-template-item:hover {
            border-color: var(--primary-300);
            background: var(--primary-50);
        }

        .text-template-item .template-preview {
            font-size: 14px;
            color: var(--neutral-800);
            margin-bottom: 4px;
        }

        .text-template-item .template-name {
            font-size: 11px;
            color: var(--neutral-500);
        }

        /* Quick Actions */
        .quick-actions {
            display: flex;
            gap: 8px;
            margin-bottom: 16px;
        }

        .quick-action-btn {
            flex: 1;
            padding: 10px;
            background: var(--neutral-50);
            border: 1px solid var(--neutral-200);
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: var(--transition-fast);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
        }

        .quick-action-btn:hover {
            border-color: var(--primary-300);
            background: var(--primary-50);
        }

        .quick-action-btn i {
            font-size: 18px;
            color: var(--primary-500);
        }

        .quick-action-btn span {
            font-size: 11px;
            color: var(--neutral-600);
        }

        /* Modal */
        .editor-modal {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 10000;
        }

        .editor-modal.show {
            display: flex;
        }

        .editor-modal-content {
            background: #fff;
            border-radius: var(--radius-lg);
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .editor-modal-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--neutral-200);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .editor-modal-title {
            font-size: 16px;
            font-weight: 600;
            color: var(--neutral-800);
        }

        .editor-modal-close {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: transparent;
            color: var(--neutral-500);
            cursor: pointer;
            border-radius: var(--radius-sm);
        }

        .editor-modal-close:hover {
            background: var(--neutral-100);
            color: var(--neutral-700);
        }

        .editor-modal-body {
            padding: 20px;
            overflow-y: auto;
        }
    </style>
    @endpush

    <div class="editor-wrapper">
        <!-- Left Sidebar - Tools -->
        <div class="editor-sidebar" id="editorSidebar">
            <div class="sidebar-logo" onclick="window.location.href='{{ route('admin.designs.index') }}'">
                <i class="fas fa-gem" style="font-size: 16px;"></i>
            </div>
            
            <div class="sidebar-tool active" data-tool="select" data-tooltip="Select (V)">
                <i class="fas fa-mouse-pointer"></i>
                <span>Select</span>
            </div>
            
            <div class="sidebar-tool" data-tool="text" data-tooltip="Text (T)">
                <i class="fas fa-font"></i>
                <span>Text</span>
            </div>
            
            <div class="sidebar-tool" data-tool="uploads" data-tooltip="Uploads (U)">
                <i class="fas fa-cloud-upload-alt"></i>
                <span>Uploads</span>
            </div>
            
            <div class="sidebar-tool" data-tool="photos" data-tooltip="Photos (P)">
                <i class="fas fa-image"></i>
                <span>Photos</span>
            </div>
            
            <div class="sidebar-tool" data-tool="elements" data-tooltip="Elements (E)">
                <i class="fas fa-shapes"></i>
                <span>Elements</span>
            </div>
            
            <div class="sidebar-tool" data-tool="frames" data-tooltip="Frames (F)">
                <i class="fas fa-vector-square"></i>
                <span>Frames</span>
            </div>
            
            <div class="sidebar-tool" data-tool="background" data-tooltip="Background (B)">
                <i class="fas fa-fill-drip"></i>
                <span>Background</span>
            </div>
            
            <div class="sidebar-tool" data-tool="pages" data-tooltip="Pages">
                <i class="fas fa-copy"></i>
                <span>Pages</span>
            </div>
            
            <div class="sidebar-divider"></div>
            
            <div class="sidebar-tool" data-tool="settings" data-tooltip="Settings">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
            </div>
            
            <div style="flex: 1;"></div>
            
            <div class="sidebar-tool" onclick="window.location.href='{{ route('admin.designs.index') }}'" data-tooltip="Back">
                <i class="fas fa-arrow-left"></i>
                <span>Back</span>
            </div>
        </div>

        <!-- Properties Panel -->
        <div class="properties-panel" id="propertiesPanel">
            <!-- Panel content will be dynamically updated based on selected tool -->
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
                    <button class="toolbar-btn icon-only" onclick="undo()" title="Undo (Ctrl+Z)">
                        <i class="fas fa-undo"></i>
                    </button>
                    <button class="toolbar-btn icon-only" onclick="redo()" title="Redo (Ctrl+Y)">
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
                        <button class="format-btn" onclick="fitToScreen()" title="Fit to Screen">
                            <i class="fas fa-expand"></i>
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
                    <button class="toolbar-btn" onclick="previewDesign()" title="Preview">
                        <i class="fas fa-eye"></i>
                        Preview
                    </button>
                    <button class="toolbar-btn" onclick="downloadDesign()" title="Download">
                        <i class="fas fa-download"></i>
                    </button>
                    <button class="toolbar-btn primary" onclick="saveDesign()">
                        <i class="fas fa-save"></i>
                        Save
                    </button>
                </div>
            </div>

            <!-- Context Toolbar (Format Toolbar) -->
            <div class="context-toolbar" id="contextToolbar">
                <!-- Text formatting options -->
                <div id="textFormatOptions" style="display: none;">
                    <select class="format-select" id="fontFamily" onchange="updateTextStyle('fontFamily', this.value)">
                        <option value="Inter">Inter</option>
                        <option value="Arial">Arial</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Times New Roman">Times New Roman</option>
                        <option value="Verdana">Verdana</option>
                        <option value="Playfair Display">Playfair Display</option>
                        <option value="Dancing Script">Dancing Script</option>
                        <option value="Great Vibes">Great Vibes</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Roboto">Roboto</option>
                        <option value="Open Sans">Open Sans</option>
                        <option value="Lato">Lato</option>
                        <option value="Poppins">Poppins</option>
                        <option value="Raleway">Raleway</option>
                        <option value="Oswald">Oswald</option>
                    </select>
                    
                    <input type="number" class="format-input" id="fontSize" value="24" min="8" max="200" onchange="updateTextStyle('fontSize', this.value + 'px')">
                    
                    <div class="toolbar-divider"></div>
                    
                    <button class="format-btn" onclick="toggleTextStyle('bold')" id="boldBtn" title="Bold (Ctrl+B)">
                        <i class="fas fa-bold"></i>
                    </button>
                    <button class="format-btn" onclick="toggleTextStyle('italic')" id="italicBtn" title="Italic (Ctrl+I)">
                        <i class="fas fa-italic"></i>
                    </button>
                    <button class="format-btn" onclick="toggleTextStyle('underline')" id="underlineBtn" title="Underline (Ctrl+U)">
                        <i class="fas fa-underline"></i>
                    </button>
                    
                    <div class="toolbar-divider"></div>
                    
                    <button class="format-btn" onclick="setTextAlign('left')" id="alignLeftBtn" title="Align Left">
                        <i class="fas fa-align-left"></i>
                    </button>
                    <button class="format-btn" onclick="setTextAlign('center')" id="alignCenterBtn" title="Align Center">
                        <i class="fas fa-align-center"></i>
                    </button>
                    <button class="format-btn" onclick="setTextAlign('right')" id="alignRightBtn" title="Align Right">
                        <i class="fas fa-align-right"></i>
                    </button>
                    
                    <div class="toolbar-divider"></div>
                    
                    <div class="color-picker-wrapper">
                        <input type="color" class="color-picker" id="textColor" value="#000000" onchange="updateTextStyle('color', this.value)" title="Text Color">
                    </div>
                </div>

                <!-- Shape formatting options -->
                <div id="shapeFormatOptions" style="display: none;">
                    <div class="color-picker-wrapper">
                        <input type="color" class="color-picker" id="shapeFillColor" value="#ef4444" onchange="updateShapeStyle('backgroundColor', this.value)" title="Fill Color">
                    </div>
                    <span style="font-size: 12px; color: var(--neutral-500); margin: 0 4px;">Fill</span>
                    
                    <div class="toolbar-divider"></div>
                    
                    <div class="color-picker-wrapper">
                        <input type="color" class="color-picker" id="shapeStrokeColor" value="#000000" onchange="updateShapeStyle('borderColor', this.value)" title="Stroke Color">
                    </div>
                    <input type="number" class="format-input" id="shapeStrokeWidth" value="0" min="0" max="20" onchange="updateShapeStyle('borderWidth', this.value + 'px')" title="Stroke Width">
                    <span style="font-size: 12px; color: var(--neutral-500); margin: 0 4px;">Stroke</span>
                    
                    <div class="toolbar-divider"></div>
                    
                    <input type="number" class="format-input" id="shapeRadius" value="0" min="0" max="100" onchange="updateShapeStyle('borderRadius', this.value + 'px')" title="Corner Radius">
                    <span style="font-size: 12px; color: var(--neutral-500); margin: 0 4px;">Radius</span>
                </div>

                <!-- Common options for all elements -->
                <div id="commonOptions" style="display: none;">
                    <div class="toolbar-divider"></div>
                    
                    <!-- Alignment Dropdown -->
                    <div class="align-dropdown">
                        <button class="format-btn" onclick="toggleAlignDropdown()" title="Align">
                            <i class="fas fa-align-center"></i>
                        </button>
                        <div class="align-dropdown-menu" id="alignDropdown">
                            <div class="align-section">
                                <div class="align-section-title">Align to Canvas</div>
                                <div class="align-buttons">
                                    <button class="align-btn" onclick="alignToCanvas('left')" title="Align Left">
                                        <i class="fas fa-align-left"></i>
                                    </button>
                                    <button class="align-btn" onclick="alignToCanvas('center-h')" title="Center Horizontally">
                                        <i class="fas fa-arrows-alt-h"></i>
                                    </button>
                                    <button class="align-btn" onclick="alignToCanvas('right')" title="Align Right">
                                        <i class="fas fa-align-right"></i>
                                    </button>
                                    <button class="align-btn" onclick="alignToCanvas('top')" title="Align Top">
                                        <i class="fas fa-arrow-up"></i>
                                    </button>
                                    <button class="align-btn" onclick="alignToCanvas('center-v')" title="Center Vertically">
                                        <i class="fas fa-arrows-alt-v"></i>
                                    </button>
                                    <button class="align-btn" onclick="alignToCanvas('bottom')" title="Align Bottom">
                                        <i class="fas fa-arrow-down"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="align-section">
                                <div class="align-section-title">Quick Position</div>
                                <div class="align-buttons">
                                    <button class="align-btn" onclick="alignToCanvas('center')" title="Center on Canvas">
                                        <i class="fas fa-crosshairs"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="toolbar-divider"></div>
                    
                    <button class="format-btn" onclick="bringToFront()" title="Bring to Front">
                        <i class="fas fa-layer-group"></i>
                    </button>
                    <button class="format-btn" onclick="sendToBack()" title="Send to Back">
                        <i class="fas fa-layer-group" style="transform: rotate(180deg);"></i>
                    </button>
                    
                    <div class="toolbar-divider"></div>
                    
                    <button class="format-btn" onclick="copyElement()" title="Copy (Ctrl+C)">
                        <i class="fas fa-copy"></i>
                    </button>
                    <button class="format-btn" onclick="pasteElement()" title="Paste (Ctrl+V)">
                        <i class="fas fa-paste"></i>
                    </button>
                    <button class="format-btn" onclick="duplicateElement()" title="Duplicate (Ctrl+D)">
                        <i class="fas fa-clone"></i>
                    </button>
                    <button class="format-btn" onclick="lockElement()" id="lockBtn" title="Lock/Unlock">
                        <i class="fas fa-lock-open"></i>
                    </button>
                    <button class="format-btn danger" onclick="deleteSelectedElement()" title="Delete (Del)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>

            <!-- Canvas Workspace -->
            <div class="canvas-workspace" id="canvasWorkspace">
                <div class="design-canvas" id="designCanvas">
                    <!-- Elements will be added here dynamically -->
                </div>
                
                <!-- Page Indicator -->
                <div class="page-indicator" id="pageIndicator">
                    <button class="page-nav-btn" onclick="navigatePage(-1)" id="prevPageBtn" title="Previous Page">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <span class="page-indicator-text" id="pageIndicatorText">Page 1 of 1</span>
                    <button class="page-nav-btn" onclick="navigatePage(1)" id="nextPageBtn" title="Next Page">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    <button class="page-nav-btn add-page" onclick="addNewPage()" title="Add Page">
                        <i class="fas fa-plus"></i>
                    </button>
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

    <!-- Hidden Form -->
    <form id="designForm" style="display: none;">
        @csrf
        <input type="text" name="design_name" id="design_name" value="">
        <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
        <input type="hidden" name="status" id="status" value="draft">
        <input type="hidden" name="is_completed" id="is_completed" value="0">
        <input type="hidden" name="canvas_data" id="canvas_data">
    </form>

    @push('scripts')
    <script>
        // ==========================================
        // STATE MANAGEMENT
        // ==========================================
        let elements = [];
        let selectedElement = null;
        let selectedElements = []; // Multi-select: array of selected element IDs
        let elementCounter = 0;
        let groupCounter = 0; // Counter for group IDs
        let zoom = 1;
        let isDragging = false;
        let isResizing = false;
        let isRotating = false;
        let dragOffset = { x: 0, y: 0 };
        let multiDragOffsets = {}; // Store offsets for each selected element during multi-drag
        let history = [];
        let historyIndex = -1;
        let currentTool = 'select';
        let uploadedImages = [];
        let snapThreshold = 5;
        let showSmartGuides = true;
        let canvasWidth = 800;
        let canvasHeight = 600;
        
        // NEW: Background support
        let canvasBackground = {
            type: 'color', // 'color' or 'image'
            color: '#ffffff',
            image: null,
            opacity: 1,
            size: 'cover' // 'cover', 'contain', 'stretch', 'tile'
        };
        
        // NEW: Multi-page support
        let pages = [];
        let currentPageIndex = 0;
        
        // Clipboard for copy/paste across pages
        let clipboardElement = null;

        // Using Picsum Photos - no API key required
        // Picsum provides reliable free images without rate limiting issues

        // ==========================================
        // INITIALIZATION
        // ==========================================
        document.addEventListener('DOMContentLoaded', function() {
            setupEventListeners();
            setupKeyboardShortcuts();
            initializeFirstPage();
            setActiveTool('select');
            saveState();
        });
        
        function initializeFirstPage() {
            // Initialize with empty first page
            pages = [{
                id: 'page_1',
                name: 'Page 1',
                elements: [],
                background: { ...canvasBackground }
            }];
            updatePageIndicator();
        }

        function setupEventListeners() {
            // Sidebar tools
            const sidebarTools = document.querySelectorAll('.sidebar-tool[data-tool]');
            console.log('Setting up sidebar tools:', sidebarTools.length, 'tools found');
            sidebarTools.forEach(tool => {
                tool.addEventListener('click', function(e) {
                    e.stopPropagation(); // Prevent event bubbling
                    const toolType = this.dataset.tool;
                    console.log('Tool clicked:', toolType);
                    setActiveTool(toolType);
                });
            });
            
            // Canvas click to deselect
            document.getElementById('designCanvas').addEventListener('click', function(e) {
                if (e.target === this) {
                    deselectAll();
                }
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.align-dropdown')) {
                    document.getElementById('alignDropdown')?.classList.remove('show');
                }
            });

            // Prevent context menu on canvas
            document.getElementById('designCanvas').addEventListener('contextmenu', function(e) {
                e.preventDefault();
            });
        }

        function setupKeyboardShortcuts() {
            document.addEventListener('keydown', function(e) {
                // Tool shortcuts
                if (!e.ctrlKey && !e.metaKey && !e.target.matches('input, textarea, [contenteditable]')) {
                    switch(e.key.toLowerCase()) {
                        case 'v': setActiveTool('select'); break;
                        case 't': setActiveTool('text'); break;
                        case 'u': setActiveTool('uploads'); break;
                        case 'p': setActiveTool('photos'); break;
                        case 'e': setActiveTool('elements'); break;
                        case 'f': setActiveTool('frames'); break;
                        case 'b': setActiveTool('background'); break;
                    }
                }

                // Ctrl/Cmd shortcuts
                if (e.ctrlKey || e.metaKey) {
                    switch(e.key.toLowerCase()) {
                        case 'z':
                            e.preventDefault();
                            if (e.shiftKey) redo();
                            else undo();
                            break;
                        case 'y':
                            e.preventDefault();
                            redo();
                            break;
                        case 's':
                            e.preventDefault();
                            saveDesign();
                            break;
                        case 'd':
                            e.preventDefault();
                            if (selectedElement) duplicateElement();
                            break;
                        case 'c':
                            e.preventDefault();
                            copyElement();
                            break;
                        case 'v':
                            e.preventDefault();
                            pasteElement();
                            break;
                        case 'a':
                            e.preventDefault();
                            selectAllElements();
                            break;
                        case 'b':
                            if (selectedElement) {
                                e.preventDefault();
                                toggleTextStyle('bold');
                            }
                            break;
                        case 'i':
                            if (selectedElement) {
                                e.preventDefault();
                                toggleTextStyle('italic');
                            }
                            break;
                        case 'u':
                            if (selectedElement) {
                                e.preventDefault();
                                toggleTextStyle('underline');
                            }
                            break;
                        case 'g':
                            e.preventDefault();
                            if (e.shiftKey) {
                                // Ctrl+Shift+G to ungroup
                                if (selectedElement) {
                                    const el = elements.find(e => e.id === selectedElement);
                                    if (el && el.type === 'group') {
                                        ungroupElements(selectedElement);
                                    }
                                }
                            } else {
                                // Ctrl+G to group
                                groupSelectedElements();
                            }
                            break;
                    }
                }
                
                // Delete
                if ((e.key === 'Delete' || e.key === 'Backspace') && selectedElement && !e.target.matches('input, textarea, [contenteditable]')) {
                    e.preventDefault();
                    deleteSelectedElement();
                }
                
                // Escape
                if (e.key === 'Escape') {
                    deselectAll();
                    closeAllPanels();
                }

                // Arrow keys for nudging
                if (selectedElement && ['ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight'].includes(e.key)) {
                    if (!e.target.matches('input, textarea, [contenteditable]')) {
                        e.preventDefault();
                        const nudge = e.shiftKey ? 10 : 1;
                        nudgeElement(e.key, nudge);
                    }
                }
            });
        }

        // ==========================================
        // TOOL PANEL MANAGEMENT
        // ==========================================
        function setActiveTool(tool) {
            console.log('setActiveTool called with:', tool);
            currentTool = tool;
            
            // Update sidebar
            document.querySelectorAll('.sidebar-tool').forEach(t => t.classList.remove('active'));
            document.querySelector(`.sidebar-tool[data-tool="${tool}"]`)?.classList.add('active');
            
            // Show appropriate panel
            console.log('Calling showToolPanel for:', tool);
            showToolPanel(tool);
        }

        function showToolPanel(tool) {
            console.log('showToolPanel called with:', tool);
            const panel = document.getElementById('propertiesPanel');
            console.log('Properties panel found:', !!panel);
            
            switch(tool) {
                case 'select':
                    console.log('Hiding panel for select tool');
                    panel.classList.remove('visible');
                    break;
                case 'text':
                    console.log('Showing text panel');
                    showTextPanel();
                    break;
                case 'uploads':
                    console.log('Showing uploads panel');
                    showUploadsPanel();
                    break;
                case 'photos':
                    console.log('Showing photos panel');
                    showPhotosPanel();
                    break;
                case 'elements':
                    console.log('Showing elements panel');
                    showElementsPanel();
                    break;
                case 'frames':
                    console.log('Showing frames panel');
                    showFramesPanel();
                    break;
                case 'background':
                    console.log('Showing background panel');
                    showBackgroundPanel();
                    break;
                case 'pages':
                    console.log('Showing pages panel');
                    showPagesPanel();
                    break;
                case 'settings':
                    console.log('Showing settings panel');
                    showSettingsPanel();
                    break;
                default:
                    console.log('Unknown tool, hiding panel');
                    panel.classList.remove('visible');
            }
        }

        function showTextPanel() {
            const panel = document.getElementById('propertiesPanel');
            panel.innerHTML = `
                <div class="panel-header">
                    <span class="panel-title">Text</span>
                    <button class="panel-close" onclick="closePanel()"><i class="fas fa-times"></i></button>
                </div>
                <div class="panel-content">
                    <div class="quick-actions">
                        <button class="quick-action-btn" onclick="addTextElement('heading')">
                            <i class="fas fa-heading"></i>
                            <span>Heading</span>
                        </button>
                        <button class="quick-action-btn" onclick="addTextElement('subheading')">
                            <i class="fas fa-text-height"></i>
                            <span>Subheading</span>
                        </button>
                        <button class="quick-action-btn" onclick="addTextElement('body')">
                            <i class="fas fa-paragraph"></i>
                            <span>Body</span>
                        </button>
                    </div>
                    
                    <div class="panel-section">
                        <div class="panel-section-title">Text Templates</div>
                        <div class="text-template-grid">
                            <div class="text-template-item" onclick="addTextTemplate('wedding')">
                                <div class="template-preview" style="font-family: 'Great Vibes'; font-size: 18px;">John & Jane</div>
                                <div class="template-name">Wedding Names</div>
                            </div>
                            <div class="text-template-item" onclick="addTextTemplate('date')">
                                <div class="template-preview" style="font-family: 'Playfair Display'; font-size: 14px;">December 25, 2024</div>
                                <div class="template-name">Event Date</div>
                            </div>
                            <div class="text-template-item" onclick="addTextTemplate('invitation')">
                                <div class="template-preview" style="font-family: 'Montserrat'; font-size: 12px;">You are cordially invited</div>
                                <div class="template-name">Invitation Text</div>
                            </div>
                            <div class="text-template-item" onclick="addTextTemplate('rsvp')">
                                <div class="template-preview" style="font-family: 'Open Sans'; font-size: 12px;">RSVP by December 1st</div>
                                <div class="template-name">RSVP Text</div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            panel.classList.add('visible');
        }

        function showUploadsPanel() {
            const panel = document.getElementById('propertiesPanel');
            panel.innerHTML = `
                <div class="panel-header">
                    <span class="panel-title">Uploads</span>
                    <button class="panel-close" onclick="closePanel()"><i class="fas fa-times"></i></button>
                </div>
                <div class="panel-content">
                    <div class="upload-area" id="uploadArea" onclick="document.getElementById('imageInput').click()">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Drag & drop or <span>click to upload</span></p>
                    </div>
                    <input type="file" id="imageInput" accept="image/*" multiple style="display: none;" onchange="handleImageUpload(event)">
                    
                    <div class="uploaded-images" id="uploadedImagesContainer">
                        <div class="uploaded-images-title">Your Uploads</div>
                        <div class="image-grid" id="uploadedImagesGrid">
                            ${uploadedImages.length === 0 ? '<p style="grid-column: 1/-1; text-align: center; color: var(--neutral-400); font-size: 12px; padding: 20px;">No images uploaded yet</p>' : ''}
                        </div>
                    </div>
                </div>
            `;
            panel.classList.add('visible');
            setupUploadDragDrop();
            renderUploadedImages();
        }

        function showPhotosPanel() {
            const panel = document.getElementById('propertiesPanel');
            panel.innerHTML = `
                <div class="panel-header">
                    <span class="panel-title">Photos</span>
                    <button class="panel-close" onclick="closePanel()"><i class="fas fa-times"></i></button>
                </div>
                <div class="panel-content">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" id="photoSearch" placeholder="Search free photos..." onkeypress="if(event.key==='Enter') searchPhotos()">
                    </div>
                    
                    <div class="panel-section">
                        <div class="panel-section-title">Popular Categories</div>
                        <div style="display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: 16px;">
                            <button class="toolbar-btn" style="height: 28px; font-size: 11px;" onclick="searchPhotos('wedding')">Wedding</button>
                            <button class="toolbar-btn" style="height: 28px; font-size: 11px;" onclick="searchPhotos('flowers')">Flowers</button>
                            <button class="toolbar-btn" style="height: 28px; font-size: 11px;" onclick="searchPhotos('nature')">Nature</button>
                            <button class="toolbar-btn" style="height: 28px; font-size: 11px;" onclick="searchPhotos('celebration')">Celebration</button>
                            <button class="toolbar-btn" style="height: 28px; font-size: 11px;" onclick="searchPhotos('love')">Love</button>
                        </div>
                    </div>
                    
                    <div id="photosGrid" class="image-grid">
                        <div class="loading-spinner" style="grid-column: 1/-1;">
                            <i class="fas fa-spinner"></i>
                        </div>
                    </div>
                </div>
            `;
            panel.classList.add('visible');
            searchPhotos('wedding'); // Load default photos
        }

        function showElementsPanel() {
            const panel = document.getElementById('propertiesPanel');
            panel.innerHTML = `
                <div class="panel-header">
                    <span class="panel-title">Elements</span>
                    <button class="panel-close" onclick="closePanel()"><i class="fas fa-times"></i></button>
                </div>
                <div class="panel-tabs">
                    <div class="panel-tab active" onclick="showElementTab('shapes')">Shapes</div>
                    <div class="panel-tab" onclick="showElementTab('lines')">Lines</div>
                    <div class="panel-tab" onclick="showElementTab('icons')">Icons</div>
                </div>
                <div class="panel-content">
                    <div id="shapesTab" class="tab-content active">
                        <div class="panel-section-title">Basic Shapes</div>
                        <div class="element-grid">
                            <div class="element-item shape-item" onclick="addShape('rectangle')">
                                <svg viewBox="0 0 100 100"><rect x="10" y="10" width="80" height="80" fill="#ef4444"/></svg>
                            </div>
                            <div class="element-item shape-item" onclick="addShape('circle')">
                                <svg viewBox="0 0 100 100"><circle cx="50" cy="50" r="40" fill="#ef4444"/></svg>
                            </div>
                            <div class="element-item shape-item" onclick="addShape('triangle')">
                                <svg viewBox="0 0 100 100"><polygon points="50,10 90,90 10,90" fill="#ef4444"/></svg>
                            </div>
                            <div class="element-item shape-item" onclick="addShape('star')">
                                <svg viewBox="0 0 100 100"><polygon points="50,5 61,40 98,40 68,62 79,97 50,75 21,97 32,62 2,40 39,40" fill="#ef4444"/></svg>
                            </div>
                            <div class="element-item shape-item" onclick="addShape('heart')">
                                <svg viewBox="0 0 100 100"><path d="M50,88 C20,60 5,40 5,25 C5,10 20,5 35,15 C42,20 47,25 50,30 C53,25 58,20 65,15 C80,5 95,10 95,25 C95,40 80,60 50,88 Z" fill="#ef4444"/></svg>
                            </div>
                            <div class="element-item shape-item" onclick="addShape('hexagon')">
                                <svg viewBox="0 0 100 100"><polygon points="50,5 93,25 93,75 50,95 7,75 7,25" fill="#ef4444"/></svg>
                            </div>
                            <div class="element-item shape-item" onclick="addShape('diamond')">
                                <svg viewBox="0 0 100 100"><polygon points="50,5 95,50 50,95 5,50" fill="#ef4444"/></svg>
                            </div>
                            <div class="element-item shape-item" onclick="addShape('rounded-rect')">
                                <svg viewBox="0 0 100 100"><rect x="10" y="10" width="80" height="80" rx="15" fill="#ef4444"/></svg>
                            </div>
                            <div class="element-item shape-item" onclick="addShape('oval')">
                                <svg viewBox="0 0 100 100"><ellipse cx="50" cy="50" rx="45" ry="30" fill="#ef4444"/></svg>
                            </div>
                        </div>
                    </div>
                    
                    <div id="linesTab" class="tab-content">
                        <div class="panel-section-title">Lines & Arrows</div>
                        <div class="element-grid">
                            <div class="element-item shape-item" onclick="addLine('horizontal')">
                                <svg viewBox="0 0 100 100"><line x1="10" y1="50" x2="90" y2="50" stroke="#ef4444" stroke-width="4"/></svg>
                            </div>
                            <div class="element-item shape-item" onclick="addLine('vertical')">
                                <svg viewBox="0 0 100 100"><line x1="50" y1="10" x2="50" y2="90" stroke="#ef4444" stroke-width="4"/></svg>
                            </div>
                            <div class="element-item shape-item" onclick="addLine('diagonal')">
                                <svg viewBox="0 0 100 100"><line x1="10" y1="90" x2="90" y2="10" stroke="#ef4444" stroke-width="4"/></svg>
                            </div>
                            <div class="element-item shape-item" onclick="addLine('arrow-right')">
                                <svg viewBox="0 0 100 100"><line x1="10" y1="50" x2="80" y2="50" stroke="#ef4444" stroke-width="4"/><polygon points="75,35 95,50 75,65" fill="#ef4444"/></svg>
                            </div>
                            <div class="element-item shape-item" onclick="addLine('double-arrow')">
                                <svg viewBox="0 0 100 100"><line x1="20" y1="50" x2="80" y2="50" stroke="#ef4444" stroke-width="4"/><polygon points="25,35 5,50 25,65" fill="#ef4444"/><polygon points="75,35 95,50 75,65" fill="#ef4444"/></svg>
                            </div>
                            <div class="element-item shape-item" onclick="addLine('dashed')">
                                <svg viewBox="0 0 100 100"><line x1="10" y1="50" x2="90" y2="50" stroke="#ef4444" stroke-width="4" stroke-dasharray="10,5"/></svg>
                            </div>
                        </div>
                    </div>
                    
                    <div id="iconsTab" class="tab-content">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Search icons...">
                        </div>
                        <div class="panel-section-title">Popular Icons</div>
                        <div class="element-grid">
                            <div class="element-item" onclick="addIcon('heart')"><i class="fas fa-heart" style="color: #ef4444;"></i></div>
                            <div class="element-item" onclick="addIcon('star')"><i class="fas fa-star" style="color: #f59e0b;"></i></div>
                            <div class="element-item" onclick="addIcon('ring')"><i class="fas fa-ring" style="color: #f59e0b;"></i></div>
                            <div class="element-item" onclick="addIcon('cake')"><i class="fas fa-birthday-cake" style="color: #ec4899;"></i></div>
                            <div class="element-item" onclick="addIcon('gift')"><i class="fas fa-gift" style="color: #8b5cf6;"></i></div>
                            <div class="element-item" onclick="addIcon('music')"><i class="fas fa-music" style="color: #3b82f6;"></i></div>
                            <div class="element-item" onclick="addIcon('camera')"><i class="fas fa-camera" style="color: #6366f1;"></i></div>
                            <div class="element-item" onclick="addIcon('glass')"><i class="fas fa-glass-cheers" style="color: #f59e0b;"></i></div>
                            <div class="element-item" onclick="addIcon('flower')"><i class="fas fa-spa" style="color: #ec4899;"></i></div>
                            <div class="element-item" onclick="addIcon('dove')"><i class="fas fa-dove" style="color: #6b7280;"></i></div>
                            <div class="element-item" onclick="addIcon('church')"><i class="fas fa-church" style="color: #6b7280;"></i></div>
                            <div class="element-item" onclick="addIcon('bell')"><i class="fas fa-bell" style="color: #f59e0b;"></i></div>
                        </div>
                    </div>
                </div>
            `;
            panel.classList.add('visible');
        }

        function showFramesPanel() {
            const panel = document.getElementById('propertiesPanel');
            panel.innerHTML = `
                <div class="panel-header">
                    <span class="panel-title">Frames</span>
                    <button class="panel-close" onclick="closePanel()"><i class="fas fa-times"></i></button>
                </div>
                <div class="panel-content">
                    <div class="panel-section">
                        <div class="panel-section-title">Photo Frames</div>
                        <div class="frame-grid">
                            <div class="frame-item" onclick="addFrame('square')">
                                <svg viewBox="0 0 100 100"><rect x="5" y="5" width="90" height="90" fill="none" stroke="#d4d4d4" stroke-width="8"/></svg>
                            </div>
                            <div class="frame-item" onclick="addFrame('circle')">
                                <svg viewBox="0 0 100 100"><circle cx="50" cy="50" r="45" fill="none" stroke="#d4d4d4" stroke-width="8"/></svg>
                            </div>
                            <div class="frame-item" onclick="addFrame('rounded')">
                                <svg viewBox="0 0 100 100"><rect x="5" y="5" width="90" height="90" rx="20" fill="none" stroke="#d4d4d4" stroke-width="8"/></svg>
                            </div>
                            <div class="frame-item" onclick="addFrame('heart')">
                                <svg viewBox="0 0 100 100"><path d="M50,88 C20,60 5,40 5,25 C5,10 20,5 35,15 C42,20 47,25 50,30 C53,25 58,20 65,15 C80,5 95,10 95,25 C95,40 80,60 50,88 Z" fill="none" stroke="#d4d4d4" stroke-width="4"/></svg>
                            </div>
                            <div class="frame-item" onclick="addFrame('star')">
                                <svg viewBox="0 0 100 100"><polygon points="50,5 61,40 98,40 68,62 79,97 50,75 21,97 32,62 2,40 39,40" fill="none" stroke="#d4d4d4" stroke-width="4"/></svg>
                            </div>
                            <div class="frame-item" onclick="addFrame('hexagon')">
                                <svg viewBox="0 0 100 100"><polygon points="50,5 93,25 93,75 50,95 7,75 7,25" fill="none" stroke="#d4d4d4" stroke-width="4"/></svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel-section">
                        <div class="panel-section-title">Decorative Borders</div>
                        <div class="frame-grid">
                            <div class="frame-item" onclick="addBorder('simple')">
                                <svg viewBox="0 0 100 100"><rect x="10" y="10" width="80" height="80" fill="none" stroke="#d4d4d4" stroke-width="2"/><rect x="5" y="5" width="90" height="90" fill="none" stroke="#d4d4d4" stroke-width="1"/></svg>
                            </div>
                            <div class="frame-item" onclick="addBorder('double')">
                                <svg viewBox="0 0 100 100"><rect x="8" y="8" width="84" height="84" fill="none" stroke="#d4d4d4" stroke-width="2"/><rect x="15" y="15" width="70" height="70" fill="none" stroke="#d4d4d4" stroke-width="2"/></svg>
                            </div>
                            <div class="frame-item" onclick="addBorder('ornate')">
                                <svg viewBox="0 0 100 100"><rect x="10" y="10" width="80" height="80" fill="none" stroke="#d4d4d4" stroke-width="2"/><circle cx="10" cy="10" r="5" fill="#d4d4d4"/><circle cx="90" cy="10" r="5" fill="#d4d4d4"/><circle cx="10" cy="90" r="5" fill="#d4d4d4"/><circle cx="90" cy="90" r="5" fill="#d4d4d4"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            panel.classList.add('visible');
        }

        // NEW: Background Panel
        function showBackgroundPanel() {
            const panel = document.getElementById('propertiesPanel');
            
            // Generate page checkboxes for "Apply to" section
            const pageCheckboxes = pages.map((page, idx) => `
                <label style="display: flex; align-items: center; gap: 8px; padding: 6px 0; cursor: pointer;">
                    <input type="checkbox" id="bgPage_${idx}" value="${idx}" ${idx === currentPageIndex ? 'checked' : ''} 
                           style="width: 16px; height: 16px; cursor: pointer;">
                    <span style="font-size: 13px;">${page.name}</span>
                </label>
            `).join('');
            
            panel.innerHTML = `
                <div class="panel-header">
                    <span class="panel-title">Background</span>
                    <button class="panel-close" onclick="closePanel()"><i class="fas fa-times"></i></button>
                </div>
                <div class="panel-content">
                    <div class="panel-section">
                        <div class="panel-section-title">Background Type</div>
                        <div style="display: flex; gap: 8px; margin-bottom: 16px;">
                            <button class="toolbar-btn ${canvasBackground.type === 'color' ? 'active' : ''}" 
                                    onclick="setBackgroundType('color')" style="flex: 1;">
                                <i class="fas fa-palette"></i> Color
                            </button>
                            <button class="toolbar-btn ${canvasBackground.type === 'image' ? 'active' : ''}" 
                                    onclick="setBackgroundType('image')" style="flex: 1;">
                                <i class="fas fa-image"></i> Image
                            </button>
                        </div>
                    </div>
                    
                    <div class="panel-section">
                        <div class="panel-section-title">Background Color</div>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <input type="color" id="bgColorPicker" value="${canvasBackground.color}" 
                                   onchange="updateBackgroundColor(this.value)" 
                                   style="width: 48px; height: 48px; border: none; cursor: pointer; border-radius: 8px;">
                            <div style="flex: 1;">
                                <input type="text" id="bgColorHex" value="${canvasBackground.color}" 
                                       onchange="updateBackgroundColor(this.value)"
                                       class="form-control" style="font-family: monospace;">
                            </div>
                        </div>
                        <div style="display: flex; flex-wrap: wrap; gap: 6px; margin-top: 12px;">
                            <div class="color-swatch" onclick="updateBackgroundColor('#ffffff')" style="background: #ffffff; border: 1px solid #ddd;"></div>
                            <div class="color-swatch" onclick="updateBackgroundColor('#f8f9fa')" style="background: #f8f9fa;"></div>
                            <div class="color-swatch" onclick="updateBackgroundColor('#fef3c7')" style="background: #fef3c7;"></div>
                            <div class="color-swatch" onclick="updateBackgroundColor('#fce7f3')" style="background: #fce7f3;"></div>
                            <div class="color-swatch" onclick="updateBackgroundColor('#dbeafe')" style="background: #dbeafe;"></div>
                            <div class="color-swatch" onclick="updateBackgroundColor('#d1fae5')" style="background: #d1fae5;"></div>
                            <div class="color-swatch" onclick="updateBackgroundColor('#1f2937')" style="background: #1f2937;"></div>
                            <div class="color-swatch" onclick="updateBackgroundColor('#000000')" style="background: #000000;"></div>
                        </div>
                    </div>
                    
                    <div class="panel-section" id="bgImageSection" style="${canvasBackground.type === 'image' ? '' : 'display: none;'}">
                        <div class="panel-section-title">Background Image</div>
                        <div class="upload-area" onclick="document.getElementById('bgImageInput').click()" style="margin-bottom: 12px;">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Click to upload image</p>
                        </div>
                        <input type="file" id="bgImageInput" accept="image/*" style="display: none;" onchange="handleBackgroundImageUpload(event)">
                        
                        ${canvasBackground.image ? `
                        <div style="margin-bottom: 12px;">
                            <img src="${canvasBackground.image}" style="width: 100%; max-height: 100px; object-fit: cover; border-radius: 8px;">
                            <button class="toolbar-btn danger" onclick="removeBackgroundImage()" style="width: 100%; margin-top: 8px;">
                                <i class="fas fa-trash"></i> Remove Image
                            </button>
                        </div>
                        ` : ''}
                        
                        <div class="form-group">
                            <label class="form-label">Image Size</label>
                            <select id="bgImageSize" class="form-select" onchange="updateBackgroundSize(this.value)">
                                <option value="cover" ${canvasBackground.size === 'cover' ? 'selected' : ''}>Cover (Fill)</option>
                                <option value="contain" ${canvasBackground.size === 'contain' ? 'selected' : ''}>Contain (Fit)</option>
                                <option value="stretch" ${canvasBackground.size === 'stretch' ? 'selected' : ''}>Stretch</option>
                                <option value="tile" ${canvasBackground.size === 'tile' ? 'selected' : ''}>Tile (Repeat)</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Opacity: <span id="bgOpacityValue">${Math.round(canvasBackground.opacity * 100)}%</span></label>
                            <input type="range" id="bgOpacitySlider" min="0" max="100" value="${canvasBackground.opacity * 100}" 
                                   onchange="updateBackgroundOpacity(this.value / 100)" style="width: 100%;">
                        </div>
                    </div>
                    
                    ${pages.length > 1 ? `
                    <div class="panel-section">
                        <div class="panel-section-title">Apply Background To</div>
                        <div style="margin-bottom: 12px;">
                            <label style="display: flex; align-items: center; gap: 8px; padding: 6px 0; cursor: pointer; font-weight: 500;">
                                <input type="checkbox" id="bgAllPages" onchange="toggleAllPagesBackground(this.checked)"
                                       style="width: 16px; height: 16px; cursor: pointer;">
                                <span style="font-size: 13px;">All Pages</span>
                            </label>
                            <div style="border-left: 2px solid var(--neutral-200); margin-left: 8px; padding-left: 12px;">
                                ${pageCheckboxes}
                            </div>
                        </div>
                        <button class="toolbar-btn" onclick="applyBackgroundToSelectedPages()" style="width: 100%;">
                            <i class="fas fa-check"></i> Apply to Selected Pages
                        </button>
                    </div>
                    ` : ''}
                </div>
            `;
            panel.classList.add('visible');
        }
        
        function toggleAllPagesBackground(checked) {
            pages.forEach((_, idx) => {
                const checkbox = document.getElementById('bgPage_' + idx);
                if (checkbox) checkbox.checked = checked;
            });
        }
        
        function applyBackgroundToSelectedPages() {
            console.log('applyBackgroundToSelectedPages called');
            console.log('Current canvasBackground:', canvasBackground);
            console.log('Pages before apply:', JSON.parse(JSON.stringify(pages)));
            
            // First save current page to ensure canvasBackground is up to date
            saveCurrentPage();
            
            const selectedPages = [];
            pages.forEach((_, idx) => {
                const checkbox = document.getElementById('bgPage_' + idx);
                console.log('Checkbox bgPage_' + idx + ':', checkbox, 'checked:', checkbox?.checked);
                if (checkbox && checkbox.checked) {
                    selectedPages.push(idx);
                }
            });
            
            console.log('Selected pages:', selectedPages);
            
            if (selectedPages.length === 0) {
                alert('Please select at least one page');
                return;
            }
            
            // Apply current background to selected pages (deep copy to avoid reference issues)
            const bgToApply = JSON.parse(JSON.stringify(canvasBackground));
            console.log('Background to apply:', bgToApply);
            
            selectedPages.forEach(idx => {
                pages[idx].background = JSON.parse(JSON.stringify(bgToApply));
                console.log('Applied to page', idx, ':', pages[idx].background);
            });
            
            console.log('Pages after apply:', JSON.parse(JSON.stringify(pages)));
            
            // Show success feedback
            const statusEl = document.createElement('div');
            statusEl.innerHTML = '<i class="fas fa-check"></i> Background applied to ' + selectedPages.length + ' page(s)';
            statusEl.style.cssText = 'position:fixed;top:20px;left:50%;transform:translateX(-50%);background:#10b981;color:white;padding:10px 20px;border-radius:8px;z-index:10000;font-size:14px;box-shadow:0 4px 12px rgba(0,0,0,0.15);';
            document.body.appendChild(statusEl);
            setTimeout(() => statusEl.remove(), 2000);
            
            saveState();
        }
        
        function setBackgroundType(type) {
            canvasBackground.type = type;
            applyCanvasBackground();
            showBackgroundPanel(); // Refresh panel
            saveCurrentPage();
        }
        
        function updateBackgroundColor(color) {
            canvasBackground.color = color;
            document.getElementById('bgColorPicker').value = color;
            document.getElementById('bgColorHex').value = color;
            applyCanvasBackground();
            saveCurrentPage();
        }
        
        function handleBackgroundImageUpload(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    canvasBackground.image = e.target.result;
                    canvasBackground.type = 'image';
                    applyCanvasBackground();
                    showBackgroundPanel(); // Refresh panel
                    saveCurrentPage();
                };
                reader.readAsDataURL(file);
            }
        }
        
        function removeBackgroundImage() {
            canvasBackground.image = null;
            canvasBackground.type = 'color';
            applyCanvasBackground();
            showBackgroundPanel(); // Refresh panel
            saveCurrentPage();
        }
        
        function updateBackgroundSize(size) {
            canvasBackground.size = size;
            applyCanvasBackground();
            saveCurrentPage();
        }
        
        function updateBackgroundOpacity(opacity) {
            canvasBackground.opacity = opacity;
            document.getElementById('bgOpacityValue').textContent = Math.round(opacity * 100) + '%';
            applyCanvasBackground();
            saveCurrentPage();
        }

        // NEW: Pages Panel
        function showPagesPanel() {
            const panel = document.getElementById('propertiesPanel');
            panel.innerHTML = `
                <div class="panel-header">
                    <span class="panel-title">Pages</span>
                    <button class="panel-close" onclick="closePanel()"><i class="fas fa-times"></i></button>
                </div>
                <div class="panel-content">
                    <div style="display: flex; gap: 8px; margin-bottom: 16px;">
                        <button class="toolbar-btn primary" onclick="addNewPage()" style="flex: 1;">
                            <i class="fas fa-plus"></i> Add Page
                        </button>
                    </div>
                    
                    <div class="panel-section">
                        <div class="panel-section-title">All Pages (${pages.length})</div>
                        <div id="pagesList" class="pages-list">
                            ${pages.map((page, index) => `
                                <div class="page-item ${index === currentPageIndex ? 'active' : ''}" 
                                     onclick="switchToPage(${index})" data-page-index="${index}">
                                    <div class="page-thumbnail">
                                        <span class="page-number">${index + 1}</span>
                                    </div>
                                    <div class="page-info">
                                        <input type="text" class="page-name-input" value="${page.name}" 
                                               onclick="event.stopPropagation()" 
                                               onchange="renamePage(${index}, this.value)"
                                               onblur="renamePage(${index}, this.value)">
                                        <span class="page-elements">${page.elements?.length || 0} elements</span>
                                    </div>
                                    <div class="page-actions">
                                        <button class="page-action-btn" onclick="event.stopPropagation(); duplicatePage(${index})" title="Duplicate">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                        ${pages.length > 1 ? `
                                        <button class="page-action-btn danger" onclick="event.stopPropagation(); deletePage(${index})" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        ` : ''}
                                    </div>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                </div>
            `;
            panel.classList.add('visible');
        }
        
        function saveCurrentPage() {
            if (pages[currentPageIndex]) {
                pages[currentPageIndex].elements = JSON.parse(JSON.stringify(elements));
                pages[currentPageIndex].background = JSON.parse(JSON.stringify(canvasBackground));
                console.log('Saved page', currentPageIndex, 'background:', pages[currentPageIndex].background);
            }
        }
        
        function switchToPage(index) {
            console.log('switchToPage called with index:', index);
            if (index < 0 || index >= pages.length) return;
            
            // Save current page
            saveCurrentPage();
            
            // Clear selection
            deselectAll();
            
            // Switch to new page
            currentPageIndex = index;
            elements = pages[index].elements ? JSON.parse(JSON.stringify(pages[index].elements)) : [];
            canvasBackground = pages[index].background ? JSON.parse(JSON.stringify(pages[index].background)) : { type: 'color', color: '#ffffff', image: null, opacity: 1, size: 'cover' };
            
            console.log('Switched to page', index, 'background:', canvasBackground);
            
            // Re-render
            renderAllElements();
            applyCanvasBackground();
            updateLayersList();
            updatePageIndicator();
            
            // Refresh panel if open
            const panel = document.getElementById('propertiesPanel');
            if (panel.classList.contains('visible') && currentTool === 'pages') {
                showPagesPanel();
            }
        }
        
        function addNewPage() {
            saveCurrentPage();
            
            const newPageId = 'page_' + (pages.length + 1) + '_' + Date.now();
            const newPage = {
                id: newPageId,
                name: 'Page ' + (pages.length + 1),
                elements: [],
                background: { type: 'color', color: '#ffffff', image: null, opacity: 1, size: 'cover' }
            };
            
            pages.push(newPage);
            switchToPage(pages.length - 1);
        }
        
        function duplicatePage(index) {
            saveCurrentPage();
            
            const sourcePage = pages[index];
            const newPage = {
                id: 'page_' + (pages.length + 1) + '_' + Date.now(),
                name: sourcePage.name + ' (Copy)',
                elements: JSON.parse(JSON.stringify(sourcePage.elements)), // Deep copy
                background: { ...sourcePage.background }
            };
            
            // Update element IDs to be unique
            newPage.elements.forEach(el => {
                el.id = 'element_' + (++elementCounter);
            });
            
            pages.splice(index + 1, 0, newPage);
            switchToPage(index + 1);
        }
        
        function deletePage(index) {
            if (pages.length <= 1) {
                alert('Cannot delete the last page');
                return;
            }
            
            if (!confirm('Are you sure you want to delete this page?')) return;
            
            pages.splice(index, 1);
            
            // Adjust current page index if needed
            if (currentPageIndex >= pages.length) {
                currentPageIndex = pages.length - 1;
            } else if (currentPageIndex > index) {
                currentPageIndex--;
            }
            
            // Load the current page
            elements = pages[currentPageIndex].elements || [];
            canvasBackground = pages[currentPageIndex].background || { type: 'color', color: '#ffffff', image: null, opacity: 1, size: 'cover' };
            
            renderAllElements();
            applyCanvasBackground();
            updateLayersList();
            showPagesPanel();
        }
        
        function renamePage(index, newName) {
            if (pages[index]) {
                pages[index].name = newName || 'Page ' + (index + 1);
            }
        }
        
        function updatePagesList() {
            // Called when pages change - refresh if panel is open
            const panel = document.getElementById('propertiesPanel');
            if (panel.classList.contains('visible') && currentTool === 'pages') {
                showPagesPanel();
            }
            // Update page indicator
            updatePageIndicator();
        }
        
        function updatePageIndicator() {
            const indicator = document.getElementById('pageIndicatorText');
            const prevBtn = document.getElementById('prevPageBtn');
            const nextBtn = document.getElementById('nextPageBtn');
            
            if (indicator) {
                indicator.textContent = `Page ${currentPageIndex + 1} of ${pages.length}`;
            }
            if (prevBtn) {
                prevBtn.disabled = currentPageIndex === 0;
            }
            if (nextBtn) {
                nextBtn.disabled = currentPageIndex >= pages.length - 1;
            }
        }
        
        function navigatePage(direction) {
            const newIndex = currentPageIndex + direction;
            if (newIndex >= 0 && newIndex < pages.length) {
                switchToPage(newIndex);
            }
        }
        
        function renderAllElements() {
            const canvas = document.getElementById('designCanvas');
            // Clear existing elements
            canvas.querySelectorAll('.canvas-element').forEach(el => el.remove());
            // Render all elements
            elements.forEach(el => renderElement(el));
        }
        
        // NEW: Apply canvas background
        function applyCanvasBackground() {
            const canvas = document.getElementById('designCanvas');
            
            // Remove existing background overlay if any
            let bgOverlay = canvas.querySelector('.canvas-background-overlay');
            if (bgOverlay) bgOverlay.remove();
            
            if (canvasBackground.type === 'image' && canvasBackground.image) {
                // Create an overlay div for the background image with opacity
                bgOverlay = document.createElement('div');
                bgOverlay.className = 'canvas-background-overlay';
                bgOverlay.style.cssText = `
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    pointer-events: none;
                    z-index: 0;
                    background-color: ${canvasBackground.color || '#ffffff'};
                    background-image: url('${canvasBackground.image}');
                    background-size: ${canvasBackground.size === 'tile' ? 'auto' : (canvasBackground.size === 'stretch' ? '100% 100%' : canvasBackground.size)};
                    background-repeat: ${canvasBackground.size === 'tile' ? 'repeat' : 'no-repeat'};
                    background-position: center;
                    opacity: ${canvasBackground.opacity};
                `;
                canvas.insertBefore(bgOverlay, canvas.firstChild);
                canvas.style.backgroundColor = canvasBackground.color || '#ffffff';
            } else {
                canvas.style.backgroundColor = canvasBackground.color || '#ffffff';
                canvas.style.backgroundImage = 'none';
            }
        }

        function showSettingsPanel() {
            const panel = document.getElementById('propertiesPanel');
            panel.innerHTML = `
                <div class="panel-header">
                    <span class="panel-title">Design Settings</span>
                    <button class="panel-close" onclick="closePanel()"><i class="fas fa-times"></i></button>
                </div>
                <div class="panel-content">
                    <form id="settingsForm">
                        <div class="panel-section">
                            <div class="panel-section-title">Basic Info</div>
                            
                            <div class="form-group">
                                <label class="form-label">Design Name <span style="color: var(--danger);">*</span></label>
                                <input type="text" id="settingsDesignName" class="form-control" placeholder="My Wedding Invitation" value="${document.getElementById('design_name').value}">
                            </div>
                            
                            {{-- User is auto-populated with logged-in user --}}
                            <input type="hidden" id="settingsUserId" value="{{ auth()->user()->id }}">
                        </div>
                        
                        <div class="panel-section">
                            <div class="panel-section-title">Canvas Size</div>
                            
                            <div class="position-controls">
                                <div class="position-input-group">
                                    <label>W</label>
                                    <input type="number" id="settingsCanvasWidth" value="${canvasWidth}" onchange="updateCanvasSize()">
                                </div>
                                <div class="position-input-group">
                                    <label>H</label>
                                    <input type="number" id="settingsCanvasHeight" value="${canvasHeight}" onchange="updateCanvasSize()">
                                </div>
                            </div>
                            
                            <div style="margin-top: 12px;">
                                <div class="panel-section-title">Presets</div>
                                <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                                    <button type="button" class="toolbar-btn" style="height: 28px; font-size: 11px;" onclick="setCanvasPreset(800, 600)">4:3</button>
                                    <button type="button" class="toolbar-btn" style="height: 28px; font-size: 11px;" onclick="setCanvasPreset(1080, 1080)">Square</button>
                                    <button type="button" class="toolbar-btn" style="height: 28px; font-size: 11px;" onclick="setCanvasPreset(1080, 1920)">Story</button>
                                    <button type="button" class="toolbar-btn" style="height: 28px; font-size: 11px;" onclick="setCanvasPreset(1200, 628)">Facebook</button>
                                    <button type="button" class="toolbar-btn" style="height: 28px; font-size: 11px;" onclick="setCanvasPreset(800, 1200)">A4 Portrait</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="panel-section">
                            <div class="panel-section-title">Status</div>
                            
                            <div class="form-group">
                                <select id="settingsStatus" class="form-select">
                                    <option value="draft">Draft</option>
                                    <option value="completed">Completed</option>
                                    <option value="archived">Archived</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="panel-section">
                            <div class="panel-section-title">Editor Options</div>
                            
                            <div class="form-group">
                                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                    <input type="checkbox" id="settingsSmartGuides" ${showSmartGuides ? 'checked' : ''} onchange="showSmartGuides = this.checked">
                                    <span class="form-label" style="margin: 0;">Show Smart Guides</span>
                                </label>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Snap Threshold (px)</label>
                                <input type="number" id="settingsSnapThreshold" class="form-control" value="${snapThreshold}" min="1" max="20" onchange="snapThreshold = parseInt(this.value)">
                            </div>
                        </div>
                        
                        <button type="button" class="toolbar-btn primary" style="width: 100%;" onclick="applySettings()">
                            <i class="fas fa-check"></i> Apply Settings
                        </button>
                    </form>
                </div>
            `;
            panel.classList.add('visible');
            
            // Set current values
            document.getElementById('settingsStatus').value = document.getElementById('status').value;
        }

        function showElementTab(tab) {
            document.querySelectorAll('.panel-tab').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
            
            event.target.classList.add('active');
            document.getElementById(tab + 'Tab').classList.add('active');
        }

        function closePanel() {
            document.getElementById('propertiesPanel').classList.remove('visible');
            setActiveTool('select');
        }

        function closeAllPanels() {
            document.getElementById('propertiesPanel').classList.remove('visible');
        }

        // ==========================================
        // ELEMENT CREATION
        // ==========================================
        function addTextElement(type = 'body') {
            saveState();
            
            const id = 'element_' + (++elementCounter);
            let content, styles;
            
            switch(type) {
                case 'heading':
                    content = 'Add a heading';
                    styles = {
                        fontFamily: 'Playfair Display',
                        fontSize: '48px',
                        fontWeight: 'bold',
                        fontStyle: 'normal',
                        textDecoration: 'none',
                        textAlign: 'center',
                        color: '#000000'
                    };
                    break;
                case 'subheading':
                    content = 'Add a subheading';
                    styles = {
                        fontFamily: 'Montserrat',
                        fontSize: '24px',
                        fontWeight: '500',
                        fontStyle: 'normal',
                        textDecoration: 'none',
                        textAlign: 'center',
                        color: '#404040'
                    };
                    break;
                default:
                    content = 'Add body text';
                    styles = {
                        fontFamily: 'Open Sans',
                        fontSize: '16px',
                        fontWeight: 'normal',
                        fontStyle: 'normal',
                        textDecoration: 'none',
                        textAlign: 'left',
                        color: '#525252'
                    };
            }
            
            const element = {
                id: id,
                type: 'text',
                x: canvasWidth / 2 - 100,
                y: canvasHeight / 2 - 20,
                width: 200,
                height: 'auto',
                rotation: 0,
                locked: false,
                content: content,
                styles: styles
            };
            
            elements.push(element);
            renderElement(element);
            selectElement(id);
            updateLayersList();
            
            // Focus for editing
            setTimeout(() => {
                const div = document.getElementById(id);
                if (div) {
                    div.contentEditable = true;
                    div.focus();
                    document.execCommand('selectAll', false, null);
                }
            }, 100);
        }

        function addTextTemplate(template) {
            saveState();
            
            const id = 'element_' + (++elementCounter);
            let content, styles;
            
            switch(template) {
                case 'wedding':
                    content = 'John & Jane';
                    styles = {
                        fontFamily: 'Great Vibes',
                        fontSize: '64px',
                        fontWeight: 'normal',
                        fontStyle: 'normal',
                        textDecoration: 'none',
                        textAlign: 'center',
                        color: '#1f2937'
                    };
                    break;
                case 'date':
                    content = 'December 25, 2024';
                    styles = {
                        fontFamily: 'Playfair Display',
                        fontSize: '24px',
                        fontWeight: '500',
                        fontStyle: 'normal',
                        textDecoration: 'none',
                        textAlign: 'center',
                        color: '#6b7280'
                    };
                    break;
                case 'invitation':
                    content = 'You are cordially invited to celebrate';
                    styles = {
                        fontFamily: 'Montserrat',
                        fontSize: '18px',
                        fontWeight: '300',
                        fontStyle: 'normal',
                        textDecoration: 'none',
                        textAlign: 'center',
                        color: '#4b5563'
                    };
                    break;
                case 'rsvp':
                    content = 'RSVP by December 1st';
                    styles = {
                        fontFamily: 'Open Sans',
                        fontSize: '14px',
                        fontWeight: '600',
                        fontStyle: 'normal',
                        textDecoration: 'none',
                        textAlign: 'center',
                        color: '#6b7280'
                    };
                    break;
            }
            
            const element = {
                id: id,
                type: 'text',
                x: canvasWidth / 2 - 150,
                y: canvasHeight / 2 - 30,
                width: 300,
                height: 'auto',
                rotation: 0,
                locked: false,
                content: content,
                styles: styles
            };
            
            elements.push(element);
            renderElement(element);
            selectElement(id);
            updateLayersList();
        }

        function addShape(shapeType) {
            saveState();
            
            const id = 'element_' + (++elementCounter);
            const element = {
                id: id,
                type: 'shape',
                shapeType: shapeType,
                x: canvasWidth / 2 - 50,
                y: canvasHeight / 2 - 50,
                width: 100,
                height: 100,
                rotation: 0,
                locked: false,
                styles: {
                    backgroundColor: '#ef4444',
                    borderColor: 'transparent',
                    borderWidth: '0px',
                    borderRadius: shapeType === 'rounded-rect' ? '15px' : '0px'
                }
            };
            
            elements.push(element);
            renderElement(element);
            selectElement(id);
            updateLayersList();
        }

        function addLine(lineType) {
            saveState();
            
            const id = 'element_' + (++elementCounter);
            const element = {
                id: id,
                type: 'line',
                lineType: lineType,
                x: canvasWidth / 2 - 75,
                y: canvasHeight / 2,
                width: 150,
                height: lineType === 'vertical' ? 150 : 4,
                rotation: 0,
                locked: false,
                styles: {
                    backgroundColor: '#ef4444'
                }
            };
            
            if (lineType === 'vertical') {
                element.width = 4;
                element.height = 150;
            }
            
            elements.push(element);
            renderElement(element);
            selectElement(id);
            updateLayersList();
        }

        function addIcon(iconType) {
            saveState();
            
            const id = 'element_' + (++elementCounter);
            const iconMap = {
                'heart': 'fa-heart',
                'star': 'fa-star',
                'ring': 'fa-ring',
                'cake': 'fa-birthday-cake',
                'gift': 'fa-gift',
                'music': 'fa-music',
                'camera': 'fa-camera',
                'glass': 'fa-glass-cheers',
                'flower': 'fa-spa',
                'dove': 'fa-dove',
                'church': 'fa-church',
                'bell': 'fa-bell'
            };
            
            const colorMap = {
                'heart': '#ef4444',
                'star': '#f59e0b',
                'ring': '#f59e0b',
                'cake': '#ec4899',
                'gift': '#8b5cf6',
                'music': '#3b82f6',
                'camera': '#6366f1',
                'glass': '#f59e0b',
                'flower': '#ec4899',
                'dove': '#6b7280',
                'church': '#6b7280',
                'bell': '#f59e0b'
            };
            
            const element = {
                id: id,
                type: 'icon',
                iconClass: iconMap[iconType] || 'fa-star',
                x: canvasWidth / 2 - 25,
                y: canvasHeight / 2 - 25,
                width: 50,
                height: 50,
                rotation: 0,
                locked: false,
                styles: {
                    color: colorMap[iconType] || '#ef4444'
                }
            };
            
            elements.push(element);
            renderElement(element);
            selectElement(id);
            updateLayersList();
        }

        function addFrame(frameType) {
            saveState();
            
            const id = 'element_' + (++elementCounter);
            const element = {
                id: id,
                type: 'frame',
                frameType: frameType,
                x: canvasWidth / 2 - 75,
                y: canvasHeight / 2 - 75,
                width: 150,
                height: 150,
                rotation: 0,
                locked: false,
                imageSrc: null,
                styles: {
                    borderColor: '#d4d4d4',
                    borderWidth: '4px'
                }
            };
            
            elements.push(element);
            renderElement(element);
            selectElement(id);
            updateLayersList();
        }

        function addBorder(borderType) {
            addFrame(borderType);
        }

        function addImageElement(src, width = 200, height = 200) {
            saveState();
            
            const id = 'element_' + (++elementCounter);
            const element = {
                id: id,
                type: 'image',
                x: canvasWidth / 2 - width / 2,
                y: canvasHeight / 2 - height / 2,
                width: width,
                height: height,
                rotation: 0,
                locked: false,
                src: src
            };
            
            elements.push(element);
            renderElement(element);
            selectElement(id);
            updateLayersList();
        }

        // ==========================================
        // ELEMENT RENDERING
        // ==========================================
        function renderElement(element) {
            const canvas = document.getElementById('designCanvas');
            const div = document.createElement('div');
            div.id = element.id;
            div.className = 'canvas-element ' + element.type + '-element';
            div.style.left = element.x + 'px';
            div.style.top = element.y + 'px';
            
            if (element.rotation) {
                div.style.transform = `rotate(${element.rotation}deg)`;
            }
            
            // Set z-index based on array position
            const index = elements.findIndex(el => el.id === element.id);
            div.style.zIndex = index + 1;
            
            switch(element.type) {
                case 'text':
                    renderTextElement(div, element);
                    break;
                case 'image':
                    renderImageElement(div, element);
                    break;
                case 'shape':
                    renderShapeElement(div, element);
                    break;
                case 'line':
                    renderLineElement(div, element);
                    break;
                case 'icon':
                    renderIconElement(div, element);
                    break;
                case 'frame':
                    renderFrameElement(div, element);
                    break;
            }
            
            // Add drag event listeners
            if (!element.locked) {
                div.addEventListener('mousedown', function(e) {
                    if (e.target.classList.contains('resize-handle') || e.target.classList.contains('rotate-handle')) return;
                    selectElement(element.id, e);
                    
                    // If multiple elements are selected, use multi-drag
                    if (selectedElements.length > 1 && selectedElements.includes(element.id)) {
                        startMultiDrag(e);
                    } else {
                        startDrag(e, element.id);
                    }
                });
            }
            
            canvas.appendChild(div);
        }

        function renderTextElement(div, element) {
            div.contentEditable = false;
            div.textContent = element.content;
            if (element.width && element.width !== 'auto') {
                div.style.width = element.width + 'px';
            }
            Object.assign(div.style, element.styles);
            
            div.addEventListener('dblclick', function(e) {
                if (element.locked) return;
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
        }

        function renderImageElement(div, element) {
            div.style.width = element.width + 'px';
            div.style.height = element.height + 'px';
            const img = document.createElement('img');
            img.src = element.src;
            img.draggable = false;
            div.appendChild(img);
        }

        function renderShapeElement(div, element) {
            div.style.width = element.width + 'px';
            div.style.height = element.height + 'px';
            
            const svgNS = "http://www.w3.org/2000/svg";
            const svg = document.createElementNS(svgNS, "svg");
            svg.setAttribute("viewBox", "0 0 100 100");
            svg.setAttribute("preserveAspectRatio", "none");
            svg.style.width = "100%";
            svg.style.height = "100%";
            
            let shape;
            const fill = element.styles.backgroundColor || '#ef4444';
            const stroke = element.styles.borderColor || 'transparent';
            const strokeWidth = parseInt(element.styles.borderWidth) || 0;
            
            switch(element.shapeType) {
                case 'rectangle':
                case 'rounded-rect':
                    shape = document.createElementNS(svgNS, "rect");
                    shape.setAttribute("x", "2");
                    shape.setAttribute("y", "2");
                    shape.setAttribute("width", "96");
                    shape.setAttribute("height", "96");
                    if (element.shapeType === 'rounded-rect') {
                        shape.setAttribute("rx", "15");
                    }
                    break;
                case 'circle':
                    shape = document.createElementNS(svgNS, "circle");
                    shape.setAttribute("cx", "50");
                    shape.setAttribute("cy", "50");
                    shape.setAttribute("r", "48");
                    break;
                case 'oval':
                    shape = document.createElementNS(svgNS, "ellipse");
                    shape.setAttribute("cx", "50");
                    shape.setAttribute("cy", "50");
                    shape.setAttribute("rx", "48");
                    shape.setAttribute("ry", "30");
                    break;
                case 'triangle':
                    shape = document.createElementNS(svgNS, "polygon");
                    shape.setAttribute("points", "50,5 95,95 5,95");
                    break;
                case 'star':
                    shape = document.createElementNS(svgNS, "polygon");
                    shape.setAttribute("points", "50,5 61,40 98,40 68,62 79,97 50,75 21,97 32,62 2,40 39,40");
                    break;
                case 'heart':
                    shape = document.createElementNS(svgNS, "path");
                    shape.setAttribute("d", "M50,88 C20,60 5,40 5,25 C5,10 20,5 35,15 C42,20 47,25 50,30 C53,25 58,20 65,15 C80,5 95,10 95,25 C95,40 80,60 50,88 Z");
                    break;
                case 'hexagon':
                    shape = document.createElementNS(svgNS, "polygon");
                    shape.setAttribute("points", "50,5 93,25 93,75 50,95 7,75 7,25");
                    break;
                case 'diamond':
                    shape = document.createElementNS(svgNS, "polygon");
                    shape.setAttribute("points", "50,5 95,50 50,95 5,50");
                    break;
            }
            
            if (shape) {
                shape.setAttribute("fill", fill);
                shape.setAttribute("stroke", stroke);
                shape.setAttribute("stroke-width", strokeWidth);
                svg.appendChild(shape);
            }
            
            div.appendChild(svg);
        }

        function renderLineElement(div, element) {
            div.style.width = element.width + 'px';
            div.style.height = element.height + 'px';
            div.style.backgroundColor = element.styles.backgroundColor || '#ef4444';
        }

        function renderIconElement(div, element) {
            div.style.width = element.width + 'px';
            div.style.height = element.height + 'px';
            div.style.display = 'flex';
            div.style.alignItems = 'center';
            div.style.justifyContent = 'center';
            
            const icon = document.createElement('i');
            icon.className = 'fas ' + element.iconClass;
            icon.style.fontSize = Math.min(element.width, element.height) * 0.8 + 'px';
            icon.style.color = element.styles.color || '#ef4444';
            div.appendChild(icon);
        }

        function renderFrameElement(div, element) {
            div.style.width = element.width + 'px';
            div.style.height = element.height + 'px';
            div.style.border = `${element.styles.borderWidth} solid ${element.styles.borderColor}`;
            
            if (element.frameType === 'circle') {
                div.style.borderRadius = '50%';
            } else if (element.frameType === 'rounded') {
                div.style.borderRadius = '20px';
            }
            
            if (element.imageSrc) {
                const img = document.createElement('img');
                img.src = element.imageSrc;
                img.style.width = '100%';
                img.style.height = '100%';
                img.style.objectFit = 'cover';
                if (element.frameType === 'circle') {
                    img.style.borderRadius = '50%';
                }
                div.appendChild(img);
            } else {
                // Transparent background - only show border
                div.style.backgroundColor = 'transparent';
                div.innerHTML = '<div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:#a3a3a3;"><i class="fas fa-image" style="font-size:24px;"></i></div>';
                
                // Allow dropping image into frame
                div.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    div.style.borderColor = '#ef4444';
                });
                div.addEventListener('dragleave', () => {
                    div.style.borderColor = element.styles.borderColor;
                });
                div.addEventListener('drop', (e) => {
                    e.preventDefault();
                    const src = e.dataTransfer.getData('text/plain');
                    if (src) {
                        element.imageSrc = src;
                        reRenderElement(element.id);
                    }
                });
            }
        }

        function reRenderElement(id) {
            const element = elements.find(e => e.id === id);
            if (!element) return;
            
            const oldDiv = document.getElementById(id);
            if (oldDiv) oldDiv.remove();
            
            renderElement(element);
            if (selectedElement === id) {
                selectElement(id);
            }
        }

        // ==========================================
        // SELECTION & MANIPULATION
        // ==========================================
        function selectElement(id, event = null) {
            const isMultiSelect = event && (event.ctrlKey || event.metaKey || event.shiftKey);
            
            if (isMultiSelect) {
                // Multi-select mode: toggle selection
                toggleMultiSelect(id);
            } else {
                // Single select mode: clear others and select this one
                deselectAll();
                
                selectedElement = id;
                selectedElements = [id];
                const div = document.getElementById(id);
                const element = elements.find(e => e.id === id);
                
                if (div && element) {
                    div.classList.add('selected');
                    
                    if (!element.locked) {
                        addResizeHandles(div);
                        addRotateHandle(div);
                    }
                    
                    // Show context toolbar
                    showContextToolbar(element);
                }
            }
            
            updateLayersList();
        }
        
        function toggleMultiSelect(id) {
            const index = selectedElements.indexOf(id);
            const div = document.getElementById(id);
            const element = elements.find(e => e.id === id);
            
            if (index > -1) {
                // Already selected - remove from selection
                selectedElements.splice(index, 1);
                if (div) {
                    div.classList.remove('selected', 'multi-selected');
                    div.querySelectorAll('.resize-handle, .rotate-handle, .rotate-line').forEach(h => h.remove());
                }
                
                // Update selectedElement to last in array or null
                selectedElement = selectedElements.length > 0 ? selectedElements[selectedElements.length - 1] : null;
            } else {
                // Not selected - add to selection
                selectedElements.push(id);
                selectedElement = id;
                
                if (div && element) {
                    div.classList.add('selected', 'multi-selected');
                    // Don't add resize handles for multi-select
                }
            }
            
            // Update visual indicators for all selected elements
            updateMultiSelectVisuals();
            
            // Show/hide group button based on selection count
            updateGroupButton();
            
            // Hide context toolbar when multi-selecting
            if (selectedElements.length > 1) {
                hideContextToolbar();
            } else if (selectedElements.length === 1) {
                const el = elements.find(e => e.id === selectedElements[0]);
                if (el) showContextToolbar(el);
            }
        }
        
        function updateMultiSelectVisuals() {
            // Remove all multi-select indicators first
            document.querySelectorAll('.canvas-element').forEach(el => {
                el.classList.remove('multi-selected');
            });
            
            // Add multi-select indicator to all selected elements
            if (selectedElements.length > 1) {
                selectedElements.forEach(id => {
                    const div = document.getElementById(id);
                    if (div) {
                        div.classList.add('selected', 'multi-selected');
                        // Remove individual handles for multi-select
                        div.querySelectorAll('.resize-handle, .rotate-handle, .rotate-line').forEach(h => h.remove());
                    }
                });
            }
        }
        
        function updateGroupButton() {
            // Show group button if 2+ elements selected
            let groupBtn = document.getElementById('groupSelectedBtn');
            if (!groupBtn) {
                // Create group button in toolbar if it doesn't exist
                const toolbar = document.querySelector('.context-toolbar');
                if (toolbar && selectedElements.length > 1) {
                    groupBtn = document.createElement('button');
                    groupBtn.id = 'groupSelectedBtn';
                    groupBtn.className = 'context-btn';
                    groupBtn.innerHTML = '<i class="fas fa-object-group"></i>';
                    groupBtn.title = 'Group Selected (Ctrl+G)';
                    groupBtn.onclick = groupSelectedElements;
                    toolbar.appendChild(groupBtn);
                }
            }
            
            if (groupBtn) {
                groupBtn.style.display = selectedElements.length > 1 ? 'flex' : 'none';
            }
        }

        function deselectAll() {
            document.querySelectorAll('.canvas-element').forEach(el => {
                el.classList.remove('selected', 'multi-selected');
                el.querySelectorAll('.resize-handle, .rotate-handle, .rotate-line').forEach(h => h.remove());
            });
            
            selectedElement = null;
            selectedElements = [];
            hideContextToolbar();
            updateLayersList();
            clearSmartGuides();
        }

        function selectAllElements() {
            // Select all elements
            deselectAll();
            selectedElements = elements.map(e => e.id);
            selectedElement = selectedElements.length > 0 ? selectedElements[selectedElements.length - 1] : null;
            
            selectedElements.forEach(id => {
                const div = document.getElementById(id);
                if (div) {
                    div.classList.add('selected', 'multi-selected');
                }
            });
            
            updateGroupButton();
            updateLayersList();
        }
        
        // ==========================================
        // GROUPING FUNCTIONS
        // ==========================================
        function groupSelectedElements() {
            if (selectedElements.length < 2) {
                alert('Select at least 2 elements to group');
                return;
            }
            
            saveState();
            
            const groupId = 'group_' + (++groupCounter);
            
            // Calculate bounding box of all selected elements
            let minX = Infinity, minY = Infinity, maxX = -Infinity, maxY = -Infinity;
            
            selectedElements.forEach(id => {
                const element = elements.find(e => e.id === id);
                if (element) {
                    minX = Math.min(minX, element.x);
                    minY = Math.min(minY, element.y);
                    maxX = Math.max(maxX, element.x + element.width);
                    maxY = Math.max(maxY, element.y + element.height);
                }
            });
            
            // Create group element
            const groupElement = {
                id: groupId,
                type: 'group',
                x: minX,
                y: minY,
                width: maxX - minX,
                height: maxY - minY,
                rotation: 0,
                locked: false,
                children: [...selectedElements], // Store child element IDs
                styles: {
                    opacity: 1
                }
            };
            
            // Update child elements with relative positions and group reference
            selectedElements.forEach(id => {
                const element = elements.find(e => e.id === id);
                if (element) {
                    element.groupId = groupId;
                    element.relativeX = element.x - minX;
                    element.relativeY = element.y - minY;
                }
            });
            
            // Add group to elements array
            elements.push(groupElement);
            
            // Render the group
            renderGroupElement(groupElement);
            
            // Select the group
            deselectAll();
            selectElement(groupId);
            
            updateLayersList();
        }
        
        function ungroupElements(groupId) {
            const group = elements.find(e => e.id === groupId && e.type === 'group');
            if (!group) return;
            
            saveState();
            
            // Remove group reference from children and restore absolute positions
            group.children.forEach(childId => {
                const child = elements.find(e => e.id === childId);
                if (child) {
                    // Restore absolute position
                    child.x = group.x + (child.relativeX || 0);
                    child.y = group.y + (child.relativeY || 0);
                    delete child.groupId;
                    delete child.relativeX;
                    delete child.relativeY;
                }
            });
            
            // Remove group element
            const groupIndex = elements.findIndex(e => e.id === groupId);
            if (groupIndex > -1) {
                elements.splice(groupIndex, 1);
            }
            
            // Remove group DOM element
            const groupDiv = document.getElementById(groupId);
            if (groupDiv) {
                groupDiv.remove();
            }
            
            // Re-render children
            group.children.forEach(childId => {
                const child = elements.find(e => e.id === childId);
                if (child) {
                    reRenderElement(childId);
                }
            });
            
            deselectAll();
            updateLayersList();
        }
        
        function renderGroupElement(element) {
            const canvas = document.getElementById('designCanvas');
            
            const div = document.createElement('div');
            div.id = element.id;
            div.className = 'canvas-element group-element';
            div.style.cssText = `
                position: absolute;
                left: ${element.x}px;
                top: ${element.y}px;
                width: ${element.width}px;
                height: ${element.height}px;
                transform: rotate(${element.rotation || 0}deg);
                opacity: ${element.styles.opacity || 1};
                pointer-events: all;
                border: 2px dashed rgba(99, 102, 241, 0.5);
                background: rgba(99, 102, 241, 0.05);
                cursor: move;
            `;
            
            // Add group indicator
            const indicator = document.createElement('div');
            indicator.className = 'group-indicator';
            indicator.innerHTML = '<i class="fas fa-object-group"></i> Group';
            indicator.style.cssText = `
                position: absolute;
                top: -24px;
                left: 0;
                font-size: 10px;
                color: #6366f1;
                background: rgba(99, 102, 241, 0.1);
                padding: 2px 6px;
                border-radius: 3px;
            `;
            div.appendChild(indicator);
            
            // Event listeners
            div.addEventListener('mousedown', function(e) {
                if (e.target.classList.contains('resize-handle') || e.target.classList.contains('rotate-handle')) return;
                e.stopPropagation();
                selectElement(element.id, e);
                if (!element.locked) {
                    startGroupDrag(e, element.id);
                }
            });
            
            div.addEventListener('dblclick', function(e) {
                e.stopPropagation();
                // Double-click to ungroup
                if (confirm('Ungroup these elements?')) {
                    ungroupElements(element.id);
                }
            });
            
            canvas.appendChild(div);
        }
        
        function startGroupDrag(e, groupId) {
            const group = elements.find(el => el.id === groupId);
            if (!group || group.locked) return;
            
            isDragging = true;
            
            const rect = document.getElementById('designCanvas').getBoundingClientRect();
            const startX = (e.clientX - rect.left) / zoom;
            const startY = (e.clientY - rect.top) / zoom;
            
            dragOffset = {
                x: startX - group.x,
                y: startY - group.y
            };
            
            document.addEventListener('mousemove', onGroupDrag);
            document.addEventListener('mouseup', stopGroupDrag);
        }
        
        function onGroupDrag(e) {
            if (!isDragging || !selectedElement) return;
            
            const group = elements.find(el => el.id === selectedElement);
            if (!group || group.type !== 'group') return;
            
            const rect = document.getElementById('designCanvas').getBoundingClientRect();
            const mouseX = (e.clientX - rect.left) / zoom;
            const mouseY = (e.clientY - rect.top) / zoom;
            
            const newX = mouseX - dragOffset.x;
            const newY = mouseY - dragOffset.y;
            
            const deltaX = newX - group.x;
            const deltaY = newY - group.y;
            
            // Update group position
            group.x = newX;
            group.y = newY;
            
            // Update group DOM
            const groupDiv = document.getElementById(group.id);
            if (groupDiv) {
                groupDiv.style.left = group.x + 'px';
                groupDiv.style.top = group.y + 'px';
            }
            
            // Update all children positions
            group.children.forEach(childId => {
                const child = elements.find(el => el.id === childId);
                if (child) {
                    child.x += deltaX;
                    child.y += deltaY;
                    
                    const childDiv = document.getElementById(childId);
                    if (childDiv) {
                        childDiv.style.left = child.x + 'px';
                        childDiv.style.top = child.y + 'px';
                    }
                }
            });
        }
        
        function stopGroupDrag() {
            isDragging = false;
            document.removeEventListener('mousemove', onGroupDrag);
            document.removeEventListener('mouseup', stopGroupDrag);
            saveState();
        }
        
        // Multi-element drag (for selected elements without group)
        function startMultiDrag(e) {
            if (selectedElements.length < 2) return;
            
            isDragging = true;
            
            const rect = document.getElementById('designCanvas').getBoundingClientRect();
            const startX = (e.clientX - rect.left) / zoom;
            const startY = (e.clientY - rect.top) / zoom;
            
            // Store offset for each selected element
            multiDragOffsets = {};
            selectedElements.forEach(id => {
                const element = elements.find(el => el.id === id);
                if (element) {
                    multiDragOffsets[id] = {
                        x: startX - element.x,
                        y: startY - element.y
                    };
                }
            });
            
            document.addEventListener('mousemove', onMultiDrag);
            document.addEventListener('mouseup', stopMultiDrag);
        }
        
        function onMultiDrag(e) {
            if (!isDragging || selectedElements.length < 2) return;
            
            const rect = document.getElementById('designCanvas').getBoundingClientRect();
            const mouseX = (e.clientX - rect.left) / zoom;
            const mouseY = (e.clientY - rect.top) / zoom;
            
            selectedElements.forEach(id => {
                const element = elements.find(el => el.id === id);
                const offset = multiDragOffsets[id];
                
                if (element && offset) {
                    element.x = mouseX - offset.x;
                    element.y = mouseY - offset.y;
                    
                    const div = document.getElementById(id);
                    if (div) {
                        div.style.left = element.x + 'px';
                        div.style.top = element.y + 'px';
                    }
                }
            });
        }
        
        function stopMultiDrag() {
            isDragging = false;
            multiDragOffsets = {};
            document.removeEventListener('mousemove', onMultiDrag);
            document.removeEventListener('mouseup', stopMultiDrag);
            saveState();
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

        function addRotateHandle(element) {
            const line = document.createElement('div');
            line.className = 'rotate-line';
            element.appendChild(line);
            
            const handle = document.createElement('div');
            handle.className = 'rotate-handle';
            handle.innerHTML = '<i class="fas fa-redo"></i>';
            handle.addEventListener('mousedown', function(e) {
                e.stopPropagation();
                startRotate(e, element.id);
            });
            element.appendChild(handle);
        }

        // ==========================================
        // CONTEXT TOOLBAR
        // ==========================================
        function showContextToolbar(element) {
            const toolbar = document.getElementById('contextToolbar');
            const textOptions = document.getElementById('textFormatOptions');
            const shapeOptions = document.getElementById('shapeFormatOptions');
            const commonOptions = document.getElementById('commonOptions');
            
            toolbar.classList.add('active');
            commonOptions.style.display = 'flex';
            
            if (element.type === 'text') {
                textOptions.style.display = 'flex';
                shapeOptions.style.display = 'none';
                updateTextFormatToolbar(element);
            } else if (element.type === 'shape') {
                textOptions.style.display = 'none';
                shapeOptions.style.display = 'flex';
                updateShapeFormatToolbar(element);
            } else {
                textOptions.style.display = 'none';
                shapeOptions.style.display = 'none';
            }
            
            // Update lock button
            const lockBtn = document.getElementById('lockBtn');
            if (element.locked) {
                lockBtn.innerHTML = '<i class="fas fa-lock"></i>';
                lockBtn.classList.add('active');
            } else {
                lockBtn.innerHTML = '<i class="fas fa-lock-open"></i>';
                lockBtn.classList.remove('active');
            }
        }

        function hideContextToolbar() {
            document.getElementById('contextToolbar').classList.remove('active');
        }

        function updateTextFormatToolbar(element) {
            if (element.styles) {
                document.getElementById('fontFamily').value = element.styles.fontFamily || 'Inter';
                document.getElementById('fontSize').value = parseInt(element.styles.fontSize) || 24;
                document.getElementById('textColor').value = element.styles.color || '#000000';
                
                document.getElementById('boldBtn').classList.toggle('active', element.styles.fontWeight === 'bold' || element.styles.fontWeight === '700');
                document.getElementById('italicBtn').classList.toggle('active', element.styles.fontStyle === 'italic');
                document.getElementById('underlineBtn').classList.toggle('active', element.styles.textDecoration === 'underline');
                
                document.getElementById('alignLeftBtn').classList.toggle('active', element.styles.textAlign === 'left');
                document.getElementById('alignCenterBtn').classList.toggle('active', element.styles.textAlign === 'center');
                document.getElementById('alignRightBtn').classList.toggle('active', element.styles.textAlign === 'right');
            }
        }

        function updateShapeFormatToolbar(element) {
            if (element.styles) {
                document.getElementById('shapeFillColor').value = element.styles.backgroundColor || '#ef4444';
                document.getElementById('shapeStrokeColor').value = element.styles.borderColor || '#000000';
                document.getElementById('shapeStrokeWidth').value = parseInt(element.styles.borderWidth) || 0;
                document.getElementById('shapeRadius').value = parseInt(element.styles.borderRadius) || 0;
            }
        }

        // ==========================================
        // TEXT FORMATTING
        // ==========================================
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
                        const isBold = element.styles.fontWeight === 'bold' || element.styles.fontWeight === '700';
                        element.styles.fontWeight = isBold ? 'normal' : 'bold';
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
                
                document.getElementById('alignLeftBtn').classList.remove('active');
                document.getElementById('alignCenterBtn').classList.remove('active');
                document.getElementById('alignRightBtn').classList.remove('active');
                document.getElementById('align' + align.charAt(0).toUpperCase() + align.slice(1) + 'Btn').classList.add('active');
                
                saveState();
            }
        }

        // ==========================================
        // SHAPE FORMATTING
        // ==========================================
        function updateShapeStyle(property, value) {
            if (!selectedElement) return;
            
            const element = elements.find(e => e.id === selectedElement);
            
            if (element && element.type === 'shape') {
                element.styles[property] = value;
                reRenderElement(selectedElement);
                saveState();
            }
        }

        // ==========================================
        // ALIGNMENT
        // ==========================================
        function toggleAlignDropdown() {
            document.getElementById('alignDropdown').classList.toggle('show');
        }

        function alignToCanvas(alignment) {
            if (!selectedElement) return;
            
            const element = elements.find(e => e.id === selectedElement);
            const div = document.getElementById(selectedElement);
            
            if (!element || !div) return;
            
            saveState();
            
            const elWidth = div.offsetWidth;
            const elHeight = div.offsetHeight;
            
            switch(alignment) {
                case 'left':
                    element.x = 0;
                    break;
                case 'center-h':
                    element.x = (canvasWidth - elWidth) / 2;
                    break;
                case 'right':
                    element.x = canvasWidth - elWidth;
                    break;
                case 'top':
                    element.y = 0;
                    break;
                case 'center-v':
                    element.y = (canvasHeight - elHeight) / 2;
                    break;
                case 'bottom':
                    element.y = canvasHeight - elHeight;
                    break;
                case 'center':
                    element.x = (canvasWidth - elWidth) / 2;
                    element.y = (canvasHeight - elHeight) / 2;
                    break;
            }
            
            div.style.left = element.x + 'px';
            div.style.top = element.y + 'px';
            
            document.getElementById('alignDropdown').classList.remove('show');
        }

        // ==========================================
        // SMART GUIDES
        // ==========================================
        function showSmartGuidesForElement(movingElement, x, y) {
            if (!showSmartGuides) return { x, y };
            
            clearSmartGuides();
            
            const canvas = document.getElementById('designCanvas');
            const movingDiv = document.getElementById(movingElement.id);
            const movingWidth = movingDiv.offsetWidth;
            const movingHeight = movingDiv.offsetHeight;
            
            let snappedX = x;
            let snappedY = y;
            
            // Canvas center guides
            const canvasCenterX = canvasWidth / 2;
            const canvasCenterY = canvasHeight / 2;
            
            // Check canvas center horizontal
            if (Math.abs((x + movingWidth / 2) - canvasCenterX) < snapThreshold) {
                snappedX = canvasCenterX - movingWidth / 2;
                createSmartGuide('vertical', canvasCenterX);
            }
            
            // Check canvas center vertical
            if (Math.abs((y + movingHeight / 2) - canvasCenterY) < snapThreshold) {
                snappedY = canvasCenterY - movingHeight / 2;
                createSmartGuide('horizontal', canvasCenterY);
            }
            
            // Check against other elements
            elements.forEach(el => {
                if (el.id === movingElement.id) return;
                
                const otherDiv = document.getElementById(el.id);
                if (!otherDiv) return;
                
                const otherX = el.x;
                const otherY = el.y;
                const otherWidth = otherDiv.offsetWidth;
                const otherHeight = otherDiv.offsetHeight;
                
                // Left edge alignment
                if (Math.abs(x - otherX) < snapThreshold) {
                    snappedX = otherX;
                    createSmartGuide('vertical', otherX);
                }
                
                // Right edge alignment
                if (Math.abs((x + movingWidth) - (otherX + otherWidth)) < snapThreshold) {
                    snappedX = otherX + otherWidth - movingWidth;
                    createSmartGuide('vertical', otherX + otherWidth);
                }
                
                // Center horizontal alignment
                if (Math.abs((x + movingWidth / 2) - (otherX + otherWidth / 2)) < snapThreshold) {
                    snappedX = otherX + otherWidth / 2 - movingWidth / 2;
                    createSmartGuide('vertical', otherX + otherWidth / 2);
                }
                
                // Top edge alignment
                if (Math.abs(y - otherY) < snapThreshold) {
                    snappedY = otherY;
                    createSmartGuide('horizontal', otherY);
                }
                
                // Bottom edge alignment
                if (Math.abs((y + movingHeight) - (otherY + otherHeight)) < snapThreshold) {
                    snappedY = otherY + otherHeight - movingHeight;
                    createSmartGuide('horizontal', otherY + otherHeight);
                }
                
                // Center vertical alignment
                if (Math.abs((y + movingHeight / 2) - (otherY + otherHeight / 2)) < snapThreshold) {
                    snappedY = otherY + otherHeight / 2 - movingHeight / 2;
                    createSmartGuide('horizontal', otherY + otherHeight / 2);
                }
            });
            
            return { x: snappedX, y: snappedY };
        }

        function createSmartGuide(type, position) {
            const canvas = document.getElementById('designCanvas');
            const guide = document.createElement('div');
            guide.className = 'smart-guide ' + type;
            
            if (type === 'horizontal') {
                guide.style.top = position + 'px';
            } else {
                guide.style.left = position + 'px';
            }
            
            canvas.appendChild(guide);
        }

        function clearSmartGuides() {
            document.querySelectorAll('.smart-guide').forEach(g => g.remove());
        }

        // ==========================================
        // DRAG & DROP
        // ==========================================
        function startDrag(e, elementId) {
            const element = elements.find(el => el.id === elementId);
            if (element && element.locked) return;
            
            isDragging = true;
            const div = document.getElementById(elementId);
            const canvas = document.getElementById('designCanvas');
            const canvasRect = canvas.getBoundingClientRect();
            
            div.classList.add('dragging');
            
            dragOffset = {
                x: (e.clientX - canvasRect.left) / zoom - parseInt(div.style.left),
                y: (e.clientY - canvasRect.top) / zoom - parseInt(div.style.top)
            };
            
            document.addEventListener('mousemove', handleDrag);
            document.addEventListener('mouseup', stopDrag);
        }

        function handleDrag(e) {
            if (!isDragging || !selectedElement) return;
            
            const canvas = document.getElementById('designCanvas');
            const canvasRect = canvas.getBoundingClientRect();
            const div = document.getElementById(selectedElement);
            const element = elements.find(el => el.id === selectedElement);
            
            let newX = (e.clientX - canvasRect.left) / zoom - dragOffset.x;
            let newY = (e.clientY - canvasRect.top) / zoom - dragOffset.y;
            
            // Apply smart guides snapping
            const snapped = showSmartGuidesForElement(element, newX, newY);
            newX = snapped.x;
            newY = snapped.y;
            
            div.style.left = newX + 'px';
            div.style.top = newY + 'px';
            
            element.x = newX;
            element.y = newY;
        }

        function stopDrag() {
            if (isDragging) {
                const div = document.getElementById(selectedElement);
                if (div) div.classList.remove('dragging');
                saveState();
            }
            isDragging = false;
            clearSmartGuides();
            document.removeEventListener('mousemove', handleDrag);
            document.removeEventListener('mouseup', stopDrag);
        }

        // ==========================================
        // RESIZE
        // ==========================================
        let resizeHandle = '';
        let resizeStart = { x: 0, y: 0, width: 0, height: 0, left: 0, top: 0 };

        function startResize(e, elementId, handle) {
            const element = elements.find(el => el.id === elementId);
            if (element && element.locked) return;
            
            isResizing = true;
            resizeHandle = handle;
            const div = document.getElementById(elementId);
            
            resizeStart = {
                x: e.clientX,
                y: e.clientY,
                width: parseInt(div.style.width) || div.offsetWidth,
                height: parseInt(div.style.height) || div.offsetHeight,
                left: parseInt(div.style.left),
                top: parseInt(div.style.top)
            };
            
            document.addEventListener('mousemove', handleResize);
            document.addEventListener('mouseup', stopResize);
        }

        function handleResize(e) {
            if (!isResizing || !selectedElement) return;
            
            const div = document.getElementById(selectedElement);
            const element = elements.find(el => el.id === selectedElement);
            const dx = (e.clientX - resizeStart.x) / zoom;
            const dy = (e.clientY - resizeStart.y) / zoom;
            
            let newWidth = resizeStart.width;
            let newHeight = resizeStart.height;
            let newLeft = resizeStart.left;
            let newTop = resizeStart.top;
            
            // Maintain aspect ratio with shift key
            const maintainRatio = e.shiftKey;
            const aspectRatio = resizeStart.width / resizeStart.height;
            
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
            
            if (maintainRatio) {
                if (resizeHandle.includes('e') || resizeHandle.includes('w')) {
                    newHeight = newWidth / aspectRatio;
                } else {
                    newWidth = newHeight * aspectRatio;
                }
            }
            
            if (newWidth > 20) {
                div.style.width = newWidth + 'px';
                div.style.left = newLeft + 'px';
            }
            if (newHeight > 20) {
                div.style.height = newHeight + 'px';
                div.style.top = newTop + 'px';
            }
            
            if (element) {
                element.width = parseInt(div.style.width);
                element.height = parseInt(div.style.height);
                element.x = parseInt(div.style.left);
                element.y = parseInt(div.style.top);
            }
        }

        function stopResize() {
            if (isResizing) {
                saveState();
                // Re-render shape elements to update SVG
                const element = elements.find(el => el.id === selectedElement);
                if (element && (element.type === 'shape' || element.type === 'icon')) {
                    reRenderElement(selectedElement);
                }
            }
            isResizing = false;
            document.removeEventListener('mousemove', handleResize);
            document.removeEventListener('mouseup', stopResize);
        }

        // ==========================================
        // ROTATION
        // ==========================================
        let rotateStart = { angle: 0, rotation: 0 };

        function startRotate(e, elementId) {
            const element = elements.find(el => el.id === elementId);
            if (element && element.locked) return;
            
            isRotating = true;
            const div = document.getElementById(elementId);
            const rect = div.getBoundingClientRect();
            const centerX = rect.left + rect.width / 2;
            const centerY = rect.top + rect.height / 2;
            
            rotateStart = {
                angle: Math.atan2(e.clientY - centerY, e.clientX - centerX) * 180 / Math.PI,
                rotation: element.rotation || 0
            };
            
            document.addEventListener('mousemove', handleRotate);
            document.addEventListener('mouseup', stopRotate);
        }

        function handleRotate(e) {
            if (!isRotating || !selectedElement) return;
            
            const div = document.getElementById(selectedElement);
            const element = elements.find(el => el.id === selectedElement);
            const rect = div.getBoundingClientRect();
            const centerX = rect.left + rect.width / 2;
            const centerY = rect.top + rect.height / 2;
            
            const currentAngle = Math.atan2(e.clientY - centerY, e.clientX - centerX) * 180 / Math.PI;
            let newRotation = rotateStart.rotation + (currentAngle - rotateStart.angle);
            
            // Snap to 15 degree increments with shift key
            if (e.shiftKey) {
                newRotation = Math.round(newRotation / 15) * 15;
            }
            
            div.style.transform = `rotate(${newRotation}deg)`;
            element.rotation = newRotation;
        }

        function stopRotate() {
            if (isRotating) {
                saveState();
            }
            isRotating = false;
            document.removeEventListener('mousemove', handleRotate);
            document.removeEventListener('mouseup', stopRotate);
        }

        // ==========================================
        // NUDGE
        // ==========================================
        function nudgeElement(direction, amount) {
            if (!selectedElement) return;
            
            const element = elements.find(e => e.id === selectedElement);
            const div = document.getElementById(selectedElement);
            
            if (!element || element.locked) return;
            
            switch(direction) {
                case 'ArrowUp':
                    element.y -= amount;
                    break;
                case 'ArrowDown':
                    element.y += amount;
                    break;
                case 'ArrowLeft':
                    element.x -= amount;
                    break;
                case 'ArrowRight':
                    element.x += amount;
                    break;
            }
            
            div.style.left = element.x + 'px';
            div.style.top = element.y + 'px';
            
            saveState();
        }

        // ==========================================
        // LAYER MANAGEMENT
        // ==========================================
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
            
            list.innerHTML = [...elements].reverse().map((el) => {
                const isSelected = el.id === selectedElement;
                let icon, name, thumbnail = '';
                
                switch(el.type) {
                    case 'text':
                        icon = 'fa-font';
                        name = el.content.substring(0, 20) + (el.content.length > 20 ? '...' : '');
                        break;
                    case 'image':
                        icon = 'fa-image';
                        name = 'Image';
                        thumbnail = `<img src="${el.src}" alt="">`;
                        break;
                    case 'shape':
                        icon = 'fa-shapes';
                        name = el.shapeType.charAt(0).toUpperCase() + el.shapeType.slice(1);
                        break;
                    case 'line':
                        icon = 'fa-minus';
                        name = 'Line';
                        break;
                    case 'icon':
                        icon = el.iconClass;
                        name = 'Icon';
                        break;
                    case 'frame':
                        icon = 'fa-vector-square';
                        name = 'Frame';
                        break;
                    case 'group':
                        icon = 'fa-object-group';
                        name = `Group (${el.children ? el.children.length : 0} items)`;
                        break;
                    default:
                        icon = 'fa-cube';
                        name = 'Element';
                }
                
                const isMultiSelected = selectedElements.includes(el.id);
                return `
                    <div class="layer-item ${isSelected ? 'selected' : ''} ${isMultiSelected ? 'multi-selected' : ''}" onclick="selectElement('${el.id}', event)">
                        <div class="layer-icon">
                            ${thumbnail || `<i class="fas ${icon}"></i>`}
                        </div>
                        <div class="layer-info">
                            <div class="layer-name">${name}</div>
                            <div class="layer-type">${el.type.charAt(0).toUpperCase() + el.type.slice(1)}${el.locked ? ' • Locked' : ''}</div>
                        </div>
                        <div class="layer-actions">
                            <button class="layer-action-btn" onclick="event.stopPropagation(); moveLayerUp('${el.id}')" title="Move Up">
                                <i class="fas fa-chevron-up"></i>
                            </button>
                            <button class="layer-action-btn" onclick="event.stopPropagation(); moveLayerDown('${el.id}')" title="Move Down">
                                <i class="fas fa-chevron-down"></i>
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

        function bringToFront() {
            if (!selectedElement) return;
            const index = elements.findIndex(el => el.id === selectedElement);
            if (index !== -1 && index < elements.length - 1) {
                saveState();
                const element = elements.splice(index, 1)[0];
                elements.push(element);
                updateZIndices();
                updateLayersList();
            }
        }

        function sendToBack() {
            if (!selectedElement) return;
            const index = elements.findIndex(el => el.id === selectedElement);
            if (index !== -1 && index > 0) {
                saveState();
                const element = elements.splice(index, 1)[0];
                elements.unshift(element);
                updateZIndices();
                updateLayersList();
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
            if (!selectedElement) return;
            
            const element = elements.find(e => e.id === selectedElement);
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

        // Copy element to clipboard (works across pages)
        function copyElement() {
            if (!selectedElement) {
                return; // Silent fail if no element selected
            }
            
            const element = elements.find(e => e.id === selectedElement);
            if (element) {
                clipboardElement = JSON.parse(JSON.stringify(element));
                // Show brief visual feedback
                const statusEl = document.createElement('div');
                statusEl.innerHTML = '<i class="fas fa-check"></i> Element copied';
                statusEl.style.cssText = 'position:fixed;top:20px;left:50%;transform:translateX(-50%);background:#10b981;color:white;padding:8px 16px;border-radius:6px;z-index:10000;font-size:14px;';
                document.body.appendChild(statusEl);
                setTimeout(() => statusEl.remove(), 1500);
            }
        }

        // Paste element from clipboard (works across pages)
        function pasteElement() {
            if (!clipboardElement) {
                // Show brief visual feedback
                const statusEl = document.createElement('div');
                statusEl.innerHTML = '<i class="fas fa-info-circle"></i> Nothing to paste. Copy an element first (Ctrl+C)';
                statusEl.style.cssText = 'position:fixed;top:20px;left:50%;transform:translateX(-50%);background:#f59e0b;color:white;padding:8px 16px;border-radius:6px;z-index:10000;font-size:14px;';
                document.body.appendChild(statusEl);
                setTimeout(() => statusEl.remove(), 2000);
                return;
            }
            
            saveState();
            
            const newId = 'element_' + (++elementCounter);
            const newElement = JSON.parse(JSON.stringify(clipboardElement));
            newElement.id = newId;
            // Offset position slightly so it's visible
            newElement.x = Math.min(newElement.x + 20, canvasWidth - 50);
            newElement.y = Math.min(newElement.y + 20, canvasHeight - 50);
            
            elements.push(newElement);
            renderElement(newElement);
            selectElement(newId);
            updateLayersList();
            
            // Show brief visual feedback
            const statusEl = document.createElement('div');
            statusEl.innerHTML = '<i class="fas fa-check"></i> Element pasted';
            statusEl.style.cssText = 'position:fixed;top:20px;left:50%;transform:translateX(-50%);background:#10b981;color:white;padding:8px 16px;border-radius:6px;z-index:10000;font-size:14px;';
            document.body.appendChild(statusEl);
            setTimeout(() => statusEl.remove(), 1500);
        }

        function lockElement() {
            if (!selectedElement) return;
            
            const element = elements.find(e => e.id === selectedElement);
            if (element) {
                element.locked = !element.locked;
                
                const lockBtn = document.getElementById('lockBtn');
                if (element.locked) {
                    lockBtn.innerHTML = '<i class="fas fa-lock"></i>';
                    lockBtn.classList.add('active');
                    // Remove handles
                    const div = document.getElementById(selectedElement);
                    div.querySelectorAll('.resize-handle, .rotate-handle, .rotate-line').forEach(h => h.remove());
                } else {
                    lockBtn.innerHTML = '<i class="fas fa-lock-open"></i>';
                    lockBtn.classList.remove('active');
                    // Add handles back
                    const div = document.getElementById(selectedElement);
                    addResizeHandles(div);
                    addRotateHandle(div);
                }
                
                updateLayersList();
                saveState();
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
                    hideContextToolbar();
                }
                
                updateZIndices();
                updateLayersList();
            }
        }

        // ==========================================
        // IMAGE UPLOAD
        // ==========================================
        function setupUploadDragDrop() {
            const uploadArea = document.getElementById('uploadArea');
            if (!uploadArea) return;
            
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                uploadArea.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                }, false);
            });
            
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
            
            uploadArea.addEventListener('drop', (e) => {
                const files = e.dataTransfer.files;
                handleFiles(files);
            }, false);
        }

        function handleImageUpload(event) {
            const files = event.target.files;
            handleFiles(files);
        }

        function handleFiles(files) {
            Array.from(files).forEach(file => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        uploadedImages.push({
                            src: e.target.result,
                            name: file.name
                        });
                        renderUploadedImages();
                        addImageElement(e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        function renderUploadedImages() {
            const grid = document.getElementById('uploadedImagesGrid');
            if (!grid) return;
            
            if (uploadedImages.length === 0) {
                grid.innerHTML = '<p style="grid-column: 1/-1; text-align: center; color: var(--neutral-400); font-size: 12px; padding: 20px;">No images uploaded yet</p>';
                return;
            }
            
            grid.innerHTML = uploadedImages.map((img, index) => `
                <div class="image-item" onclick="addImageElement('${img.src}')" draggable="true" ondragstart="event.dataTransfer.setData('text/plain', '${img.src}')">
                    <img src="${img.src}" alt="${img.name}">
                </div>
            `).join('');
        }

        // ==========================================
        // PHOTO SEARCH (Free APIs)
        // ==========================================
        async function searchPhotos(query) {
            const searchInput = document.getElementById('photoSearch');
            if (!query && searchInput) {
                query = searchInput.value;
            }
            if (!query) query = 'wedding';
            
            const grid = document.getElementById('photosGrid');
            grid.innerHTML = '<div class="loading-spinner" style="grid-column: 1/-1;"><i class="fas fa-spinner"></i></div>';
            
            try {
                // Using Picsum Photos API (more reliable than Unsplash Source)
                const photos = [];
                
                // Generate photos using Picsum Photos - reliable free image service
                for (let i = 0; i < 12; i++) {
                    const seed = `${query}-${Date.now()}-${i}`;
                    photos.push({
                        src: `https://picsum.photos/seed/${encodeURIComponent(seed)}/400/400`,
                        thumb: `https://picsum.photos/seed/${encodeURIComponent(seed)}/200/200`,
                        credit: 'Picsum'
                    });
                }
                
                grid.innerHTML = photos.map(photo => `
                    <div class="image-item" onclick="addImageElement('${photo.src}')">
                        <img src="${photo.thumb}" alt="${query}" loading="lazy">
                        <div class="image-overlay">
                            <span class="image-credit">${photo.credit}</span>
                        </div>
                    </div>
                `).join('');
                
            } catch (error) {
                console.error('Error fetching photos:', error);
                grid.innerHTML = '<p style="grid-column: 1/-1; text-align: center; color: var(--neutral-400); padding: 20px;">Failed to load photos. Please try again.</p>';
            }
        }

        // ==========================================
        // ZOOM
        // ==========================================
        function zoomIn() {
            if (zoom < 3) {
                zoom = Math.min(3, zoom + 0.1);
                updateZoom();
            }
        }

        function zoomOut() {
            if (zoom > 0.1) {
                zoom = Math.max(0.1, zoom - 0.1);
                updateZoom();
            }
        }

        function updateZoom() {
            const canvas = document.getElementById('designCanvas');
            canvas.style.transform = `scale(${zoom})`;
            document.getElementById('zoomLevel').textContent = Math.round(zoom * 100) + '%';
        }

        function fitToScreen() {
            const workspace = document.getElementById('canvasWorkspace');
            const workspaceRect = workspace.getBoundingClientRect();
            const padding = 80;
            
            const scaleX = (workspaceRect.width - padding) / canvasWidth;
            const scaleY = (workspaceRect.height - padding) / canvasHeight;
            
            zoom = Math.min(scaleX, scaleY, 1);
            updateZoom();
        }

        // ==========================================
        // CANVAS SIZE
        // ==========================================
        function updateCanvasSize() {
            const widthInput = document.getElementById('settingsCanvasWidth');
            const heightInput = document.getElementById('settingsCanvasHeight');
            
            if (widthInput && heightInput) {
                canvasWidth = parseInt(widthInput.value) || 800;
                canvasHeight = parseInt(heightInput.value) || 600;
            }
            
            const canvas = document.getElementById('designCanvas');
            canvas.style.width = canvasWidth + 'px';
            canvas.style.height = canvasHeight + 'px';
        }

        function setCanvasPreset(width, height) {
            canvasWidth = width;
            canvasHeight = height;
            
            document.getElementById('settingsCanvasWidth').value = width;
            document.getElementById('settingsCanvasHeight').value = height;
            
            updateCanvasSize();
            fitToScreen();
        }

        // ==========================================
        // SETTINGS
        // ==========================================
        function applySettings() {
            const designName = document.getElementById('settingsDesignName').value;
            const status = document.getElementById('settingsStatus').value;
            
            document.getElementById('design_name').value = designName;
            // user_id is auto-populated with logged-in user
            document.getElementById('status').value = status;
            
            updateDesignTitle();
            updateCanvasSize();
            
            closePanel();
        }

        function updateDesignTitle() {
            const name = document.getElementById('design_name').value || 'Untitled Design';
            document.getElementById('designTitle').textContent = name;
        }

        // ==========================================
        // HISTORY (UNDO/REDO)
        // ==========================================
        function saveState() {
            const state = JSON.stringify(elements);
            
            history = history.slice(0, historyIndex + 1);
            history.push(state);
            historyIndex = history.length - 1;
            
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
            
            const canvas = document.getElementById('designCanvas');
            canvas.innerHTML = '';
            
            elements.forEach(el => renderElement(el));
            
            selectedElement = null;
            hideContextToolbar();
            updateLayersList();
        }

        // ==========================================
        // SAVE & EXPORT
        // ==========================================
        function saveDesign() {
            const designName = document.getElementById('design_name').value;
            const userId = document.getElementById('user_id').value;
            
            if (!designName) {
                alert('Please fill in Design Name in Settings');
                setActiveTool('settings');
                showToolPanel('settings');
                return;
            }
            
            // Save current page before generating canvas data
            saveCurrentPage();
            
            const canvasData = {
                width: canvasWidth,
                height: canvasHeight,
                pages: pages,
                background: canvasBackground, // Canvas-level background as fallback
                // Keep elements for backward compatibility (first page elements)
                elements: pages[0]?.elements || elements
            };
            
            document.getElementById('canvas_data').value = JSON.stringify(canvasData);
            
            const formData = new FormData(document.getElementById('designForm'));
            
            fetch('{{ route("admin.designs.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => {
                if (response.redirected) {
                    window.location.href = response.url;
                    return;
                }
                return response.json();
            })
            .then(data => {
                if (data && data.success) {
                    alert('Design saved successfully!');
                    window.location.href = '{{ route("admin.designs.index") }}';
                } else if (data && data.message) {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                // If redirected, this is actually success
                console.log('Save completed');
            });
        }

        function previewDesign() {
            // Save current page first
            saveCurrentPage();
            
            const previewWindow = window.open('', '_blank');
            
            // Generate HTML for all pages
            const allPagesHtml = pages.map((page, pageIdx) => {
                const pageBg = page.background || canvasBackground;
                let bgStyle = '';
                
                if (pageBg.type === 'image' && pageBg.image) {
                    const sizeMap = {
                        'cover': 'background-size: cover; background-position: center;',
                        'contain': 'background-size: contain; background-position: center; background-repeat: no-repeat;',
                        'stretch': 'background-size: 100% 100%;',
                        'tile': 'background-repeat: repeat;'
                    };
                    bgStyle = `background-color: ${pageBg.color}; background-image: url('${pageBg.image}'); ${sizeMap[pageBg.size] || sizeMap['cover']} opacity: ${pageBg.opacity};`;
                } else {
                    bgStyle = `background-color: ${pageBg.color};`;
                }
                
                const elementsHtml = (page.elements || []).map((el, index) => {
                    const baseStyle = `position: absolute; left: ${el.x}px; top: ${el.y}px; z-index: ${index + 1};`;
                    const transform = el.rotation ? `transform: rotate(${el.rotation}deg);` : '';
                    
                    switch(el.type) {
                        case 'text':
                            return `<div style="${baseStyle} ${transform} font-family: ${el.styles?.fontFamily || 'Arial'}; font-size: ${el.styles?.fontSize || '16px'}; font-weight: ${el.styles?.fontWeight || 'normal'}; font-style: ${el.styles?.fontStyle || 'normal'}; text-decoration: ${el.styles?.textDecoration || 'none'}; text-align: ${el.styles?.textAlign || 'left'}; color: ${el.styles?.color || '#000'}; padding: 8px 12px;">${el.content}</div>`;
                        case 'image':
                            return `<div style="${baseStyle} ${transform} width: ${el.width}px; height: ${el.height}px; overflow: hidden;"><img src="${el.src}" style="width: 100%; height: 100%; object-fit: cover;"></div>`;
                        case 'shape':
                            return `<div style="${baseStyle} ${transform} width: ${el.width}px; height: ${el.height}px;">${el.svgContent || ''}</div>`;
                        case 'icon':
                            return `<div style="${baseStyle} ${transform} width: ${el.width}px; height: ${el.height}px; display: flex; align-items: center; justify-content: center;"><i class="fas ${el.iconClass}" style="font-size: ${Math.min(el.width, el.height) * 0.8}px; color: ${el.styles?.color || '#000'};"></i></div>`;
                        default:
                            return '';
                    }
                }).join('');
                
                return `
                    <div class="page-container" data-page="${pageIdx + 1}">
                        <div class="page-label">${page.name}</div>
                        <div class="preview-canvas" style="width: ${canvasWidth}px; height: ${canvasHeight}px; ${bgStyle}">
                            ${elementsHtml}
                        </div>
                    </div>
                `;
            }).join('');
            
            previewWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Design Preview - All Pages</title>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
                    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Great+Vibes&family=Playfair+Display:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&family=Open+Sans:wght@300;400;500;600;700&family=Lato:wght@300;400;700&family=Poppins:wght@300;400;500;600;700&family=Raleway:wght@300;400;500;600;700&family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
                    <style>
                        * { box-sizing: border-box; }
                        body {
                            margin: 0;
                            padding: 40px;
                            background: #1a1a2e;
                            min-height: 100vh;
                        }
                        .preview-header {
                            text-align: center;
                            margin-bottom: 40px;
                            color: white;
                        }
                        .preview-header h1 {
                            font-size: 24px;
                            margin: 0 0 8px 0;
                            font-weight: 600;
                        }
                        .preview-header p {
                            font-size: 14px;
                            opacity: 0.7;
                            margin: 0;
                        }
                        .pages-wrapper {
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                            gap: 60px;
                        }
                        .page-container {
                            display: flex;
                            flex-direction: column;
                            align-items: center;
                        }
                        .page-label {
                            color: white;
                            font-size: 14px;
                            font-weight: 500;
                            margin-bottom: 16px;
                            padding: 6px 16px;
                            background: rgba(255,255,255,0.1);
                            border-radius: 20px;
                        }
                        .preview-canvas {
                            background: white;
                            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
                            position: relative;
                            overflow: hidden;
                            border-radius: 4px;
                        }
                        .nav-hint {
                            position: fixed;
                            bottom: 20px;
                            left: 50%;
                            transform: translateX(-50%);
                            background: rgba(255,255,255,0.9);
                            padding: 12px 24px;
                            border-radius: 30px;
                            font-size: 13px;
                            color: #333;
                            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
                        }
                    </style>
                </head>
                <body>
                    <div class="preview-header">
                        <h1>Design Preview</h1>
                        <p>${pages.length} page${pages.length > 1 ? 's' : ''} • ${canvasWidth} × ${canvasHeight}px</p>
                    </div>
                    <div class="pages-wrapper">
                        ${allPagesHtml}
                    </div>
                    ${pages.length > 1 ? '<div class="nav-hint">Scroll to see all pages</div>' : ''}
                </body>
                </html>
            `);
            previewWindow.document.close();
        }

        function downloadDesign() {
            alert('Download feature coming soon! For now, use Preview and take a screenshot.');
        }

        // Initialize
        saveState();
    </script>
    @endpush
</x-admin-layout>