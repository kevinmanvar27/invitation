@extends('layouts.home')

@section('content')
<!-- Hero Section -->
<div class="hero">
    <div class="hero-circle-1 hero-decoration"></div>
    <div class="hero-circle-2 hero-decoration"></div>
    <div class="hero-circle-3 hero-decoration"></div>
    
    <div class="hero-container">
        <div class="hero-badge">
            <span>✨</span> About Us
        </div>
        
        <h1 class="hero-title">
            About
            <span class="hero-title-highlight">Uvinvite</span>
        </h1>
        
        <p class="hero-subtitle">
            Creating beautiful digital wedding invitations that capture your unique love story
        </p>
    </div>
</div>

<!-- Stats Section -->
<div class="stats-section">
    <div class="stats-container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">10K+</div>
                <div class="stat-label">Happy Couples</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">500+</div>
                <div class="stat-label">Beautiful Templates</div>
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

<!-- Content Section -->
<div class="features-section">
    <div class="features-container">
        <div class="features-header">
            <div class="features-header-badge">OUR STORY</div>
            <h2>Our Journey</h2>
            <p class="text-neutral">
                Discover how we became the premier destination for digital wedding invitations
            </p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Our Foundation</h3>
                <p class="feature-description">
                    Welcome to Uvinvite, your premier destination for creating beautiful digital wedding invitations. 
                    Founded by Utsav Patel, our platform was born out of a desire to make wedding planning more accessible, 
                    affordable, and enjoyable for couples around the world.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Our Mission</h3>
                <p class="feature-description">
                    Our mission is to empower couples to create stunning digital wedding invitations that capture their 
                    unique style and love story. We believe that technology should enhance the joy of wedding planning, 
                    not complicate it. Through innovative design and intuitive tools, we're making it easier than ever 
                    for couples to share their special day with friends and family.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Our Team</h3>
                <p class="feature-description">
                    Our team of talented designers and developers work tirelessly to provide you with the latest 
                    templates, features, and tools to make your wedding planning experience seamless from start to finish.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Why Choose Section -->
<div class="testimonials-section">
    <div class="testimonials-container">
        <div class="testimonials-header">
            <div class="features-header-badge">WHY CHOOSE US</div>
            <h2>Why Choose Uvinvite?</h2>
        </div>

        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Beautiful Designs</h3>
                <p class="feature-description">
                    Hundreds of professionally designed templates to match any wedding style, from traditional to modern.
                </p>
            </div>
            
            <div class="testimonial-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Easy Customization</h3>
                <p class="feature-description">
                    Intuitive drag-and-drop editor that makes personalizing your invitation a breeze with no design skills needed.
                </p>
            </div>
            
            <div class="testimonial-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Share & Print</h3>
                <p class="feature-description">
                    Share digitally via email or social media, or order premium printed invitations delivered to your door.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection