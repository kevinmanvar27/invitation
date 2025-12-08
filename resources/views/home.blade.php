@extends('layouts.home')

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
                <a href="{{ route('templates.index') }}" class="btn btn-primary btn-lg">
                    Get Started
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
<div class="stats-section pt-12">
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
<div class="features-section mt-12 pt-12">
    <div class="features-container">
        <div class="features-header">
            <div class="features-header-badge">FEATURES</div>
            <h2>Everything you need for your wedding invitations</h2>
            <p class="text-neutral">
                Our platform provides all the tools to create stunning wedding invitations that your guests will love.
            </p>
        </div>

        <div class="features-grid mt-10">
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
        
        <!-- Template Preview Carousel -->
        <div class="carousel-container mt-12 pt-12">
            <div class="text-center mb-12">
                <h3>Popular Templates</h3>
                <p class="text-neutral">Get inspired by our most popular wedding invitation designs</p>
            </div>
            
            <div class="carousel-wrapper">
                <!-- Carousel Item 1 -->
                <div class="carousel-item active" data-carousel-item="0">
                    <div class="carousel-content">
                        <div class="carousel-image">
                            <span class="text-neutral font-medium">Elegant Floral Design</span>
                        </div>
                        <div class="carousel-text">
                            <h4 class="carousel-title">Elegant Floral Design</h4>
                            <p class="carousel-description">A beautiful floral theme with elegant typography and customizable color schemes.</p>
                            <div class="carousel-tags">
                                <span class="carousel-tag">Floral</span>
                                <span class="carousel-tag">Elegant</span>
                                <span class="carousel-tag">Romantic</span>
                            </div>
                            <a href="{{ route('templates.index') }}" class="btn btn-primary">
                                Use This Template
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Carousel Item 2 -->
                <div class="carousel-item" data-carousel-item="1">
                    <div class="carousel-content">
                        <div class="carousel-image">
                            <span class="text-neutral font-medium">Minimalist Modern</span>
                        </div>
                        <div class="carousel-text">
                            <h4 class="carousel-title">Minimalist Modern</h4>
                            <p class="carousel-description">Clean lines and modern typography for couples who prefer a sleek aesthetic.</p>
                            <div class="carousel-tags">
                                <span class="carousel-tag">Minimalist</span>
                                <span class="carousel-tag">Modern</span>
                                <span class="carousel-tag">Clean</span>
                            </div>
                            <a href="{{ route('templates.index') }}" class="btn btn-primary">
                                Use This Template
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Carousel Item 3 -->
                <div class="carousel-item" data-carousel-item="2">
                    <div class="carousel-content">
                        <div class="carousel-image">
                            <span class="text-neutral font-medium">Vintage Romance</span>
                        </div>
                        <div class="carousel-text">
                            <h4 class="carousel-title">Vintage Romance</h4>
                            <p class="carousel-description">Classic vintage design with ornate details and romantic flourishes.</p>
                            <div class="carousel-tags">
                                <span class="carousel-tag">Vintage</span>
                                <span class="carousel-tag">Romantic</span>
                                <span class="carousel-tag">Classic</span>
                            </div>
                            <a href="{{ route('templates.index') }}" class="btn btn-primary">
                                Use This Template
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="carousel-indicators mt-8">
                <button class="carousel-indicator active" data-carousel-target="0"></button>
                <button class="carousel-indicator" data-carousel-target="1"></button>
                <button class="carousel-indicator" data-carousel-target="2"></button>
            </div>
        </div>
    </div>
</div>

<!-- Testimonials Section -->
<div class="testimonials-section mt-12 pt-12">
    <div class="testimonials-container">
        <div class="testimonials-header">
            <div class="features-header-badge">TESTIMONIALS</div>
            <h2>What our couples say</h2>
        </div>

        <div class="testimonials-grid mt-10">
            <!-- Testimonial 1 -->
            <div class="testimonial-card">
                <div class="testimonial-rating">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                </div>
                <p class="testimonial-text">
                    "We absolutely loved our wedding invitations! The process was so easy and the final result exceeded our expectations."
                </p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">SM</div>
                    <div>
                        <div class="testimonial-name">Sarah & Michael</div>
                        <div class="testimonial-date">June 2023</div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="testimonial-card">
                <div class="testimonial-rating">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                </div>
                <p class="testimonial-text">
                    "The RSVP management feature saved us so much time. We could easily track responses and manage our guest list."
                </p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">JD</div>
                    <div>
                        <div class="testimonial-name">Jessica & David</div>
                        <div class="testimonial-date">April 2023</div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="testimonial-card">
                <div class="testimonial-rating">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                </div>
                <p class="testimonial-text">
                    "The print quality was exceptional. Our guests couldn't believe the invitations were printed online."
                </p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">EJ</div>
                    <div>
                        <div class="testimonial-name">Emma & James</div>
                        <div class="testimonial-date">August 2023</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Section -->
<div class="contact-section mt-12 pt-12">
    <div class="contact-container">
        <div class="contact-header">
            <div class="features-header-badge">CONTACT US</div>
            <h2>Have questions? We're here to help</h2>
            <p class="text-neutral">
                Reach out to our team and we'll get back to you as soon as possible.
            </p>
        </div>
        
        <div class="contact-form mt-10">
            <form>
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" name="subject" id="subject" class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="message" class="form-label">Message</label>
                    <textarea name="message" id="message" rows="5" class="form-control"></textarea>
                </div>
                
                <div class="form-actions mt-8">
                    <button type="submit" class="btn btn-primary btn-lg">
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection