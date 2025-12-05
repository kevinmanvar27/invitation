@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="hero">
    <div class="hero-circle-1 hero-decoration"></div>
    <div class="hero-circle-2 hero-decoration"></div>
    <div class="hero-circle-3 hero-decoration"></div>
    
    <div class="hero-container">
        <div class="hero-badge">
            <span>✨</span> Template Details
        </div>
        
        <h1 class="hero-title">
            {{ $template->name }}
            <span class="hero-title-highlight">Preview</span>
        </h1>
        
        <p class="hero-subtitle">
            Preview and customize this beautiful wedding invitation template
        </p>
    </div>
</div>

<!-- Content Section -->
<div class="features-section">
    <div class="features-container">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="feature-card">
                <div class="mb-4 rounded-lg overflow-hidden">
                    <img src="{{ asset($template->preview_path) }}" alt="{{ $template->name }}" class="w-full rounded-lg shadow-md">
                </div>
            </div>
            
            <div class="feature-card">
                <h2 class="feature-title">Template Details</h2>
                
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Description</h3>
                    <p class="feature-description">
                        {{ $template->description }}
                    </p>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-3">Specifications</h3>
                    <ul class="space-y-2">
                        <li class="flex justify-between py-2 border-b border-neutral-200">
                            <span class="text-neutral-700">Theme:</span>
                            <span class="font-medium">{{ $template->theme }}</span>
                        </li>
                        <li class="flex justify-between py-2 border-b border-neutral-200">
                            <span class="text-neutral-700">Style:</span>
                            <span class="font-medium">{{ $template->style }}</span>
                        </li>
                        <li class="flex justify-between py-2 border-b border-neutral-200">
                            <span class="text-neutral-700">Orientation:</span>
                            <span class="font-medium">{{ ucfirst($template->orientation) }}</span>
                        </li>
                        <li class="flex justify-between py-2 border-b border-neutral-200">
                            <span class="text-neutral-700">Type:</span>
                            <span class="font-medium">
                                @if ($template->is_premium)
                                    <span class="bg-warning-100 text-warning-700 text-xs font-medium px-2.5 py-0.5 rounded">Premium</span>
                                @else
                                    <span class="bg-success-100 text-success-700 text-xs font-medium px-2.5 py-0.5 rounded">Free</span>
                                @endif
                            </span>
                        </li>
                        @if ($template->is_premium)
                            <li class="flex justify-between py-2">
                                <span class="text-neutral-700">Price:</span>
                                <span class="font-medium">${{ $template->price }}</span>
                            </li>
                        @endif
                    </ul>
                </div>
                
                <div class="mt-8">
                    <a href="{{ route('editor.show', $template) }}" class="btn btn-primary w-full">
                        Customize This Template
                    </a>
                    <a href="{{ route('templates.index') }}" class="btn btn-outline w-full mt-3">
                        ← Back to Templates
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection