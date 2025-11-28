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

    <title>{{ config('app.name', 'Laravel') }} - Admin Panel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link rel="stylesheet" href="@versionedAsset('css/app.css')">
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="@versionedAsset('js/app.js')" defer></script>
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-50 flex">
        <!-- Sidebar -->
        <div class="admin-sidebar modern-sidebar" id="adminSidebar">
            <div class="p-4 border-b border-gray-700 flex justify-between items-center">
                <h1 class="text-xl font-bold admin-sidebar-nav-text">Admin Panel</h1>
                <div class="sidebar-toggle" id="sidebarToggle">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </div>
            </div>
            <nav class="mt-4 modern-nav">
                <a href="{{ route('admin.dashboard') }}" class="admin-sidebar-nav-link modern-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="admin-sidebar-nav-text">Dashboard</span>
                </a>
                <div class="nav-section">
                    <div class="sidebar-section-title modern-section-title">User Management</div>
                    <a href="{{ route('admin.users.index') }}" class="admin-sidebar-nav-link modern-nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <span class="admin-sidebar-nav-text">Users</span>
                    </a>
                    <a href="{{ route('admin.user-profiles.index') }}" class="admin-sidebar-nav-link modern-nav-link {{ request()->routeIs('admin.user-profiles.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="admin-sidebar-nav-text">User Profiles</span>
                    </a>
                </div>
                <div class="nav-section">
                    <div class="sidebar-section-title modern-section-title">Template Management</div>
                    <a href="{{ route('admin.templates.index') }}" class="admin-sidebar-nav-link modern-nav-link {{ request()->routeIs('admin.templates.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
                        </svg>
                        <span class="admin-sidebar-nav-text">Templates</span>
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="admin-sidebar-nav-link modern-nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                        </svg>
                        <span class="admin-sidebar-nav-text">Categories</span>
                    </a>
                    <a href="{{ route('admin.tags.index') }}" class="admin-sidebar-nav-link modern-nav-link {{ request()->routeIs('admin.tags.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        <span class="admin-sidebar-nav-text">Tags</span>
                    </a>
                </div>
                <div class="nav-section">
                    <div class="sidebar-section-title modern-section-title">Design Management</div>
                    <a href="{{ route('admin.designs.index') }}" class="admin-sidebar-nav-link modern-nav-link {{ request()->routeIs('admin.designs.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                        </svg>
                        <span class="admin-sidebar-nav-text">User Designs</span>
                    </a>
                    <a href="{{ route('admin.customizations.index') }}" class="admin-sidebar-nav-link modern-nav-link {{ request()->routeIs('admin.customizations.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="admin-sidebar-nav-text">Customizations</span>
                    </a>
                    <a href="{{ route('admin.elements.index') }}" class="admin-sidebar-nav-link modern-nav-link {{ request()->routeIs('admin.elements.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        <span class="admin-sidebar-nav-text">Design Elements</span>
                    </a>
                    <a href="{{ route('admin.fonts.index') }}" class="admin-sidebar-nav-link modern-nav-link {{ request()->routeIs('admin.fonts.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <span class="admin-sidebar-nav-text">Fonts</span>
                    </a>
                </div>
                <div class="nav-section">
                    <div class="sidebar-section-title modern-section-title">Business Operations</div>
                    <a href="{{ route('admin.subscriptions.index') }}" class="admin-sidebar-nav-link modern-nav-link {{ request()->routeIs('admin.subscriptions.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="admin-sidebar-nav-text">Subscriptions</span>
                    </a>
                    <a href="{{ route('admin.payments.index') }}" class="admin-sidebar-nav-link modern-nav-link {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="admin-sidebar-nav-text">Payments</span>
                    </a>
                    <a href="{{ route('admin.downloads.index') }}" class="admin-sidebar-nav-link modern-nav-link {{ request()->routeIs('admin.downloads.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        <span class="admin-sidebar-nav-text">Downloads</span>
                    </a>
                    <a href="{{ route('admin.shared-invitations.index') }}" class="admin-sidebar-nav-link modern-nav-link {{ request()->routeIs('admin.shared-invitations.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                        </svg>
                        <span class="admin-sidebar-nav-text">Shared Invitations</span>
                    </a>
                    <a href="{{ route('admin.rsvp-responses.index') }}" class="admin-sidebar-nav-link modern-nav-link {{ request()->routeIs('admin.rsvp-responses.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span class="admin-sidebar-nav-text">RSVP Responses</span>
                    </a>
                    <a href="{{ route('admin.rsvp-settings.index') }}" class="admin-sidebar-nav-link modern-nav-link {{ request()->routeIs('admin.rsvp-settings.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="admin-sidebar-nav-text">RSVP Settings</span>
                    </a>
                    <a href="{{ route('admin.print-orders.index') }}" class="admin-sidebar-nav-link modern-nav-link {{ request()->routeIs('admin.print-orders.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        <span class="admin-sidebar-nav-text">Print Orders</span>
                    </a>
                </div>
                <div class="nav-section">
                    <div class="sidebar-section-title modern-section-title">Marketing</div>
                    <a href="{{ route('admin.coupons.index') }}" class="admin-sidebar-nav-link modern-nav-link {{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                        </svg>
                        <span class="admin-sidebar-nav-text">Coupons</span>
                    </a>
                    <a href="{{ route('admin.referrals.index') }}" class="admin-sidebar-nav-link modern-nav-link {{ request()->routeIs('admin.referrals.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                        </svg>
                        <span class="admin-sidebar-nav-text">Referrals</span>
                    </a>
                    <a href="{{ route('admin.shipping-addresses.index') }}" class="admin-sidebar-nav-link modern-nav-link {{ request()->routeIs('admin.shipping-addresses.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="admin-sidebar-nav-text">Shipping Addresses</span>
                    </a>
                </div>
                <div class="nav-section">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="admin-sidebar-nav-link modern-nav-link w-full text-left">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span class="admin-sidebar-nav-text">Logout</span>
                        </button>
                    </form>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Navigation -->
            <header class="bg-white shadow modern-header">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    <button id="mobileMenuButton" class="md:hidden text-gray-500 modern-mobile-toggle">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <div class="flex-1"></div>
                    <div class="ml-3 relative">
                        <div class="flex items-center">
                            <div class="text-sm text-gray-700 mr-3 modern-user-name">
                                {{ Auth::user()->name }}
                            </div>
                            <div class="relative">
                                <button id="userMenuButton" class="flex text-sm rounded-full focus:outline-none modern-user-avatar">
                                    <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=7F9CF5&background=EBF4FF" alt="{{ Auth::user()->name }}">
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Heading -->
            @if (isset($header))
                <div class="bg-white shadow modern-page-header">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </div>
            @endif

            <!-- Page Content -->
            <main class="flex-1 modern-main-content">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg modern-content-card">
                            <div class="p-6 text-gray-900 modern-content-body">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t modern-footer">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <p class="text-center text-sm text-gray-500 modern-footer-text">
                        &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                    </p>
                </div>
            </footer>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#sidebarToggle').on('click', function() {
                $('#adminSidebar').toggleClass('collapsed');
            });
            
            $('#mobileMenuButton').on('click', function() {
                $('#adminSidebar').toggleClass('mobile-hidden');
            });
            
            // Initialize DataTables if present
            if ($('.data-table').length) {
                $('.data-table').DataTable({
                    "pageLength": 25,
                    "order": [],
                    "responsive": true,
                    "language": {
                        "search": "Search:",
                        "lengthMenu": "Show _MENU_ entries",
                        "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                        "paginate": {
                            "first": "First",
                            "last": "Last",
                            "next": "Next",
                            "previous": "Previous"
                        }
                    }
                });
            }
        });
    </script>
    
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