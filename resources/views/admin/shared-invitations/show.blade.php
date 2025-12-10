<x-admin-layout>
    <!-- Page Header -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.shared-invitations.index') }}">Shared Invitations</a></li>
                    <li class="breadcrumb-item active">Details</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <!-- Left Column - Profile & Related -->
        <div class="col-lg-4">
            <!-- Profile Card -->
            <div class="card mb-4">
                <div class="card-body text-center">
                    <div class="avatar bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <h5 class="mb-1">Shared Invitation #{{ $sharedInvitation->id }}</h5>
                    <p class="text-muted mb-3">{{ $sharedInvitation->design->name ?? 'No Design' }}</p>
                    
                    <span class="badge bg-{{ $sharedInvitation->share_method == 'email' ? 'primary' : ($sharedInvitation->share_method == 'sms' ? 'success' : 'info') }} mb-3">
                        @if($sharedInvitation->share_method == 'email')
                            <i class="fas fa-envelope me-1"></i>
                        @elseif($sharedInvitation->share_method == 'sms')
                            <i class="fas fa-sms me-1"></i>
                        @else
                            <i class="fas fa-link me-1"></i>
                        @endif
                        {{ ucfirst($sharedInvitation->share_method) }}
                    </span>

                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('admin.shared-invitations.edit', $sharedInvitation->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                            <i class="fas fa-trash me-1"></i>Delete
                        </button>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <div class="row text-center">
                        <div class="col-6">
                            <small class="text-muted d-block">Created</small>
                            <strong>{{ $sharedInvitation->created_at->format('M d, Y') }}</strong>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Updated</small>
                            <strong>{{ $sharedInvitation->updated_at->format('M d, Y') }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Card -->
            @if($sharedInvitation->user)
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-user me-2"></i>Shared By</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar bg-info text-white d-flex align-items-center justify-content-center me-3">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0">{{ $sharedInvitation->user->name }}</h6>
                            <small class="text-muted">{{ $sharedInvitation->user->email }}</small>
                        </div>
                        <a href="{{ route('admin.users.show', $sharedInvitation->user->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <!-- Design Card -->
            @if($sharedInvitation->design)
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-palette me-2"></i>Design</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar bg-primary text-white d-flex align-items-center justify-content-center me-3">
                            <i class="fas fa-palette"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0">{{ $sharedInvitation->design->name }}</h6>
                            <small class="text-muted">Design ID: {{ $sharedInvitation->design->id }}</small>
                        </div>
                        <a href="{{ route('admin.designs.show', $sharedInvitation->design->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <!-- Quick Actions -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h6>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('admin.shared-invitations.edit', $sharedInvitation->id) }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-edit text-primary me-3"></i>
                            <span>Edit Invitation</span>
                        </a>
                        @if($sharedInvitation->design)
                        <a href="{{ route('admin.designs.show', $sharedInvitation->design->id) }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-palette text-info me-3"></i>
                            <span>View Design</span>
                        </a>
                        @endif
                        @if($sharedInvitation->user)
                        <a href="{{ route('admin.users.show', $sharedInvitation->user->id) }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-user text-success me-3"></i>
                            <span>View User</span>
                        </a>
                        @endif
                        @if($sharedInvitation->share_token)
                        <button type="button" class="list-group-item list-group-item-action d-flex align-items-center" onclick="copyToken()">
                            <i class="fas fa-copy text-warning me-3"></i>
                            <span>Copy Share Token</span>
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Details -->
        <div class="col-lg-8">
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="stat-card stat-card-primary">
                        <div class="stat-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="stat-value">{{ number_format($sharedInvitation->view_count) }}</div>
                        <div class="stat-label">Views</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-card-success">
                        <div class="stat-icon">
                            @if($sharedInvitation->share_method == 'email')
                                <i class="fas fa-envelope"></i>
                            @elseif($sharedInvitation->share_method == 'sms')
                                <i class="fas fa-sms"></i>
                            @else
                                <i class="fas fa-link"></i>
                            @endif
                        </div>
                        <div class="stat-value">{{ ucfirst($sharedInvitation->share_method) }}</div>
                        <div class="stat-label">Method</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-card-info">
                        <div class="stat-icon">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                        <div class="stat-value">{{ $sharedInvitation->sent_at ? 'Yes' : 'No' }}</div>
                        <div class="stat-label">Sent</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-card-warning">
                        <div class="stat-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-value">{{ $sharedInvitation->viewed_at ? 'Yes' : 'No' }}</div>
                        <div class="stat-label">Viewed</div>
                    </div>
                </div>
            </div>

            <!-- Share Token Card -->
            @if($sharedInvitation->share_token)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-key me-2"></i>Share Token</h5>
                </div>
                <div class="card-body">
                    <div class="input-group">
                        <input type="text" class="form-control font-monospace" id="shareToken" value="{{ $sharedInvitation->share_token }}" readonly>
                        <button class="btn btn-outline-primary" type="button" onclick="copyToken()">
                            <i class="fas fa-copy me-1"></i>Copy
                        </button>
                    </div>
                </div>
            </div>
            @endif

            <!-- Recipient Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-user-tag me-2"></i>Recipient Information</h5>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Recipient Email</span>
                            <span class="detail-value">
                                @if($sharedInvitation->recipient_email)
                                    <a href="mailto:{{ $sharedInvitation->recipient_email }}">{{ $sharedInvitation->recipient_email }}</a>
                                @else
                                    <span class="text-muted">Not provided</span>
                                @endif
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Recipient Phone</span>
                            <span class="detail-value">
                                @if($sharedInvitation->recipient_phone)
                                    <a href="tel:{{ $sharedInvitation->recipient_phone }}">{{ $sharedInvitation->recipient_phone }}</a>
                                @else
                                    <span class="text-muted">Not provided</span>
                                @endif
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Share Method</span>
                            <span class="detail-value">
                                <span class="badge bg-{{ $sharedInvitation->share_method == 'email' ? 'primary' : ($sharedInvitation->share_method == 'sms' ? 'success' : 'info') }}">
                                    {{ ucfirst($sharedInvitation->share_method) }}
                                </span>
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">View Count</span>
                            <span class="detail-value">{{ number_format($sharedInvitation->view_count) }} views</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Timestamps -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Timestamps</h5>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Sent At</span>
                            <span class="detail-value">
                                @if($sharedInvitation->sent_at)
                                    {{ $sharedInvitation->sent_at->format('F d, Y \a\t h:i A') }}
                                    <span class="badge bg-success ms-2">Sent</span>
                                @else
                                    <span class="text-muted">Not sent yet</span>
                                @endif
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">First Viewed At</span>
                            <span class="detail-value">
                                @if($sharedInvitation->viewed_at)
                                    {{ $sharedInvitation->viewed_at->format('F d, Y \a\t h:i A') }}
                                    <span class="badge bg-info ms-2">Viewed</span>
                                @else
                                    <span class="text-muted">Not viewed yet</span>
                                @endif
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Created At</span>
                            <span class="detail-value">{{ $sharedInvitation->created_at->format('F d, Y \a\t h:i A') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Last Updated</span>
                            <span class="detail-value">{{ $sharedInvitation->updated_at->format('F d, Y \a\t h:i A') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <a href="{{ route('admin.shared-invitations.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Shared Invitations
            </a>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle text-danger me-2"></i>Confirm Delete
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this shared invitation?</p>
                    <div class="alert alert-warning">
                        <strong>Shared Invitation #{{ $sharedInvitation->id }}</strong><br>
                        Design: {{ $sharedInvitation->design->name ?? 'N/A' }}<br>
                        Method: {{ ucfirst($sharedInvitation->share_method) }}<br>
                        Views: {{ number_format($sharedInvitation->view_count) }}
                    </div>
                    <p class="text-danger mb-0"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.shared-invitations.destroy', $sharedInvitation->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i>Delete
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

        function copyToken() {
            var tokenInput = document.getElementById('shareToken');
            tokenInput.select();
            tokenInput.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(tokenInput.value);
            
            // Show feedback
            var btn = event.target.closest('button');
            var originalHtml = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check me-1"></i>Copied!';
            btn.classList.remove('btn-outline-primary');
            btn.classList.add('btn-success');
            
            setTimeout(function() {
                btn.innerHTML = originalHtml;
                btn.classList.remove('btn-success');
                btn.classList.add('btn-outline-primary');
            }, 2000);
        }
    </script>
    @endpush
</x-admin-layout>