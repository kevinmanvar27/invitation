@extends('layouts.app')

@section('content')
<div class="relative overflow-hidden bg-gradient-to-br from-purple-600 to-indigo-700">
    <div class="absolute inset-0 bg-black opacity-10"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight text-white">
                <span class="block">Create Stunning Wedding</span>
                <span class="block mt-2 text-indigo-200">Invitations in Minutes</span>
            </h1>
            <p class="mt-6 max-w-lg mx-auto text-xl text-indigo-100 md:max-w-3xl">
                Design, customize, and share beautiful wedding invitations with our easy-to-use platform.
            </p>
            <div class="mt-10 flex justify-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-indigo-700 bg-white hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-indigo-700 bg-white hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Create Account
                    </a>
                    <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-3 border border-white text-base font-medium rounded-md text-white bg-transparent hover:bg-white hover:bg-opacity-10 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Sign In
                    </a>
                @endauth
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white to-transparent"></div>
</div>

<!-- Enhanced Redesigned Stats Section -->
<div class="bg-gradient-to-br from-gray-50 to-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <!-- Stat 1 -->
            <div class="text-center group">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-white shadow-lg mb-6 transition-all duration-500 group-hover:shadow-xl group-hover:-translate-y-2 mx-auto border border-gray-100 stat-circle">
                    <div class="flex items-center">
                        <span class="text-3xl stat-number">500</span>
                        <span class="text-xl stat-number">+</span>
                    </div>
                </div>
                <h3 class="text-xl font-medium text-text-light tracking-tight">Beautiful Templates</h3>
            </div>
            
            <!-- Stat 2 -->
            <div class="text-center group">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-white shadow-lg mb-6 transition-all duration-500 group-hover:shadow-xl group-hover:-translate-y-2 mx-auto border border-gray-100 stat-circle">
                    <div class="flex items-center">
                        <span class="text-3xl stat-number">10K</span>
                        <span class="text-xl stat-number">+</span>
                    </div>
                </div>
                <h3 class="text-xl font-medium text-text-light tracking-tight">Happy Couples</h3>
            </div>
            
            <!-- Stat 3 -->
            <div class="text-center group">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-white shadow-lg mb-6 transition-all duration-500 group-hover:shadow-xl group-hover:-translate-y-2 mx-auto border border-gray-100 stat-circle">
                    <div class="flex items-center">
                        <span class="text-3xl stat-number">100</span>
                        <span class="text-xl stat-number">%</span>
                    </div>
                </div>
                <h3 class="text-xl font-medium text-text-light tracking-tight">Satisfaction Rate</h3>
            </div>
            
            <!-- Stat 4 -->
            <div class="text-center group">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-white shadow-lg mb-6 transition-all duration-500 group-hover:shadow-xl group-hover:-translate-y-2 mx-auto border border-gray-100 stat-circle">
                    <div class="text-3xl stat-number">24/7</div>
                </div>
                <h3 class="text-xl font-medium text-text-light tracking-tight">Support Available</h3>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:text-center">
            <h2 class="text-base font-semibold text-indigo-600 tracking-wide uppercase">Features</h2>
            <p class="mt-2 text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Everything you need for your wedding invitations
            </p>
            <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                Our platform provides all the tools to create stunning wedding invitations that your guests will love.
            </p>
        </div>

        <div class="mt-16">
            <div class="grid gap-16 lg:grid-cols-3 lg:gap-x-12 lg:gap-y-16">
                <!-- Feature 1 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
                    <div class="p-8">
                        <div class="flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 text-indigo-600 mb-6">
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
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
                    <div class="p-8">
                        <div class="flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 text-indigo-600 mb-6">
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
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
                    <div class="p-8">
                        <div class="flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 text-indigo-600 mb-6">
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
    </div>
</div>

<!-- CTA Section -->
<div class="bg-gradient-to-r from-indigo-600 to-purple-700 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
            <span class="block">Ready to create your perfect wedding invitations?</span>
        </h2>
        <p class="mt-4 max-w-3xl mx-auto text-xl text-indigo-100">
            Join thousands of happy couples who have created beautiful invitations with our platform.
        </p>
        <div class="mt-10 flex justify-center gap-4">
            @auth
                <a href="{{ route('templates.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-indigo-700 bg-white hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Browse Templates
                </a>
            @else
                <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-indigo-700 bg-white hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Get Started Free
                </a>
            @endauth
        </div>
    </div>
</div>
@endsection