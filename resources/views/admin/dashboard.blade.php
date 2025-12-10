<x-admin-layout>
    <x-slot name="header">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
    </x-slot>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-lg-4 col-md-6">
            <div class="stat-card stat-card-primary">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $stats['users'] ?? '0' }}</span>
                        <span class="stat-card-label">Total Users</span>
                    </div>
                </div>
                <a href="{{ route('admin.users.index') }}" class="stat-card-footer">
                    View all users <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
            <div class="stat-card stat-card-success">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-file-image"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $stats['templates'] ?? '0' }}</span>
                        <span class="stat-card-label">Templates</span>
                    </div>
                </div>
                <a href="{{ route('admin.templates.index') }}" class="stat-card-footer">
                    View all templates <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
            <div class="stat-card stat-card-warning">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-crown"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $stats['subscriptions'] ?? '0' }}</span>
                        <span class="stat-card-label">Active Subscriptions</span>
                    </div>
                </div>
                <a href="{{ route('admin.subscriptions.index') }}" class="stat-card-footer">
                    View subscriptions <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Secondary Stats Row -->
    <div class="row g-4 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="stat-card stat-card-info">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-paint-brush"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $stats['designs'] ?? '0' }}</span>
                        <span class="stat-card-label">User Designs</span>
                    </div>
                </div>
                <a href="{{ route('admin.designs.index') }}" class="stat-card-footer">
                    View designs <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="stat-card stat-card-secondary">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $stats['payments'] ?? '0' }}</span>
                        <span class="stat-card-label">Payments</span>
                    </div>
                </div>
                <a href="{{ route('admin.payments.index') }}" class="stat-card-footer">
                    View payments <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="stat-card stat-card-primary">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $stats['rsvp_responses'] ?? '0' }}</span>
                        <span class="stat-card-label">RSVP Responses</span>
                    </div>
                </div>
                <a href="{{ route('admin.rsvp-responses.index') }}" class="stat-card-footer">
                    View responses <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-md-6">
            <div class="stat-card stat-card-success">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-print"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $stats['print_orders'] ?? '0' }}</span>
                        <span class="stat-card-label">Print Orders</span>
                    </div>
                </div>
                <a href="{{ route('admin.print-orders.index') }}" class="stat-card-footer">
                    View orders <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Links Section -->
    <div class="row g-4">
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt me-2 text-warning"></i>Quick Links
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-users me-3 text-primary"></i>Manage Users</span>
                                <i class="fas fa-chevron-right text-muted"></i>
                            </div>
                        </a>
                        <a href="{{ route('admin.templates.index') }}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-file-image me-3 text-success"></i>Manage Templates</span>
                                <i class="fas fa-chevron-right text-muted"></i>
                            </div>
                        </a>
                        <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-folder me-3 text-info"></i>Template Categories</span>
                                <i class="fas fa-chevron-right text-muted"></i>
                            </div>
                        </a>
                        <a href="{{ route('admin.tags.index') }}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-tags me-3 text-secondary"></i>Template Tags</span>
                                <i class="fas fa-chevron-right text-muted"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-palette me-2 text-info"></i>Content Management
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('admin.designs.index') }}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-paint-brush me-3 text-primary"></i>User Designs</span>
                                <i class="fas fa-chevron-right text-muted"></i>
                            </div>
                        </a>
                        <a href="{{ route('admin.elements.index') }}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-cube me-3 text-success"></i>Design Elements</span>
                                <i class="fas fa-chevron-right text-muted"></i>
                            </div>
                        </a>
                        <a href="{{ route('admin.fonts.index') }}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-font me-3 text-warning"></i>Fonts</span>
                                <i class="fas fa-chevron-right text-muted"></i>
                            </div>
                        </a>
                        <a href="{{ route('admin.customizations.index') }}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-sliders-h me-3 text-danger"></i>Customizations</span>
                                <i class="fas fa-chevron-right text-muted"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-briefcase me-2 text-success"></i>Business Operations
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('admin.subscriptions.index') }}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-crown me-3 text-warning"></i>Subscriptions</span>
                                <i class="fas fa-chevron-right text-muted"></i>
                            </div>
                        </a>
                        <a href="{{ route('admin.payments.index') }}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-credit-card me-3 text-success"></i>Payments</span>
                                <i class="fas fa-chevron-right text-muted"></i>
                            </div>
                        </a>
                        <a href="{{ route('admin.print-orders.index') }}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-print me-3 text-primary"></i>Print Orders</span>
                                <i class="fas fa-chevron-right text-muted"></i>
                            </div>
                        </a>
                        <a href="{{ route('admin.rsvp-responses.index') }}" class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between align-items-center">
                                <span><i class="fas fa-envelope me-3 text-info"></i>RSVP Responses</span>
                                <i class="fas fa-chevron-right text-muted"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="row g-4 mt-2">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-clock me-2 text-primary"></i>Recent Users
                    </h5>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body p-0">
                    @if(isset($recentUsers) && count($recentUsers) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Email</th>
                                        <th>Joined</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentUsers as $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=ffffff&background=ff6b6b&size=32" 
                                                         class="rounded-circle me-2" 
                                                         width="32" 
                                                         height="32" 
                                                         alt="{{ $user->name }}">
                                                    <span>{{ $user->name }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-users fa-2x mb-2"></i>
                            <p class="mb-0">No recent users</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-shopping-cart me-2 text-success"></i>Recent Orders
                    </h5>
                    <a href="{{ route('admin.print-orders.index') }}" class="btn btn-sm btn-outline-success">View All</a>
                </div>
                <div class="card-body p-0">
                    @if(isset($recentOrders) && count($recentOrders) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders as $order)
                                        <tr>
                                            <td><strong>#{{ $order->id }}</strong></td>
                                            <td>{{ $order->user->name ?? 'N/A' }}</td>
                                            <td>
                                                <span class="badge badge-{{ $order->status === 'completed' ? 'success' : ($order->status === 'pending' ? 'warning' : 'secondary') }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $order->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-shopping-cart fa-2x mb-2"></i>
                            <p class="mb-0">No recent orders</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>