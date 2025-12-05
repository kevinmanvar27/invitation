@extends('layouts.home')

@section('content')
<!-- Hero Section -->
<div class="hero">
    <div class="hero-circle-1 hero-decoration"></div>
    <div class="hero-circle-2 hero-decoration"></div>
    <div class="hero-circle-3 hero-decoration"></div>
    
    <div class="hero-container">
        <div class="hero-badge">
            <span>📜</span> Policy
        </div>
        
        <h1 class="hero-title">
            Return & Refund
            <span class="hero-title-highlight">Policy</span>
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
                <div class="stat-number">24/7</div>
                <div class="stat-label">Support</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">100%</div>
                <div class="stat-label">Satisfaction</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">48h</div>
                <div class="stat-label">Response Time</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">30d</div>
                <div class="stat-label">Return Window</div>
            </div>
        </div>
    </div>
</div>

<!-- Content Section -->
<div class="features-section">
    <div class="features-container">
        <div class="features-header">
            <div class="features-header-badge">POLICY DETAILS</div>
            <h2>Our Commitment to You</h2>
            <p class="text-neutral">
                Your satisfaction is our priority. Here's how we handle returns and refunds.
            </p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                </div>
                <h3 class="feature-title">Digital Products</h3>
                <p class="feature-description">
                    Our digital wedding invitations are delivered electronically and are therefore non-refundable once 
                    the download process has begun or the invitation has been shared. Since digital products are 
                    non-tangible, they cannot be returned or exchanged.
                </p>
                <div class="mt-4 p-4 bg-red-50 rounded-lg border-l-4 border-red-500">
                    <p class="text-sm text-neutral-700">
                        Please review your digital invitation carefully before sharing or downloading. We recommend 
                        previewing your invitation thoroughly before finalizing your order.
                    </p>
                </div>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Print Services</h3>
                <p class="feature-description">
                    For printed invitations and related products, we offer the following return and refund policy:
                </p>
                <ul class="mt-4 space-y-2 text-sm text-neutral">
                    <li class="flex items-start">
                        <span class="text-primary mr-2">✓</span>
                        <span>Quality issues: Contact us within 7 days with photos</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-primary mr-2">✓</span>
                        <span>Order errors: Contact us immediately</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-primary mr-2">✗</span>
                        <span>Change of mind: Not eligible for refund</span>
                    </li>
                </ul>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Subscription Services</h3>
                <p class="feature-description">
                    For our subscription services:
                </p>
                <ul class="mt-4 space-y-2 text-sm text-neutral">
                    <li class="flex items-start">
                        <span class="text-primary mr-2">•</span>
                        <span>You may cancel anytime through account settings</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-primary mr-2">•</span>
                        <span>Retain access until end of billing period</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-primary mr-2">•</span>
                        <span>No refunds for unused subscription periods</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- How to Request Section -->
<div class="testimonials-section">
    <div class="testimonials-container">
        <div class="testimonials-header">
            <div class="features-header-badge">HOW TO REQUEST</div>
            <h2>Requesting a Refund</h2>
            <p class="text-neutral">
                Follow these simple steps to request a refund
            </p>
        </div>

        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-primary-100 text-primary-600 mb-4">
                    <span class="font-bold">1</span>
                </div>
                <h3 class="feature-title">Contact Us</h3>
                <p class="feature-description">
                    Email us at <a href="mailto:info@uvinvite.com" class="text-primary hover:underline">info@uvinvite.com</a> with subject "Refund Request"
                </p>
            </div>
            
            <div class="testimonial-card">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-primary-100 text-primary-600 mb-4">
                    <span class="font-bold">2</span>
                </div>
                <h3 class="feature-title">Provide Details</h3>
                <p class="feature-description">
                    Include order number, purchase date, and reason for refund
                </p>
            </div>
            
            <div class="testimonial-card">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-primary-100 text-primary-600 mb-4">
                    <span class="font-bold">3</span>
                </div>
                <h3 class="feature-title">Review Process</h3>
                <p class="feature-description">
                    We'll respond within 3-5 business days with next steps
                </p>
            </div>
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('contact') }}" class="btn btn-primary inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
                Contact Support
            </a>
        </div>
    </div>
</div>
@endsection