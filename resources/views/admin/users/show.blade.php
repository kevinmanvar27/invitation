<x-admin-layout>
    <x-slot name="header">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
            </ol>
        </nav>
    </x-slot>

    <div class="row g-4">
        <!-- User Profile Card -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body text-center py-4">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=ffffff&background=ff6b6b&size=120" 
                         class="rounded-circle mb-3" 
                         width="120" 
                         height="120" 
                         alt="{{ $user->name }}">
                    <h4 class="mb-1">{{ $user->name }}</h4>
                    <p class="text-muted mb-3">{{ $user->email }}</p>
                    
                    <div class="d-flex justify-content-center gap-2 mb-3">
                        @if($user->is_admin)
                            <span class="badge badge-info">
                                <i class="fas fa-shield-alt me-1"></i>Admin
                            </span>
                        @else
                            <span class="badge badge-secondary">
                                <i class="fas fa-user me-1"></i>User
                            </span>
                        @endif
                        
                        @if($user->is_active)
                            <span class="badge badge-success">
                                <i class="fas fa-check-circle me-1"></i>Active
                            </span>
                        @else
                            <span class="badge badge-danger">
                                <i class="fas fa-times-circle me-1"></i>Inactive
                            </span>
                        @endif
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i> Edit User
                        </a>
                        <button type="button" class="btn btn-outline-danger" onclick="confirmDelete()">
                            <i class="fas fa-trash me-1"></i> Delete User
                        </button>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="row text-center">
                        <div class="col-6 border-end">
                            <small class="text-muted d-block">Joined</small>
                            <strong>{{ $user->created_at->format('M d, Y') }}</strong>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Last Updated</small>
                            <strong>{{ $user->updated_at->format('M d, Y') }}</strong>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions Card -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt me-2 text-warning"></i>Quick Actions
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('admin.designs.index', ['user_id' => $user->id]) }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-paint-brush me-2 text-primary"></i> View Designs
                        </a>
                        <a href="{{ route('admin.subscriptions.index', ['user_id' => $user->id]) }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-crown me-2 text-warning"></i> View Subscriptions
                        </a>
                        <a href="{{ route('admin.payments.index', ['user_id' => $user->id]) }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-credit-card me-2 text-success"></i> View Payments
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-envelope me-2 text-info"></i> Send Email
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- User Details -->
        <div class="col-lg-8">
            <!-- Statistics Cards -->
            <div class="row g-3 mb-4">
                <div class="col-md-3 col-6">
                    <div class="stat-card stat-card-primary">
                        <div class="stat-card-body">
                            <div class="stat-card-content">
                                <span class="stat-card-value">{{ $user->designs->count() }}</span>
                                <span class="stat-card-label">Designs</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card stat-card-success">
                        <div class="stat-card-body">
                            <div class="stat-card-content">
                                <span class="stat-card-value">{{ $user->subscriptions->count() }}</span>
                                <span class="stat-card-label">Subscriptions</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card stat-card-warning">
                        <div class="stat-card-body">
                            <div class="stat-card-content">
                                <span class="stat-card-value">{{ $user->payments->count() }}</span>
                                <span class="stat-card-label">Payments</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card stat-card-info">
                        <div class="stat-card-body">
                            <div class="stat-card-content">
                                <span class="stat-card-value">{{ $user->sharedInvitations->count() }}</span>
                                <span class="stat-card-label">Invitations</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Basic Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2 text-primary"></i>Basic Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">User ID</span>
                            <span class="detail-value">#{{ $user->id }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Full Name</span>
                            <span class="detail-value">{{ $user->name }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Email Address</span>
                            <span class="detail-value">{{ $user->email }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Email Verified</span>
                            <span class="detail-value">
                                @if($user->email_verified_at)
                                    <span class="badge badge-success">
                                        <i class="fas fa-check me-1"></i>{{ $user->email_verified_at->format('M d, Y H:i') }}
                                    </span>
                                @else
                                    <span class="badge badge-warning">
                                        <i class="fas fa-clock me-1"></i>Not Verified
                                    </span>
                                @endif
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Account Created</span>
                            <span class="detail-value">{{ $user->created_at->format('M d, Y H:i') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Last Updated</span>
                            <span class="detail-value">{{ $user->updated_at->format('M d, Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Profile Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-user-circle me-2 text-info"></i>Profile Information
                    </h5>
                </div>
                <div class="card-body">
                    @if($user->profile)
                        <div class="detail-grid">
                            <div class="detail-item">
                                <span class="detail-label">Wedding Date</span>
                                <span class="detail-value">{{ $user->profile->wedding_date ? \Carbon\Carbon::parse($user->profile->wedding_date)->format('M d, Y') : 'Not Set' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Partner Name</span>
                                <span class="detail-value">{{ $user->profile->partner_name ?? 'Not Set' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Phone</span>
                                <span class="detail-value">{{ $user->profile->phone ?? 'Not Set' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Address</span>
                                <span class="detail-value">{{ $user->profile->address ?? 'Not Set' }}</span>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-user-slash fa-2x mb-2"></i>
                            <p class="mb-0">No profile information available</p>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Recent Activity -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-history me-2 text-secondary"></i>Recent Designs
                    </h5>
                    <a href="{{ route('admin.designs.index', ['user_id' => $user->id]) }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body p-0">
                    @if($user->designs->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Design</th>
                                        <th>Template</th>
                                        <th>Created</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user->designs->take(5) as $design)
                                        <tr>
                                            <td>
                                                <strong>{{ $design->name ?? 'Untitled Design' }}</strong>
                                            </td>
                                            <td>{{ $design->template->name ?? 'N/A' }}</td>
                                            <td class="text-muted">{{ $design->created_at->diffForHumans() }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('admin.designs.show', $design->id) }}" class="btn btn-icon btn-outline-secondary btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-paint-brush fa-2x mb-2"></i>
                            <p class="mb-0">No designs yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Back Button -->
    <div class="mt-4">
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to Users
        </a>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle text-danger me-2"></i>Confirm Delete
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong>{{ $user->name }}</strong>?</p>
                    <p class="text-muted mb-0">This action cannot be undone and will remove all associated data.</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function confirmDelete() {
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
    </script>
    @endpush
</x-admin-layout>