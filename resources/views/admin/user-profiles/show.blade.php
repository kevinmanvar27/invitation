<x-admin-layout>
    <x-slot name="title">User Profile Details</x-slot>
    <x-slot name="page_title">User Profile Details</x-slot>

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.user-profiles.index') }}">User Profiles</a></li>
                    <li class="breadcrumb-item active">Profile #{{ $userProfile->id }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <!-- Left Column - Profile Card -->
        <div class="col-lg-4 mb-4">
            <!-- Main Profile Card -->
            <div class="card">
                <div class="card-body text-center">
                    @if($userProfile->profile_picture)
                        <img src="{{ asset($userProfile->profile_picture) }}" alt="Profile Picture" 
                             class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover;">
                    @else
                        <div class="avatar mx-auto mb-3" style="width: 100px; height: 100px; background: linear-gradient(135deg, #17a2b8, #138496);">
                            <i class="fas fa-id-card fa-2x text-white"></i>
                        </div>
                    @endif
                    <h5 class="mb-1">{{ $userProfile->user->name ?? 'Unknown User' }}</h5>
                    <p class="text-muted mb-3">Profile #{{ $userProfile->id }}</p>
                    
                    @if($userProfile->wedding_date)
                        @if($userProfile->wedding_date->isPast())
                            <span class="badge bg-secondary">Wedding Passed</span>
                        @elseif($userProfile->wedding_date->diffInDays(now()) <= 30)
                            <span class="badge bg-warning">Wedding Soon</span>
                        @else
                            <span class="badge bg-success">Upcoming Wedding</span>
                        @endif
                    @else
                        <span class="badge bg-info">No Date Set</span>
                    @endif
                    
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <a href="{{ route('admin.user-profiles.edit', $userProfile->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete()">
                            <i class="fas fa-trash me-1"></i>Delete
                        </button>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row text-center">
                        <div class="col-6 border-end">
                            <small class="text-muted d-block">Created</small>
                            <strong>{{ $userProfile->created_at->format('M d, Y') }}</strong>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Updated</small>
                            <strong>{{ $userProfile->updated_at->format('M d, Y') }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Associated User Card -->
            @if($userProfile->user)
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-user me-2"></i>Associated User</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #6c757d, #495057);">
                            <i class="fas fa-user text-white"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0">{{ $userProfile->user->name }}</h6>
                            <small class="text-muted">{{ $userProfile->user->email }}</small>
                        </div>
                        <a href="{{ route('admin.users.show', $userProfile->user->id) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <!-- Quick Actions Card -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h6>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('admin.user-profiles.edit', $userProfile->id) }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-edit me-2 text-primary"></i>Edit Profile
                        </a>
                        @if($userProfile->user)
                        <a href="{{ route('admin.users.show', $userProfile->user->id) }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-user me-2 text-info"></i>View User Account
                        </a>
                        @endif
                        <a href="{{ route('admin.user-profiles.create') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-plus me-2 text-success"></i>Create New Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Details -->
        <div class="col-lg-8">
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="stat-card stat-card-primary">
                        <div class="stat-icon">
                            <i class="fas fa-hashtag"></i>
                        </div>
                        <div class="stat-value">{{ $userProfile->id }}</div>
                        <div class="stat-label">Profile ID</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card stat-card-success">
                        <div class="stat-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="stat-value">
                            @if($userProfile->wedding_date)
                                {{ $userProfile->wedding_date->diffInDays(now()) }}
                            @else
                                --
                            @endif
                        </div>
                        <div class="stat-label">Days {{ $userProfile->wedding_date && $userProfile->wedding_date->isPast() ? 'Since' : 'Until' }} Wedding</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card stat-card-info">
                        <div class="stat-icon">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div class="stat-value">
                            {{ $userProfile->preferences ? count((array)$userProfile->preferences) : 0 }}
                        </div>
                        <div class="stat-label">Preferences Set</div>
                    </div>
                </div>
            </div>

            <!-- Wedding Information Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-heart me-2 text-danger"></i>Wedding Information</h5>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Partner Name</span>
                            <span class="detail-value">{{ $userProfile->partner_name ?? 'Not specified' }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Wedding Date</span>
                            <span class="detail-value">
                                @if($userProfile->wedding_date)
                                    {{ $userProfile->wedding_date->format('F d, Y') }}
                                    <small class="text-muted">({{ $userProfile->wedding_date->diffForHumans() }})</small>
                                @else
                                    <span class="text-muted">Not set</span>
                                @endif
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Couple</span>
                            <span class="detail-value">
                                {{ $userProfile->user->name ?? 'Unknown' }}
                                @if($userProfile->partner_name)
                                    <i class="fas fa-heart text-danger mx-2"></i>
                                    {{ $userProfile->partner_name }}
                                @endif
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Profile Picture</span>
                            <span class="detail-value">
                                @if($userProfile->profile_picture)
                                    <span class="badge bg-success">Uploaded</span>
                                @else
                                    <span class="badge bg-secondary">Not uploaded</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Picture Card (if exists) -->
            @if($userProfile->profile_picture)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-camera me-2"></i>Profile Picture</h5>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset($userProfile->profile_picture) }}" alt="Profile Picture" 
                         class="img-fluid rounded shadow" style="max-height: 300px;">
                    <p class="text-muted mt-2 mb-0">
                        <small>{{ $userProfile->profile_picture }}</small>
                    </p>
                </div>
            </div>
            @endif

            <!-- Preferences Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-cog me-2"></i>Preferences</h5>
                </div>
                <div class="card-body">
                    @php
                        $preferences = $userProfile->preferences;
                        if (is_string($preferences)) {
                            $preferences = json_decode($preferences, true);
                        }
                    @endphp
                    @if($preferences && is_array($preferences) && count($preferences) > 0)
                        <div class="detail-grid">
                            @foreach($preferences as $key => $value)
                                <div class="detail-item">
                                    <span class="detail-label">{{ ucfirst(str_replace('_', ' ', $key)) }}</span>
                                    <span class="detail-value">
                                        @if(is_array($value))
                                            <code>{{ json_encode($value) }}</code>
                                        @elseif(is_bool($value))
                                            <span class="badge {{ $value ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $value ? 'Yes' : 'No' }}
                                            </span>
                                        @else
                                            {{ $value }}
                                        @endif
                                    </span>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Raw JSON -->
                        <hr class="my-3">
                        <h6 class="text-muted mb-2">Raw JSON</h6>
                        <pre class="bg-light p-3 rounded mb-0" style="max-height: 200px; overflow-y: auto;"><code>{{ json_encode($preferences, JSON_PRETTY_PRINT) }}</code></pre>
                    @else
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-cog fa-3x mb-3 opacity-50"></i>
                            <p class="mb-0">No preferences set</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Timestamps Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Timestamps</h5>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Created At</span>
                            <span class="detail-value">
                                {{ $userProfile->created_at->format('F d, Y \a\t h:i A') }}
                                <small class="text-muted">({{ $userProfile->created_at->diffForHumans() }})</small>
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Last Updated</span>
                            <span class="detail-value">
                                {{ $userProfile->updated_at->format('F d, Y \a\t h:i A') }}
                                <small class="text-muted">({{ $userProfile->updated_at->diffForHumans() }})</small>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <a href="{{ route('admin.user-profiles.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Back to User Profiles
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
                    <p>Are you sure you want to delete this user profile?</p>
                    <div class="alert alert-warning">
                        <strong>Profile #{{ $userProfile->id }}</strong><br>
                        User: {{ $userProfile->user->name ?? 'Unknown' }}<br>
                        @if($userProfile->partner_name)
                            Partner: {{ $userProfile->partner_name }}
                        @endif
                    </div>
                    <p class="text-danger mb-0"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.user-profiles.destroy', $userProfile->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i>Delete Profile
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