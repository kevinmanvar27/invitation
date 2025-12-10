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

    <!-- Fonts - Inter & Playfair Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    
    <!-- Custom Admin Theme -->
    <link rel="stylesheet" href="{{ asset('css/admin/admin-theme.css') }}">
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('styles')
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="admin-sidebar" id="adminSidebar">
            <!-- Brand Logo -->
            <div class="sidebar-brand">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-gem brand-icon"></i>
                    <span class="brand-text">Admin Panel</span>
                </a>
            </div>

            <!-- Sidebar Menu -->
            <nav class="sidebar-nav">
                <ul class="nav-menu">
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    
                    <!-- User Management Section -->
                    <li class="nav-section">User Management</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <i class="fas fa-users"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.user-profiles.index') }}" class="nav-link {{ request()->routeIs('admin.user-profiles.*') ? 'active' : '' }}">
                            <i class="fas fa-user-circle"></i>
                            <span>User Profiles</span>
                        </a>
                    </li>
                    
                    <!-- Template Management Section -->
                    <li class="nav-section">Template Management</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.templates.index') }}" class="nav-link {{ request()->routeIs('admin.templates.*') ? 'active' : '' }}">
                            <i class="fas fa-file-image"></i>
                            <span>Templates</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                            <i class="fas fa-folder"></i>
                            <span>Categories</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.tags.index') }}" class="nav-link {{ request()->routeIs('admin.tags.*') ? 'active' : '' }}">
                            <i class="fas fa-tags"></i>
                            <span>Tags</span>
                        </a>
                    </li>
                    
                    <!-- Design Management Section -->
                    <li class="nav-section">Design Management</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.designs.index') }}" class="nav-link {{ request()->routeIs('admin.designs.*') ? 'active' : '' }}">
                            <i class="fas fa-paint-brush"></i>
                            <span>User Designs</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.customizations.index') }}" class="nav-link {{ request()->routeIs('admin.customizations.*') ? 'active' : '' }}">
                            <i class="fas fa-sliders-h"></i>
                            <span>Customizations</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.elements.index') }}" class="nav-link {{ request()->routeIs('admin.elements.*') ? 'active' : '' }}">
                            <i class="fas fa-cube"></i>
                            <span>Design Elements</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.fonts.index') }}" class="nav-link {{ request()->routeIs('admin.fonts.*') ? 'active' : '' }}">
                            <i class="fas fa-font"></i>
                            <span>Fonts</span>
                        </a>
                    </li>
                    
                    <!-- Business Operations Section -->
                    <li class="nav-section">Business Operations</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.subscriptions.index') }}" class="nav-link {{ request()->routeIs('admin.subscriptions.*') ? 'active' : '' }}">
                            <i class="fas fa-crown"></i>
                            <span>Subscriptions</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.payments.index') }}" class="nav-link {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
                            <i class="fas fa-credit-card"></i>
                            <span>Payments</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.downloads.index') }}" class="nav-link {{ request()->routeIs('admin.downloads.*') ? 'active' : '' }}">
                            <i class="fas fa-download"></i>
                            <span>Downloads</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.shared-invitations.index') }}" class="nav-link {{ request()->routeIs('admin.shared-invitations.*') ? 'active' : '' }}">
                            <i class="fas fa-share-alt"></i>
                            <span>Shared Invitations</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.rsvp-responses.index') }}" class="nav-link {{ request()->routeIs('admin.rsvp-responses.*') ? 'active' : '' }}">
                            <i class="fas fa-envelope"></i>
                            <span>RSVP Responses</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.rsvp-settings.index') }}" class="nav-link {{ request()->routeIs('admin.rsvp-settings.*') ? 'active' : '' }}">
                            <i class="fas fa-cog"></i>
                            <span>RSVP Settings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.print-orders.index') }}" class="nav-link {{ request()->routeIs('admin.print-orders.*') ? 'active' : '' }}">
                            <i class="fas fa-print"></i>
                            <span>Print Orders</span>
                        </a>
                    </li>
                    
                    <!-- Marketing Section -->
                    <li class="nav-section">Marketing</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.coupons.index') }}" class="nav-link {{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}">
                            <i class="fas fa-ticket-alt"></i>
                            <span>Coupons</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.referrals.index') }}" class="nav-link {{ request()->routeIs('admin.referrals.*') ? 'active' : '' }}">
                            <i class="fas fa-link"></i>
                            <span>Referrals</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.shipping-addresses.index') }}" class="nav-link {{ request()->routeIs('admin.shipping-addresses.*') ? 'active' : '' }}">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Shipping Addresses</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <div class="admin-main">
            <!-- Top Navbar -->
            <nav class="admin-navbar">
                <div class="navbar-left">
                    <button type="button" class="sidebar-toggle" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <!-- Breadcrumb -->
                    @if (isset($breadcrumb))
                        <nav aria-label="breadcrumb" class="d-none d-md-block">
                            {{ $breadcrumb }}
                        </nav>
                    @endif
                </div>
                
                <div class="navbar-right">
                    <!-- Quick Actions -->
                    <a href="{{ route('home') }}" class="navbar-action" title="View Site" target="_blank">
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                    
                    <!-- User Dropdown -->
                    <div class="dropdown">
                        <button class="user-dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=ffffff&background=ff6b6b" 
                                 class="user-avatar" 
                                 alt="{{ Auth::user()->name }}">
                            <span class="user-name d-none d-md-inline">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down dropdown-arrow"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="dropdown-header">
                                <strong>{{ Auth::user()->name }}</strong>
                                <small class="d-block text-muted">{{ Auth::user()->email }}</small>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a href="{{ route('admin.profile') }}" class="dropdown-item">
                                    <i class="fas fa-user me-2"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.settings') }}" class="dropdown-item">
                                    <i class="fas fa-cog me-2"></i> Settings
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="admin-content">
                <!-- Page Header -->
                @if (isset($header))
                    <div class="page-header">
                        {{ $header }}
                    </div>
                @endif

                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        {{ session('warning') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('info'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="fas fa-info-circle me-2"></i>
                        {{ session('info') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Main Content Slot -->
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="admin-footer">
                <div class="footer-left">
                    <strong>&copy; {{ date('Y') }} {{ config('app.name') }}.</strong> All rights reserved.
                </div>
                <div class="footer-right">
                    <span class="version">Version 1.0.0</span>
                </div>
            </footer>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Initialize DataTables if present
            if ($('.data-table').length) {
                $('.data-table').DataTable({
                    "pageLength": 25,
                    "order": [],
                    "responsive": true,
                    "language": {
                        "search": "_INPUT_",
                        "searchPlaceholder": "Search...",
                        "lengthMenu": "Show _MENU_ entries",
                        "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                        "paginate": {
                            "first": '<i class="fas fa-angle-double-left"></i>',
                            "last": '<i class="fas fa-angle-double-right"></i>',
                            "next": '<i class="fas fa-angle-right"></i>',
                            "previous": '<i class="fas fa-angle-left"></i>'
                        }
                    },
                    "dom": '<"table-toolbar"<"toolbar-left"l><"toolbar-right"f>>rt<"table-footer"<"footer-left"i><"footer-right"p>>'
                });
            }
            
            // Sidebar toggle functionality
            $('#sidebarToggle').on('click', function(e) {
                e.preventDefault();
                $('.admin-wrapper').toggleClass('sidebar-collapsed');
                
                // Store preference in localStorage
                if ($('.admin-wrapper').hasClass('sidebar-collapsed')) {
                    localStorage.setItem('sidebarCollapsed', 'true');
                } else {
                    localStorage.removeItem('sidebarCollapsed');
                }
            });
            
            // Restore sidebar state from localStorage
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                $('.admin-wrapper').addClass('sidebar-collapsed');
            }
            
            // Mobile sidebar overlay click to close
            $(document).on('click', '.admin-main', function(e) {
                if ($(window).width() < 992 && $('.admin-wrapper').hasClass('sidebar-open')) {
                    $('.admin-wrapper').removeClass('sidebar-open');
                }
            });
            
            // Mobile sidebar toggle
            if ($(window).width() < 992) {
                $('#sidebarToggle').off('click').on('click', function(e) {
                    e.preventDefault();
                    $('.admin-wrapper').toggleClass('sidebar-open');
                });
            }
            
            // Auto-dismiss alerts after 5 seconds
            setTimeout(function() {
                $('.alert').alert('close');
            }, 5000);
            
            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
            
            // Initialize popovers
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
            var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl);
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>