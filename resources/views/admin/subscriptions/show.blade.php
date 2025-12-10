<x-admin-layout>
    <x-slot name="title">Subscription Details</x-slot>

    <!-- Page Header -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.subscriptions.index') }}">Subscriptions</a></li>
                    <li class="breadcrumb-item active">#{{ $subscription->id }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <!-- Profile Card -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar bg-primary text-white mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <h4 class="mb-1">{{ ucfirst($subscription->plan_type) }} Plan</h4>
                    <p class="text-muted mb-2">Subscription #{{ $subscription->id }}</p>
                    
                    @if($subscription->status === 'active')
                        <span class="badge bg-success fs-6">Active</span>
                    @elseif($subscription->status === 'inactive')
                        <span class="badge bg-warning text-dark fs-6">Inactive</span>
                    @else
                        <span class="badge bg-danger fs-6">Expired</span>
                    @endif
                    
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <a href="{{ route('admin.subscriptions.edit', $subscription->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                        <button type="button" class="btn btn-outline-danger" onclick="confirmDelete()">
                            <i class="fas fa-trash me-1"></i> Delete
                        </button>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <div class="row text-center">
                        <div class="col-6">
                            <small class="text-muted d-block">Started</small>
                            <span class="fw-medium">{{ $subscription->started_at ? $subscription->started_at->format('M d, Y') : 'N/A' }}</span>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Expires</small>
                            <span class="fw-medium">{{ $subscription->expires_at ? $subscription->expires_at->format('M d, Y') : 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h6>
                </div>
                <div class="list-group list-group-flush">
                    @if($subscription->user)
                        <a href="{{ route('admin.users.show', $subscription->user->id) }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-user me-2 text-muted"></i> View User
                        </a>
                    @endif
                    <a href="{{ route('admin.subscriptions.create') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-plus me-2 text-muted"></i> Create New Subscription
                    </a>
                    <a href="{{ route('admin.payments.index') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-money-bill me-2 text-muted"></i> View Payments
                    </a>
                </div>
            </div>
        </div>

        <!-- Details Column -->
        <div class="col-lg-8">
            <!-- Stats -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="stat-card stat-card-primary">
                        <div class="stat-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stat-value">${{ number_format($subscription->price, 2) }}</div>
                        <div class="stat-label">Price</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card stat-card-info">
                        <div class="stat-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="stat-value">
                            @if($subscription->expires_at && $subscription->expires_at->isFuture())
                                {{ $subscription->expires_at->diffInDays(now()) }}
                            @else
                                0
                            @endif
                        </div>
                        <div class="stat-label">Days Remaining</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card stat-card-success">
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-value">
                            @if($subscription->started_at)
                                {{ $subscription->started_at->diffInDays(now()) }}
                            @else
                                0
                            @endif
                        </div>
                        <div class="stat-label">Days Active</div>
                    </div>
                </div>
            </div>

            <!-- User Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-user me-2"></i>User Information</h5>
                </div>
                <div class="card-body">
                    @if($subscription->user)
                        <div class="d-flex align-items-center">
                            <div class="avatar me-3">
                                {{ strtoupper(substr($subscription->user->name, 0, 2)) }}
                            </div>
                            <div>
                                <h6 class="mb-0">{{ $subscription->user->name }}</h6>
                                <small class="text-muted">{{ $subscription->user->email }}</small>
                            </div>
                            <a href="{{ route('admin.users.show', $subscription->user->id) }}" class="btn btn-sm btn-outline-primary ms-auto">
                                View Profile
                            </a>
                        </div>
                    @else
                        <p class="text-muted mb-0">No user associated</p>
                    @endif
                </div>
            </div>

            <!-- Subscription Details -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Subscription Details</h5>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Subscription ID</span>
                            <span class="detail-value">#{{ $subscription->id }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Plan Type</span>
                            <span class="detail-value">
                                <span class="badge bg-primary">{{ ucfirst($subscription->plan_type) }}</span>
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Status</span>
                            <span class="detail-value">
                                @if($subscription->status === 'active')
                                    <span class="badge bg-success">Active</span>
                                @elseif($subscription->status === 'inactive')
                                    <span class="badge bg-warning text-dark">Inactive</span>
                                @else
                                    <span class="badge bg-danger">Expired</span>
                                @endif
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Price</span>
                            <span class="detail-value">${{ number_format($subscription->price, 2) }} {{ $subscription->currency }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Currency</span>
                            <span class="detail-value">{{ $subscription->currency }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Started At</span>
                            <span class="detail-value">{{ $subscription->started_at ? $subscription->started_at->format('M d, Y \a\t h:i A') : 'N/A' }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Expires At</span>
                            <span class="detail-value">{{ $subscription->expires_at ? $subscription->expires_at->format('M d, Y \a\t h:i A') : 'N/A' }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Created At</span>
                            <span class="detail-value">{{ $subscription->created_at->format('M d, Y \a\t h:i A') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Updated At</span>
                            <span class="detail-value">{{ $subscription->updated_at->format('M d, Y \a\t h:i A') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <div class="d-flex justify-content-start">
                <a href="{{ route('admin.subscriptions.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back to Subscriptions
                </a>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle text-danger me-2"></i>Confirm Delete
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this subscription?</p>
                    <p class="text-muted small mb-0">This action cannot be undone.</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.subscriptions.destroy', $subscription->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i> Delete Subscription
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