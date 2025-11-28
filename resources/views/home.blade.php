@extends('layouts.home')

@section('content')
<!-- Hero Section with Enhanced Visuals -->
<div class="relative overflow-hidden bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-blue-100/30 via-purple-100/20 to-pink-100/30"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-36">
        <div class="text-center animate-fade-in">
            <div class="mb-6 flex justify-center">
                <div class="inline-flex items-center px-4 py-2 bg-white/80 backdrop-blur-sm rounded-full text-sm font-medium text-blue-600 border border-blue-100 shadow-sm">
                    <span class="mr-2">✨</span> New: Wedding Planning Toolkit
                </div>
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight text-gray-900 animate-slide-up">
                <span class="block">Create Stunning Wedding</span>
                <span class="block mt-2 bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600">Invitations in Minutes</span>
            </h1>
            <p class="mt-6 max-w-lg mx-auto text-xl text-gray-600 md:max-w-3xl animate-slide-up delay-150">
                Design, customize, and share beautiful wedding invitations with our easy-to-use platform. Perfect for every style and budget.
            </p>
            <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4 animate-slide-up delay-300">
                @auth
                    <a href="{{ route('templates.index') }}" class="btn btn-primary hover-scale animate-pop-in px-8 py-4 text-lg font-semibold shadow-lg">
                        Get Started
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-primary hover-scale animate-pop-in px-8 py-4 text-lg font-semibold shadow-lg">
                        Create Account
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline hover-scale animate-pop-in delay-150 px-8 py-4 text-lg font-semibold">
                        Sign In
                    </a>
                @endauth
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-24 bg-gradient-to-t from-white to-transparent"></div>
    
    <!-- Enhanced floating decorative elements -->
    <div class="absolute top-20 left-10 w-24 h-24 rounded-full bg-blue-200/20 blur-2xl animate-pulse-slow"></div>
    <div class="absolute bottom-20 right-10 w-32 h-32 rounded-full bg-purple-200/20 blur-2xl animate-pulse-slow delay-1000"></div>
    <div class="absolute top-1/3 right-20 w-16 h-16 rounded-full bg-pink-200/30 blur-xl animate-pulse-slow delay-500"></div>
    <div class="absolute bottom-1/3 left-20 w-20 h-20 rounded-full bg-indigo-200/30 blur-xl animate-pulse-slow delay-750"></div>
    
    <!-- Decorative rings -->
    <div class="absolute top-1/4 left-1/4 w-64 h-64 rounded-full border border-blue-200/30 animate-pulse-slow"></div>
    <div class="absolute bottom-1/4 right-1/4 w-48 h-48 rounded-full border border-purple-200/30 animate-pulse-slow delay-1500"></div>
</div>

<!-- Enhanced Redesigned Stats Section -->
<div class="bg-gradient-to-br from-gray-50 to-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <!-- Stat 1 -->
            <div class="text-center group staggered-delay">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-white shadow-lg mb-6 stat-circle mx-auto border border-gray-100 hover-lift transform transition-all duration-300">
                    <div class="flex items-center">
                        <span class="text-3xl stat-number font-bold">500</span>
                        <span class="text-xl stat-number font-bold">+</span>
                    </div>
                </div>
                <h3 class="text-xl font-medium text-gray-900 tracking-tight">Beautiful Templates</h3>
            </div>
            
            <!-- Stat 2 -->
            <div class="text-center group staggered-delay">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-white shadow-lg mb-6 stat-circle mx-auto border border-gray-100 hover-lift transform transition-all duration-300">
                    <div class="flex items-center">
                        <span class="text-3xl stat-number font-bold">10K</span>
                        <span class="text-xl stat-number font-bold">+</span>
                    </div>
                </div>
                <h3 class="text-xl font-medium text-gray-900 tracking-tight">Happy Couples</h3>
            </div>
            
            <!-- Stat 3 -->
            <div class="text-center group staggered-delay">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-white shadow-lg mb-6 stat-circle mx-auto border border-gray-100 hover-lift transform transition-all duration-300">
                    <div class="flex items-center">
                        <span class="text-3xl stat-number font-bold">100</span>
                        <span class="text-xl stat-number font-bold">%</span>
                    </div>
                </div>
                <h3 class="text-xl font-medium text-gray-900 tracking-tight">Satisfaction Rate</h3>
            </div>
            
            <!-- Stat 4 -->
            <div class="text-center group staggered-delay">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-white shadow-lg mb-6 stat-circle mx-auto border border-gray-100 hover-lift transform transition-all duration-300">
                    <div class="text-3xl stat-number font-bold">24/7</div>
                </div>
                <h3 class="text-xl font-medium text-gray-900 tracking-tight">Support Available</h3>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-16 bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center mb-16 animate-fade-in">
            <h2 class="text-base font-semibold text-blue-600 tracking-wide uppercase">Features</h2>
            <p class="mt-2 text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Everything you need for your wedding invitations
            </p>
            <p class="mt-4 max-w-2xl text-xl text-gray-600 lg:mx-auto">
                Our platform provides all the tools to create stunning wedding invitations that your guests will love.
            </p>
        </div>

        <div class="mt-16">
            <div class="grid gap-10 lg:grid-cols-3 lg:gap-x-8 lg:gap-y-10">
                <!-- Feature 1 -->
                <div class="card hover-lift-card staggered-delay bg-white rounded-2xl overflow-hidden shadow-xl transform transition-all duration-300 hover:shadow-2xl">
                    <div class="p-8">
                        <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-purple-100 text-blue-600 mb-6 transition-transform hover:rotate-12">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Beautiful Templates</h3>
                        <p class="text-gray-600">
                            Choose from hundreds of professionally designed templates that match your wedding style and personality.
                        </p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="card hover-lift-card staggered-delay bg-white rounded-2xl overflow-hidden shadow-xl transform transition-all duration-300 hover:shadow-2xl">
                    <div class="p-8">
                        <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-purple-100 text-blue-600 mb-6 transition-transform hover:rotate-12">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 001 1v3a1 1 0 011 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Easy Customization</h3>
                        <p class="text-gray-600">
                            Personalize every detail with our intuitive drag-and-drop editor. Add your photos, text, fonts, and colors.
                        </p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="card hover-lift-card staggered-delay bg-white rounded-2xl overflow-hidden shadow-xl transform transition-all duration-300 hover:shadow-2xl">
                    <div class="p-8">
                        <div class="flex items-center justify-center w-16 h-16 rounded-2xl bg-purple-100 text-blue-600 mb-6 transition-transform hover:rotate-12">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Share & Print</h3>
                        <p class="text-gray-600">
                            Send digital invitations via email or social media, or order premium printed versions delivered to your door.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Template Preview Carousel -->
        <div class="mt-16 animate-fade-in delay-300">
            <div class="text-center mb-8">
                <h3 class="text-2xl font-bold text-gray-900">Popular Templates</h3>
                <p class="mt-2 text-gray-600">Get inspired by our most popular wedding invitation designs</p>
            </div>
            
            <div class="relative bg-white rounded-2xl shadow-xl p-6 max-w-4xl mx-auto border border-gray-100">
                <!-- Carousel Item 1 -->
                <div class="flex flex-col md:flex-row items-center gap-8 transition-all duration-300 ease-in-out transform carousel-item" data-carousel-item="0">
                    <div class="md:w-1/2">
                        <div class="bg-gradient-to-br from-pink-100 to-purple-100 border-2 border-dashed rounded-2xl w-full h-64 flex items-center justify-center shadow-md">
                            <span class="text-gray-500 text-lg font-medium">Elegant Floral Design</span>
                        </div>
                    </div>
                    <div class="md:w-1/2">
                        <h4 class="text-xl font-bold text-gray-900 mb-2">Elegant Floral Design</h4>
                        <p class="text-gray-600 mb-4">A beautiful floral theme with elegant typography and customizable color schemes.</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Floral</span>
                            <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Elegant</span>
                            <span class="bg-pink-100 text-pink-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Romantic</span>
                        </div>
                        <a href="{{ route('templates.index') }}" class="btn btn-primary hover-scale px-6 py-2 rounded-lg font-medium">
                            Use This Template
                        </a>
                    </div>
                </div>
                
                <!-- Carousel Item 2 -->
                <div class="flex flex-col md:flex-row items-center gap-8 transition-all duration-300 ease-in-out transform carousel-item opacity-0 absolute top-0 left-0 w-full hidden" data-carousel-item="1">
                    <div class="md:w-1/2">
                        <div class="bg-gradient-to-br from-blue-100 to-teal-100 border-2 border-dashed rounded-2xl w-full h-64 flex items-center justify-center shadow-md">
                            <span class="text-gray-500 text-lg font-medium">Minimalist Modern</span>
                        </div>
                    </div>
                    <div class="md:w-1/2">
                        <h4 class="text-xl font-bold text-gray-900 mb-2">Minimalist Modern</h4>
                        <p class="text-gray-600 mb-4">Clean lines and modern typography for couples who prefer a sleek aesthetic.</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Minimalist</span>
                            <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Modern</span>
                            <span class="bg-teal-100 text-teal-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Clean</span>
                        </div>
                        <a href="{{ route('templates.index') }}" class="btn btn-primary hover-scale px-6 py-2 rounded-lg font-medium">
                            Use This Template
                        </a>
                    </div>
                </div>
                
                <!-- Carousel Item 3 -->
                <div class="flex flex-col md:flex-row items-center gap-8 transition-all duration-300 ease-in-out transform carousel-item opacity-0 absolute top-0 left-0 w-full hidden" data-carousel-item="2">
                    <div class="md:w-1/2">
                        <div class="bg-gradient-to-br from-yellow-100 to-orange-100 border-2 border-dashed rounded-2xl w-full h-64 flex items-center justify-center shadow-md">
                            <span class="text-gray-500 text-lg font-medium">Vintage Romance</span>
                        </div>
                    </div>
                    <div class="md:w-1/2">
                        <h4 class="text-xl font-bold text-gray-900 mb-2">Vintage Romance</h4>
                        <p class="text-gray-600 mb-4">Classic vintage design with ornate details and romantic flourishes.</p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Vintage</span>
                            <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Romantic</span>
                            <span class="bg-orange-100 text-orange-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Classic</span>
                        </div>
                        <a href="{{ route('templates.index') }}" class="btn btn-primary hover-scale px-6 py-2 rounded-lg font-medium">
                            Use This Template
                        </a>
                    </div>
                </div>
                
                <div class="flex justify-center mt-6 space-x-2">
                    <button class="w-3 h-3 rounded-full bg-blue-600 transition-all duration-300" data-carousel-target="0"></button>
                    <button class="w-3 h-3 rounded-full bg-gray-300 hover:bg-gray-400 transition-all duration-300" data-carousel-target="1"></button>
                    <button class="w-3 h-3 rounded-full bg-gray-300 hover:bg-gray-400 transition-all duration-300" data-carousel-target="2"></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testimonials Section -->
<div class="py-16 bg-gradient-to-br from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center mb-16 animate-fade-in">
            <h2 class="text-base font-semibold text-blue-600 tracking-wide uppercase">Testimonials</h2>
            <p class="mt-2 text-3xl font-extrabold text-gray-900 sm:text-4xl">
                What our couples say
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Testimonial 1 -->
            <div class="bg-white rounded-2xl shadow-lg p-6 hover-lift staggered-delay transform transition-all duration-300 hover:shadow-xl">
                <div class="flex items-center mb-4">
                    <div class="flex text-yellow-400">
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
                </div>
                <p class="text-gray-600 italic mb-6">
                    "We absolutely loved our wedding invitations! The process was so easy and the final result exceeded our expectations."
                </p>
                <div class="flex items-center">
                    <div class="ml-4">
                        <div class="text-lg font-bold text-gray-900">Sarah & Michael</div>
                        <div class="text-gray-600">June 2023</div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="bg-white rounded-2xl shadow-lg p-6 hover-lift staggered-delay transform transition-all duration-300 hover:shadow-xl">
                <div class="flex items-center mb-4">
                    <div class="flex text-yellow-400">
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
                </div>
                <p class="text-gray-600 italic mb-6">
                    "The RSVP management feature saved us so much time. We could easily track responses and manage our guest list."
                </p>
                <div class="flex items-center">
                    <div class="ml-4">
                        <div class="text-lg font-bold text-gray-900">Jessica & David</div>
                        <div class="text-gray-600">April 2023</div>
                    </div>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="bg-white rounded-2xl shadow-lg p-6 hover-lift staggered-delay transform transition-all duration-300 hover:shadow-xl">
                <div class="flex items-center mb-4">
                    <div class="flex text-yellow-400">
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
                </div>
                <p class="text-gray-600 italic mb-6">
                    "The print quality was exceptional. Our guests couldn't believe the invitations were printed online."
                </p>
                <div class="flex items-center">
                    <div class="ml-4">
                        <div class="text-lg font-bold text-gray-900">Emma & James</div>
                        <div class="text-gray-600">August 2023</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Section -->
<div class="py-16 bg-gradient-to-br from-white to-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center mb-16 animate-fade-in">
            <h2 class="text-base font-semibold text-blue-600 tracking-wide uppercase">Contact Us</h2>
            <p class="mt-2 text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Have questions? We're here to help
            </p>
            <p class="mt-4 max-w-2xl text-xl text-gray-600 lg:mx-auto">
                Reach out to our team and we'll get back to you as soon as possible.
            </p>
        </div>
        
        <div class="mt-10 max-w-3xl mx-auto">
            <form class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
                <div class="sm:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <div class="mt-1">
                        <input type="text" name="name" id="name" class="py-3 px-4 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-lg transition-all duration-300 hover:border-blue-400">
                    </div>
                </div>
                
                <div class="sm:col-span-2">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" class="py-3 px-4 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-lg transition-all duration-300 hover:border-blue-400">
                    </div>
                </div>
                
                <div class="sm:col-span-2">
                    <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                    <div class="mt-1">
                        <input type="text" name="subject" id="subject" class="py-3 px-4 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-lg transition-all duration-300 hover:border-blue-400">
                    </div>
                </div>
                
                <div class="sm:col-span-2">
                    <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                    <div class="mt-1">
                        <textarea id="message" name="message" rows="4" class="py-3 px-4 block w-full shadow-sm focus:ring-blue-500 focus:border-blue-500 border-gray-300 rounded-lg transition-all duration-300 hover:border-blue-400"></textarea>
                    </div>
                </div>
                
                <div class="sm:col-span-2">
                    <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 hover-scale transition-all duration-300 transform hover:-translate-y-0.5">
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="bg-gradient-to-r from-blue-600 to-purple-600 py-16 rounded-t-3xl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-extrabold text-white sm:text-4xl animate-fade-in">
            <span class="block">Ready to create your perfect wedding invitations?</span>
        </h2>
        <p class="mt-4 max-w-3xl mx-auto text-xl text-blue-100 animate-fade-in delay-150">
            Join thousands of happy couples who have created beautiful invitations with our platform.
        </p>
        <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">
            @auth
                <a href="{{ route('templates.index') }}" class="btn btn-secondary hover-scale animate-pop-in px-8 py-4 text-lg font-semibold rounded-lg shadow-lg transform transition-all duration-300 hover:shadow-xl">
                    Browse Templates
                </a>
            @else
                <a href="{{ route('register') }}" class="btn btn-secondary hover-scale animate-pop-in px-8 py-4 text-lg font-semibold rounded-lg shadow-lg transform transition-all duration-300 hover:shadow-xl">
                    Get Started Free
                </a>
            @endauth
        </div>
    </div>
</div>
@endsection