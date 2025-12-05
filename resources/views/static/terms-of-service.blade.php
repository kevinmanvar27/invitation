@extends('layouts.home')

@section('content')
<!-- Hero Section -->
<div class="hero">
    <div class="hero-circle-1 hero-decoration"></div>
    <div class="hero-circle-2 hero-decoration"></div>
    <div class="hero-circle-3 hero-decoration"></div>
    
    <div class="hero-container">
        <div class="hero-badge">
            <span>📜</span> Terms of Service
        </div>
        
        <h1 class="hero-title">
            Terms &
            <span class="hero-title-highlight">Conditions</span>
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
                <div class="stat-label">Compliance</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">9</div>
                <div class="stat-label">Key Sections</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Support</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">30</div>
                <div class="stat-label">Day Guarantee</div>
            </div>
        </div>
    </div>
</div>

<!-- Content Section -->
<div class="features-section">
    <div class="features-container">
        <div class="features-header">
            <div class="features-header-badge">TERMS OF SERVICE</div>
            <h2>Welcome to Uvinvite</h2>
            <p class="text-neutral">
                These terms and conditions outline the rules and regulations for the use of Uvinvite's Website.
            </p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">1. Intellectual Property</h3>
                <p class="feature-description">
                    Unless otherwise stated, Uvinvite and/or its licensors own the intellectual property rights for 
                    all material on Uvinvite. All intellectual property rights are reserved.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                    </svg>
                </div>
                <h3 class="feature-title">2. User Responsibilities</h3>
                <p class="feature-description">
                    As a user of Uvinvite, you agree to provide accurate information, maintain account security, 
                    authorize all activities under your account, and comply with legal requirements.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                    </svg>
                </div>
                <h3 class="feature-title">3. Content Ownership</h3>
                <p class="feature-description">
                    You retain all rights to any content you submit, post or display on or through Uvinvite. By 
                    submitting content, you grant us a worldwide, non-exclusive, royalty-free license to use it.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">4. Payments & Subscriptions</h3>
                <p class="feature-description">
                    Some features require payment of fees. You agree to pay all fees as they become due. All fees 
                    are exclusive of taxes, and we offer a 30-day money-back guarantee.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                    </svg>
                </div>
                <h3 class="feature-title">5. Termination</h3>
                <p class="feature-description">
                    We may terminate or suspend your account immediately, without prior notice or liability, for any 
                    reason whatsoever, including without limitation if you breach the Terms.
                </p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">6. Limitation of Liability</h3>
                <p class="feature-description">
                    In no event shall Uvinvite be liable for any indirect, incidental, special, consequential or 
                    punitive damages, including without limitation, loss of profits, data, or other intangible losses.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Additional Terms Section -->
<div class="testimonials-section">
    <div class="testimonials-container">
        <div class="testimonials-header">
            <div class="features-header-badge">ADDITIONAL TERMS</div>
            <h2>Additional Information</h2>
        </div>

        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">7. Changes to Terms</h3>
                <p class="feature-description">
                    We reserve the right to modify or replace these Terms at any time. If a revision is material, 
                    we will provide at least 30 days' notice prior to any new terms taking effect.
                </p>
            </div>
            
            <div class="testimonial-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">8. Governing Law</h3>
                <p class="feature-description">
                    These Terms shall be governed and construed in accordance with the laws of India, without regard 
                    to its conflict of law provisions.
                </p>
            </div>
            
            <div class="testimonial-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">9. Contact Information</h3>
                <p class="feature-description">
                    If you have any questions about these Terms, please contact us at info@uvinvite.com or 
                    Mavdi chowk, Rajkot, Gujarat, India.
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