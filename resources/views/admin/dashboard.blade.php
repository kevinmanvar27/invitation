<x-admin-layout>
    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
        <p class="text-muted">Overview of your wedding invitation platform</p>
    </x-slot>

    <div class="container-fluid">
        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-lg-4 col-6 mb-4">
                <div class="card card-stat">
                    <div class="inner">
                        <h3>1,245</h3>
                        <p>Total Users</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-4 col-6 mb-4">
                <div class="card card-stat">
                    <div class="inner">
                        <h3>89</h3>
                        <p>Templates</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file-image"></i>
                    </div>
                    <a href="{{ route('admin.templates.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            
            <div class="col-lg-4 col-6 mb-4">
                <div class="card card-stat">
                    <div class="inner">
                        <h3>324</h3>
                        <p>Subscriptions</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-subscript"></i>
                    </div>
                    <a href="{{ route('admin.subscriptions.index') }}" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Links Section -->
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quick Links</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a href="{{ route('admin.users.index') }}" class="text-decoration-none d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-users mr-2"></i>Manage Users</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('admin.templates.index') }}" class="text-decoration-none d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-file-image mr-2"></i>Manage Templates</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('admin.categories.index') }}" class="text-decoration-none d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-folder mr-2"></i>Template Categories</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('admin.tags.index') }}" class="text-decoration-none d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-tags mr-2"></i>Template Tags</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Content Management</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a href="{{ route('admin.designs.index') }}" class="text-decoration-none d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-paint-brush mr-2"></i>User Designs</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('admin.elements.index') }}" class="text-decoration-none d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-cube mr-2"></i>Design Elements</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('admin.fonts.index') }}" class="text-decoration-none d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-font mr-2"></i>Fonts</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('admin.customizations.index') }}" class="text-decoration-none d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-sliders-h mr-2"></i>Customizations</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Business Operations</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a href="{{ route('admin.subscriptions.index') }}" class="text-decoration-none d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-subscript mr-2"></i>Subscriptions</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('admin.payments.index') }}" class="text-decoration-none d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-credit-card mr-2"></i>Payments</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('admin.print-orders.index') }}" class="text-decoration-none d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-print mr-2"></i>Print Orders</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ route('admin.rsvp-responses.index') }}" class="text-decoration-none d-flex justify-content-between align-items-center">
                                    <span><i class="fas fa-envelope mr-2"></i>RSVP Responses</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>