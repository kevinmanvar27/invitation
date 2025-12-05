@extends('layouts.home')

@section('content')
<!-- Hero Section -->
<div class="hero">
    <div class="hero-circle-1 hero-decoration"></div>
    <div class="hero-circle-2 hero-decoration"></div>
    <div class="hero-circle-3 hero-decoration"></div>
    
    <div class="hero-container">
        <div class="hero-badge">
            <span>✨</span> Privacy Policy
        </div>
        
        <h1 class="hero-title">
            Privacy &
            <span class="hero-title-highlight">Protection</span>
        </h1>
        
        <p class="hero-subtitle">
            Last updated: {{ date('F d, Y') }}
        </p>
    </div>
</div>

<!-- Stats Section -->
<div class="stats-section">
    <div class="stats-container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">100%</div>
                <div class="stat-label">Data Protection</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Security Monitoring</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">0</div>
                <div class="stat-label">Data Breaches</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">GDPR</div>
                <div class="stat-label">Compliant</div>
            </div>
        </div>
    </div>
</div>

<!-- Content Section -->
<div class="features-section">
    <div class="features-container">
        <div class="features-header">
            <div class="features-header-badge">PRIVACY POLICY</div>
            <h2>Your Privacy Matters</h2>
            <p class="text-neutral">
                At Uvinvite ("uvinvite.com"), we respect your privacy and are committed to protecting your personal data.
            </p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">1. Important Information</h3>
                <p class="feature-description">
                    Uvinvite is a wedding invitation creation platform owned and operated by Utsav Patel. 
                    We are committed to ensuring that your privacy is protected. Should we ask you to provide certain 
                    information by which you can be identified when using this website, then you can be assured that 
                    it will only be used in accordance with this privacy statement.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">2. Data Collection</h3>
                <p class="feature-description">
                    We may collect, use, store and transfer different kinds of personal data about you which we have 
                    grouped together as follows: Identity Data, Contact Data, Financial Data, and Transaction Data.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                    </svg>
                </div>
                <h3 class="feature-title">3. Data Usage</h3>
                <p class="feature-description">
                    We will only use your personal data when the law allows us to. Most commonly, we will use your 
                    personal data to perform contracts, comply with legal obligations, and for our legitimate interests.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">4. Cookies Policy</h3>
                <p class="feature-description">
                    Our website uses cookies to distinguish you from other users. We use essential cookies for website 
                    functionality and performance cookies to analyze visitor usage. You can disable non-essential cookies.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">5. Data Security</h3>
                <p class="feature-description">
                    We have put in place appropriate security measures to prevent your personal data from being 
                    accidentally lost, used or accessed in an unauthorized way, altered or disclosed.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">6. Data Retention</h3>
                <p class="feature-description">
                    We will only retain your personal data for as long as necessary to fulfill the purposes we collected 
                    it for, including for legal, accounting, or reporting requirements.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Legal Rights Section -->
<div class="testimonials-section">
    <div class="testimonials-container">
        <div class="testimonials-header">
            <div class="features-header-badge">YOUR RIGHTS</div>
            <h2>Your Legal Rights</h2>
        </div>

        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Access Your Data</h3>
                <p class="feature-description">
                    Request access to your personal data that we hold.
                </p>
            </div>
            
            <div class="testimonial-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Correct Your Data</h3>
                <p class="feature-description">
                    Request correction of your personal data if it's inaccurate.
                </p>
            </div>
            
            <div class="testimonial-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Delete Your Data</h3>
                <p class="feature-description">
                    Request erasure of your personal data in certain circumstances.
                </p>
            </div>
            
            <div class="testimonial-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Object to Processing</h3>
                <p class="feature-description">
                    Object to processing of your personal data in certain circumstances.
                </p>
            </div>
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('contact') }}" class="btn btn-primary">
                Contact Us for More Information
            </a>
        </div>
    </div>
</div>
@endsection