<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Cache control meta tags -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <title>{{ config('app.name', 'WeddingInvites') }}</title>

    <!-- Manifest -->
    <link rel="manifest" href="/manifest.json">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link rel="stylesheet" href="@versionedAsset('css/app.css')">
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="@versionedAsset('js/app.js')" defer></script>
</head>
<body class="font-sans antialiased bg-white text-gray-900">
    <!-- Header Section -->
    <header class="bg-white shadow border-b border-gray-200 animate-fade-in sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600 hover:text-blue-800 transition-colors duration-300 transform hover:scale-105">
                        {{ config('app.name', 'WeddingInvites') }}
                    </a>
                </div>
                
                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden">
                    <button id="mobile-menu-button" class="text-gray-900 hover:text-blue-600 focus:outline-none transform transition-transform duration-300 hover:scale-110">
                        <span class="sr-only">Open main menu</span>
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path id="menu-icon" class="block" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path id="close-icon" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Navigation Menu -->
                <nav class="hidden md:flex space-x-8 items-center">
                    <a href="{{ route('home') }}" class="text-gray-900 hover:text-blue-600 font-medium transition-all duration-300 hover:scale-105">Home</a>
                    <a href="{{ route('templates.index') }}" class="text-gray-900 hover:text-blue-600 font-medium transition-all duration-300 hover:scale-105">Templates</a>
                    <a href="#" class="text-gray-900 hover:text-blue-600 font-medium transition-all duration-300 hover:scale-105">Services</a>
                    <a href="#" class="text-gray-900 hover:text-blue-600 font-medium transition-all duration-300 hover:scale-105">Pricing</a>
                    <a href="{{ route('contact') }}" class="text-gray-900 hover:text-blue-600 font-medium transition-all duration-300 hover:scale-105">Contact</a>
                    
                    <!-- Admin Link -->
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-900 hover:text-blue-600 font-medium transition-all duration-300 hover:scale-105">Admin</a>
                        @endif
                    @endauth
                </nav>
                
                <!-- Authentication Links -->
                <div class="hidden md:flex items-center">
                    @auth
                        <div class="ml-3 relative">
                            <div class="flex items-center space-x-4">
                                <span class="text-gray-900">{{ Auth::user()->name }}</span>
                                <a href="{{ route('dashboard') }}" class="text-gray-900 hover:text-blue-600 font-medium transition-all duration-300 hover:scale-105">Dashboard</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-gray-900 hover:text-blue-600 font-medium transition-all duration-300 hover:scale-105">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-900 hover:text-blue-600 font-medium transition-all duration-300 hover:scale-105">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-gray-900 hover:text-blue-600 font-medium transition-all duration-300 hover:scale-105">Register</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden animate-slide-up">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 bg-blue-100 transform transition-all duration-300 hover:scale-105">Home</a>
                <a href="{{ route('templates.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-blue-100 transform transition-all duration-300 hover:scale-105">Templates</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-blue-100 transform transition-all duration-300 hover:scale-105">Services</a>
                <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-blue-100 transform transition-all duration-300 hover:scale-105">Pricing</a>
                <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-blue-100 transform transition-all duration-300 hover:scale-105">Contact</a>
                                
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-blue-100 transform transition-all duration-300 hover:scale-105">Admin</a>
                    @endif
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-blue-100 transform transition-all duration-300 hover:scale-105">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-blue-100 transform transition-all duration-300 hover:scale-105">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-blue-100 transform transition-all duration-300 hover:scale-105">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-blue-100 transform transition-all duration-300 hover:scale-105">Register</a>
                    @endif
                @endauth
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer Section -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1">
                    <h3 class="text-lg font-bold mb-4 text-white">{{ config('app.name', 'WeddingInvites') }}</h3>
                    <p class="text-gray-400">
                        Create beautiful wedding invitations with our easy-to-use platform.
                    </p>
                </div>
                
                <div class="col-span-1">
                    <h4 class="text-md font-semibold mb-4 text-white">Services</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors duration-300">Wedding Invitations</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors duration-300">RSVP Management</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors duration-300">Print Services</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors duration-300">Custom Designs</a></li>
                    </ul>
                </div>
                
                <div class="col-span-1">
                    <h4 class="text-md font-semibold mb-4 text-white">Company</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('about') }}" class="text-gray-400 hover:text-blue-400 transition-colors duration-300">About Us</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-blue-400 transition-colors duration-300">Contact</a></li>
                        <li><a href="{{ route('privacy-policy') }}" class="text-gray-400 hover:text-blue-400 transition-colors duration-300">Privacy Policy</a></li>
                        <li><a href="{{ route('terms-of-service') }}" class="text-gray-400 hover:text-blue-400 transition-colors duration-300">Terms of Service</a></li>
                        <li><a href="{{ route('return-refund-policy') }}" class="text-gray-400 hover:text-blue-400 transition-colors duration-300">Return & Refund Policy</a></li>
                    </ul>
                </div>
                
                <div class="col-span-1">
                    <h4 class="text-md font-semibold mb-4 text-white">Connect</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors duration-300">Facebook</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors duration-300">Instagram</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors duration-300">Twitter</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-blue-400 transition-colors duration-300">Pinterest</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="mt-8 pt-8 border-t border-gray-800 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'WeddingInvites') }}. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    <!-- Force reload CSS on page load to prevent caching issues -->
    <script>
        (function() {
            // Function to force reload all stylesheets
            function reloadStylesheets() {
                var links = document.getElementsByTagName('link');
                for (var i = 0; i < links.length; i++) {
                    var link = links[i];
                    if (link.rel === 'stylesheet') {
                        var href = link.href;
                        // Add a timestamp to force reload
                        var timestamp = '_cache_bust=' + new Date().getTime();
                        if (href.indexOf('?') >= 0) {
                            link.href = href + '&' + timestamp;
                        } else {
                            link.href = href + '?' + timestamp;
                        }
                    }
                }
            }
            
            // Reload stylesheets on page load
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', reloadStylesheets);
            } else {
                reloadStylesheets();
            }
        })();
    </script>
    
</body>
</html>