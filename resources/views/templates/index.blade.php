@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="hero">
    <div class="hero-circle-1 hero-decoration"></div>
    <div class="hero-circle-2 hero-decoration"></div>
    <div class="hero-circle-3 hero-decoration"></div>
    
    <div class="hero-container">
        <div class="hero-badge">
            <span>✨</span> Wedding Templates
        </div>
        
        <h1 class="hero-title">
            Beautiful Wedding
            <span class="hero-title-highlight">Invitation Templates</span>
        </h1>
        
        <p class="hero-subtitle">
            Choose from our collection of professionally designed templates to create your perfect wedding invitation
        </p>
    </div>
</div>

<!-- Stats Section -->
<div class="stats-section">
    <div class="stats-container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">{{ $templates->count() }}+</div>
                <div class="stat-label">Templates</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">500+</div>
                <div class="stat-label">Designs</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">100%</div>
                <div class="stat-label">Satisfaction</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Support</div>
            </div>
        </div>
    </div>
</div>

<!-- Content Section -->
<div class="features-section">
    <div class="features-container">
        <div class="features-header">
            <div class="features-header-badge">TEMPLATES</div>
            <h2>Browse Our Collection</h2>
            <p class="text-neutral">
                Find the perfect template that matches your wedding style and personality
            </p>
        </div>

        <div class="features-grid">
            @forelse ($templates as $template)
                <div class="feature-card">
                    <div class="mb-4 rounded-lg overflow-hidden">
                        <img src="{{ asset($template->thumbnail_path) }}" alt="{{ $template->name }}" class="w-full h-48 object-cover">
                    </div>
                    <h3 class="feature-title">{{ $template->name }}</h3>
                    <p class="feature-description mb-4">
                        {{ $template->description }}
                    </p>
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm text-neutral-600">{{ $template->theme }} - {{ $template->style }}</span>
                        @if ($template->is_premium)
                            <span class="bg-warning-100 text-warning-700 text-xs font-medium px-2.5 py-0.5 rounded">Premium</span>
                        @else
                            <span class="bg-success-100 text-success-700 text-xs font-medium px-2.5 py-0.5 rounded">Free</span>
                        @endif
                    </div>
                    <a href="{{ route('templates.show', $template->id) }}" class="btn btn-primary w-full">
                        Use This Template
                    </a>
                </div>
            @empty
                <div class="feature-card text-center col-span-3">
                    <p class="text-neutral-600">No templates available at the moment.</p>
                </div>
            @endforelse
        </div>
        
        @if ($templates->hasPages())
            <div class="mt-8">
                {{ $templates->links() }}
            </div>
        @endif
    </div>
</div>
@endsection