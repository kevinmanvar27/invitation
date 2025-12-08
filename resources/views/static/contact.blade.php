@extends('layouts.home')

@section('content')
<!-- Hero Section -->
<div class="hero">
    <div class="hero-circle-1 hero-decoration"></div>
    <div class="hero-circle-2 hero-decoration"></div>
    <div class="hero-circle-3 hero-decoration"></div>
    
    <div class="hero-container">
        <div class="hero-badge">
            <span>✉️</span> Get in Touch
        </div>
        
        <h1 class="hero-title">
            Contact
            <span class="hero-title-highlight">Us</span>
        </h1>
        
        <p class="hero-subtitle">
            We'd love to hear from you. Get in touch with our team.
        </p>
    </div>
</div>

<!-- Our Location Map Section -->
<div class="contact-section">
    <div class="contact-container">
       <div class="stats-grid">
            <!-- Phone Card-->
            <a href="tel:+917878959565" class="stat-card">
                <div class="feature-icon">
                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </div>
                <div class="stat-label">+91 7878 959565</div>
            </a>
            
            <!-- Email card -->
            <a href="mailto:info@uvinvite.com" class="stat-card">
                <div class="feature-icon">
                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div class="stat-label">info@uvinvite.com</div>
            </a>

            <!-- Address card -->
            <a href="https://goo.gl/maps/6x7yFy8L9vJwGqFw8" class="stat-card">
                <div class="feature-icon">
                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <div class="stat-label">Shivalay Complex, Mavdi chowk, <br/>150ft Ring Road, Rajkot</div>
            </a>

        </div>

        <div class="features-grid mt-10">
            <div class="feature-card">
                <!-- Add Map here -->
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14782.50030100999!2d70.7799935!3d22.2997135!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959ca248c77c05f%3A0xdf73e92170be022f!2sMavdi%20Chowk%2C%20Rajkot%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1654321567890!5m2!1sen!2sin" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            <!-- Contact us form Section -->
            <div class="feature-card">
                <div class="feature-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                </div>
                <h3 class="feature-title">Send us a Message</h3>
                <form class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-neutral-800 mb-0 mt-4">Name</label>
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-neutral-800 mb-0 mt-4">Email</label>
                        <input type="email" id="email" name="email" class="form-control">
                    </div>
                    
                    <div>
                        <label for="subject" class="block text-sm font-medium text-neutral-800 mb-0 mt-4">Subject</label>
                        <input type="text" id="subject" name="subject" class="form-control">
                    </div>
                    
                    <div>
                        <label for="message" class="block text-sm font-medium text-neutral-800 mb-0 mt-4">Message</label>
                        <textarea id="message" name="message" rows="6" class="form-control"></textarea>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary btn-lg">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>

    
    
    </div>


</div>
@endsection