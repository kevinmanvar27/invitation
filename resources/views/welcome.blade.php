@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="hero">
    <div class="hero-circle-1 hero-decoration"></div>
    <div class="hero-circle-2 hero-decoration"></div>
    <div class="hero-circle-3 hero-decoration"></div>
    
    <div class="hero-container">
        <div class="hero-badge">
            <span>✨</span> New: Wedding Planning Toolkit
        </div>
        
        <h1 class="hero-title">
            Create Stunning Wedding
            <span class="hero-title-highlight">Invitations in Minutes</span>
        </h1>
        
        <p class="hero-subtitle">
            Design, customize, and share beautiful wedding invitations with our easy-to-use platform. Perfect for every style and budget.
        </p>
        
        <div class="hero-buttons">
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">
                    Go to Dashboard
                </a>
            @else
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                    Create Account
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline btn-lg">
                    Sign In
                </a>
            @endauth
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="stats-section">
    <div class="stats-container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">500+</div>
                <div class="stat-label">Beautiful Templates</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">10K+</div>
                <div class="stat-label">Happy Couples</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">100%</div>
                <div class="stat-label">Satisfaction Rate</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Support Available</div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="features-section">
    <div class="features-container">
        <div class="features-header">
            <div class="features-header-badge">FEATURES</div>
            <h2>Everything you need for your wedding invitations</h2>
            <p class="text-neutral">
                Our platform provides all the tools to create stunning wedding invitations that your guests will love.
            </p>
        </div>

        <div class="features-grid">
            <!-- Feature 1 -->
            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Beautiful Templates</h3>
                <p class="feature-description">
                    Choose from hundreds of professionally designed templates that match your wedding style and personality.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 001 1v3a1 1 0 011 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Easy Customization</h3>
                <p class="feature-description">
                    Personalize every detail with our intuitive drag-and-drop editor. Add your photos, text, fonts, and colors.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Share & Print</h3>
                <p class="feature-description">
                    Send digital invitations via email or social media, or order premium printed versions delivered to your door.
                </p>
            </div>
        </div>
    </div>
</div>

@endsection