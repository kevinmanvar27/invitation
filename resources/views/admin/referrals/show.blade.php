<x-admin-layout>
    <!-- Page Header -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.referrals.index') }}">Referrals</a></li>
                    <li class="breadcrumb-item active">#{{ $referral->id }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <!-- Left Column - Referral Profile -->
        <div class="col-lg-4 mb-4">
            <!-- Referral Card -->
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-user-friends fs-2"></i>
                    </div>
                    <h5 class="mb-1">Referral #{{ $referral->id }}</h5>
                    <p class="text-muted mb-3">${{ number_format($referral->reward_earned, 2) }} reward</p>
                    
                    @if($referral->status == 'completed')
                        <span class="badge bg-success fs-6 px-3 py-2">Completed</span>
                    @else
                        <span class="badge bg-warning fs-6 px-3 py-2">Pending</span>
                    @endif

                    <div class="d-flex gap-2 justify-content-center mt-4">
                        <a href="{{ route('admin.referrals.edit', $referral) }}" class="btn btn-primary">
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
                            <small class="text-muted d-block">Created</small>
                            <span class="fw-medium">{{ $referral->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Updated</small>
                            <span class="fw-medium">{{ $referral->updated_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Referrer Card -->
            @if($referral->referrer)
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-user me-2"></i>Referrer</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar bg-success text-white d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            {{ strtoupper(substr($referral->referrer->name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <h6 class="mb-0">{{ $referral->referrer->name }}</h6>
                            <small class="text-muted">{{ $referral->referrer->email }}</small>
                        </div>
                    </div>
                    <a href="{{ route('admin.users.show', $referral->referrer) }}" class="btn btn-sm btn-outline-primary w-100 mt-3">
                        <i class="fas fa-external-link-alt me-1"></i> View Referrer
                    </a>
                </div>
            </div>
            @endif

            <!-- Referred Card -->
            @if($referral->referred)
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-user-plus me-2"></i>Referred User</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar bg-info text-white d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            {{ strtoupper(substr($referral->referred->name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <h6 class="mb-0">{{ $referral->referred->name }}</h6>
                            <small class="text-muted">{{ $referral->referred->email }}</small>
                        </div>
                    </div>
                    <a href="{{ route('admin.users.show', $referral->referred) }}" class="btn btn-sm btn-outline-primary w-100 mt-3">
                        <i class="fas fa-external-link-alt me-1"></i> View Referred User
                    </a>
                </div>
            </div>
            @endif

            <!-- Quick Actions -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h6>
                </div>
                <div class="list-group list-group-flush">
                    @if($referral->status == 'pending')
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-check-circle text-success me-3"></i>
                            <span>Mark as Completed</span>
                        </a>
                    @endif
                    <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="fas fa-envelope text-primary me-3"></i>
                        <span>Send Notification</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="fas fa-dollar-sign text-success me-3"></i>
                        <span>Process Reward</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Column - Details -->
        <div class="col-lg-8">
            <!-- Stats Row -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="stat-card stat-card-success h-100">
                        <div class="stat-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stat-value">${{ number_format($referral->reward_earned, 2) }}</div>
                        <div class="stat-label">Reward Earned</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card stat-card-primary h-100">
                        <div class="stat-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="stat-value">{{ $referral->referrer->name ?? 'N/A' }}</div>
                        <div class="stat-label">Referrer</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card stat-card-info h-100">
                        <div class="stat-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="stat-value">{{ $referral->referred->name ?? 'N/A' }}</div>
                        <div class="stat-label">Referred</div>
                    </div>
                </div>
            </div>

            <!-- Referral Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Referral Information</h6>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Referral ID</span>
                            <span class="detail-value">#{{ $referral->id }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Status</span>
                            <span class="detail-value">
                                @if($referral->status == 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Reward Earned</span>
                            <span class="detail-value text-success fw-bold">${{ number_format($referral->reward_earned, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Referrer Details -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-user me-2"></i>Referrer Details</h6>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Name</span>
                            <span class="detail-value">{{ $referral->referrer->name ?? 'N/A' }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Email</span>
                            <span class="detail-value">{{ $referral->referrer->email ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Referred User Details -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-user-plus me-2"></i>Referred User Details</h6>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Name</span>
                            <span class="detail-value">{{ $referral->referred->name ?? 'N/A' }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Email</span>
                            <span class="detail-value">{{ $referral->referred->email ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Timestamps -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-clock me-2"></i>Timestamps</h6>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Created At</span>
                            <span class="detail-value">{{ $referral->created_at->format('M d, Y \a\t H:i') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Updated At</span>
                            <span class="detail-value">{{ $referral->updated_at->format('M d, Y \a\t H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <a href="{{ route('admin.referrals.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Referrals
            </a>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle text-danger me-2"></i>Delete Referral
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this referral?</p>
                    <div class="bg-light rounded p-3">
                        <strong>Referral:</strong> #{{ $referral->id }}<br>
                        <strong>Referrer:</strong> {{ $referral->referrer->name ?? 'N/A' }}<br>
                        <strong>Referred:</strong> {{ $referral->referred->name ?? 'N/A' }}<br>
                        <strong>Reward:</strong> ${{ number_format($referral->reward_earned, 2) }}
                    </div>
                    <p class="text-danger mt-3 mb-0"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.referrals.destroy', $referral) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i> Delete Referral
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function confirmDelete() {
            var modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }
    </script>
    @endpush
</x-admin-layout>