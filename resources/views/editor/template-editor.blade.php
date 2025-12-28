@extends('layouts.app')
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

.design-canvas {
    position: relative;
    overflow: hidden;
}

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

.canvas-text {
    cursor: text;
    white-space: pre-wrap;
    word-wrap: break-word;
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
        
        <div class="canvas-container">
            <div class="canvas-wrapper" id="canvasWrapper">
                <div class="design-canvas" id="designCanvas">
                    <!-- Canvas elements will be rendered here -->
                </div>
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

<script>
// Design data from server
const designId = {{ $design->id }};
const originalCanvasData = @json($design->canvas_data);
let canvasData = JSON.parse(JSON.stringify(originalCanvasData)); // Deep copy

// Element visibility state
let elementStates = {};

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

// Initialize the editor
document.addEventListener('DOMContentLoaded', function() {
    initializeCanvas();
    renderElementsList();
    renderCanvas();
    
    // Show success message if redirected from template use
    @if(session('success'))
        showToast('{{ session('success') }}', 'success');
    @endif
});

// Initialize canvas dimensions
function initializeCanvas() {
    const canvas = document.getElementById('designCanvas');
    const wrapper = document.getElementById('canvasWrapper');
    
    const width = canvasData.width || 800;
    const height = canvasData.height || 600;
    
    // Scale canvas to fit viewport
    const container = document.querySelector('.canvas-container');
    const maxWidth = container.clientWidth - 48;
    const maxHeight = container.clientHeight - 48;
    
    let scale = Math.min(maxWidth / width, maxHeight / height, 1);
    
    canvas.style.width = width + 'px';
    canvas.style.height = height + 'px';
    wrapper.style.transform = `scale(${scale})`;
    wrapper.style.transformOrigin = 'center center';
    
    // Set background
    if (canvasData.background) {
        if (canvasData.background.startsWith('#') || canvasData.background.startsWith('rgb')) {
            canvas.style.backgroundColor = canvasData.background;
        } else if (canvasData.background.startsWith('linear-gradient') || canvasData.background.startsWith('url')) {
            canvas.style.background = canvasData.background;
        }
    } else {
        canvas.style.backgroundColor = '#ffffff';
    }
    
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
    const canvas = document.getElementById('designCanvas');
    const elements = canvasData.elements || [];
    
    let html = '';
    
    elements.forEach(element => {
        const isEnabled = elementStates[element.id]?.enabled !== false;
        html += renderCanvasElement(element, isEnabled);
    });
    
    canvas.innerHTML = html;
}

// Render individual canvas element
function renderCanvasElement(element, isEnabled) {
    const hiddenClass = !isEnabled ? 'hidden' : '';
    const styles = element.styles || {};
    
    let style = `
        left: ${element.x}px;
        top: ${element.y}px;
        width: ${element.width}px;
        height: ${element.height}px;
        transform: rotate(${element.rotation || 0}deg);
        z-index: ${element.zIndex || 1};
    `;
    
    switch(element.type) {
        case 'text':
            let textStyle = '';
            if (styles.fontFamily) textStyle += `font-family: '${styles.fontFamily}', sans-serif;`;
            if (styles.fontSize) textStyle += `font-size: ${styles.fontSize};`;
            if (styles.fontWeight) textStyle += `font-weight: ${styles.fontWeight};`;
            if (styles.fontStyle) textStyle += `font-style: ${styles.fontStyle};`;
            if (styles.textDecoration) textStyle += `text-decoration: ${styles.textDecoration};`;
            if (styles.textAlign) textStyle += `text-align: ${styles.textAlign};`;
            if (styles.color) textStyle += `color: ${styles.color};`;
            
            return `
                <div class="canvas-element canvas-text ${hiddenClass}" 
                     data-element-id="${element.id}" 
                     style="${style} ${textStyle}"
                     onclick="focusTextInput('${element.id}')">
                    <span class="text-content">${element.content || ''}</span>
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
            
        default:
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
        
        // Reset element states
        if (canvasData.elements) {
            canvasData.elements.forEach(el => {
                elementStates[el.id] = { enabled: true };
            });
        }
        
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
    const loadingOverlay = document.getElementById('loadingOverlay');
    loadingOverlay.classList.add('show');
    
    // Prepare data - filter out disabled elements
    const saveData = {
        ...canvasData,
        elements: canvasData.elements.filter(el => elementStates[el.id]?.enabled !== false)
    };
    
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

// Handle window resize
window.addEventListener('resize', function() {
    initializeCanvas();
});
</script>
@endsection
