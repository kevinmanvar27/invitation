@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="card">
            <div class="p-6 text-text-light">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Design Editor - {{ $template->name }}</h1>
                    <div class="flex space-x-2">
                        <button id="save-btn" class="btn btn-primary btn-md">
                            Save Design
                        </button>
                        <button id="preview-btn" class="btn btn-secondary btn-md">
                            Preview
                        </button>
                        <button id="download-btn" class="btn btn-secondary btn-md">
                            Download
                        </button>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                    <!-- Toolbar -->
                    <div class="lg:col-span-1 bg-gray-50 p-4 rounded-lg">
                        <h2 class="text-lg font-semibold mb-4 text-text-light">Tools</h2>
                        <div class="space-y-4">
                            <div>
                                <h3 class="font-medium mb-2 text-text-light">Text</h3>
                                <div class="space-y-2">
                                    <button class="w-full text-left px-3 py-2 bg-surface-light border border-border-light rounded-md hover:bg-gray-100 text-text-light">
                                        Add Text
                                    </button>
                                    <button class="w-full text-left px-3 py-2 bg-surface-light border border-border-light rounded-md hover:bg-gray-100 text-text-light">
                                        Edit Text
                                    </button>
                                </div>
                            </div>
                            
                            <div>
                                <h3 class="font-medium mb-2 text-text-light">Images</h3>
                                <div class="space-y-2">
                                    <button class="w-full text-left px-3 py-2 bg-surface-light border border-border-light rounded-md hover:bg-gray-100 text-text-light">
                                        Upload Image
                                    </button>
                                    <button class="w-full text-left px-3 py-2 bg-surface-light border border-border-light rounded-md hover:bg-gray-100 text-text-light">
                                        Image Library
                                    </button>
                                </div>
                            </div>
                            
                            <div>
                                <h3 class="font-medium mb-2 text-text-light">Elements</h3>
                                <div class="space-y-2">
                                    <button class="w-full text-left px-3 py-2 bg-surface-light border border-border-light rounded-md hover:bg-gray-100 text-text-light">
                                        Stickers
                                    </button>
                                    <button class="w-full text-left px-3 py-2 bg-surface-light border border-border-light rounded-md hover:bg-gray-100 text-text-light">
                                        Borders
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Canvas Area -->
                    <div class="lg:col-span-2">
                        <div class="bg-gray-100 border-2 border-dashed border-border-light rounded-lg h-96 flex items-center justify-center">
                            <div class="text-center">
                                <div class="text-4xl mb-4">🎨</div>
                                <p class="text-text-secondary-light">Design Canvas</p>
                                <p class="text-sm text-text-secondary-light mt-2">Your design will appear here</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Properties Panel -->
                    <div class="lg:col-span-1 bg-gray-50 p-4 rounded-lg">
                        <h2 class="text-lg font-semibold mb-4 text-text-light">Properties</h2>
                        <div class="space-y-4">
                            <div>
                                <h3 class="font-medium mb-2 text-text-light">Text Properties</h3>
                                <div class="space-y-2">
                                    <div>
                                        <label class="block text-sm font-medium text-text-light">Font</label>
                                        <select class="mt-1 block w-full rounded-md border-border-light shadow-sm focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50 input-field">
                                            <option>Arial</option>
                                            <option>Times New Roman</option>
                                            <option>Courier New</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-text-light">Size</label>
                                        <input type="range" min="8" max="72" value="16" class="w-full">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-text-light">Color</label>
                                        <input type="color" class="mt-1 block w-full h-10 rounded-md border-border-light shadow-sm focus:border-primary-light focus:ring focus:ring-primary-light focus:ring-opacity-50">
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <h3 class="font-medium mb-2 text-text-light">Background</h3>
                                <div class="space-y-2">
                                    <button class="w-full text-left px-3 py-2 bg-surface-light border border-border-light rounded-md hover:bg-gray-100 text-text-light">
                                        Solid Color
                                    </button>
                                    <button class="w-full text-left px-3 py-2 bg-surface-light border border-border-light rounded-md hover:bg-gray-100 text-text-light">
                                        Gradient
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection