<x-admin-layout>
    <x-slot name="title">User Customization Details</x-slot>
    <x-slot name="page_title">User Customization Details</x-slot>

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.user-customizations.index') }}">User Customizations</a></li>
                    <li class="breadcrumb-item active">Customization #{{ $customization->id }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <!-- Left Column - Profile Card -->
        <div class="col-lg-4 mb-4">
            <!-- Main Customization Card -->
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar mx-auto mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #6f42c1, #5a32a3);">
                        <i class="fas fa-sliders-h fa-2x text-white"></i>
                    </div>
                    <h5 class="mb-1">
                        {{ $customization->bride_name ?? 'Bride' }} & {{ $customization->groom_name ?? 'Groom' }}
                    </h5>
                    <p class="text-muted mb-3">Customization #{{ $customization->id }}</p>
                    
                    @if($customization->rsvp_enabled)
                        <span class="badge bg-success">RSVP Enabled</span>
                    @else
                        <span class="badge bg-secondary">RSVP Disabled</span>
                    @endif
                    
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <a href="{{ route('admin.user-customizations.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Back
                        </a>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row text-center">
                        <div class="col-6 border-end">
                            <small class="text-muted d-block">Created</small>
                            <strong>{{ $customization->created_at->format('M d, Y') }}</strong>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Updated</small>
                            <strong>{{ $customization->updated_at->format('M d, Y') }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Associated User Card -->
            @if($customization->user)
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-user me-2"></i>User</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #6c757d, #495057);">
                            <i class="fas fa-user text-white"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0">{{ $customization->user->name }}</h6>
                            <small class="text-muted">{{ $customization->user->email }}</small>
                        </div>
                        <a href="{{ route('admin.users.show', $customization->user->id) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <!-- Associated Design Card -->
            @if($customization->design)
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-palette me-2"></i>Design</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #ff6b6b, #ee5a5a);">
                            <i class="fas fa-palette text-white"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0">{{ $customization->design->design_name ?? 'Unnamed Design' }}</h6>
                            <small class="text-muted">Design #{{ $customization->design->id }}</small>
                        </div>
                        <a href="{{ route('admin.designs.show', $customization->design->id) }}" class="btn btn-outline-primary btn-sm">
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
                        @if($customization->user)
                        <a href="{{ route('admin.users.show', $customization->user->id) }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-user me-2 text-info"></i>View User
                        </a>
                        @endif
                        @if($customization->design)
                        <a href="{{ route('admin.designs.show', $customization->design->id) }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-palette me-2 text-danger"></i>View Design
                        </a>
                        @endif
                        <a href="{{ route('admin.user-customizations.index') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-list me-2 text-secondary"></i>All Customizations
                        </a>
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
                            <i class="fas fa-hashtag"></i>
                        </div>
                        <div class="stat-value">{{ $customization->id }}</div>
                        <div class="stat-label">Customization ID</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-card-success">
                        <div class="stat-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="stat-value">
                            @if($customization->wedding_date)
                                {{ $customization->wedding_date->format('M d') }}
                            @else
                                --
                            @endif
                        </div>
                        <div class="stat-label">Wedding Date</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-card-info">
                        <div class="stat-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="stat-value">
                            {{ $customization->rsvp_enabled ? 'Yes' : 'No' }}
                        </div>
                        <div class="stat-label">RSVP Enabled</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-card-warning">
                        <div class="stat-icon">
                            <i class="fas fa-globe"></i>
                        </div>
                        <div class="stat-value">{{ strtoupper($customization->language ?? 'EN') }}</div>
                        <div class="stat-label">Language</div>
                    </div>
                </div>
            </div>

            <!-- Wedding Details Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-heart me-2 text-danger"></i>Wedding Details</h5>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Bride Name</span>
                            <span class="detail-value">{{ $customization->bride_name ?? 'Not specified' }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Groom Name</span>
                            <span class="detail-value">{{ $customization->groom_name ?? 'Not specified' }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Wedding Date</span>
                            <span class="detail-value">
                                @if($customization->wedding_date)
                                    {{ $customization->wedding_date->format('F d, Y') }}
                                    <small class="text-muted">({{ $customization->wedding_date->diffForHumans() }})</small>
                                @else
                                    <span class="text-muted">Not set</span>
                                @endif
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Wedding Time</span>
                            <span class="detail-value">{{ $customization->wedding_time ?? 'Not specified' }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Venue</span>
                            <span class="detail-value">{{ $customization->venue ?? 'Not specified' }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Language</span>
                            <span class="detail-value">
                                <span class="badge bg-info">{{ strtoupper($customization->language ?? 'EN') }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Style & RSVP Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-paint-brush me-2"></i>Style & RSVP Settings</h5>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Wording Style</span>
                            <span class="detail-value">
                                @if($customization->wording_style)
                                    <span class="badge bg-primary">{{ ucfirst($customization->wording_style) }}</span>
                                @else
                                    <span class="text-muted">Default</span>
                                @endif
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">RSVP Enabled</span>
                            <span class="detail-value">
                                @if($customization->rsvp_enabled)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-secondary">No</span>
                                @endif
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">RSVP Deadline</span>
                            <span class="detail-value">
                                @if($customization->rsvp_deadline)
                                    {{ $customization->rsvp_deadline->format('F d, Y') }}
                                    @if($customization->rsvp_deadline->isPast())
                                        <span class="badge bg-danger ms-1">Passed</span>
                                    @else
                                        <small class="text-muted">({{ $customization->rsvp_deadline->diffForHumans() }})</small>
                                    @endif
                                @else
                                    <span class="text-muted">Not set</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Custom Text Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-quote-left me-2"></i>Custom Text</h5>
                </div>
                <div class="card-body">
                    @if($customization->custom_text)
                        @if(is_array($customization->custom_text))
                            <div class="detail-grid">
                                @foreach($customization->custom_text as $key => $text)
                                    <div class="detail-item">
                                        <span class="detail-label">{{ ucfirst(str_replace('_', ' ', $key)) }}</span>
                                        <span class="detail-value">{{ $text }}</span>
                                    </div>
                                @endforeach
                            </div>
                            
                            <!-- Raw JSON -->
                            <hr class="my-3">
                            <h6 class="text-muted mb-2">Raw JSON</h6>
                            <pre class="bg-light p-3 rounded mb-0" style="max-height: 200px; overflow-y: auto;"><code>{{ json_encode($customization->custom_text, JSON_PRETTY_PRINT) }}</code></pre>
                        @else
                            <p class="mb-0">{{ $customization->custom_text }}</p>
                        @endif
                    @else
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-quote-left fa-3x mb-3 opacity-50"></i>
                            <p class="mb-0">No custom text available</p>
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
                                {{ $customization->created_at->format('F d, Y \a\t h:i A') }}
                                <small class="text-muted">({{ $customization->created_at->diffForHumans() }})</small>
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Last Updated</span>
                            <span class="detail-value">
                                {{ $customization->updated_at->format('F d, Y \a\t h:i A') }}
                                <small class="text-muted">({{ $customization->updated_at->diffForHumans() }})</small>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <a href="{{ route('admin.user-customizations.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Back to User Customizations
            </a>
        </div>
    </div>
</x-admin-layout>