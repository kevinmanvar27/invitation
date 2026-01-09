@extends('layouts.app')

@section('title', 'Customize Template - ' . $design->design_name)

@push('styles')
<!-- Google Fonts for design elements -->
<link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:wght@400;500;600;700&family=Dancing+Script:wght@400;500;600;700&family=Pacifico&family=Lobster&family=Satisfy&family=Sacramento&family=Alex+Brush&family=Allura&family=Tangerine:wght@400;700&display=swap" rel="stylesheet">
@endpush

@section('content')
<style>
/* Template Editor Styles */
.template-editor {
    display: flex;
    height: calc(100vh - 80px);
    background: #f8fafc;
}

/* Left Sidebar - Elements List */
.elements-sidebar {
    width: 320px;
    background: #fff;
    border-right: 1px solid #e2e8f0;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.sidebar-header {
    padding: 16px 20px;
    border-bottom: 1px solid #e2e8f0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
}

.sidebar-header h2 {
    font-size: 18px;
    font-weight: 600;
    margin: 0 0 4px 0;
}

.sidebar-header p {
    font-size: 13px;
    opacity: 0.9;
    margin: 0;
}

.elements-list {
    flex: 1;
    overflow-y: auto;
    padding: 16px;
}

.element-item {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    margin-bottom: 12px;
    overflow: hidden;
    transition: all 0.2s ease;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}

.element-item:hover {
    border-color: #667eea;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);
}

.element-item.disabled {
    opacity: 0.5;
    background: #f8fafc;
}

.element-item.disabled .element-preview {
    filter: grayscale(1);
}

.element-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 14px;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
}

.element-type {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 600;
    color: #334155;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.element-type-icon {
    width: 24px;
    height: 24px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.element-type-icon.text {
    background: #dbeafe;
    color: #2563eb;
}

.element-type-icon.image {
    background: #dcfce7;
    color: #16a34a;
}

.element-type-icon.frame {
    background: #fef3c7;
    color: #d97706;
}

.element-toggle {
    position: relative;
    width: 44px;
    height: 24px;
}

.element-toggle input {
    opacity: 0;
    width: 0;
    height: 0;
}

.toggle-slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #cbd5e1;
    transition: 0.3s;
    border-radius: 24px;
}

.toggle-slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: 0.3s;
    border-radius: 50%;
    box-shadow: 0 1px 3px rgba(0,0,0,0.2);
}

.element-toggle input:checked + .toggle-slider {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.element-toggle input:checked + .toggle-slider:before {
    transform: translateX(20px);
}

.element-content {
    padding: 14px;
}

/* Text Element Editing */
.text-edit-area {
    width: 100%;
    min-height: 60px;
    padding: 12px;
    border: 2px dashed #e2e8f0;
    border-radius: 8px;
    font-size: 14px;
    line-height: 1.5;
    resize: vertical;
    transition: all 0.2s ease;
    background: #fff;
    font-family: inherit;
}

.text-edit-area:focus {
    outline: none;
    border-color: #667eea;
    background: #f8fafc;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.text-style-info {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-top: 10px;
}

.style-tag {
    font-size: 11px;
    padding: 3px 8px;
    background: #f1f5f9;
    border-radius: 4px;
    color: #64748b;
}

/* Image Element */
.image-preview-container {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    background: #f1f5f9;
    height: 120px;
}

.image-preview {
    width: 100%;
    height: 100%;
    object-fit: contain;
    display: block;
    background: #f8fafc;
}

.image-actions-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    opacity: 0;
    transition: opacity 0.2s ease;
}

.image-preview-container:hover .image-actions-overlay {
    opacity: 1;
}

.image-action-btn {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
}

.image-action-btn.zoom-btn {
    background: rgba(255,255,255,0.95);
    color: #334155;
}

.image-action-btn.zoom-btn:hover {
    background: #fff;
    transform: scale(1.1);
}

.image-action-btn.replace-btn {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
}

.image-action-btn.replace-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
}

.image-action-btn svg {
    width: 20px;
    height: 20px;
}

.image-upload-input {
    display: none;
}

/* Image Zoom Modal */
.image-zoom-modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 3000;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.image-zoom-modal.show {
    opacity: 1;
    visibility: visible;
}

.image-zoom-content {
    position: relative;
    max-width: 90vw;
    max-height: 90vh;
}

.image-zoom-content img {
    display: block;
    object-fit: contain;
    border-radius: 8px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.5);
}

.image-zoom-close {
    position: absolute;
    top: -40px;
    right: 0;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    border: none;
    background: rgba(255,255,255,0.2);
    color: #fff;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}

.image-zoom-close:hover {
    background: rgba(255,255,255,0.3);
    transform: scale(1.1);
}

.image-zoom-info {
    position: absolute;
    bottom: -36px;
    left: 0;
    right: 0;
    text-align: center;
    color: rgba(255,255,255,0.7);
    font-size: 13px;
}

/* Image Crop/Adjust Modal */
.image-crop-modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.95);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    z-index: 3500;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.image-crop-modal.show {
    opacity: 1;
    visibility: visible;
}

.crop-modal-header {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    padding: 16px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: rgba(0,0,0,0.5);
}

.crop-modal-title {
    color: #fff;
    font-size: 18px;
    font-weight: 600;
}

.crop-modal-close {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: none;
    background: rgba(255,255,255,0.1);
    color: #fff;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}

.crop-modal-close:hover {
    background: rgba(255,255,255,0.2);
}

.crop-container {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.crop-frame {
    position: relative;
    overflow: hidden;
    border: 3px solid #fff;
    border-radius: 4px;
    box-shadow: 0 0 0 9999px rgba(0,0,0,0.6);
    cursor: move;
}

.crop-image {
    display: block;
    max-width: none;
    transform-origin: center center;
    cursor: move;
    user-select: none;
    -webkit-user-drag: none;
    position: absolute;
    top: 50%;
    left: 50%;
}

.crop-controls {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 20px 24px;
    background: linear-gradient(transparent, rgba(0,0,0,0.8));
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.crop-zoom-control {
    display: flex;
    align-items: center;
    gap: 16px;
    justify-content: center;
}

.crop-zoom-label {
    color: rgba(255,255,255,0.8);
    font-size: 13px;
    min-width: 50px;
}

.crop-zoom-slider {
    width: 200px;
    height: 6px;
    -webkit-appearance: none;
    appearance: none;
    background: rgba(255,255,255,0.2);
    border-radius: 3px;
    outline: none;
}

.crop-zoom-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #fff;
    cursor: pointer;
    box-shadow: 0 2px 8px rgba(0,0,0,0.3);
}

.crop-zoom-slider::-moz-range-thumb {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #fff;
    cursor: pointer;
    border: none;
    box-shadow: 0 2px 8px rgba(0,0,0,0.3);
}

.crop-zoom-value {
    color: #fff;
    font-size: 13px;
    min-width: 45px;
    text-align: right;
}

.crop-actions {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
}

.crop-btn {
    padding: 12px 32px;
    border-radius: 8px;
    border: none;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.crop-btn.cancel {
    background: rgba(255,255,255,0.1);
    color: #fff;
}

.crop-btn.cancel:hover {
    background: rgba(255,255,255,0.2);
}

.crop-btn.apply {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: #fff;
}

.crop-btn.apply:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
}

.crop-btn.reset {
    background: rgba(255,255,255,0.1);
    color: #fff;
    padding: 12px 20px;
}

.crop-btn.reset:hover {
    background: rgba(255,255,255,0.2);
}

.crop-hint {
    text-align: center;
    color: rgba(255,255,255,0.6);
    font-size: 12px;
    margin-top: 8px;
}

/* Adjust Image Button in Sidebar */
.image-adjust-btn {
    width: 100%;
    margin-top: 8px;
    padding: 8px 12px;
    border: 1px dashed #cbd5e1;
    border-radius: 6px;
    background: #f8fafc;
    color: #64748b;
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    transition: all 0.2s ease;
}

.image-adjust-btn:hover {
    border-color: #667eea;
    color: #667eea;
    background: #f0f4ff;
}

.image-adjust-btn svg {
    width: 14px;
    height: 14px;
}

/* Frame Element */
.frame-preview {
    width: 100%;
    height: 100px;
    border: 4px double #d4d4d4;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8fafc;
    color: #94a3b8;
    font-size: 13px;
}

/* Canvas Area */
.canvas-area {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
}

.canvas-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 24px;
    background: #fff;
    border-bottom: 1px solid #e2e8f0;
}

.canvas-title {
    font-size: 16px;
    font-weight: 600;
    color: #1e293b;
}

.canvas-actions {
    display: flex;
    gap: 10px;
}

.btn-action {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    border: none;
}

.btn-secondary {
    background: #f1f5f9;
    color: #475569;
}

.btn-secondary:hover {
    background: #e2e8f0;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
}

.btn-success {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: #fff;
}

.btn-success:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
}

/* Canvas Container */
.canvas-container {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 24px;
    background: linear-gradient(135deg, #f0f4f8 0%, #e2e8f0 100%);
    overflow: auto;
}

.canvas-wrapper {
    position: relative;
    background: #fff;
    box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    border-radius: 4px;
}

.canvas-wrapper.resizing {
    outline: 2px dashed #667eea;
}

.design-canvas {
    position: relative;
    overflow: hidden;
}

/* Canvas Resize Handles */
.resize-handle {
    position: absolute;
    background: #667eea;
    z-index: 1000;
}

.resize-handle.corner {
    width: 12px;
    height: 12px;
    border: 2px solid #fff;
    border-radius: 50%;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.resize-handle.edge {
    background: rgba(102, 126, 234, 0.5);
}

.resize-handle.top-left { top: -6px; left: -6px; cursor: nw-resize; }
.resize-handle.top-right { top: -6px; right: -6px; cursor: ne-resize; }
.resize-handle.bottom-left { bottom: -6px; left: -6px; cursor: sw-resize; }
.resize-handle.bottom-right { bottom: -6px; right: -6px; cursor: se-resize; }

.resize-handle.top { top: -3px; left: 10px; right: 10px; height: 6px; cursor: n-resize; }
.resize-handle.bottom { bottom: -3px; left: 10px; right: 10px; height: 6px; cursor: s-resize; }
.resize-handle.left { left: -3px; top: 10px; bottom: 10px; width: 6px; cursor: w-resize; }
.resize-handle.right { right: -3px; top: 10px; bottom: 10px; width: 6px; cursor: e-resize; }

/* Canvas Elements */
.canvas-element {
    position: absolute;
    transition: opacity 0.3s ease;
}

.canvas-element.hidden {
    opacity: 0.15;
    pointer-events: none;
}

.canvas-element.selected {
    outline: 2px solid #667eea;
    outline-offset: 2px;
}

/* Sticker Elements */
.canvas-sticker {
    cursor: move;
    user-select: none;
}

.canvas-sticker img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    pointer-events: none;
}

.canvas-sticker:hover {
    outline: 2px dashed #f59e0b;
    outline-offset: 2px;
}

.canvas-sticker.selected {
    outline: 2px solid #f59e0b;
    outline-offset: 2px;
}

.sticker-resize-handle {
    position: absolute;
    width: 10px;
    height: 10px;
    background: #f59e0b;
    border: 2px solid #fff;
    border-radius: 50%;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    z-index: 10;
    display: none;
}

.canvas-sticker.selected .sticker-resize-handle {
    display: block;
}

.sticker-resize-handle.tl { top: -5px; left: -5px; cursor: nw-resize; }
.sticker-resize-handle.tr { top: -5px; right: -5px; cursor: ne-resize; }
.sticker-resize-handle.bl { bottom: -5px; left: -5px; cursor: sw-resize; }
.sticker-resize-handle.br { bottom: -5px; right: -5px; cursor: se-resize; }

.sticker-delete-btn {
    position: absolute;
    top: -12px;
    right: -12px;
    width: 24px;
    height: 24px;
    background: #ef4444;
    border: 2px solid #fff;
    border-radius: 50%;
    color: #fff;
    display: none;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 11;
    box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}

.canvas-sticker.selected .sticker-delete-btn {
    display: flex;
}

.canvas-text {
    cursor: text;
    white-space: pre-wrap;
    word-wrap: break-word;
    overflow: visible;
    display: block;
}

.canvas-text:hover {
    outline: 2px dashed #667eea;
    outline-offset: 2px;
}

.canvas-image {
    cursor: pointer;
}

.canvas-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.canvas-image:hover {
    outline: 2px dashed #16a34a;
    outline-offset: 2px;
}

.canvas-frame {
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(0,0,0,0.02);
}

/* Toast Notification */
.toast {
    position: fixed;
    bottom: 24px;
    right: 24px;
    padding: 16px 24px;
    background: #1e293b;
    color: #fff;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 500;
    box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    transform: translateY(100px);
    opacity: 0;
    transition: all 0.3s ease;
    z-index: 1000;
}

.toast.show {
    transform: translateY(0);
    opacity: 1;
}

.toast.success {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
}

.toast.error {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
}

/* Loading Overlay */
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255,255,255,0.9);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    z-index: 2000;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.loading-overlay.show {
    opacity: 1;
    visibility: visible;
}

.loading-spinner {
    width: 48px;
    height: 48px;
    border: 4px solid #e2e8f0;
    border-top-color: #667eea;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

.loading-text {
    margin-top: 16px;
    font-size: 16px;
    color: #475569;
    font-weight: 500;
}

/* No Elements State */
.no-elements {
    padding: 40px 20px;
    text-align: center;
    color: #94a3b8;
}

.no-elements svg {
    width: 48px;
    height: 48px;
    margin-bottom: 12px;
    opacity: 0.5;
}

/* Canvas Settings Panel */
.canvas-settings {
    padding: 16px;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
}

.settings-row {
    display: flex;
    gap: 12px;
    align-items: center;
    flex-wrap: wrap;
}

.settings-group {
    display: flex;
    align-items: center;
    gap: 8px;
}

.settings-label {
    font-size: 13px;
    font-weight: 500;
    color: #64748b;
}

.settings-input {
    padding: 6px 12px;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    font-size: 13px;
    width: 80px;
}

.color-picker-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    gap: 8px;
}

.color-preview {
    width: 32px;
    height: 32px;
    border: 2px solid #e2e8f0;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.color-preview:hover {
    border-color: #667eea;
    transform: scale(1.05);
}

.color-input {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

.upload-bg-btn {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    font-size: 13px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.upload-bg-btn:hover {
    border-color: #667eea;
    background: #f8fafc;
}

.sticker-upload-btn {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: #fff;
    border: none;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
}

.sticker-upload-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
}

/* Responsive */
@media (max-width: 768px) {
    .template-editor {
        flex-direction: column;
    }
    
    .elements-sidebar {
        width: 100%;
        height: 40vh;
        border-right: none;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .canvas-container {
        padding: 16px;
    }
}
</style>

<div class="template-editor">
    <!-- Left Sidebar - Elements List -->
    <div class="elements-sidebar">
        <div class="sidebar-header">
            <h2>Customize Template</h2>
            <p>Edit text, replace images, toggle elements</p>
        </div>
        
        <div class="elements-list" id="elementsList">
            <!-- Elements will be populated by JavaScript -->
        </div>
    </div>
    
    <!-- Canvas Area -->
    <div class="canvas-area">
        <div class="canvas-header">
            <span class="canvas-title">{{ $design->design_name }}</span>
            <div class="canvas-actions">
                <a href="{{ route('dashboard') }}" class="btn-action btn-secondary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 12H5M12 19l-7-7 7-7"/>
                    </svg>
                    My Designs
                </a>
                <button class="btn-action btn-secondary" onclick="resetChanges()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/>
                        <path d="M3 3v5h5"/>
                    </svg>
                    Reset
                </button>
                <button class="btn-action btn-primary" onclick="previewDesign()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    Preview
                </button>
                <button class="btn-action btn-success" onclick="saveDesign()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                        <polyline points="17 21 17 13 7 13 7 21"/>
                        <polyline points="7 3 7 8 15 8"/>
                    </svg>
                    Save Design
                </button>
            </div>
        </div>
        
        <!-- Canvas Settings Panel -->
        <div class="canvas-settings">
            <div class="settings-row">
                <div class="settings-group">
                    <span class="settings-label">Canvas Size:</span>
                    <input type="number" id="canvasWidth" class="settings-input" value="800" min="200" max="2000" onchange="updateCanvasSize()">
                    <span class="settings-label">×</span>
                    <input type="number" id="canvasHeight" class="settings-input" value="600" min="200" max="2000" onchange="updateCanvasSize()">
                    <span class="settings-label">px</span>
                </div>
                
                <div class="settings-group">
                    <span class="settings-label">Background:</span>
                    <div class="color-picker-wrapper">
                        <div class="color-preview" id="bgColorPreview" onclick="document.getElementById('bgColorInput').click()"></div>
                        <input type="color" id="bgColorInput" class="color-input" value="#ffffff" onchange="updateCanvasBackground('color', this.value)">
                    </div>
                    <label class="upload-bg-btn">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                            <circle cx="8.5" cy="8.5" r="1.5"/>
                            <polyline points="21 15 16 10 5 21"/>
                        </svg>
                        Upload Image
                        <input type="file" id="bgImageInput" accept="image/*" style="display: none;" onchange="uploadBackgroundImage(this)">
                    </label>
                    <button class="upload-bg-btn" onclick="clearBackground()">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                        </svg>
                        Clear
                    </button>
                </div>
                
                <div class="settings-group">
                    <label class="sticker-upload-btn">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 5v14M5 12h14"/>
                        </svg>
                        Add Sticker
                        <input type="file" id="stickerInput" accept="image/*" style="display: none;" onchange="addSticker(this)">
                    </label>
                </div>
            </div>
        </div>
        
        <div class="canvas-container">
            <div class="canvas-wrapper" id="canvasWrapper">
                <div class="design-canvas" id="designCanvas">
                    <!-- Canvas elements will be rendered here -->
                </div>
                <!-- Canvas Resize Handles -->
                <div class="resize-handle corner top-left" data-direction="nw"></div>
                <div class="resize-handle corner top-right" data-direction="ne"></div>
                <div class="resize-handle corner bottom-left" data-direction="sw"></div>
                <div class="resize-handle corner bottom-right" data-direction="se"></div>
                <div class="resize-handle edge top" data-direction="n"></div>
                <div class="resize-handle edge bottom" data-direction="s"></div>
                <div class="resize-handle edge left" data-direction="w"></div>
                <div class="resize-handle edge right" data-direction="e"></div>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div class="toast" id="toast"></div>

<!-- Loading Overlay -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
    <div class="loading-text">Saving your design...</div>
</div>

<!-- Image Zoom Modal -->
<div class="image-zoom-modal" id="imageZoomModal" onclick="closeZoomModal(event)">
    <div class="image-zoom-content" id="imageZoomContent">
        <button type="button" class="image-zoom-close" onclick="closeZoomModal(event, true)">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
        <img src="" alt="Zoom Preview" id="zoomImage">
        <div class="image-zoom-info" id="zoomInfo"></div>
    </div>
</div>

<!-- Image Crop/Adjust Modal -->
<div class="image-crop-modal" id="imageCropModal">
    <div class="crop-modal-header">
        <span class="crop-modal-title">Adjust Image Position</span>
        <button type="button" class="crop-modal-close" onclick="closeCropModal()">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>
    </div>
    
    <div class="crop-container">
        <div class="crop-frame" id="cropFrame">
            <img src="" alt="Crop Image" id="cropImage" class="crop-image">
        </div>
    </div>
    
    <div class="crop-controls">
        <div class="crop-zoom-control">
            <span class="crop-zoom-label">Zoom:</span>
            <input type="range" class="crop-zoom-slider" id="cropZoomSlider" min="100" max="300" value="100" oninput="updateCropZoom(this.value)">
            <span class="crop-zoom-value" id="cropZoomValue">100%</span>
        </div>
        <div class="crop-actions">
            <button type="button" class="crop-btn reset" onclick="resetCrop()">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/>
                    <path d="M3 3v5h5"/>
                </svg>
                Reset
            </button>
            <button type="button" class="crop-btn cancel" onclick="closeCropModal()">Cancel</button>
            <button type="button" class="crop-btn apply" onclick="applyCrop()">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
                Apply
            </button>
        </div>
        <p class="crop-hint">Drag image to reposition • Use slider to zoom in/out</p>
    </div>
</div>

<!-- Test script to verify scripts are loading -->
<script>
console.log('='.repeat(80));
console.log('TEST SCRIPT BEFORE MAIN SCRIPT - If you see this, scripts are loading!');
console.log('='.repeat(80));

// Global error handler
window.onerror = function(message, source, lineno, colno, error) {
    console.error('🚨 GLOBAL ERROR CAUGHT:');
    console.error('Message:', message);
    console.error('Source:', source);
    console.error('Line:', lineno, 'Column:', colno);
    console.error('Error object:', error);
    return false; // Let default error handling continue
};

// Unhandled promise rejection handler
window.onunhandledrejection = function(event) {
    console.error('🚨 UNHANDLED PROMISE REJECTION:');
    console.error('Reason:', event.reason);
    console.error('Promise:', event.promise);
};

console.log('✓ Global error handlers installed');
</script>

<script>
/*
 * ============================================================================
 * TEMPLATE EDITOR - MAIN SCRIPT
 * ============================================================================
 * This script initializes and manages the template editor functionality.
 * 
 * DEBUG FEATURES ENABLED:
 * - Comprehensive console logging at each initialization step
 * - Global error handlers for catching runtime errors
 * - Fallback initialization if DOMContentLoaded doesn't fire
 * - Safe parsing of canvas data with error handling
 * 
 * If you don't see ANY console output, check:
 * 1. Browser console is open and not filtered
 * 2. JavaScript is enabled in your browser
 * 3. No browser extensions blocking scripts
 * 4. Check browser's Network tab for script loading errors
 * ============================================================================
 */

// Test console output
console.log('🚀 Script loaded successfully!');
console.log('Current time:', new Date().toLocaleTimeString());

// Design data from server
const designId = {{ $design->id }};
let originalCanvasData = @json($design->canvas_data);

console.log('Raw originalCanvasData:', originalCanvasData);
console.log('Type of originalCanvasData:', typeof originalCanvasData);

// Initialize canvasData with defaults if null
let canvasData;
try {
    if (originalCanvasData && typeof originalCanvasData === 'object') {
        // Deep clone the object
        canvasData = JSON.parse(JSON.stringify(originalCanvasData));
        console.log('✓ Canvas data cloned from original');
        console.log('Canvas data structure:', canvasData);
        
        // Check if this is a pages-based structure (from template preview)
        if (canvasData.pages && Array.isArray(canvasData.pages) && canvasData.pages.length > 0) {
            console.log('🔄 Converting pages-based structure to editor format...');
            console.log('📄 Pages count:', canvasData.pages.length);
            const firstPage = canvasData.pages[0];
            console.log('📄 First page:', firstPage);
            console.log('📄 First page elements:', firstPage.elements);
            console.log('📄 DETAILED FIRST PAGE ELEMENTS:', JSON.stringify(firstPage.elements, null, 2));
            
            // Convert elements to editor format
            const convertedElements = (firstPage.elements || []).map(element => {
                console.log('  → Converting element:', element.type, element.id);
                
                const converted = {
                    id: element.id || 'el_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9),
                    type: element.type,
                    x: parseFloat(element.x) || 0,
                    y: parseFloat(element.y) || 0,
                    width: element.width === 'auto' ? 'auto' : (parseFloat(element.width) || 100),
                    height: element.height === 'auto' ? 'auto' : (parseFloat(element.height) || 100),
                    rotation: parseFloat(element.rotation) || 0,
                    zIndex: parseInt(element.zIndex) || 1,
                    opacity: parseFloat(element.opacity) || 1,
                    locked: element.locked || false
                };
                
                // Convert text elements - preserve ALL text properties
                if (element.type === 'text') {
                    converted.content = element.text || element.content || '';
                    converted.text = converted.content; // Ensure both properties exist
                    
                    // Extract styles from MULTIPLE possible locations
                    const styles = element.styles || {};
                    
                    // Priority order: element.styles > top-level properties > defaults
                    let fontFamily = styles.fontFamily || element.fontFamily;
                    let fontSize = styles.fontSize || element.fontSize;
                    let fontWeight = styles.fontWeight || element.fontWeight;
                    let fontStyle = styles.fontStyle || element.fontStyle;
                    let textAlign = styles.textAlign || element.textAlign;
                    let textDecoration = styles.textDecoration || element.textDecoration;
                    let color = styles.color || element.fill || element.color;
                    
                    // Apply defaults if still undefined
                    fontFamily = fontFamily || 'Arial';
                    fontSize = fontSize || '24px';
                    fontWeight = fontWeight || 'normal';
                    fontStyle = fontStyle || 'normal';
                    textAlign = textAlign || 'left';
                    textDecoration = textDecoration || 'none';
                    color = color || '#000000';
                    
                    // Normalize fontSize to always include 'px' if it's a number
                    if (typeof fontSize === 'number') {
                        fontSize = fontSize + 'px';
                    } else if (typeof fontSize === 'string' && !fontSize.includes('px')) {
                        // If it's a string number without px, add px
                        const numValue = parseInt(fontSize);
                        if (!isNaN(numValue)) {
                            fontSize = numValue + 'px';
                        }
                    }
                    
                    converted.styles = {
                        fontFamily: fontFamily,
                        fontSize: fontSize,
                        fontWeight: fontWeight,
                        fontStyle: fontStyle,
                        textAlign: textAlign,
                        textDecoration: textDecoration,
                        color: color
                    };
                    
                    console.log('    ✓ Text element converted with styles:', converted.styles);
                }
                
                // Convert image elements - preserve ALL image properties
                else if (element.type === 'image') {
                    converted.src = element.src || element.imageSrc || '';
                    converted.imageSrc = converted.src; // Store in both fields
                    
                    // Preserve crop settings
                    if (element.cropSettings) {
                        converted.cropSettings = element.cropSettings;
                    }
                    
                    // Preserve filters or effects
                    if (element.filters) {
                        converted.filters = element.filters;
                    }
                    
                    console.log('    ✓ Image element converted:', converted);
                }
                
                // Convert shape elements - preserve ALL shape properties
                else if (element.type === 'shape') {
                    const styles = element.styles || {};
                    converted.shape = element.shape || element.shapeType || 'rectangle';
                    converted.shapeType = converted.shape; // Store in both fields
                    converted.fill = element.fill || styles.backgroundColor || styles.fill || '#000000';
                    converted.stroke = element.stroke || styles.borderColor || styles.stroke || 'none';
                    converted.strokeWidth = element.strokeWidth || styles.borderWidth || styles.strokeWidth || 0;
                    
                    // Normalize strokeWidth to number
                    if (typeof converted.strokeWidth === 'string') {
                        converted.strokeWidth = parseInt(converted.strokeWidth) || 0;
                    }
                    
                    // Store complete styles object
                    converted.styles = {
                        backgroundColor: converted.fill,
                        fill: converted.fill,
                        borderColor: converted.stroke,
                        stroke: converted.stroke,
                        borderWidth: converted.strokeWidth + 'px',
                        strokeWidth: converted.strokeWidth
                    };
                    
                    console.log('    ✓ Shape element converted:', converted);
                }
                
                // Convert frame elements - preserve ALL frame properties
                else if (element.type === 'frame') {
                    const styles = element.styles || {};
                    converted.frameType = element.frameType || 'square';
                    converted.src = element.src || element.imageSrc || '';
                    converted.imageSrc = converted.src; // Store in both fields
                    
                    const borderColor = styles.borderColor || element.borderColor || '#000000';
                    const borderWidth = styles.borderWidth || element.borderWidth || '2px';
                    
                    // Normalize borderWidth to include 'px' if it's a number
                    let normalizedBorderWidth = borderWidth;
                    if (typeof normalizedBorderWidth === 'number') {
                        normalizedBorderWidth = normalizedBorderWidth + 'px';
                    }
                    
                    converted.styles = {
                        borderColor: borderColor,
                        borderWidth: normalizedBorderWidth
                    };
                    
                    // Also store at top level for compatibility
                    converted.borderColor = borderColor;
                    converted.borderWidth = normalizedBorderWidth;
                    
                    console.log('    ✓ Frame element converted:', converted);
                }
                
                // Convert line elements - preserve ALL line properties
                else if (element.type === 'line') {
                    converted.lineType = element.lineType || 'solid';
                    converted.stroke = element.stroke || element.fill || '#000000';
                    converted.fill = converted.stroke; // Store in both fields
                    converted.strokeWidth = element.strokeWidth || 2;
                    
                    // Normalize strokeWidth
                    if (typeof converted.strokeWidth === 'string') {
                        converted.strokeWidth = parseInt(converted.strokeWidth) || 2;
                    }
                    
                    console.log('    ✓ Line element converted:', converted);
                }
                
                // Convert icon elements - preserve ALL icon properties
                else if (element.type === 'icon') {
                    converted.iconName = element.iconName || element.iconClass || '';
                    converted.iconClass = converted.iconName; // Store in both fields
                    converted.fill = element.fill || element.color || styles.color || '#000000';
                    converted.color = converted.fill; // Store in both fields
                    
                    converted.styles = {
                        color: converted.fill
                    };
                    
                    console.log('    ✓ Icon element converted:', converted);
                }
                
                else {
                    console.warn('    ⚠️ Unknown element type:', element.type);
                }
                
                return converted;
            }).filter(el => el !== null); // Remove null elements
            
            // Convert to flat structure expected by editor
            const convertedData = {
                width: canvasData.width || 800,
                height: canvasData.height || 600,
                background: '#ffffff',
                elements: convertedElements,
                stickers: []
            };
            
            // Handle background from page
            if (firstPage.background) {
                if (firstPage.background.type === 'color') {
                    convertedData.background = firstPage.background.color || '#ffffff';
                    convertedData.backgroundType = 'color';
                } else if (firstPage.background.type === 'image' && firstPage.background.image) {
                    convertedData.background = `url(${firstPage.background.image})`;
                    convertedData.backgroundType = 'image';
                    convertedData.backgroundOpacity = firstPage.background.opacity || 1;
                    convertedData.backgroundColor = firstPage.background.color || '#ffffff';
                    console.log('  → Background image with opacity:', convertedData.backgroundOpacity);
                    console.log('  → Background color:', convertedData.backgroundColor);
                }
            }
            
            canvasData = convertedData;
            console.log('✓ Converted to editor format:', canvasData);
            console.log('✓ Converted elements count:', convertedElements.length);
            console.log('✓ First element sample:', convertedElements[0]);
        }
    } else {
        // Use defaults
        canvasData = {
            width: 800,
            height: 600,
            background: '#ffffff',
            elements: [],
            stickers: []
        };
        console.log('✓ Using default canvas data');
    }
} catch (error) {
    console.error('Error parsing canvas data:', error);
    // Fallback to defaults
    canvasData = {
        width: 800,
        height: 600,
        background: '#ffffff',
        elements: [],
        stickers: []
    };
    console.log('✓ Using fallback canvas data due to error');
}

// Element visibility state
let elementStates = {};

// Ensure stickers array exists
if (!canvasData.stickers) {
    canvasData.stickers = [];
}

// Ensure elements array exists
if (!canvasData.elements) {
    canvasData.elements = [];
}

// Ensure dimensions exist
if (!canvasData.width) canvasData.width = 800;
if (!canvasData.height) canvasData.height = 600;
if (!canvasData.background) canvasData.background = '#ffffff';

console.log('📊 Final canvas data:', {
    width: canvasData.width,
    height: canvasData.height,
    background: canvasData.background,
    elementsCount: canvasData.elements ? canvasData.elements.length : 0,
    stickersCount: canvasData.stickers ? canvasData.stickers.length : 0
});

// Canvas resize state
let canvasResizeState = {
    isResizing: false,
    direction: null,
    startX: 0,
    startY: 0,
    startWidth: 0,
    startHeight: 0
};

// Sticker interaction state
let stickerState = {
    selectedId: null,
    isDragging: false,
    isResizing: false,
    resizeDirection: null,
    startX: 0,
    startY: 0,
    startWidth: 0,
    startHeight: 0,
    startLeft: 0,
    startTop: 0
};

// Global crop state
let cropState = {
    elementId: null,
    maxWidth: 200,
    maxHeight: 200,
    currentZoom: 100,
    offsetX: 0,
    offsetY: 0,
    isDragging: false,
    startX: 0,
    startY: 0,
    imageNaturalWidth: 0,
    imageNaturalHeight: 0,
    originalSrc: null
};

// Check if DOM is already loaded
if (document.readyState === 'loading') {
    console.log('📄 DOM is still loading, waiting for DOMContentLoaded...');
} else {
    console.log('📄 DOM already loaded, readyState:', document.readyState);
}

// Initialize the editor
// Load all Google Fonts before rendering
async function loadFonts() {
    console.log('🔤 Loading Google Fonts...');
    const fonts = [
        'Great Vibes',
        'Dancing Script',
        'Playfair Display',
        'Pacifico',
        'Lobster',
        'Satisfy',
        'Sacramento',
        'Alex Brush',
        'Allura',
        'Tangerine',
        'Montserrat',
        'Roboto',
        'Open Sans',
        'Lato',
        'Poppins',
        'Raleway',
        'Oswald'
    ];
    
    try {
        // Wait for document.fonts to be ready
        await document.fonts.ready;
        console.log('✓ Document fonts ready');
        
        // Load each font
        for (const font of fonts) {
            try {
                await document.fonts.load(`16px "${font}"`);
                console.log(`  ✓ Loaded: ${font}`);
            } catch (err) {
                console.warn(`  ⚠ Failed to load ${font}:`, err.message);
            }
        }
        
        console.log('✓ All fonts loaded successfully');
    } catch (error) {
        console.error('❌ Error loading fonts:', error);
    }
}

document.addEventListener('DOMContentLoaded', async function() {
    console.log('🎯 DOMContentLoaded event fired!');
    try {
        console.log('=== EDITOR INITIALIZATION START ===');
        console.log('Canvas Data:', canvasData);
        console.log('Design ID:', designId);
        
        console.log('Step 0: Loading fonts...');
        await loadFonts();
        console.log('✓ Fonts loaded');
        
        console.log('Step 1: Initializing canvas...');
        initializeCanvas();
        console.log('✓ Canvas initialized');
        
        console.log('Step 2: Rendering elements list...');
        renderElementsList();
        console.log('✓ Elements list rendered');
        
        console.log('Step 3: Rendering canvas...');
        renderCanvas();
        console.log('✓ Canvas rendered');
        
        console.log('Step 4: Initializing canvas resize...');
        initializeCanvasResize();
        console.log('✓ Canvas resize initialized');
        
        console.log('Step 5: Initializing canvas interactions...');
        initializeCanvasInteractions();
        console.log('✓ Canvas interactions initialized');
        
        console.log('=== EDITOR INITIALIZATION COMPLETE ===');
        
        // Show success message if redirected from template use
        @if(session('success'))
            showToast('{{ session('success') }}', 'success');
        @endif
    } catch (error) {
        console.error('❌ Error initializing editor:', error);
        console.error('Error stack:', error.stack);
        showToast('Error loading editor. Please refresh the page.', 'error');
    }
});

// Fallback: If DOM is already loaded when script runs, initialize immediately
if (document.readyState === 'interactive' || document.readyState === 'complete') {
    console.log('⚡ DOM already ready, initializing immediately...');
    setTimeout(async function() {
        try {
            console.log('=== FALLBACK INITIALIZATION START ===');
            await loadFonts();
            initializeCanvas();
            renderElementsList();
            renderCanvas();
            initializeCanvasResize();
            initializeCanvasInteractions();
            console.log('=== FALLBACK INITIALIZATION COMPLETE ===');
        } catch (error) {
            console.error('❌ Error in fallback initialization:', error);
            console.error('Error stack:', error.stack);
        }
    }, 100);
}

// Initialize canvas dimensions
function initializeCanvas() {
    console.log('  → Looking for canvas elements...');
    const canvas = document.getElementById('designCanvas');
    const wrapper = document.getElementById('canvasWrapper');
    
    console.log('  → Canvas element:', canvas ? 'FOUND' : 'NOT FOUND');
    console.log('  → Wrapper element:', wrapper ? 'FOUND' : 'NOT FOUND');
    
    if (!canvas || !wrapper) {
        console.error('❌ Canvas or wrapper not found!');
        return;
    }
    
    const width = canvasData.width || 800;
    const height = canvasData.height || 600;
    
    console.log('  → Canvas dimensions:', width, 'x', height);
    
    // Update size inputs
    const widthInput = document.getElementById('canvasWidth');
    const heightInput = document.getElementById('canvasHeight');
    
    console.log('  → Width input:', widthInput ? 'FOUND' : 'NOT FOUND');
    console.log('  → Height input:', heightInput ? 'FOUND' : 'NOT FOUND');
    
    if (widthInput) widthInput.value = width;
    if (heightInput) heightInput.value = height;
    
    // Scale canvas to fit viewport
    const container = document.querySelector('.canvas-container');
    const maxWidth = container.clientWidth - 48;
    const maxHeight = container.clientHeight - 48;
    
    let scale = Math.min(maxWidth / width, maxHeight / height, 1);
    
    canvas.style.width = width + 'px';
    canvas.style.height = height + 'px';
    wrapper.style.transform = `scale(${scale})`;
    wrapper.style.transformOrigin = 'center center';
    
    console.log('  → Canvas styled:', width + 'px x ' + height + 'px');
    console.log('  → Scale applied:', scale);
    
    // Set background
    const bgPreview = document.getElementById('bgColorPreview');
    const bgInput = document.getElementById('bgColorInput');
    
    console.log('  → Setting background:', canvasData.background);
    console.log('  → Background type:', canvasData.backgroundType);
    console.log('  → Background opacity:', canvasData.backgroundOpacity);
    console.log('  → Background color:', canvasData.backgroundColor);
    
    if (canvasData.background) {
        if (canvasData.background.startsWith('#') || canvasData.background.startsWith('rgb')) {
            // Solid color background
            canvas.style.backgroundColor = canvasData.background;
            canvas.style.backgroundImage = 'none';
            if (bgPreview) bgPreview.style.background = canvasData.background;
            if (bgInput) bgInput.value = canvasData.background;
        } else if (canvasData.background.startsWith('linear-gradient') || canvasData.background.startsWith('url')) {
            // Image or gradient background
            
            // If we have opacity and background color, create a layered effect
            if (canvasData.backgroundType === 'image' && canvasData.backgroundOpacity !== undefined && canvasData.backgroundOpacity < 1) {
                console.log('  → Applying background with opacity:', canvasData.backgroundOpacity);
                
                // Set background color first
                canvas.style.backgroundColor = canvasData.backgroundColor || '#ffffff';
                
                // Create a pseudo-element effect using linear-gradient overlay
                const opacity = canvasData.backgroundOpacity;
                const imageUrl = canvasData.background.match(/url\((.*?)\)/)[1];
                
                // Apply background with opacity using multiple backgrounds
                canvas.style.backgroundImage = `
                    linear-gradient(rgba(255, 255, 255, ${1 - opacity}), rgba(255, 255, 255, ${1 - opacity})),
                    ${canvasData.background}
                `.trim();
                canvas.style.backgroundSize = 'cover, cover';
                canvas.style.backgroundPosition = 'center, center';
                canvas.style.backgroundRepeat = 'no-repeat, no-repeat';
                
                console.log('  → Background image applied with opacity overlay');
            } else {
                // Normal background without opacity
                canvas.style.background = canvasData.background;
                canvas.style.backgroundSize = 'cover';
                canvas.style.backgroundPosition = 'center';
                canvas.style.backgroundRepeat = 'no-repeat';
            }
            
            if (bgPreview) bgPreview.style.background = canvasData.background;
        }
    } else {
        canvas.style.backgroundColor = '#ffffff';
        canvas.style.backgroundImage = 'none';
        if (bgPreview) bgPreview.style.background = '#ffffff';
        if (bgInput) bgInput.value = '#ffffff';
    }
    
    console.log('  → Background applied');
    
    // Initialize element states
    if (canvasData.elements) {
        canvasData.elements.forEach(el => {
            elementStates[el.id] = { enabled: true };
        });
    }
}

// Render elements list in sidebar
function renderElementsList() {
    const list = document.getElementById('elementsList');
    const elements = canvasData.elements || [];
    
    if (elements.length === 0) {
        list.innerHTML = `
            <div class="no-elements">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                    <line x1="9" y1="9" x2="15" y2="15"/>
                    <line x1="15" y1="9" x2="9" y2="15"/>
                </svg>
                <p>No editable elements found</p>
            </div>
        `;
        return;
    }
    
    let html = '';
    
    elements.forEach((element, index) => {
        const isEnabled = elementStates[element.id]?.enabled !== false;
        
        html += `
            <div class="element-item ${!isEnabled ? 'disabled' : ''}" data-element-id="${element.id}">
                <div class="element-header">
                    <div class="element-type">
                        <span class="element-type-icon ${element.type}">${getTypeIcon(element.type)}</span>
                        ${element.type.charAt(0).toUpperCase() + element.type.slice(1)}
                    </div>
                    <label class="element-toggle">
                        <input type="checkbox" ${isEnabled ? 'checked' : ''} onchange="toggleElement('${element.id}', this.checked)">
                        <span class="toggle-slider"></span>
                    </label>
                </div>
                <div class="element-content">
                    ${renderElementEditor(element, index)}
                </div>
            </div>
        `;
    });
    
    list.innerHTML = html;
}

// Get icon for element type
function getTypeIcon(type) {
    switch(type) {
        case 'text':
            return '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 7V4h16v3"/><path d="M9 20h6"/><path d="M12 4v16"/></svg>';
        case 'image':
            return '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>';
        case 'frame':
            return '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>';
        default:
            return '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/></svg>';
    }
}

// Render editor for each element type
function renderElementEditor(element, index) {
    switch(element.type) {
        case 'text':
            return renderTextEditor(element, index);
        case 'image':
            return renderImageEditor(element, index);
        case 'frame':
            return renderFrameEditor(element, index);
        default:
            return `<p style="color: #94a3b8; font-size: 13px;">Unknown element type</p>`;
    }
}

// Text editor
function renderTextEditor(element, index) {
    const styles = element.styles || {};
    return `
        <textarea class="text-edit-area" 
                  data-element-id="${element.id}"
                  oninput="updateTextContent('${element.id}', this.value)"
                  placeholder="Enter text...">${element.content || ''}</textarea>
        <div class="text-style-info">
            ${styles.fontFamily ? `<span class="style-tag">${styles.fontFamily}</span>` : ''}
            ${styles.fontSize ? `<span class="style-tag">${styles.fontSize}</span>` : ''}
            ${styles.color ? `<span class="style-tag" style="background: ${styles.color}; color: ${getContrastColor(styles.color)};">${styles.color}</span>` : ''}
        </div>
    `;
}

// Image editor
function renderImageEditor(element, index) {
    const src = element.src || '';
    const isBase64 = src.startsWith('data:');
    const displaySrc = isBase64 ? src : (src || '/images/placeholder.svg');
    
    // Get element dimensions from canvas_data (backend set size)
    const maxWidth = element.width || 200;
    const maxHeight = element.height || 200;
    
    const hasImage = src && src.length > 0;
    
    // Apply crop settings to preview if they exist
    let previewStyle = '';
    let containerStyle = '';
    if (element.cropSettings) {
        const crop = element.cropSettings;
        const scale = crop.zoom / 100;
        previewStyle = `
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(calc(-50% + ${crop.offsetX * 0.5}px), calc(-50% + ${crop.offsetY * 0.5}px)) scale(${scale});
            transform-origin: center center;
            max-width: none;
            max-height: none;
            width: auto;
            height: auto;
        `;
        containerStyle = 'overflow: hidden; position: relative;';
    }
    
    return `
        <div class="image-preview-container" data-max-width="${maxWidth}" data-max-height="${maxHeight}" style="${containerStyle}">
            <img src="${displaySrc}" alt="Image" class="image-preview" id="imagePreview_${element.id}" style="${previewStyle}" onerror="this.src='/images/placeholder.svg'">
            <div class="image-actions-overlay">
                <button type="button" class="image-action-btn zoom-btn" onclick="event.stopPropagation(); zoomImage('${element.id}', ${maxWidth}, ${maxHeight})" title="Zoom Preview">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="M21 21l-4.35-4.35"/>
                        <path d="M11 8v6M8 11h6"/>
                    </svg>
                </button>
                <button type="button" class="image-action-btn replace-btn" onclick="event.stopPropagation(); document.getElementById('imageInput_${element.id}').click()" title="Replace Image">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                        <polyline points="17 8 12 3 7 8"/>
                        <line x1="12" y1="3" x2="12" y2="15"/>
                    </svg>
                </button>
            </div>
            <input type="file" 
                   id="imageInput_${element.id}" 
                   class="image-upload-input" 
                   accept="image/*" 
                   onchange="replaceImage('${element.id}', this)">
        </div>
        ${hasImage ? `
        <button type="button" class="image-adjust-btn" onclick="openCropModal('${element.id}', ${maxWidth}, ${maxHeight})">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M6 2v4h12V2"/>
                <path d="M6 18v4"/>
                <path d="M18 18v4"/>
                <rect x="6" y="6" width="12" height="12" rx="1"/>
            </svg>
            Adjust / Crop Image
        </button>
        ` : ''}
        <div class="text-style-info" style="margin-top: 8px;">
            <span class="style-tag">${maxWidth} × ${maxHeight}px</span>
            ${element.cropSettings ? `<span class="style-tag">Cropped ${element.cropSettings.zoom}%</span>` : ''}
        </div>
    `;
}

// Frame editor
function renderFrameEditor(element, index) {
    const frameType = element.frameType || 'simple';
    return `
        <div class="frame-preview" style="border-style: ${frameType === 'double' ? 'double' : 'solid'};">
            ${element.imageSrc ? `<img src="${element.imageSrc}" style="max-width: 80%; max-height: 80%; object-fit: contain;">` : 'Frame placeholder'}
        </div>
    `;
}

// Get contrast color for text
function getContrastColor(hexcolor) {
    if (!hexcolor) return '#000';
    hexcolor = hexcolor.replace('#', '');
    const r = parseInt(hexcolor.substr(0, 2), 16);
    const g = parseInt(hexcolor.substr(2, 2), 16);
    const b = parseInt(hexcolor.substr(4, 2), 16);
    const yiq = ((r * 299) + (g * 587) + (b * 114)) / 1000;
    return (yiq >= 128) ? '#000' : '#fff';
}

// Toggle element visibility
function toggleElement(elementId, enabled) {
    elementStates[elementId] = { enabled: enabled };
    
    // Update sidebar item
    const item = document.querySelector(`.element-item[data-element-id="${elementId}"]`);
    if (item) {
        item.classList.toggle('disabled', !enabled);
    }
    
    // Update canvas element
    const canvasEl = document.querySelector(`.canvas-element[data-element-id="${elementId}"]`);
    if (canvasEl) {
        canvasEl.classList.toggle('hidden', !enabled);
    }
    
    showToast(enabled ? 'Element enabled' : 'Element disabled');
}

// Update text content
function updateTextContent(elementId, newContent) {
    // Update canvas data
    const element = canvasData.elements.find(el => el.id === elementId);
    if (element) {
        element.content = newContent;
    }
    
    // Update canvas display
    const canvasEl = document.querySelector(`.canvas-element[data-element-id="${elementId}"] .text-content`);
    if (canvasEl) {
        canvasEl.textContent = newContent;
    }
}

// Replace image
function replaceImage(elementId, input) {
    const file = input.files[0];
    if (!file) return;
    
    if (!file.type.startsWith('image/')) {
        showToast('Please select an image file', 'error');
        return;
    }
    
    const reader = new FileReader();
    reader.onload = function(e) {
        const base64 = e.target.result;
        
        // Update canvas data
        const element = canvasData.elements.find(el => el.id === elementId);
        if (element) {
            element.src = base64;
            // Clear crop settings when replacing image
            delete element.cropSettings;
        }
        
        // Re-render to update both sidebar and canvas with new image (no crop)
        renderCanvas();
        renderElementsList();
        
        showToast('Image replaced successfully', 'success');
    };
    reader.readAsDataURL(file);
}

// Zoom image preview
function zoomImage(elementId, maxWidth, maxHeight) {
    const element = canvasData.elements.find(el => el.id === elementId);
    if (!element || !element.src) {
        showToast('No image to preview', 'error');
        return;
    }
    
    const modal = document.getElementById('imageZoomModal');
    const zoomImg = document.getElementById('zoomImage');
    const zoomInfo = document.getElementById('zoomInfo');
    
    // Set image source
    zoomImg.src = element.src;
    
    // Set max dimensions from backend (element.width and element.height)
    // Image will not exceed these dimensions
    zoomImg.style.maxWidth = maxWidth + 'px';
    zoomImg.style.maxHeight = maxHeight + 'px';
    
    // Show size info
    zoomInfo.textContent = `Max size: ${maxWidth} × ${maxHeight}px`;
    
    // Show modal
    modal.classList.add('show');
    
    // Prevent body scroll
    document.body.style.overflow = 'hidden';
}

// Close zoom modal
function closeZoomModal(event, forceClose = false) {
    const modal = document.getElementById('imageZoomModal');
    const content = document.getElementById('imageZoomContent');
    
    // Only close if clicking outside the image or force close
    if (forceClose || event.target === modal) {
        modal.classList.remove('show');
        document.body.style.overflow = '';
    }
}

// Close modals on Escape key (handled in combined listener below)

// Open crop modal
function openCropModal(elementId, maxWidth, maxHeight) {
    const element = canvasData.elements.find(el => el.id === elementId);
    if (!element || !element.src) {
        showToast('No image to adjust', 'error');
        return;
    }
    
    const modal = document.getElementById('imageCropModal');
    const cropFrame = document.getElementById('cropFrame');
    const cropImage = document.getElementById('cropImage');
    const zoomSlider = document.getElementById('cropZoomSlider');
    const zoomValue = document.getElementById('cropZoomValue');
    
    // Store state - load existing crop settings if available
    cropState.elementId = elementId;
    cropState.maxWidth = maxWidth;
    cropState.maxHeight = maxHeight;
    cropState.originalSrc = element.src;
    
    // Load existing crop settings or use defaults
    if (element.cropSettings) {
        cropState.currentZoom = element.cropSettings.zoom || 100;
        cropState.offsetX = element.cropSettings.offsetX || 0;
        cropState.offsetY = element.cropSettings.offsetY || 0;
        cropState.imageNaturalWidth = element.cropSettings.naturalWidth || 0;
        cropState.imageNaturalHeight = element.cropSettings.naturalHeight || 0;
    } else {
        cropState.currentZoom = 100;
        cropState.offsetX = 0;
        cropState.offsetY = 0;
    }
    
    // Set crop frame dimensions (backend-set size)
    cropFrame.style.width = maxWidth + 'px';
    cropFrame.style.height = maxHeight + 'px';
    
    // Load image and get natural dimensions
    cropImage.onload = function() {
        // Only update natural dimensions if not already set from cropSettings
        if (!cropState.imageNaturalWidth || !cropState.imageNaturalHeight) {
            cropState.imageNaturalWidth = this.naturalWidth;
            cropState.imageNaturalHeight = this.naturalHeight;
        }
        
        // Apply transform with loaded settings
        updateCropImageTransform();
    };
    
    cropImage.src = element.src;
    
    // Set zoom slider to current value
    zoomSlider.value = cropState.currentZoom;
    zoomValue.textContent = cropState.currentZoom + '%';
    
    // Add drag event listeners
    cropImage.addEventListener('mousedown', startDragImage);
    document.addEventListener('mousemove', moveDragImage);
    document.addEventListener('mouseup', stopDragImage);
    
    // Touch support for mobile
    cropImage.addEventListener('touchstart', startDragImageTouch, { passive: false });
    document.addEventListener('touchmove', moveDragImageTouch, { passive: false });
    document.addEventListener('touchend', stopDragImage);
    
    // Show modal
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
}

// Update crop image transform based on zoom and offset
function updateCropImageTransform() {
    const cropImage = document.getElementById('cropImage');
    const scale = cropState.currentZoom / 100;
    
    // Apply transform - image is positioned at 50%/50% with transform-origin center
    // So we translate -50% to center it, then apply user offset and scale
    cropImage.style.transform = `translate(calc(-50% + ${cropState.offsetX}px), calc(-50% + ${cropState.offsetY}px)) scale(${scale})`;
}

// Update crop zoom from slider
function updateCropZoom(value) {
    cropState.currentZoom = parseInt(value);
    document.getElementById('cropZoomValue').textContent = value + '%';
    
    // Constrain offset when zooming out
    constrainCropOffset();
    updateCropImageTransform();
}

// Constrain offset to keep image within bounds
function constrainCropOffset() {
    const scale = cropState.currentZoom / 100;
    const scaledWidth = cropState.imageNaturalWidth * scale;
    const scaledHeight = cropState.imageNaturalHeight * scale;
    
    // Calculate max offset (how far image can move)
    const maxOffsetX = Math.max(0, (scaledWidth - cropState.maxWidth) / 2);
    const maxOffsetY = Math.max(0, (scaledHeight - cropState.maxHeight) / 2);
    
    // Constrain offset
    cropState.offsetX = Math.max(-maxOffsetX, Math.min(maxOffsetX, cropState.offsetX));
    cropState.offsetY = Math.max(-maxOffsetY, Math.min(maxOffsetY, cropState.offsetY));
}

// Reset crop to original position and zoom
function resetCrop() {
    cropState.currentZoom = 100;
    cropState.offsetX = 0;
    cropState.offsetY = 0;
    
    document.getElementById('cropZoomSlider').value = 100;
    document.getElementById('cropZoomValue').textContent = '100%';
    
    updateCropImageTransform();
}

// Close crop modal without saving
function closeCropModal() {
    const modal = document.getElementById('imageCropModal');
    const cropImage = document.getElementById('cropImage');
    
    // Remove event listeners
    cropImage.removeEventListener('mousedown', startDragImage);
    document.removeEventListener('mousemove', moveDragImage);
    document.removeEventListener('mouseup', stopDragImage);
    cropImage.removeEventListener('touchstart', startDragImageTouch);
    document.removeEventListener('touchmove', moveDragImageTouch);
    document.removeEventListener('touchend', stopDragImage);
    
    // Hide modal
    modal.classList.remove('show');
    document.body.style.overflow = '';
    
    // Reset state
    cropState.isDragging = false;
}

// Apply crop and save to canvas_data
// Instead of using toDataURL (which has security restrictions), 
// we store the crop parameters and apply them via CSS transforms
function applyCrop() {
    const scale = cropState.currentZoom / 100;
    
    // Update canvas_data with crop parameters
    const elementIndex = canvasData.elements.findIndex(el => el.id === cropState.elementId);
    if (elementIndex !== -1) {
        // Store crop settings in the element
        canvasData.elements[elementIndex].cropSettings = {
            zoom: cropState.currentZoom,
            offsetX: cropState.offsetX,
            offsetY: cropState.offsetY,
            naturalWidth: cropState.imageNaturalWidth,
            naturalHeight: cropState.imageNaturalHeight
        };
        
        // Re-render canvas and sidebar
        renderCanvas();
        renderElementsList();
        
        showToast('Image adjusted successfully', 'success');
    }
    
    // Close modal
    closeCropModal();
}

// Start dragging image (mouse)
function startDragImage(e) {
    e.preventDefault();
    cropState.isDragging = true;
    cropState.startX = e.clientX - cropState.offsetX;
    cropState.startY = e.clientY - cropState.offsetY;
    
    document.getElementById('cropImage').style.cursor = 'grabbing';
}

// Move image while dragging (mouse)
function moveDragImage(e) {
    if (!cropState.isDragging) return;
    
    e.preventDefault();
    
    cropState.offsetX = e.clientX - cropState.startX;
    cropState.offsetY = e.clientY - cropState.startY;
    
    // Constrain to bounds
    constrainCropOffset();
    updateCropImageTransform();
}

// Stop dragging image
function stopDragImage() {
    cropState.isDragging = false;
    const cropImage = document.getElementById('cropImage');
    if (cropImage) {
        cropImage.style.cursor = 'move';
    }
}

// Touch support - start drag
function startDragImageTouch(e) {
    e.preventDefault();
    const touch = e.touches[0];
    cropState.isDragging = true;
    cropState.startX = touch.clientX - cropState.offsetX;
    cropState.startY = touch.clientY - cropState.offsetY;
}

// Touch support - move drag
function moveDragImageTouch(e) {
    if (!cropState.isDragging) return;
    
    e.preventDefault();
    const touch = e.touches[0];
    
    cropState.offsetX = touch.clientX - cropState.startX;
    cropState.offsetY = touch.clientY - cropState.startY;
    
    // Constrain to bounds
    constrainCropOffset();
    updateCropImageTransform();
}

// Close modals on Escape key (combined listener for all modals)
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        // Check crop modal first (higher z-index)
        const cropModal = document.getElementById('imageCropModal');
        if (cropModal && cropModal.classList.contains('show')) {
            closeCropModal();
            return;
        }
        
        // Then check zoom modal
        const zoomModal = document.getElementById('imageZoomModal');
        if (zoomModal && zoomModal.classList.contains('show')) {
            zoomModal.classList.remove('show');
            document.body.style.overflow = '';
            return;
        }
    }
});

// Render canvas
function renderCanvas() {
    console.log('🎨 renderCanvas() called');
    const canvas = document.getElementById('designCanvas');
    const elements = canvasData.elements || [];
    const stickers = canvasData.stickers || [];
    
    console.log('  → Canvas element:', canvas ? 'FOUND' : 'NOT FOUND');
    console.log('  → Elements to render:', elements.length);
    console.log('  → Stickers to render:', stickers.length);
    console.log('  → Canvas data:', canvasData);
    console.log('  → Full elements array:', elements);
    
    if (!canvas) {
        console.error('❌ Canvas element not found!');
        return;
    }
    
    let html = '';
    
    // Render template elements
    elements.forEach((element, index) => {
        console.log(`  → Rendering element ${index}:`, element.type, element);
        console.log(`     - Position: (${element.x}, ${element.y})`);
        console.log(`     - Size: ${element.width} x ${element.height}`);
        console.log(`     - Styles:`, element.styles);
        console.log(`     - Content/Text:`, element.content || element.text);
        
        const isEnabled = elementStates[element.id]?.enabled !== false;
        const elementHtml = renderCanvasElement(element, isEnabled);
        if (elementHtml) {
            html += elementHtml;
            console.log(`     ✓ HTML generated (${elementHtml.length} chars)`);
        } else {
            console.warn(`     ⚠️ Element ${index} (${element.type}) returned no HTML`);
        }
    });
    
    // Render stickers
    stickers.forEach((sticker, index) => {
        console.log(`  → Rendering sticker ${index}:`, sticker);
        html += renderStickerElement(sticker);
    });
    
    console.log('  → Total HTML length:', html.length);
    console.log('  → Setting canvas innerHTML...');
    canvas.innerHTML = html;
    console.log('✓ Canvas rendered with', elements.length, 'elements and', stickers.length, 'stickers');
    console.log('✓ Canvas innerHTML set, checking DOM...');
    console.log('  → Canvas children count:', canvas.children.length);
}

// Render sticker element
function renderStickerElement(sticker) {
    const isSelected = stickerState.selectedId === sticker.id;
    
    return `
        <div class="canvas-element canvas-sticker ${isSelected ? 'selected' : ''}" 
             data-sticker-id="${sticker.id}"
             style="left: ${sticker.x}px; top: ${sticker.y}px; width: ${sticker.width}px; height: ${sticker.height}px; transform: rotate(${sticker.rotation || 0}deg); z-index: ${sticker.zIndex};"
             onmousedown="startStickerDrag('${sticker.id}', event)"
             onclick="selectSticker('${sticker.id}', event)">
            <img src="${sticker.src}" alt="Sticker" draggable="false">
            
            <!-- Resize handles -->
            <div class="sticker-resize-handle tl" onmousedown="startStickerResize('${sticker.id}', 'tl', event)"></div>
            <div class="sticker-resize-handle tr" onmousedown="startStickerResize('${sticker.id}', 'tr', event)"></div>
            <div class="sticker-resize-handle bl" onmousedown="startStickerResize('${sticker.id}', 'bl', event)"></div>
            <div class="sticker-resize-handle br" onmousedown="startStickerResize('${sticker.id}', 'br', event)"></div>
            
            <!-- Delete button -->
            <button class="sticker-delete-btn" onclick="deleteSticker('${sticker.id}', event)" title="Delete sticker">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
    `;
}

// Render individual canvas element
function renderCanvasElement(element, isEnabled) {
    if (!element || !element.type) {
        console.error('Invalid element:', element);
        return '';
    }
    
    const hiddenClass = !isEnabled ? 'hidden' : '';
    const styles = element.styles || {};
    
    // Handle 'auto' width/height for text elements
    let widthValue, heightValue;
    
    if (element.width === 'auto' || element.width === null || element.width === undefined) {
        widthValue = 'auto';
    } else {
        widthValue = `${element.width}px`;
    }
    
    if (element.height === 'auto' || element.height === null || element.height === undefined) {
        heightValue = 'auto';
    } else {
        heightValue = `${element.height}px`;
    }
    
    let style = `
        left: ${element.x || 0}px;
        top: ${element.y || 0}px;
        width: ${widthValue};
        height: ${heightValue};
        transform: rotate(${element.rotation || 0}deg);
        z-index: ${element.zIndex || 1};
        opacity: ${element.opacity || 1};
    `;
    
    switch(element.type) {
        case 'text':
            // Extract font properties with fallbacks (styles object OR element level)
            const fontFamily = styles.fontFamily || element.fontFamily || 'Arial';
            const fontSize = styles.fontSize || element.fontSize || '24px';
            const fontWeight = styles.fontWeight || element.fontWeight || 'normal';
            const fontStyle = styles.fontStyle || element.fontStyle || 'normal';
            const textDecoration = styles.textDecoration || element.textDecoration || 'none';
            const textAlign = styles.textAlign || element.textAlign || 'left';
            const color = styles.color || element.fill || element.color || '#000000';
            
            // Normalize fontSize to string with 'px' suffix
            const normalizedFontSize = typeof fontSize === 'number' ? `${fontSize}px` : fontSize;
            
            // Build inline styles
            let textStyle = `
                font-family: '${fontFamily}', sans-serif;
                font-size: ${normalizedFontSize};
                font-weight: ${fontWeight};
                font-style: ${fontStyle};
                text-decoration: ${textDecoration};
                text-align: ${textAlign};
                color: ${color};
            `;
            
            const textContent = element.content || element.text || '';
            console.log('    → Rendering text element:', element.id);
            console.log('      Content:', textContent);
            console.log('      Font:', fontFamily, normalizedFontSize, fontWeight);
            console.log('      Color:', color);
            console.log('      Full textStyle:', textStyle);
            
            // Escape HTML to prevent XSS
            const escapedContent = textContent.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
            
            return `
                <div class="canvas-element canvas-text ${hiddenClass}" 
                     data-element-id="${element.id}" 
                     style="${style} ${textStyle}"
                     onclick="focusTextInput('${element.id}')">
                    <span class="text-content">${escapedContent}</span>
                </div>
            `;
            
        case 'image':
            const imgSrc = element.src || '/images/placeholder.svg';
            const hasImageSrc = element.src && element.src.length > 0;
            
            // Apply crop settings if they exist
            let imgStyle = '';
            if (element.cropSettings) {
                const crop = element.cropSettings;
                const scale = crop.zoom / 100;
                // Transform the image within the container
                imgStyle = `
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(calc(-50% + ${crop.offsetX}px), calc(-50% + ${crop.offsetY}px)) scale(${scale});
                    transform-origin: center center;
                    max-width: none;
                    max-height: none;
                `;
            }
            
            return `
                <div class="canvas-element canvas-image ${hiddenClass}" 
                     data-element-id="${element.id}" 
                     style="${style} overflow: hidden; ${element.cropSettings ? 'position: relative;' : ''}"
                     onclick="document.getElementById('imageInput_${element.id}').click()"
                     ondblclick="event.stopPropagation(); ${hasImageSrc ? `openCropModal('${element.id}', ${element.width}, ${element.height})` : ''}">
                    <img src="${imgSrc}" alt="Image" style="${imgStyle}" onerror="this.src='/images/placeholder.svg'">
                </div>
            `;
            
        case 'frame':
            let frameStyle = '';
            if (styles.borderColor) frameStyle += `border-color: ${styles.borderColor};`;
            if (styles.borderWidth) frameStyle += `border-width: ${styles.borderWidth};`;
            frameStyle += `border-style: ${element.frameType === 'double' ? 'double' : 'solid'};`;
            
            return `
                <div class="canvas-element canvas-frame ${hiddenClass}" 
                     data-element-id="${element.id}" 
                     style="${style} ${frameStyle}">
                    ${element.imageSrc ? `<img src="${element.imageSrc}" style="max-width: 90%; max-height: 90%; object-fit: contain;">` : ''}
                </div>
            `;
            
        case 'shape':
            const shapeType = element.shape || 'rectangle';
            const fill = element.fill || '#000000';
            const stroke = element.stroke || 'none';
            const strokeWidth = element.strokeWidth || 0;
            
            let shapeHtml = '';
            if (shapeType === 'rectangle') {
                shapeHtml = `<div style="width: 100%; height: 100%; background: ${fill}; border: ${strokeWidth}px solid ${stroke};"></div>`;
            } else if (shapeType === 'circle') {
                shapeHtml = `<div style="width: 100%; height: 100%; background: ${fill}; border: ${strokeWidth}px solid ${stroke}; border-radius: 50%;"></div>`;
            } else if (shapeType === 'triangle') {
                shapeHtml = `<svg width="100%" height="100%" viewBox="0 0 100 100"><polygon points="50,10 90,90 10,90" fill="${fill}" stroke="${stroke}" stroke-width="${strokeWidth}"/></svg>`;
            } else if (shapeType === 'star') {
                shapeHtml = `<svg width="100%" height="100%" viewBox="0 0 100 100"><polygon points="50,5 61,35 92,35 67,57 78,88 50,70 22,88 33,57 8,35 39,35" fill="${fill}" stroke="${stroke}" stroke-width="${strokeWidth}"/></svg>`;
            } else if (shapeType === 'heart') {
                shapeHtml = `<svg width="100%" height="100%" viewBox="0 0 100 100"><path d="M50,90 C50,90 10,60 10,40 C10,25 20,15 30,15 C40,15 50,25 50,25 C50,25 60,15 70,15 C80,15 90,25 90,40 C90,60 50,90 50,90 Z" fill="${fill}" stroke="${stroke}" stroke-width="${strokeWidth}"/></svg>`;
            } else if (shapeType === 'hexagon') {
                shapeHtml = `<svg width="100%" height="100%" viewBox="0 0 100 100"><polygon points="50,5 90,25 90,75 50,95 10,75 10,25" fill="${fill}" stroke="${stroke}" stroke-width="${strokeWidth}"/></svg>`;
            } else if (shapeType === 'pentagon') {
                shapeHtml = `<svg width="100%" height="100%" viewBox="0 0 100 100"><polygon points="50,5 95,40 75,95 25,95 5,40" fill="${fill}" stroke="${stroke}" stroke-width="${strokeWidth}"/></svg>`;
            } else if (shapeType === 'diamond') {
                shapeHtml = `<svg width="100%" height="100%" viewBox="0 0 100 100"><polygon points="50,5 95,50 50,95 5,50" fill="${fill}" stroke="${stroke}" stroke-width="${strokeWidth}"/></svg>`;
            } else if (shapeType === 'octagon') {
                shapeHtml = `<svg width="100%" height="100%" viewBox="0 0 100 100"><polygon points="30,5 70,5 95,30 95,70 70,95 30,95 5,70 5,30" fill="${fill}" stroke="${stroke}" stroke-width="${strokeWidth}"/></svg>`;
            }
            
            return `
                <div class="canvas-element canvas-shape ${hiddenClass}" 
                     data-element-id="${element.id}" 
                     style="${style}">
                    ${shapeHtml}
                </div>
            `;
            
        case 'line':
            const lineType = element.lineType || 'solid';
            const lineStroke = element.stroke || '#000000';
            const lineStrokeWidth = element.strokeWidth || 2;
            
            let dashArray = '';
            if (lineType === 'dashed') dashArray = '10,5';
            else if (lineType === 'dotted') dashArray = '2,3';
            
            return `
                <div class="canvas-element canvas-line ${hiddenClass}" 
                     data-element-id="${element.id}" 
                     style="${style}">
                    <svg width="100%" height="100%">
                        <line x1="0" y1="50%" x2="100%" y2="50%" 
                              stroke="${lineStroke}" 
                              stroke-width="${lineStrokeWidth}" 
                              ${dashArray ? `stroke-dasharray="${dashArray}"` : ''} />
                    </svg>
                </div>
            `;
            
        case 'icon':
            const iconFill = element.fill || '#000000';
            const iconName = element.iconName || 'star';
            
            // Simple icon rendering (you can expand this with more icons)
            let iconSvg = '';
            if (iconName === 'star') {
                iconSvg = `<svg width="100%" height="100%" viewBox="0 0 24 24" fill="${iconFill}"><polygon points="12,2 15,9 22,9 17,14 19,21 12,17 5,21 7,14 2,9 9,9"/></svg>`;
            } else if (iconName === 'heart') {
                iconSvg = `<svg width="100%" height="100%" viewBox="0 0 24 24" fill="${iconFill}"><path d="M12,21 C12,21 3,15 3,9 C3,6 5,4 7,4 C9,4 12,6 12,6 C12,6 15,4 17,4 C19,4 21,6 21,9 C21,15 12,21 12,21 Z"/></svg>`;
            } else {
                iconSvg = `<svg width="100%" height="100%" viewBox="0 0 24 24" fill="${iconFill}"><circle cx="12" cy="12" r="10"/></svg>`;
            }
            
            return `
                <div class="canvas-element canvas-icon ${hiddenClass}" 
                     data-element-id="${element.id}" 
                     style="${style}">
                    ${iconSvg}
                </div>
            `;
            
        default:
            console.warn('Unknown element type:', element.type);
            return '';
    }
}

// Focus text input in sidebar when clicking canvas text
function focusTextInput(elementId) {
    const textarea = document.querySelector(`.text-edit-area[data-element-id="${elementId}"]`);
    if (textarea) {
        textarea.focus();
        textarea.select();
        
        // Scroll sidebar to show the element
        const elementItem = textarea.closest('.element-item');
        if (elementItem) {
            elementItem.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
}

// Reset changes
function resetChanges() {
    if (confirm('Are you sure you want to reset all changes?')) {
        canvasData = JSON.parse(JSON.stringify(originalCanvasData));
        
        // Ensure stickers array exists
        if (!canvasData.stickers) {
            canvasData.stickers = [];
        }
        
        // Reset element states
        if (canvasData.elements) {
            canvasData.elements.forEach(el => {
                elementStates[el.id] = { enabled: true };
            });
        }
        
        // Deselect stickers
        deselectSticker();
        
        initializeCanvas();
        renderElementsList();
        renderCanvas();
        showToast('Changes reset successfully');
    }
}

// Preview design (full screen)
function previewDesign() {
    // Create preview modal
    const modal = document.createElement('div');
    modal.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 3000;
        cursor: pointer;
    `;
    
    const canvas = document.getElementById('designCanvas').cloneNode(true);
    canvas.style.transform = 'none';
    canvas.querySelectorAll('.hidden').forEach(el => el.style.display = 'none');
    
    modal.appendChild(canvas);
    modal.onclick = () => modal.remove();
    
    document.body.appendChild(modal);
}

// Save design
function saveDesign() {
    console.log('💾 Saving design...');
    const loadingOverlay = document.getElementById('loadingOverlay');
    loadingOverlay.classList.add('show');
    
    // Prepare data - filter out disabled elements
    const filteredElements = canvasData.elements.filter(el => elementStates[el.id]?.enabled !== false);
    
    console.log('📦 Filtered elements:', filteredElements.length);
    
    // Convert elements back to template format
    const convertedElements = filteredElements.map(element => {
        const converted = {
            id: element.id,
            type: element.type,
            x: element.x,
            y: element.y,
            width: element.width,
            height: element.height,
            rotation: element.rotation || 0,
            zIndex: element.zIndex || 1,
            opacity: element.opacity || 1
        };
        
        // Convert text elements back - preserve ALL properties
        if (element.type === 'text') {
            const styles = element.styles || {};
            converted.text = element.content || element.text || '';
            converted.content = converted.text; // Store in both fields
            
            // Store styles in both formats for compatibility
            converted.fontSize = parseInt(styles.fontSize) || element.fontSize || 24;
            converted.fontFamily = styles.fontFamily || element.fontFamily || 'Arial';
            converted.fontWeight = styles.fontWeight || element.fontWeight || 'normal';
            converted.fontStyle = styles.fontStyle || element.fontStyle || 'normal';
            converted.textAlign = styles.textAlign || element.textAlign || 'left';
            converted.textDecoration = styles.textDecoration || element.textDecoration || 'none';
            converted.fill = styles.color || element.fill || element.color || '#000000';
            converted.color = converted.fill; // Ensure color is also stored
            
            // Also store complete styles object
            converted.styles = {
                fontFamily: converted.fontFamily,
                fontSize: converted.fontSize + 'px',
                fontWeight: converted.fontWeight,
                fontStyle: converted.fontStyle,
                textAlign: converted.textAlign,
                textDecoration: converted.textDecoration,
                color: converted.fill
            };
        }
        
        // Convert image elements - preserve ALL properties
        if (element.type === 'image') {
            converted.src = element.src || '';
            converted.imageSrc = converted.src; // Store in both fields
            
            // Preserve crop settings
            if (element.cropSettings) {
                converted.cropSettings = element.cropSettings;
            }
            
            // Preserve any filters or effects
            if (element.filters) {
                converted.filters = element.filters;
            }
        }
        
        // Convert shape elements - preserve ALL properties
        if (element.type === 'shape') {
            converted.shape = element.shape || element.shapeType || 'rectangle';
            converted.shapeType = converted.shape; // Store in both fields
            converted.fill = element.fill || '#000000';
            converted.stroke = element.stroke || 'none';
            converted.strokeWidth = element.strokeWidth || 0;
            
            // Store styles object
            converted.styles = {
                backgroundColor: converted.fill,
                fill: converted.fill,
                borderColor: converted.stroke,
                stroke: converted.stroke,
                borderWidth: converted.strokeWidth + 'px',
                strokeWidth: converted.strokeWidth
            };
        }
        
        // Convert frame elements - preserve ALL properties
        if (element.type === 'frame') {
            converted.frameType = element.frameType || 'square';
            converted.src = element.src || element.imageSrc || '';
            converted.imageSrc = converted.src; // Store in both fields
            
            const styles = element.styles || {};
            converted.styles = {
                borderColor: styles.borderColor || element.borderColor || '#000000',
                borderWidth: styles.borderWidth || element.borderWidth || '2px'
            };
            
            // Also store at top level
            converted.borderColor = converted.styles.borderColor;
            converted.borderWidth = converted.styles.borderWidth;
        }
        
        // Convert line elements - preserve ALL properties
        if (element.type === 'line') {
            converted.lineType = element.lineType || 'solid';
            converted.stroke = element.stroke || '#000000';
            converted.strokeWidth = element.strokeWidth || 2;
            converted.fill = converted.stroke; // Some templates use fill
        }
        
        // Convert icon elements - preserve ALL properties
        if (element.type === 'icon') {
            converted.iconName = element.iconName || element.iconClass || '';
            converted.iconClass = converted.iconName; // Store in both fields
            converted.fill = element.fill || element.color || '#000000';
            converted.color = converted.fill; // Store in both fields
            
            converted.styles = {
                color: converted.fill
            };
        }
        
        // Preserve locked state
        converted.locked = element.locked || false;
        
        return converted;
    });
    
    // Convert flat structure back to pages structure for consistency
    const saveData = {
        width: canvasData.width,
        height: canvasData.height,
        pages: [{
            id: 'page_1',
            name: 'Page 1',
            elements: convertedElements,
            background: {
                type: canvasData.background && (canvasData.background.startsWith('#') || canvasData.background.startsWith('rgb')) ? 'color' : 'image',
                color: canvasData.background && (canvasData.background.startsWith('#') || canvasData.background.startsWith('rgb')) ? canvasData.background : '#ffffff',
                image: canvasData.background && canvasData.background.startsWith('url(') ? canvasData.background.match(/url\(['"]?([^'"]+)['"]?\)/)?.[1] : null,
                opacity: 1,
                size: 'cover'
            }
        }]
    };
    
    console.log('💾 Save data structure:', saveData);
    console.log('💾 Converted elements:', convertedElements);
    
    fetch(`/editor/${designId}/save`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            design_name: '{{ $design->design_name }}',
            canvas_data: saveData
        })
    })
    .then(response => response.json())
    .then(data => {
        loadingOverlay.classList.remove('show');
        if (data.success) {
            showToast('Design saved successfully!', 'success');
            // Update original data after successful save
            originalCanvasData = JSON.parse(JSON.stringify(canvasData));
        } else {
            showToast('Error saving design: ' + (data.message || 'Unknown error'), 'error');
        }
    })
    .catch(error => {
        loadingOverlay.classList.remove('show');
        console.error('Error:', error);
        showToast('Error saving design', 'error');
    });
}

// Show toast notification
function showToast(message, type = 'success') {
    const toast = document.getElementById('toast');
    toast.textContent = message;
    toast.className = 'toast ' + type;
    toast.classList.add('show');
    
    setTimeout(() => {
        toast.classList.remove('show');
    }, 3000);
}

// ========== CANVAS RESIZE FUNCTIONALITY ==========

function initializeCanvasResize() {
    const handles = document.querySelectorAll('.resize-handle');
    
    handles.forEach(handle => {
        handle.addEventListener('mousedown', startCanvasResize);
    });
    
    document.addEventListener('mousemove', doCanvasResize);
    document.addEventListener('mouseup', stopCanvasResize);
}

function startCanvasResize(e) {
    e.preventDefault();
    e.stopPropagation();
    
    canvasResizeState.isResizing = true;
    canvasResizeState.direction = e.target.dataset.direction;
    canvasResizeState.startX = e.clientX;
    canvasResizeState.startY = e.clientY;
    canvasResizeState.startWidth = canvasData.width || 800;
    canvasResizeState.startHeight = canvasData.height || 600;
    
    document.getElementById('canvasWrapper').classList.add('resizing');
}

function doCanvasResize(e) {
    if (!canvasResizeState.isResizing) return;
    
    e.preventDefault();
    
    const deltaX = e.clientX - canvasResizeState.startX;
    const deltaY = e.clientY - canvasResizeState.startY;
    const direction = canvasResizeState.direction;
    
    let newWidth = canvasResizeState.startWidth;
    let newHeight = canvasResizeState.startHeight;
    
    // Calculate new dimensions based on direction
    if (direction.includes('e')) newWidth += deltaX;
    if (direction.includes('w')) newWidth -= deltaX;
    if (direction.includes('s')) newHeight += deltaY;
    if (direction.includes('n')) newHeight -= deltaY;
    
    // Constrain to min/max
    newWidth = Math.max(200, Math.min(2000, newWidth));
    newHeight = Math.max(200, Math.min(2000, newHeight));
    
    // Update canvas
    canvasData.width = Math.round(newWidth);
    canvasData.height = Math.round(newHeight);
    
    // Update inputs
    document.getElementById('canvasWidth').value = canvasData.width;
    document.getElementById('canvasHeight').value = canvasData.height;
    
    // Apply new size
    const canvas = document.getElementById('designCanvas');
    canvas.style.width = canvasData.width + 'px';
    canvas.style.height = canvasData.height + 'px';
}

function stopCanvasResize() {
    if (canvasResizeState.isResizing) {
        canvasResizeState.isResizing = false;
        document.getElementById('canvasWrapper').classList.remove('resizing');
    }
}

function updateCanvasSize() {
    const width = parseInt(document.getElementById('canvasWidth').value);
    const height = parseInt(document.getElementById('canvasHeight').value);
    
    if (width >= 200 && width <= 2000) canvasData.width = width;
    if (height >= 200 && height <= 2000) canvasData.height = height;
    
    const canvas = document.getElementById('designCanvas');
    canvas.style.width = canvasData.width + 'px';
    canvas.style.height = canvasData.height + 'px';
    
    showToast('Canvas size updated');
}

// ========== CANVAS BACKGROUND FUNCTIONALITY ==========

function updateCanvasBackground(type, value) {
    const canvas = document.getElementById('designCanvas');
    const preview = document.getElementById('bgColorPreview');
    
    if (type === 'color') {
        canvasData.background = value;
        canvas.style.background = value;
        preview.style.background = value;
        showToast('Background color updated');
    }
}

function uploadBackgroundImage(input) {
    const file = input.files[0];
    if (!file) return;
    
    if (!file.type.startsWith('image/')) {
        showToast('Please select an image file', 'error');
        return;
    }
    
    const reader = new FileReader();
    reader.onload = function(e) {
        const base64 = e.target.result;
        canvasData.background = `url(${base64})`;
        
        const canvas = document.getElementById('designCanvas');
        canvas.style.background = `url(${base64}) center/cover no-repeat`;
        
        showToast('Background image updated', 'success');
    };
    reader.readAsDataURL(file);
}

function clearBackground() {
    canvasData.background = '#ffffff';
    const canvas = document.getElementById('designCanvas');
    canvas.style.background = '#ffffff';
    document.getElementById('bgColorPreview').style.background = '#ffffff';
    document.getElementById('bgColorInput').value = '#ffffff';
    showToast('Background cleared');
}

// ========== STICKER FUNCTIONALITY ==========

function addSticker(input) {
    console.log('Adding sticker...');
    const file = input.files[0];
    if (!file) {
        console.log('No file selected');
        return;
    }
    
    console.log('File selected:', file.name, file.type, file.size, 'bytes');
    
    if (!file.type.startsWith('image/')) {
        console.log('Invalid file type:', file.type);
        showToast('Please select an image file', 'error');
        return;
    }
    
    const reader = new FileReader();
    reader.onload = function(e) {
        const base64 = e.target.result;
        
        // Create new sticker object
        const sticker = {
            id: 'sticker_' + Date.now(),
            src: base64,
            x: 100,
            y: 100,
            width: 150,
            height: 150,
            rotation: 0,
            zIndex: 1000 + canvasData.stickers.length
        };
        
        canvasData.stickers.push(sticker);
        console.log('Sticker added to canvas:', sticker);
        console.log('Total stickers:', canvasData.stickers.length);
        
        renderCanvas();
        
        showToast('Sticker added successfully', 'success');
    };
    reader.readAsDataURL(file);
    
    // Clear input
    input.value = '';
}

function selectSticker(stickerId, event) {
    if (event) {
        event.stopPropagation();
    }
    
    // Deselect all stickers
    document.querySelectorAll('.canvas-sticker').forEach(el => {
        el.classList.remove('selected');
    });
    
    // Select this sticker
    stickerState.selectedId = stickerId;
    const stickerEl = document.querySelector(`.canvas-sticker[data-sticker-id="${stickerId}"]`);
    if (stickerEl) {
        stickerEl.classList.add('selected');
    }
}

function deselectSticker() {
    stickerState.selectedId = null;
    document.querySelectorAll('.canvas-sticker').forEach(el => {
        el.classList.remove('selected');
    });
}

function deleteSticker(stickerId, event) {
    if (event) {
        event.stopPropagation();
    }
    
    const index = canvasData.stickers.findIndex(s => s.id === stickerId);
    if (index !== -1) {
        canvasData.stickers.splice(index, 1);
        renderCanvas();
        showToast('Sticker deleted');
    }
}

function startStickerDrag(stickerId, event) {
    event.preventDefault();
    event.stopPropagation();
    
    selectSticker(stickerId);
    
    const sticker = canvasData.stickers.find(s => s.id === stickerId);
    if (!sticker) return;
    
    stickerState.isDragging = true;
    stickerState.startX = event.clientX;
    stickerState.startY = event.clientY;
    stickerState.startLeft = sticker.x;
    stickerState.startTop = sticker.y;
}

function startStickerResize(stickerId, direction, event) {
    event.preventDefault();
    event.stopPropagation();
    
    selectSticker(stickerId);
    
    const sticker = canvasData.stickers.find(s => s.id === stickerId);
    if (!sticker) return;
    
    stickerState.isResizing = true;
    stickerState.resizeDirection = direction;
    stickerState.startX = event.clientX;
    stickerState.startY = event.clientY;
    stickerState.startWidth = sticker.width;
    stickerState.startHeight = sticker.height;
    stickerState.startLeft = sticker.x;
    stickerState.startTop = sticker.y;
}

function initializeCanvasInteractions() {
    const canvas = document.getElementById('designCanvas');
    
    // Click on canvas to deselect stickers
    canvas.addEventListener('click', function(e) {
        if (e.target === canvas) {
            deselectSticker();
        }
    });
    
    // Mouse move for sticker drag/resize
    document.addEventListener('mousemove', function(e) {
        if (stickerState.isDragging) {
            const sticker = canvasData.stickers.find(s => s.id === stickerState.selectedId);
            if (!sticker) return;
            
            const deltaX = e.clientX - stickerState.startX;
            const deltaY = e.clientY - stickerState.startY;
            
            sticker.x = Math.max(0, Math.min(canvasData.width - sticker.width, stickerState.startLeft + deltaX));
            sticker.y = Math.max(0, Math.min(canvasData.height - sticker.height, stickerState.startTop + deltaY));
            
            updateStickerPosition(sticker.id);
        } else if (stickerState.isResizing) {
            const sticker = canvasData.stickers.find(s => s.id === stickerState.selectedId);
            if (!sticker) return;
            
            const deltaX = e.clientX - stickerState.startX;
            const deltaY = e.clientY - stickerState.startY;
            const direction = stickerState.resizeDirection;
            
            // Calculate new dimensions maintaining aspect ratio
            let newWidth = stickerState.startWidth;
            let newHeight = stickerState.startHeight;
            let newX = stickerState.startLeft;
            let newY = stickerState.startTop;
            
            const aspectRatio = stickerState.startWidth / stickerState.startHeight;
            
            // Calculate based on corner
            if (direction === 'br') {
                newWidth = stickerState.startWidth + deltaX;
                newHeight = newWidth / aspectRatio;
            } else if (direction === 'bl') {
                newWidth = stickerState.startWidth - deltaX;
                newHeight = newWidth / aspectRatio;
                newX = stickerState.startLeft + deltaX;
            } else if (direction === 'tr') {
                newWidth = stickerState.startWidth + deltaX;
                newHeight = newWidth / aspectRatio;
                newY = stickerState.startTop + (stickerState.startHeight - newHeight);
            } else if (direction === 'tl') {
                newWidth = stickerState.startWidth - deltaX;
                newHeight = newWidth / aspectRatio;
                newX = stickerState.startLeft + deltaX;
                newY = stickerState.startTop + (stickerState.startHeight - newHeight);
            }
            
            // Constrain minimum size
            if (newWidth >= 30 && newHeight >= 30) {
                sticker.width = newWidth;
                sticker.height = newHeight;
                sticker.x = Math.max(0, Math.min(canvasData.width - newWidth, newX));
                sticker.y = Math.max(0, Math.min(canvasData.height - newHeight, newY));
                
                updateStickerPosition(sticker.id);
            }
        }
    });
    
    // Mouse up to stop drag/resize
    document.addEventListener('mouseup', function() {
        stickerState.isDragging = false;
        stickerState.isResizing = false;
    });
}

function updateStickerPosition(stickerId) {
    const sticker = canvasData.stickers.find(s => s.id === stickerId);
    if (!sticker) return;
    
    const stickerEl = document.querySelector(`.canvas-sticker[data-sticker-id="${stickerId}"]`);
    if (stickerEl) {
        stickerEl.style.left = sticker.x + 'px';
        stickerEl.style.top = sticker.y + 'px';
        stickerEl.style.width = sticker.width + 'px';
        stickerEl.style.height = sticker.height + 'px';
    }
}

// Handle window resize
window.addEventListener('resize', function() {
    initializeCanvas();
});

// Final confirmation that script loaded completely
console.log('✅ Script fully loaded and parsed!');
console.log('📊 Total functions defined:', Object.keys(window).filter(key => typeof window[key] === 'function').length);
console.log('🎨 Canvas data initialized:', canvasData ? 'YES' : 'NO');
console.log('🔢 Design ID:', designId);
</script>
@endsection
