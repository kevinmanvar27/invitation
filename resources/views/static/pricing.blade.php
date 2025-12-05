@extends('layouts.home')

@section('content')
<!-- Hero Section -->
<div class="hero">
    <div class="hero-circle-1 hero-decoration"></div>
    <div class="hero-circle-2 hero-decoration"></div>
    <div class="hero-circle-3 hero-decoration"></div>
    
    <div class="hero-container">
        <div class="hero-badge">
            <span>✨</span> Pricing Plans
        </div>
        
        <h1 class="hero-title">
            Simple & Transparent
            <span class="hero-title-highlight">Pricing</span>
        </h1>
        
        <p class="hero-subtitle">
            Choose the perfect plan for your wedding invitation needs
        </p>
    </div>
</div>

<!-- Stats Section -->
<div class="stats-section">
    <div class="stats-container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">₹0</div>
                <div class="stat-label">Starting Price</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">100%</div>
                <div class="stat-label">Satisfaction</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Support</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number">3</div>
                <div class="stat-label">Plan Options</div>
            </div>
        </div>
    </div>
</div>

<!-- Pricing Section -->
<div class="features-section">
    <div class="features-container">
        <div class="features-header">
            <div class="features-header-badge">PRICING</div>
            <h2>Choose Your Perfect Plan</h2>
            <p class="text-neutral">
                Select the plan that best fits your wedding invitation needs and budget
            </p>
        </div>

        <div class="features-grid">
            <!-- Basic Plan -->
            <div class="feature-card">
                <div class="text-center mb-6">
                    <h3 class="feature-title">Basic</h3>
                    <div class="mt-4">
                        <span class="text-4xl font-extrabold text-neutral-900">₹0</span>
                        <span class="text-neutral-600">/ forever</span>
                    </div>
                    <p class="mt-2 text-neutral-600">Perfect for couples on a budget</p>
                </div>
                
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-neutral-700">5 Digital Invitations</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-neutral-700">Basic Templates</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-neutral-700">RSVP Management</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-neutral-700">Email Support</span>
                    </li>
                </ul>
                
                <div class="mt-auto">
                    <a href="{{ route('register') }}" class="btn btn-outline w-full">
                        Get Started
                    </a>
                </div>
            </div>

            <!-- Premium Plan -->
            <div class="feature-card relative border-2 border-primary-500">
                <div class="absolute -top-3 left-1/2 transform -translate-x-1/2 bg-primary-500 text-white px-4 py-1 rounded-full text-sm font-medium">
                    Most Popular
                </div>
                <div class="text-center mb-6 pt-4">
                    <h3 class="feature-title">Premium</h3>
                    <div class="mt-4">
                        <span class="text-4xl font-extrabold text-neutral-900">₹999</span>
                        <span class="text-neutral-600">/ one-time</span>
                    </div>
                    <p class="mt-2 text-neutral-600">Perfect for most weddings</p>
                </div>
                
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-neutral-700">Unlimited Digital Invitations</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-neutral-700">All Premium Templates</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-neutral-700">Advanced RSVP Features</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-neutral-700">Custom Branding</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-neutral-700">Priority Support</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-neutral-700">Guest List Management</span>
                    </li>
                </ul>
                
                <div class="mt-auto">
                    <a href="{{ route('register') }}" class="btn btn-primary w-full">
                        Get Started
                    </a>
                </div>
            </div>

            <!-- Enterprise Plan -->
            <div class="feature-card">
                <div class="text-center mb-6">
                    <h3 class="feature-title">Enterprise</h3>
                    <div class="mt-4">
                        <span class="text-4xl font-extrabold text-neutral-900">₹2999</span>
                        <span class="text-neutral-600">/ one-time</span>
                    </div>
                    <p class="mt-2 text-neutral-600">Perfect for large weddings</p>
                </div>
                
                <ul class="space-y-4 mb-8">
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-neutral-700">Everything in Premium</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-neutral-700">Custom Design Services</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-neutral-700">Print Services Included</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-neutral-700">Dedicated Account Manager</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-neutral-700">24/7 Premium Support</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 flex-shrink-0 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="ml-3 text-neutral-700">Event Coordination Services</span>
                    </li>
                </ul>
                
                <div class="mt-auto">
                    <a href="{{ route('contact') }}" class="btn btn-outline w-full">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FAQ Section -->
<div class="testimonials-section">
    <div class="testimonials-container">
        <div class="testimonials-header">
            <div class="features-header-badge">FAQ</div>
            <h2>Frequently Asked Questions</h2>
        </div>

        <div class="testimonials-grid">
            <div class="testimonial-card">
                <h3 class="feature-title">Can I upgrade my plan later?</h3>
                <p class="feature-description">
                    Yes, you can upgrade your plan at any time. You'll only pay the difference between your current plan and the new plan.
                </p>
            </div>
            
            <div class="testimonial-card">
                <h3 class="feature-title">Do you offer refunds?</h3>
                <p class="feature-description">
                    We offer a 30-day money-back guarantee on all our plans. If you're not satisfied, contact us for a full refund.
                </p>
            </div>
            
            <div class="testimonial-card">
                <h3 class="feature-title">Are there any hidden fees?</h3>
                <p class="feature-description">
                    No, our pricing is transparent. The price you see is the price you pay. Taxes may apply depending on your location.
                </p>
            </div>
            
            <div class="testimonial-card">
                <h3 class="feature-title">Can I customize my invitations?</h3>
                <p class="feature-description">
                    Absolutely! All our plans include customization options. Premium and Enterprise plans offer advanced customization features.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection