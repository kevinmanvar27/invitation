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

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    
    <!-- Custom Admin Styles -->
    <link rel="stylesheet" href="{{ asset('css/admin/admin-panel.css') }}">
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light bg-white border-bottom">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" id="sidebarToggle" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ms-auto">
                <!-- User Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=7F9CF5&background=EBF4FF" class="user-image rounded-circle" width="30" height="30" alt="User Image">
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a href="{{ route('admin.profile') }}" class="dropdown-item">
                                <i class="fas fa-user me-2"></i> Profile
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar">
            <!-- Brand Logo -->
            <a href="{{ route('admin.dashboard') }}" class="sidebar-brand bg-dark">
                <span class="brand-text">Admin Panel</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav-sidebar">
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        
                        <li class="nav-header">USER MANAGEMENT</li>
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.user-profiles.index') }}" class="nav-link {{ request()->routeIs('admin.user-profiles.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-circle"></i>
                                <p>User Profiles</p>
                            </a>
                        </li>
                        
                        <li class="nav-header">TEMPLATE MANAGEMENT</li>
                        <li class="nav-item">
                            <a href="{{ route('admin.templates.index') }}" class="nav-link {{ request()->routeIs('admin.templates.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file-image"></i>
                                <p>Templates</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-folder"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.tags.index') }}" class="nav-link {{ request()->routeIs('admin.tags.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>Tags</p>
                            </a>
                        </li>
                        
                        <li class="nav-header">DESIGN MANAGEMENT</li>
                        <li class="nav-item">
                            <a href="{{ route('admin.designs.index') }}" class="nav-link {{ request()->routeIs('admin.designs.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-paint-brush"></i>
                                <p>User Designs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.customizations.index') }}" class="nav-link {{ request()->routeIs('admin.customizations.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-sliders-h"></i>
                                <p>Customizations</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.elements.index') }}" class="nav-link {{ request()->routeIs('admin.elements.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cube"></i>
                                <p>Design Elements</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.fonts.index') }}" class="nav-link {{ request()->routeIs('admin.fonts.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-font"></i>
                                <p>Fonts</p>
                            </a>
                        </li>
                        
                        <li class="nav-header">BUSINESS OPERATIONS</li>
                        <li class="nav-item">
                            <a href="{{ route('admin.subscriptions.index') }}" class="nav-link {{ request()->routeIs('admin.subscriptions.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-subscript"></i>
                                <p>Subscriptions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.payments.index') }}" class="nav-link {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-credit-card"></i>
                                <p>Payments</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.downloads.index') }}" class="nav-link {{ request()->routeIs('admin.downloads.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-download"></i>
                                <p>Downloads</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.shared-invitations.index') }}" class="nav-link {{ request()->routeIs('admin.shared-invitations.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-share-alt"></i>
                                <p>Shared Invitations</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.rsvp-responses.index') }}" class="nav-link {{ request()->routeIs('admin.rsvp-responses.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-envelope"></i>
                                <p>RSVP Responses</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.rsvp-settings.index') }}" class="nav-link {{ request()->routeIs('admin.rsvp-settings.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>RSVP Settings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.print-orders.index') }}" class="nav-link {{ request()->routeIs('admin.print-orders.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-print"></i>
                                <p>Print Orders</p>
                            </a>
                        </li>
                        
                        <li class="nav-header">MARKETING</li>
                        <li class="nav-item">
                            <a href="{{ route('admin.coupons.index') }}" class="nav-link {{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-ticket-alt"></i>
                                <p>Coupons</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.referrals.index') }}" class="nav-link {{ request()->routeIs('admin.referrals.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-link"></i>
                                <p>Referrals</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.shipping-addresses.index') }}" class="nav-link {{ request()->routeIs('admin.shipping-addresses.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-map-marker-alt"></i>
                                <p>Shipping Addresses</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @if (isset($header))
                <div class="content-header">
                    <div class="container-fluid">
                        {{ $header }}
                    </div>
                </div>
            @endif

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    {{ $slot }}
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Footer -->
        <footer class="main-footer">
            <div class="float-end d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div>
            <strong>&copy; {{ date('Y') }} {{ config('app.name') }}.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <script>
        $(document).ready(function() {
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
            
            // Sidebar toggle functionality
            $('#sidebarToggle').on('click', function(e) {
                e.preventDefault();
                $('body').toggleClass('sidebar-open');
            });
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