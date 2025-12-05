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
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800|playfair-display:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link rel="stylesheet" href="@versionedAsset('css/modern-app.css')">
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="@versionedAsset('js/app.js')" defer></script>
</head>
<body class="font-sans antialiased bg-white text-gray-900">
    <!-- Header Section -->
    <header class="navbar">
        <div class="navbar-container">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="navbar-brand">
                        {{ config('app.name', 'WeddingInvites') }}
                    </a>
                </div>
                
                <!-- Mobile menu button -->
                <div class="mobile-menu-button">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path id="menu-icon" class="block" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path id="close-icon" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
            </div>
            
            <!-- Navigation Menu -->
            <nav class="nav-links">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('templates.index') }}" class="nav-link {{ request()->routeIs('templates.*') ? 'active' : '' }}">Templates</a>
                <a href="{{ route('services') }}" class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}">Services</a>
                <a href="{{ route('pricing') }}" class="nav-link {{ request()->routeIs('pricing') ? 'active' : '' }}">Pricing</a>
                <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
                
                <!-- Admin Link -->
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">Admin</a>
                    @endif
                @endauth
            </nav>
            
            <!-- Authentication Links -->
            <div class="nav-auth">
                @auth
                    <div class="relative">
                        <!-- User Profile Dropdown -->
                        <div class="dropdown">
                            <button class="dropdown-toggle" id="userDropdown" aria-haspopup="true" aria-expanded="false">
                                <!-- User Avatar -->
                                <div class="user-avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </div>
                                <span class="user-name">{{ Auth::user()->name }}</span>
                                <svg class="dropdown-arrow" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div class="dropdown-menu" aria-labelledby="userDropdown">
                                <a href="{{ route('dashboard') }}" class="dropdown-item">
                                    <svg class="dropdown-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    Dashboard
                                </a>
                                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                                    @csrf
                                    <button type="submit" class="dropdown-item" aria-label="Logout">
                                        <svg class="dropdown-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                            <polyline points="16 17 21 12 16 7"></polyline>
                                            <line x1="21" y1="12" x2="9" y2="12"></line>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-outline">Register</a>
                    @endif
                @endauth
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="mobile-menu">
            <div class="mobile-menu-header">
                <a href="{{ route('home') }}" class="navbar-brand">
                    {{ config('app.name', 'WeddingInvites') }}
                </a>
                <button class="mobile-close-button">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <div class="mobile-nav-links">
                <a href="{{ route('home') }}" class="mobile-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                <a href="{{ route('templates.index') }}" class="mobile-nav-link {{ request()->routeIs('templates.*') ? 'active' : '' }}">Templates</a>
                <a href="{{ route('services') }}" class="mobile-nav-link {{ request()->routeIs('services') ? 'active' : '' }}">Services</a>
                <a href="{{ route('pricing') }}" class="mobile-nav-link {{ request()->routeIs('pricing') ? 'active' : '' }}">Pricing</a>
                <a href="{{ route('contact') }}" class="mobile-nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
                
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="mobile-nav-link">Admin</a>
                    @endif
                    <a href="{{ route('dashboard') }}" class="mobile-nav-link">Dashboard</a>
                @endauth
            </div>
            
            <div class="mobile-auth">
                @auth
                    <div class="mobile-user-profile">
                        <!-- User Avatar -->
                        <div class="mobile-user-avatar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <div class="mobile-user-info">
                            <span class="mobile-user-name">{{ Auth::user()->name }}</span>
                            <span class="mobile-user-email">{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                    
                    <div class="mobile-menu-items">
                        <a href="{{ route('dashboard') }}" class="mobile-nav-link">
                            <svg class="mobile-dropdown-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                            Dashboard
                        </a>
                        
                        <form method="POST" action="{{ route('logout') }}" class="logout-form">
                            @csrf
                            <button type="submit" class="mobile-nav-link" aria-label="Logout">
                                <svg class="mobile-dropdown-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary w-full mb-3">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-secondary w-full">Register</a>
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
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-grid">
                <div class="footer-column">
                    <a href="{{ route('home') }}" class="footer-brand">{{ config('app.name', 'WeddingInvites') }}</a>
                    <p class="footer-description">
                        Create beautiful wedding invitations with our easy-to-use platform.
                    </p>
                    <div class="footer-social">
                        <a href="#" class="footer-social-link" aria-label="Facebook">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" role="img" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="footer-social-link" aria-label="Instagram">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" role="img" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="#" class="footer-social-link" aria-label="Twitter">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" role="img" aria-hidden="true">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                        <a href="#" class="footer-social-link" aria-label="Pinterest">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" role="img" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.097.118.112.222.085.343-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.164-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h4>Services</h4>
                    <ul class="footer-links">
                        <li><a href="#">Wedding Invitations</a></li>
                        <li><a href="#">RSVP Management</a></li>
                        <li><a href="#">Print Services</a></li>
                        <li><a href="#">Custom Designs</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h4>Company</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                        <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                        <li><a href="{{ route('terms-of-service') }}">Terms of Service</a></li>
                        <li><a href="{{ route('return-refund-policy') }}">Return & Refund Policy</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h4>Connect</h4>
                    <ul class="footer-links">
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Pinterest</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-divider"></div>
            
            <div class="footer-copyright">
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
    
    <!-- Dropdown Menu JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownToggle = document.querySelector('.dropdown-toggle');
            const dropdownMenu = document.querySelector('.dropdown-menu');
            const dropdownArrow = document.querySelector('.dropdown-arrow');
            
            if (dropdownToggle && dropdownMenu) {
                dropdownToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdownMenu.classList.toggle('show');
                    dropdownArrow.classList.toggle('open');
                    const isExpanded = dropdownMenu.classList.contains('show');
                    dropdownToggle.setAttribute('aria-expanded', isExpanded);
                });
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!dropdownToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
                        dropdownMenu.classList.remove('show');
                        dropdownArrow.classList.remove('open');
                        dropdownToggle.setAttribute('aria-expanded', 'false');
                    }
                });
                
                // Close dropdown when pressing Escape key
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') {
                        dropdownMenu.classList.remove('show');
                        dropdownArrow.classList.remove('open');
                        dropdownToggle.setAttribute('aria-expanded', 'false');
                    }
                });
            }
        });
    </script>
</body>
</html>