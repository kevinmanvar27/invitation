@extends('layouts.home')

@section('content')
<!-- Hero Section -->
<div class="hero">
    <div class="hero-circle-1 hero-decoration"></div>
    <div class="hero-circle-2 hero-decoration"></div>
    <div class="hero-circle-3 hero-decoration"></div>
    
    <div class="hero-container">
        <div class="hero-badge">
            <span>✨</span> Our Services
        </div>
        
        <h1 class="hero-title">
            Wedding Invitation
            <span class="hero-title-highlight">Services</span>
        </h1>
        
        <p class="hero-subtitle">
            Professional wedding invitation solutions tailored to your special day
        </p>
    </div>
</div>

<!-- Features Section -->
<div class="features-section">
    <div class="features-container">
        <div class="features-header">
            <div class="features-header-badge">SERVICES</div>
            <h2>Our Comprehensive Services</h2>
            <p class="text-neutral">
                Everything you need to create the perfect wedding invitations and manage your special day
            </p>
        </div>

        <div class="features-grid">
            <!-- Service 1 -->
            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Digital Invitations</h3>
                <p class="feature-description">
                    Beautiful digital wedding invitations that can be easily shared via email, social media, or messaging apps.
                </p>
            </div>

            <!-- Service 2 -->
            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">RSVP Management</h3>
                <p class="feature-description">
                    Track guest responses, manage guest lists, and send automated reminders to ensure you get accurate headcounts.
                </p>
            </div>

            <!-- Service 3 -->
            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Print Services</h3>
                <p class="feature-description">
                    Professional printing services for those who want physical invitations with the same beautiful designs.
                </p>
            </div>

            <!-- Service 4 -->
            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Custom Designs</h3>
                <p class="feature-description">
                    Work with our designers to create a completely custom invitation that matches your wedding theme perfectly.
                </p>
            </div>

            <!-- Service 5 -->
            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Wedding Websites</h3>
                <p class="feature-description">
                    Create a beautiful wedding website to share your story, photos, registry information, and more with your guests.
                </p>
            </div>

            <!-- Service 6 -->
            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Event Coordination</h3>
                <p class="feature-description">
                    Full-service event coordination to help plan and execute your perfect wedding day from start to finish.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Why Choose Us Section -->
<div class="testimonials-section">
    <div class="testimonials-container">
        <div class="testimonials-header">
            <div class="features-header-badge">WHY CHOOSE US</div>
            <h2>Why Choose Our Services?</h2>
        </div>

        <div class="testimonials-grid">
            <!-- Reason 1 -->
            <div class="testimonial-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Easy to Use</h3>
                <p class="feature-description">
                    Our intuitive platform makes creating beautiful invitations simple, even for non-designers.
                </p>
            </div>

            <!-- Reason 2 -->
            <div class="testimonial-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Fully Customizable</h3>
                <p class="feature-description">
                    Personalize every aspect of your invitation to match your unique style and wedding theme.
                </p>
            </div>

            <!-- Reason 3 -->
            <div class="testimonial-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">24/7 Support</h3>
                <p class="feature-description">
                    Our dedicated support team is always ready to help you with any questions or issues.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection