@extends('layouts.home')

@section('content')
<!-- Enhanced Login Page with Attractive Split Layout -->
<div class="min-h-screen bg-gradient-to-br from-secondary-light via-accent-light to-primary-light flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-secondary-light/30 via-accent-light/20 to-primary-light/30"></div>
    
    <!-- Wedding-themed decorative graphics -->
    <div class="absolute top-10 left-10 w-16 h-16 opacity-20 animate-float">
        <svg viewBox="0 0 100 100" class="w-full h-full text-primary">
            <path fill="currentColor" d="M50,15 C65,30 85,30 85,50 C85,70 65,70 50,85 C35,70 15,70 15,50 C15,30 35,30 50,15 Z"></path>
        </svg>
    </div>
    
    <div class="absolute bottom-10 right-10 w-20 h-20 opacity-20 animate-bounce-soft delay-1000">
        <svg viewBox="0 0 100 100" class="w-full h-full text-secondary">
            <circle cx="50" cy="50" r="40" fill="currentColor" />
            <path fill="#ffffff" d="M30,40 Q50,20 70,40 Q70,60 50,80 Q30,60 30,40 Z"></path>
        </svg>
    </div>
    
    <div class="absolute top-1/4 right-1/4 w-12 h-12 opacity-30 animate-pulse-slow delay-500">
        <svg viewBox="0 0 100 100" class="w-full h-full text-accent">
            <polygon points="50,10 70,40 100,45 80,70 85,100 50,85 15,100 20,70 0,45 30,40" fill="currentColor"></polygon>
        </svg>
    </div>
    
    <div class="absolute bottom-1/3 left-1/3 w-14 h-14 opacity-25 animate-float delay-1500">
        <svg viewBox="0 0 100 100" class="w-full h-full text-primary-dark">
            <path fill="currentColor" d="M20,50 Q40,30 60,50 Q80,70 90,50 L90,70 Q80,90 60,70 Q40,90 20,70 Z"></path>
        </svg>
    </div>
    
    <!-- Floating decorative elements -->
    <div class="absolute top-20 left-10 w-24 h-24 rounded-full bg-blue-200/20 blur-2xl animate-pulse-slow"></div>
    <div class="absolute bottom-20 right-10 w-32 h-32 rounded-full bg-purple-200/20 blur-2xl animate-pulse-slow delay-1000"></div>
    
    <div class="relative max-w-7xl mx-auto w-full">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
            <!-- Left side - Enhanced Branding and Visuals -->
            <div class="lg:w-1/2 text-center lg:text-left animate-fade-in-up">
                <!-- Decorative header with animation -->
                <div class="relative mb-8">
                    <div class="absolute -top-6 -left-6 w-24 h-24 rounded-full bg-secondary/30 blur-xl animate-pulse-slow"></div>
                    <div class="absolute -bottom-6 -right-6 w-16 h-16 rounded-full bg-primary/30 blur-xl animate-bounce-soft delay-500"></div>
                    
                    <div class="relative inline-block">
                        <div class="w-24 h-24 mx-auto bg-gradient-to-br from-secondary to-accent rounded-2xl flex items-center justify-center shadow-xl transform -rotate-3 animate-enhanced-pulse">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-gray-900 mb-6">
                    <span class="block">Welcome back to</span>
                    <span class="block mt-2 bg-clip-text text-transparent bg-gradient-to-r from-secondary to-accent">{{ config('app.name', 'WeddingInvites') }}</span>
                </h1>
                
                <p class="text-xl text-secondary-dark mb-8 max-w-lg mx-auto lg:mx-0">
                    Sign in to manage your wedding invitations, track RSVPs, and customize your special day with ease.
                </p>
                
                <!-- Visual feature highlights with icons -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-5 shadow-lg border border-gray-100 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                        <div class="w-12 h-12 rounded-full bg-secondary-light flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-primary-dark">Manage Invitations</h3>
                        <p class="mt-2 text-secondary-dark text-sm">Easily update and customize your wedding invitations</p>
                    </div>
                    
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-5 shadow-lg border border-gray-100 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                        <div class="w-12 h-12 rounded-full bg-accent-light flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-primary-dark">Track RSVPs</h3>
                        <p class="mt-2 text-secondary-dark text-sm">Monitor guest responses and manage your guest list</p>
                    </div>
                    
                    <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-5 shadow-lg border border-gray-100 transform transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                        <div class="w-12 h-12 rounded-full bg-primary-light flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-primary-dark">Wedding Planning</h3>
                        <p class="mt-2 text-secondary-dark text-sm">Access tools to plan and organize your special day</p>
                    </div>
                </div>
                
                <!-- Wedding-themed decorative SVG -->
                <div class="mb-8 flex justify-center lg:justify-start">
                    <div class="relative w-64 h-32">
                        <svg viewBox="0 0 200 100" class="w-full h-full text-gray-300">
                            <!-- Decorative wedding elements -->
                            <path d="M20,50 Q40,30 60,50 Q80,70 100,50 Q120,30 140,50 Q160,70 180,50" stroke="currentColor" stroke-width="1" fill="none" stroke-dasharray="5,5" class="animate-pulse-slow"></path>
                            
                            <!-- Heart symbols -->
                            <path d="M30,40 C35,35 45,35 50,40 C55,45 55,55 50,60 C45,65 35,65 30,60 C25,55 25,45 30,40 Z" fill="#ec4899" opacity="0.7" class="animate-float"></path>
                            <path d="M80,30 C85,25 95,25 100,30 C105,35 105,45 100,50 C95,55 85,55 80,50 C75,45 75,35 80,30 Z" fill="#3b82f6" opacity="0.7" class="animate-float delay-1000"></path>
                            <path d="M130,45 C135,40 145,40 150,45 C155,50 155,60 150,65 C145,70 135,70 130,65 C125,60 125,50 130,45 Z" fill="#8b5cf6" opacity="0.7" class="animate-float delay-750"></path>
                            
                            <!-- Ring symbol -->
                            <circle cx="170" cy="50" r="8" stroke="#f472b6" stroke-width="2" fill="none" class="animate-spin" style="transform-origin: center;"></circle>
                        </svg>
                    </div>
                </div>
                
                <!-- Testimonial with enhanced styling -->
                <div class="bg-gradient-to-r from-secondary-light to-accent-light rounded-2xl p-6 shadow-lg border border-secondary-light max-w-lg mx-auto lg:mx-0">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-secondary to-accent flex items-center justify-center shadow-md">
                                <span class="text-white font-bold text-lg">MJ</span>
                            </div>
                        </div>
                        <div class="ml-4">
                            <div class="flex items-center mb-1">
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            </div>
                            <h4 class="text-lg font-semibold text-primary-dark">Michael & Jennifer</h4>
                            <p class="text-secondary-dark italic">"Managing our wedding invitations and RSVPs through this platform made our planning so much easier. Highly recommended!"</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right side - Login Form -->
            <div class="lg:w-1/2 w-full max-w-md animate-slide-up">
                <div class="bg-white/90 backdrop-blur-lg rounded-3xl shadow-2xl p-8 border border-secondary-light/50 transform transition-all duration-500 hover:shadow-2xl animate-pop-in">
                    <!-- Logo and Title -->
                    <div class="text-center mb-8">
                        <div class="mx-auto w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center mb-4 shadow-md transform transition-transform duration-300 hover:rotate-12">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-primary-dark">Welcome back</h2>
                        <p class="mt-2 text-secondary-dark">
                            Sign in to your {{ config('app.name', 'WeddingInvites') }} account
                        </p>
                    </div>
                    
                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="rounded-xl bg-error-light/80 backdrop-blur-sm p-4 mb-6 animate-shake border border-error">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-error" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-error-dark">
                                        {{ __('Whoops! Something went wrong.') }}
                                    </h3>
                                    <div class="mt-2 text-sm text-error-dark">
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Login Form -->
                    <form class="space-y-6" method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="space-y-4">
                            <!-- Email Field -->
                            <div class="relative group animate-fade-in-up delay-150">
                                <label for="email" class="block text-sm font-medium text-secondary-dark mb-1 transition-all duration-300">
                                    Email address
                                </label>
                                <div class="mt-1 relative rounded-xl shadow-sm transition-all duration-300 group-hover:shadow-md">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                    </div>
                                    <input 
                                        id="email" 
                                        name="email" 
                                        type="email" 
                                        autocomplete="email" 
                                        required 
                                        class="py-4 px-4 pl-12 block w-full rounded-xl border border-secondary shadow-sm focus:ring-4 focus:ring-accent/20 focus:border-accent transition-all duration-300 hover:border-accent @error('email') border-error @enderror"
                                        value="{{ old('email') }}"
                                        placeholder="you@example.com">
                                </div>
                            </div>
                            
                            <!-- Password Field -->
                            <div class="relative group animate-fade-in-up delay-300">
                                <label for="password" class="block text-sm font-medium text-secondary-dark mb-1 transition-all duration-300">
                                    Password
                                </label>
                                <div class="mt-1 relative rounded-xl shadow-sm transition-all duration-300 group-hover:shadow-md">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input 
                                        id="password" 
                                        name="password" 
                                        type="password" 
                                        autocomplete="current-password" 
                                        required 
                                        class="py-4 px-4 pl-12 block w-full rounded-xl border border-secondary shadow-sm focus:ring-4 focus:ring-accent/20 focus:border-accent transition-all duration-300 hover:border-accent @error('password') border-error @enderror"
                                        placeholder="••••••••">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between animate-fade-in-up delay-500">
                            <div class="flex items-center">
                                <input 
                                    id="remember" 
                                    name="remember" 
                                    type="checkbox" 
                                    class="h-5 w-5 text-accent focus:ring-accent border-secondary rounded transition-all duration-300" 
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember" class="ml-3 block text-sm text-secondary-dark">
                                    Remember me
                                </label>
                            </div>
                            
                            <div class="text-sm">
                                <a href="#" class="font-medium text-accent hover:text-accent-dark transition-colors duration-300 hover:underline">
                                    Forgot your password?
                                </a>
                            </div>
                        </div>
                        
                        <!-- Sign In Button -->
                        <div class="pt-4 animate-fade-in-up delay-750">
                            <button 
                                type="submit" 
                                class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-lg text-base font-semibold text-white bg-gradient-to-r from-secondary to-accent hover:from-secondary-dark hover:to-accent-dark focus:outline-none focus:ring-4 focus:ring-secondary/30 transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-xl">
                                Sign in
                            </button>
                        </div>
                    </form>
                    
                   
                    
                    <!-- Sign Up Link -->
                    <div class="mt-6 text-center animate-fade-in-up delay-1000">
                        <p class="text-secondary-dark">
                            Don't have an account? 
                            <a href="{{ route('register') }}" class="font-semibold text-accent hover:text-accent-dark transition-colors duration-300 underline decoration-dotted">
                                Create one now
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection