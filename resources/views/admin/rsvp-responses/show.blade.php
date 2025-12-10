<x-admin-layout>
    <x-slot name="title">RSVP Response Details</x-slot>

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.rsvp-responses.index') }}">RSVP Responses</a></li>
                    <li class="breadcrumb-item active">{{ $rsvpResponse->guest_name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <!-- Left Column - Profile Card -->
        <div class="col-lg-4 mb-4">
            <!-- Response Profile Card -->
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar mx-auto mb-3 {{ $rsvpResponse->response === 'yes' ? 'bg-success' : ($rsvpResponse->response === 'no' ? 'bg-danger' : 'bg-warning') }} bg-opacity-10 {{ $rsvpResponse->response === 'yes' ? 'text-success' : ($rsvpResponse->response === 'no' ? 'text-danger' : 'text-warning') }}" style="width: 80px; height: 80px; font-size: 2rem;">
                        <i class="fas {{ $rsvpResponse->response === 'yes' ? 'fa-check' : ($rsvpResponse->response === 'no' ? 'fa-times' : 'fa-question') }}"></i>
                    </div>
                    <h5 class="mb-1">{{ $rsvpResponse->guest_name }}</h5>
                    <p class="text-muted mb-2">{{ $rsvpResponse->guest_email ?? 'No email provided' }}</p>
                    @if($rsvpResponse->response === 'yes')
                        <span class="badge bg-success mb-3">Attending</span>
                    @elseif($rsvpResponse->response === 'no')
                        <span class="badge bg-danger mb-3">Not Attending</span>
                    @else
                        <span class="badge bg-warning mb-3">Maybe</span>
                    @endif
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="{{ route('admin.rsvp-responses.edit', $rsvpResponse->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                        <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                            <i class="fas fa-trash me-1"></i> Delete
                        </button>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row text-center">
                        <div class="col-6">
                            <small class="text-muted d-block">Created</small>
                            <strong>{{ $rsvpResponse->created_at->format('M d, Y') }}</strong>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Responded</small>
                            <strong>{{ $rsvpResponse->responded_at ? $rsvpResponse->responded_at->format('M d, Y') : 'N/A' }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shared Invitation Card -->
            @if($rsvpResponse->sharedInvitation)
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-envelope-open me-2"></i>Shared Invitation</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar bg-info bg-opacity-10 text-info me-3">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0">Invitation #{{ $rsvpResponse->sharedInvitation->id }}</h6>
                            <small class="text-muted">{{ $rsvpResponse->sharedInvitation->user->name ?? 'N/A' }}</small>
                        </div>
                        <a href="{{ route('admin.shared-invitations.show', $rsvpResponse->sharedInvitation->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <!-- Quick Actions -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h6>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('admin.rsvp-responses.edit', $rsvpResponse->id) }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-edit text-primary me-2"></i> Edit Response
                        </a>
                        @if($rsvpResponse->guest_email)
                        <a href="mailto:{{ $rsvpResponse->guest_email }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-envelope text-info me-2"></i> Send Email
                        </a>
                        @endif
                        @if($rsvpResponse->guest_phone)
                        <a href="tel:{{ $rsvpResponse->guest_phone }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-phone text-success me-2"></i> Call Guest
                        </a>
                        @endif
                        @if($rsvpResponse->sharedInvitation)
                        <a href="{{ route('admin.shared-invitations.show', $rsvpResponse->sharedInvitation->id) }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-envelope-open text-warning me-2"></i> View Invitation
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Details -->
        <div class="col-lg-8">
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="stat-card {{ $rsvpResponse->response === 'yes' ? 'stat-card-success' : ($rsvpResponse->response === 'no' ? 'stat-card-danger' : 'stat-card-warning') }}">
                        <div class="stat-icon">
                            <i class="fas {{ $rsvpResponse->response === 'yes' ? 'fa-check-circle' : ($rsvpResponse->response === 'no' ? 'fa-times-circle' : 'fa-question-circle') }}"></i>
                        </div>
                        <div class="stat-value">{{ ucfirst($rsvpResponse->response) }}</div>
                        <div class="stat-label">Response</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card stat-card-primary">
                        <div class="stat-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="stat-value">{{ $rsvpResponse->plus_ones_count }}</div>
                        <div class="stat-label">Plus Ones</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card stat-card-info">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-value">{{ $rsvpResponse->plus_ones_count + 1 }}</div>
                        <div class="stat-label">Total Guests</div>
                    </div>
                </div>
            </div>

            <!-- Guest Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-user me-2"></i>Guest Information</h6>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Guest Name</span>
                            <span class="detail-value">{{ $rsvpResponse->guest_name }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Email</span>
                            <span class="detail-value">
                                @if($rsvpResponse->guest_email)
                                    <a href="mailto:{{ $rsvpResponse->guest_email }}">{{ $rsvpResponse->guest_email }}</a>
                                @else
                                    <span class="text-muted">Not provided</span>
                                @endif
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Phone</span>
                            <span class="detail-value">
                                @if($rsvpResponse->guest_phone)
                                    <a href="tel:{{ $rsvpResponse->guest_phone }}">{{ $rsvpResponse->guest_phone }}</a>
                                @else
                                    <span class="text-muted">Not provided</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Response Details -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-check-circle me-2"></i>Response Details</h6>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Response</span>
                            <span class="detail-value">
                                @if($rsvpResponse->response === 'yes')
                                    <span class="badge bg-success">Yes - Attending</span>
                                @elseif($rsvpResponse->response === 'no')
                                    <span class="badge bg-danger">No - Not Attending</span>
                                @else
                                    <span class="badge bg-warning">Maybe - Undecided</span>
                                @endif
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Plus Ones</span>
                            <span class="detail-value">{{ $rsvpResponse->plus_ones_count }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Responded At</span>
                            <span class="detail-value">{{ $rsvpResponse->responded_at ? $rsvpResponse->responded_at->format('F d, Y \a\t h:i A') : 'Not recorded' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preferences -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-utensils me-2"></i>Preferences</h6>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Meal Preference</span>
                            <span class="detail-value">{{ $rsvpResponse->meal_preference ?? 'Not specified' }}</span>
                        </div>
                    </div>
                    @if($rsvpResponse->special_requests)
                    <div class="mt-3">
                        <label class="form-label text-muted">Special Requests</label>
                        <div class="bg-light p-3 rounded">
                            {{ $rsvpResponse->special_requests }}
                        </div>
                    </div>
                    @endif
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
                            <span class="detail-value">{{ $rsvpResponse->created_at->format('F d, Y \a\t h:i A') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Last Updated</span>
                            <span class="detail-value">{{ $rsvpResponse->updated_at->format('F d, Y \a\t h:i A') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <a href="{{ route('admin.rsvp-responses.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to RSVP Responses
            </a>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this RSVP response?</p>
                    <div class="bg-light p-3 rounded">
                        <strong>{{ $rsvpResponse->guest_name }}</strong><br>
                        <small class="text-muted">Response: {{ ucfirst($rsvpResponse->response) }}</small>
                    </div>
                    <div class="alert alert-warning mt-3 mb-0">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        This action cannot be undone.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.rsvp-responses.destroy', $rsvpResponse->id) }}" method="POST" class="d-inline">
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
            var modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }
    </script>
    @endpush
</x-admin-layout>