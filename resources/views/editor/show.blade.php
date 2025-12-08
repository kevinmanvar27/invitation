@extends('layouts.app')

@section('content')
<style>
/* Canvas-focused Editor Styles */
.editor-container {
    display: flex;
    flex-direction: column;
    height: calc(100vh - 120px);
    padding: 1rem;
}

.editor-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 0;
    margin-bottom: 1rem;
    border-bottom: 1px solid #e2e8f0;
}

.editor-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1e293b;
}

.editor-toolbar {
    display: flex;
    gap: 0.5rem;
    padding: 0.75rem;
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border: 1px solid #e2e8f0;
    border-radius: 0.5rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}

.editor-toolbar-button {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0.5rem;
    border-radius: 0.375rem;
    background-color: white;
    border: 1px solid #e2e8f0;
    color: #334155;
    cursor: pointer;
    transition: all 0.2s ease;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
}

.editor-toolbar-button:hover {
    background-color: #f8fafc;
    color: #3b82f6;
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.editor-main {
    display: flex;
    flex: 1;
    gap: 1rem;
    overflow: hidden;
}

.editor-sidebar {
    width: 240px; /* Reduced width for more canvas space */
    display: flex;
    flex-direction: column;
    gap: 1rem;
    overflow-y: auto;
}

.editor-tools-panel {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border: 1px solid #e2e8f0;
    border-radius: 0.75rem;
    padding: 1rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    max-height: 300px; /* Limit height for better scrolling */
    overflow-y: auto;
}

.editor-properties-panel {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border: 1px solid #e2e8f0;
    border-radius: 0.75rem;
    padding: 1rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    flex: 1;
    overflow-y: auto;
    max-height: 500px; /* Limit height for better scrolling */
}

.editor-canvas-area {
    flex: 1;
    display: flex;
    flex-direction: column;
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border: 1px solid #e2e8f0;
    border-radius: 0.75rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    min-width: 0; /* Allow shrinking on small screens */
    position: relative;
}

.editor-canvas-area::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        linear-gradient(90deg, rgba(226, 232, 240, 0.2) 1px, transparent 1px),
        linear-gradient(rgba(226, 232, 240, 0.2) 1px, transparent 1px);
    background-size: 20px 20px;
    pointer-events: none;
    z-index: 0;
}

.editor-canvas-header {
    padding: 1rem;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
}

.editor-canvas-title {
    font-weight: 600;
    color: #1e293b;
    font-size: 1.25rem;
}

.editor-canvas-content {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
    border: 2px dashed #bae6fd;
    margin: 1rem;
    border-radius: 0.5rem;
    overflow: hidden;
    position: relative;
    box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.05);
    z-index: 1; /* Above the grid background */
}

.editor-tool-category {
    margin-bottom: 1rem;
}

.editor-tool-category:last-child {
    margin-bottom: 0;
}

.editor-tool-title {
    font-size: 0.875rem; /* Smaller title font */
    font-weight: 600;
    color: #334155;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.25rem; /* Reduced gap */
    cursor: pointer;
}

.editor-tool-title svg {
    width: 0.875rem;
    height: 0.875rem;
}

.editor-tool-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.75rem; /* Increased gap for better spacing */
    margin-top: 0.5rem;
}

.editor-tool-button {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0.75rem; /* Increased padding for better touch targets */
    border-radius: 0.5rem; /* Slightly larger radius */
    background-color: white;
    border: 1px solid #e2e8f0;
    color: #334155;
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 0.875rem; /* Slightly larger font size */
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
}

.editor-tool-button:hover {
    background-color: #f8fafc;
    color: #3b82f6;
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}



.editor-property-group {
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #e2e8f0;
}

.editor-property-group:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}

.editor-property-group:last-child {
    margin-bottom: 0;
}

.editor-property-title {
    font-size: 0.875rem; /* Smaller title font */
    font-weight: 600;
    color: #334155;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.25rem; /* Reduced gap */
}

.editor-property-title svg {
    width: 0.875rem;
    height: 0.875rem;
}

.editor-property-controls {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    background: white;
    border-radius: 0.5rem;
    padding: 1rem;
    border: 1px solid #e2e8f0;
}

.editor-property-control {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.editor-control-label {
    font-size: 0.875rem;
    font-weight: 500;
    color: #64748b;
}

.editor-control-input {
    padding: 0.5rem;
    border-radius: 0.375rem;
    border: 1px solid #cbd5e1;
    background-color: white;
    transition: all 0.2s ease;
}

.editor-control-input:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    outline: none;
}

/* Modal Input Styles */
#textInput, #imageInput {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #cbd5e1;
    border-radius: 0.375rem;
    transition: all 0.2s ease;
}

#textInput:focus, #imageInput:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    outline: none;
}

/* Modal Input Styles */
#textInput, #imageInput {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid #cbd5e1;
    border-radius: 0.375rem;
    transition: all 0.2s ease;
}

#textInput:focus, #imageInput:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
    outline: none;
}

.editor-canvas-placeholder {
    text-align: center;
    padding: 2rem;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    border-radius: 0.5rem;
}

.editor-canvas-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 4rem;
    height: 4rem;
    border-radius: 50%;
    background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
    color: #3b82f6;
    margin-bottom: 1rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.editor-canvas-text {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.5rem;
}

.editor-canvas-subtext {
    color: #64748b;
    margin-bottom: 1.5rem;
}

.btn-primary-canvas {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
    border: none;
    border-radius: 0.375rem;
    padding: 0.75rem 1.5rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-primary-canvas:hover {
    background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    transform: translateY(-1px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Collapsible sections */
.editor-tool-category.collapsed .editor-tool-grid {
    display: none;
}

.editor-tool-category.collapsed .editor-tool-title::after {
    content: '▶';
    margin-left: auto;
    transition: transform 0.2s ease;
}

.editor-tool-category:not(.collapsed) .editor-tool-title::after {
    content: '▼';
    margin-left: auto;
    transition: transform 0.2s ease;
}

@media (max-width: 1024px) {
    .editor-sidebar {
        width: 200px;
    }
}

@media (max-width: 768px) {
    .editor-container {
        height: auto;
    }
    
    .editor-main {
        flex-direction: column;
    }
    
    .editor-sidebar {
        width: 100%;
        flex-direction: row;
        overflow-x: auto;
    }
    
    .editor-tools-panel, .editor-properties-panel {
        min-width: 240px;
    }
}
.editor-canvas-design {
    width: 100%;
    height: 100%;
}

.editor-canvas-image {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    border-radius: 0.5rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.editor-canvas-preview {
    display: flex;
    width: 100%;
    height: 100%;
    align-items: center;
    justify-content: center;
}

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    align-items: center;
    justify-content: center;
}

.modal-content {
    background: white;
    border-radius: 0.5rem;
    padding: 1.5rem;
    width: 90%;
    max-width: 500px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    animation: modalFadeIn 0.3s ease-out;
}

@keyframes modalFadeIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

</style>
<script>
function switchToDesignMode() {
    document.getElementById('templatePreview').style.display = 'none';
    document.getElementById('designCanvas').style.display = 'flex';
}

function switchToTemplatePreview() {
    document.getElementById('designCanvas').style.display = 'none';
    document.getElementById('templatePreview').style.display = 'flex';
}

function toggleToolCategory(element) {
    const category = element.closest('.editor-tool-category');
    category.classList.toggle('collapsed');
}

// Text Modal Functions
function openTextModal() {
    document.getElementById('textModal').style.display = 'flex';
}

function closeTextModal() {
    document.getElementById('textModal').style.display = 'none';
    document.getElementById('textInput').value = '';
}

function addTextToCanvas() {
    const text = document.getElementById('textInput').value;
    if (text.trim() !== '') {
        // In a real implementation, this would add the text to the canvas
        alert('Text added to canvas: ' + text);
        closeTextModal();
    } else {
        alert('Please enter some text');
    }
}

// Image Upload Modal Functions
function openImageUploadModal() {
    document.getElementById('imageUploadModal').style.display = 'flex';
}

function closeImageUploadModal() {
    document.getElementById('imageUploadModal').style.display = 'none';
    document.getElementById('imageInput').value = '';
}

function uploadImage() {
    const fileInput = document.getElementById('imageInput');
    const file = fileInput.files[0];
    
    if (file) {
        // Check if file is an image
        if (!file.type.match('image.*')) {
            alert('Please select an image file');
            return;
        }
        
        // Create FormData object to send file
        const formData = new FormData();
        formData.append('image', file);
        formData.append('_token', '{{ csrf_token() }}');
        
        // Send AJAX request to upload image
        fetch('{{ route("editor.upload-image") }}', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Image uploaded successfully!');
                closeImageUploadModal();
            } else {
                alert('Error uploading image: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error uploading image');
        });
    } else {
        alert('Please select an image file');
    }
}

// Save Design Function
function saveDesign() {
    // In a real implementation, this would collect all canvas data and save it
    const elements = [
        // Sample text element
        {
            type: 'text',
            content: 'Sample Text',
            x: 100,
            y: 100,
            width: 200,
            height: 50,
            rotation: 0,
            zIndex: 1,
            styles: {
                fontFamily: 'Arial',
                fontSize: '16px',
                color: '#000000'
            }
        },
        // Sample image element
        {
            type: 'image',
            content: '/images/sample.jpg',
            x: 150,
            y: 200,
            width: 150,
            height: 150,
            rotation: 0,
            zIndex: 2,
            styles: {
                border: '1px solid #cccccc'
            }
        }
    ];
    
    // Send AJAX request to save design
    fetch('{{ route("editor.save", $template->id) }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            design_name: '{{ $template->name }} Custom Design',
            elements: elements
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Design saved successfully!');
        } else {
            alert('Error saving design: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error saving design');
    });
}

// When the page loads, show the template preview first
document.addEventListener('DOMContentLoaded', function() {
    // The template preview is shown by default
    // Users can click "Start Editing" to switch to design mode
    
    // Set up collapsible tool categories
    const toolTitles = document.querySelectorAll('.editor-tool-title');
    toolTitles.forEach(title => {
        title.addEventListener('click', function() {
            toggleToolCategory(this);
        });
    });
    
    // Collapse all categories by default except the first one
    const categories = document.querySelectorAll('.editor-tool-category');
    categories.forEach((category, index) => {
        if (index > 0) {
            category.classList.add('collapsed');
        }
    });
    
    // Close modals when clicking outside
    window.onclick = function(event) {
        const textModal = document.getElementById('textModal');
        const imageModal = document.getElementById('imageUploadModal');
        
        if (event.target === textModal) {
            closeTextModal();
        }
        
        if (event.target === imageModal) {
            closeImageUploadModal();
        }
    }
});
</script>
<!-- Canvas Editor -->
<div class="editor-container">
    <div class="editor-header">
        <h1 class="editor-title">{{ $template->name }} - Customization</h1>
        <div class="editor-toolbar">
            <button id="save-btn" class="editor-toolbar-button" onclick="saveDesign()">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </button>
            <button id="preview-btn" class="editor-toolbar-button">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </button>
            <button id="template-preview-btn" class="editor-toolbar-button" onclick="switchToTemplatePreview()">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </button>
            <button id="download-btn" class="editor-toolbar-button">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
            </button>
        </div>
    </div>

    <div class="editor-main">
        <!-- Left Sidebar - Tools -->
        <div class="editor-sidebar">
            <div class="editor-tools-panel">
                <div class="editor-tool-category">
                    <h3 class="editor-tool-title">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Text
                    </h3>
                    <div class="editor-tool-grid">
                        <button class="editor-tool-button" onclick="openTextModal()">Add Text</button>
                        <button class="editor-tool-button">Edit Text</button>
                    </div>
                </div>
                
                <div class="editor-tool-category">
                    <h3 class="editor-tool-title">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Images
                    </h3>
                    <div class="editor-tool-grid">
                        <button class="editor-tool-button" onclick="openImageUploadModal()">Upload</button>
                        <button class="editor-tool-button">Library</button>
                    </div>
                </div>
                
                <div class="editor-tool-category">
                    <h3 class="editor-tool-title">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                        </svg>
                        Elements
                    </h3>
                    <div class="editor-tool-grid">
                        <button class="editor-tool-button">Stickers</button>
                        <button class="editor-tool-button">Borders</button>
                    </div>
                </div>
            </div>
            
            <div class="editor-properties-panel">
                <div class="editor-property-group">
                    <h3 class="editor-property-title">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Text Settings
                    </h3>
                    <div class="editor-property-controls">
                        <div class="editor-property-control">
                            <label class="editor-control-label">Font Family</label>
                            <select class="editor-control-input">
                                <option>Playfair Display</option>
                                <option>Inter</option>
                                <option>Georgia</option>
                                <option>Arial</option>
                            </select>
                        </div>
                        <div class="editor-property-control">
                            <label class="editor-control-label">Font Size</label>
                            <input type="range" min="8" max="72" value="16" class="editor-control-input">
                        </div>
                        <div class="editor-property-control">
                            <label class="editor-control-label">Text Color</label>
                            <input type="color" class="editor-control-input">
                        </div>
                    </div>
                </div>
                
                <div class="editor-property-group">
                    <h3 class="editor-property-title">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Background
                    </h3>
                    <div class="editor-tool-grid">
                        <button class="editor-tool-button">Solid Color</button>
                        <button class="editor-tool-button">Gradient</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Canvas Area -->
        <div class="editor-canvas-area">
            <div class="editor-canvas-header">
                <h2 class="editor-canvas-title">Design Canvas</h2>
            </div>
            <div class="editor-canvas-content">
                <!-- Template Preview -->
                <div class="editor-canvas-preview" id="templatePreview">
                    @if($template->preview_path)
                        <img src="{{ asset('previews/' . $template->preview_path) }}" alt="{{ $template->name }} Preview" class="editor-canvas-image">
                    @else
                        <div class="editor-canvas-placeholder">
                            <div class="editor-canvas-icon">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                                </svg>
                            </div>
                            <h3 class="editor-canvas-text">{{ $template->name }}</h3>
                            <p class="editor-canvas-subtext">Template Preview</p>
                        </div>
                    @endif
                </div>
                <!-- Design Canvas (initially hidden) -->
                <div class="editor-canvas-design" id="designCanvas" style="display: none; width: 100%; height: 100%;">
                    <div class="editor-canvas-placeholder">
                        <div class="editor-canvas-icon">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                            </svg>
                        </div>
                        <h3 class="editor-canvas-text">Your Design Canvas</h3>
                        <p class="editor-canvas-subtext">Start creating your personalized invitation</p>
                        <button class="btn-primary-canvas" onclick="switchToDesignMode()">Start Editing</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Text Modal -->
    <div id="textModal" class="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1000; align-items: center; justify-content: center;">
        <div class="modal-content" style="background: white; border-radius: 0.5rem; padding: 1.5rem; width: 90%; max-width: 500px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <h3 style="font-size: 1.25rem; font-weight: 600;">Add Text</h3>
                <button onclick="closeTextModal()" style="background: none; border: none; font-size: 1.5rem; cursor: pointer;">&times;</button>
            </div>
            <div style="margin-bottom: 1rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Enter your text:</label>
                <textarea id="textInput" style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 0.375rem; min-height: 100px;"></textarea>
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 0.5rem;">
                <button onclick="closeTextModal()" style="padding: 0.5rem 1rem; border: 1px solid #cbd5e1; border-radius: 0.375rem; background: white; cursor: pointer;">Cancel</button>
                <button onclick="addTextToCanvas()" style="padding: 0.5rem 1rem; border: none; border-radius: 0.375rem; background: #3b82f6; color: white; cursor: pointer;">Add Text</button>
            </div>
        </div>
    </div>

    <!-- Image Upload Modal -->
    <div id="imageUploadModal" class="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1000; align-items: center; justify-content: center;">
        <div class="modal-content" style="background: white; border-radius: 0.5rem; padding: 1.5rem; width: 90%; max-width: 500px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <h3 style="font-size: 1.25rem; font-weight: 600;">Upload Image</h3>
                <button onclick="closeImageUploadModal()" style="background: none; border: none; font-size: 1.5rem; cursor: pointer;">&times;</button>
            </div>
            <div style="margin-bottom: 1rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Choose an image:</label>
                <input type="file" id="imageInput" accept="image/*" style="width: 100%; padding: 0.75rem; border: 1px solid #cbd5e1; border-radius: 0.375rem;">
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 0.5rem;">
                <button onclick="closeImageUploadModal()" style="padding: 0.5rem 1rem; border: 1px solid #cbd5e1; border-radius: 0.375rem; background: white; cursor: pointer;">Cancel</button>
                <button onclick="uploadImage()" style="padding: 0.5rem 1rem; border: none; border-radius: 0.375rem; background: #3b82f6; color: white; cursor: pointer;">Upload</button>
            </div>
        </div>
    </div>
@endsection