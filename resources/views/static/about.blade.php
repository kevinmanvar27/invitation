@extends('layouts.home')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center mb-16 animate-fade-in">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 animate-slide-down">About Uvinvite</h1>
        <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-500 mx-auto rounded-full animate-scale-in"></div>
        <p class="mt-6 text-xl text-gray-600 max-w-3xl mx-auto animate-slide-up delay-150">
            Creating beautiful digital wedding invitations that capture your unique love story
        </p>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-20 animate-fade-in delay-300">
        <div class="order-2 lg:order-1">
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100 transform transition-all duration-500 hover:shadow-2xl hover:-translate-y-1">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Story</h2>
                <p class="text-gray-600 mb-5 text-lg leading-relaxed">
                    Welcome to Uvinvite, your premier destination for creating beautiful digital wedding invitations. 
                    Founded by Utsav Patel, our platform was born out of a desire to make wedding planning more accessible, 
                    affordable, and enjoyable for couples around the world.
                </p>
                <p class="text-gray-600 mb-5 text-lg leading-relaxed">
                    We understand that your wedding day is one of the most important days of your life, and your 
                    invitation sets the tone for this special celebration. That's why we've created a platform that 
                    combines elegant design with user-friendly technology to help you create invitations that truly 
                    reflect your unique love story.
                </p>
                <p class="text-gray-600 text-lg leading-relaxed">
                    Our team of talented designers and developers work tirelessly to provide you with the latest 
                    templates, features, and tools to make your wedding planning experience seamless from start to finish.
                </p>
            </div>
        </div>
        <div class="order-1 lg:order-2 flex justify-center">
            <div class="relative">
                <div class="bg-gradient-to-br from-blue-100 to-purple-100 rounded-2xl w-80 h-80 flex items-center justify-center shadow-lg transform rotate-3 hover:rotate-6 transition-transform duration-500">
                    <div class="bg-gradient-to-br from-pink-100 to-blue-100 rounded-xl w-64 h-64 flex items-center justify-center shadow-inner">
                        <span class="text-7xl animate-pulse">💌</span>
                    </div>
                </div>
                <div class="absolute -bottom-4 -right-4 bg-white rounded-full p-4 shadow-lg border border-gray-100 animate-bounce">
                    <svg class="w-10 h-10 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-gradient-to-r from-blue-50 via-purple-50 to-pink-50 rounded-3xl p-10 mb-20 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-blue-200 rounded-full -mt-32 -mr-32 opacity-20 animate-pulse-slow"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-purple-200 rounded-full -mb-32 -ml-32 opacity-20 animate-pulse-slow delay-1000"></div>
        <div class="relative z-10 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Mission</h2>
            <p class="text-gray-700 text-center text-xl max-w-4xl mx-auto leading-relaxed">
                Our mission is to empower couples to create stunning digital wedding invitations that capture their 
                unique style and love story. We believe that technology should enhance the joy of wedding planning, 
                not complicate it. Through innovative design and intuitive tools, we're making it easier than ever 
                for couples to share their special day with friends and family.
            </p>
        </div>
    </div>
    
    <div class="text-center mb-16">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">Why Choose Uvinvite?</h2>
        <p class="text-gray-600 text-xl max-w-3xl mx-auto mb-12">
            We provide everything you need to create the perfect wedding invitation
        </p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 group">
            <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-purple-100 rounded-2xl flex items-center justify-center mb-6 mx-auto group-hover:rotate-12 transition-transform duration-300">
                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">Beautiful Designs</h3>
            <p class="text-gray-600 text-center">
                Hundreds of professionally designed templates to match any wedding style, from traditional to modern.
            </p>
        </div>
        
        <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 group">
            <div class="w-20 h-20 bg-gradient-to-br from-pink-100 to-blue-100 rounded-2xl flex items-center justify-center mb-6 mx-auto group-hover:rotate-12 transition-transform duration-300">
                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">Easy Customization</h3>
            <p class="text-gray-600 text-center">
                Intuitive drag-and-drop editor that makes personalizing your invitation a breeze with no design skills needed.
            </p>
        </div>
        
        <div class="bg-white rounded-2xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 group">
            <div class="w-20 h-20 bg-gradient-to-br from-purple-100 to-pink-100 rounded-2xl flex items-center justify-center mb-6 mx-auto group-hover:rotate-12 transition-transform duration-300">
                <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">Share & Print</h3>
            <p class="text-gray-600 text-center">
                Share digitally via email or social media, or order premium printed invitations delivered to your door.
            </p>
        </div>
    </div>
    
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl p-12 text-center text-white animate-fade-in">
        <h2 class="text-3xl font-bold mb-6">Ready to Create Your Perfect Wedding Invitation?</h2>
        <p class="text-xl mb-8 max-w-2xl mx-auto">
            Join thousands of happy couples who have created beautiful invitations with our platform.
        </p>
        <a href="{{ route('templates.index') }}" class="inline-block bg-white text-blue-600 font-bold py-4 px-8 rounded-full shadow-lg hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 animate-bounce-slow">
            Browse Templates
        </a>
    </div>
</div>
@endsection