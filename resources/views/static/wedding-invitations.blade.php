@extends('layouts.home')

@section('content')
<!-- Hero Section -->
<div class="hero">
    <div class="hero-circle-1 hero-decoration"></div>
    <div class="hero-circle-2 hero-decoration"></div>
    <div class="hero-circle-3 hero-decoration"></div>
    
    <div class="hero-container">
        <div class="hero-badge">
            <span>✨</span> Digital Invitations
        </div>
        
        <h1 class="hero-title">
            Beautiful Digital
            <span class="hero-title-highlight">Wedding Invitations</span>
        </h1>
        
        <p class="hero-subtitle">
            Create stunning digital wedding invitations in minutes with our easy-to-use platform
        </p>
        
        <div class="hero-buttons">
            <a href="{{ route('templates.index') }}" class="btn btn-primary btn-lg">
                Browse Templates
            </a>
            <a href="{{ route('register') }}" class="btn btn-outline btn-lg">
                Create Account
            </a>
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
            <div class="features-header-badge">DIGITAL INVITATIONS</div>
            <h2>Why Digital Wedding Invitations?</h2>
            <p class="text-neutral">
                Discover the benefits of choosing digital wedding invitations for your special day
            </p>
        </div>

        <div class="features-grid">
            <!-- Benefit 1 -->
            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Eco-friendly and Sustainable</h3>
                <p class="feature-description">
                    Reduce paper waste and environmental impact with our digital invitations.
                </p>
            </div>

            <!-- Benefit 2 -->
            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Instant Delivery</h3>
                <p class="feature-description">
                    Send your invitations instantly to all your guests via email or social media.
                </p>
            </div>

            <!-- Benefit 3 -->
            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Easy RSVP Tracking</h3>
                <p class="feature-description">
                    Manage guest responses effortlessly with our built-in RSVP management system.
                </p>
            </div>

            <!-- Benefit 4 -->
            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Cost-effective</h3>
                <p class="feature-description">
                    Save money compared to traditional paper invitations with our affordable digital solutions.
                </p>
            </div>

            <!-- Benefit 5 -->
            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Fully Customizable</h3>
                <p class="feature-description">
                    Personalize every detail to match your wedding theme and personal style.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Templates Section -->
<div class="testimonials-section">
    <div class="testimonials-container">
        <div class="testimonials-header">
            <div class="features-header-badge">TEMPLATES</div>
            <h2>Popular Wedding Invitation Templates</h2>
        </div>

        <div class="testimonials-grid">
            <!-- Template 1 -->
            <div class="testimonial-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Classic Elegance</h3>
                <p class="feature-description">
                    Timeless designs with sophisticated typography and color schemes.
                </p>
            </div>

            <!-- Template 2 -->
            <div class="testimonial-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Modern Minimal</h3>
                <p class="feature-description">
                    Clean lines and contemporary designs for the modern couple.
                </p>
            </div>

            <!-- Template 3 -->
            <div class="testimonial-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Rustic Charm</h3>
                <p class="feature-description">
                    Warm, earthy tones and natural elements for outdoor weddings.
                </p>
            </div>
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('templates.index') }}" class="btn btn-primary btn-lg">
                Browse All Templates
            </a>
        </div>
    </div>
</div>

<!-- How It Works Section -->
<div class="features-section">
    <div class="features-container">
        <div class="features-header">
            <div class="features-header-badge">PROCESS</div>
            <h2>How It Works</h2>
            <p class="text-neutral">
                Create beautiful wedding invitations in just four simple steps
            </p>
        </div>

        <div class="features-grid">
            <!-- Step 1 -->
            <div class="feature-card text-center">
                <div class="feature-icon mx-auto mb-4">
                    <div class="text-2xl font-bold text-white bg-primary-500 rounded-full w-12 h-12 flex items-center justify-center">1</div>
                </div>
                <h3 class="feature-title">Choose Template</h3>
                <p class="feature-description">
                    Browse our collection of professionally designed templates.
                </p>
            </div>

            <!-- Step 2 -->
            <div class="feature-card text-center">
                <div class="feature-icon mx-auto mb-4">
                    <div class="text-2xl font-bold text-white bg-primary-500 rounded-full w-12 h-12 flex items-center justify-center">2</div>
                </div>
                <h3 class="feature-title">Customize</h3>
                <p class="feature-description">
                    Personalize your invitation with photos, text, and colors.
                </p>
            </div>

            <!-- Step 3 -->
            <div class="feature-card text-center">
                <div class="feature-icon mx-auto mb-4">
                    <div class="text-2xl font-bold text-white bg-primary-500 rounded-full w-12 h-12 flex items-center justify-center">3</div>
                </div>
                <h3 class="feature-title">Send</h3>
                <p class="feature-description">
                    Share your digital invitation via email or social media.
                </p>
            </div>

            <!-- Step 4 -->
            <div class="feature-card text-center">
                <div class="feature-icon mx-auto mb-4">
                    <div class="text-2xl font-bold text-white bg-primary-500 rounded-full w-12 h-12 flex items-center justify-center">4</div>
                </div>
                <h3 class="feature-title">Track RSVPs</h3>
                <p class="feature-description">
                    Monitor guest responses and manage your guest list easily.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection