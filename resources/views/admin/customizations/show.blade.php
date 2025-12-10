{{-- Admin Customization Show - Admin Panel --}}
{{-- Bootstrap 5 + custom admin theme --}}

<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.customizations.index') }}">Customizations</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        @if($customization->bride_name && $customization->groom_name)
                            {{ $customization->bride_name }} & {{ $customization->groom_name }}
                        @else
                            Customization #{{ $customization->id }}
                        @endif
                    </li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <div class="row g-4">
        <!-- Main Info Card -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-sliders-h me-2"></i>Customization Information
                    </h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.customizations.edit', $customization->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <form action="{{ route('admin.customizations.destroy', $customization->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this customization?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash me-1"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Association Info -->
                    <h6 class="text-muted mb-3"><i class="fas fa-link me-2"></i>Association</h6>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label text-muted">Design</label>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0">
                                @if($customization->design)
                                    <a href="{{ route('admin.designs.show', $customization->design->id) }}">{{ $customization->design->design_name }}</a>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label text-muted">User</label>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0">
                                @if($customization->user)
                                    <a href="{{ route('admin.users.show', $customization->user->id) }}">{{ $customization->user->name }}</a>
                                    <span class="text-muted">({{ $customization->user->email }})</span>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <!-- Couple Information -->
                    <h6 class="text-muted mb-3"><i class="fas fa-heart me-2"></i>Couple Information</h6>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label text-muted">Bride Name</label>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0 fw-medium">{{ $customization->bride_name ?? 'Not set' }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label text-muted">Groom Name</label>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0 fw-medium">{{ $customization->groom_name ?? 'Not set' }}</p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <!-- Wedding Details -->
                    <h6 class="text-muted mb-3"><i class="fas fa-calendar-alt me-2"></i>Wedding Details</h6>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label text-muted">Wedding Date</label>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0">
                                @if($customization->wedding_date)
                                    <i class="fas fa-calendar me-2 text-muted"></i>{{ $customization->wedding_date->format('F d, Y') }}
                                @else
                                    <span class="text-muted">Not set</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label text-muted">Wedding Time</label>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0">
                                @if($customization->wedding_time)
                                    <i class="fas fa-clock me-2 text-muted"></i>{{ is_string($customization->wedding_time) ? $customization->wedding_time : $customization->wedding_time->format('h:i A') }}
                                @else
                                    <span class="text-muted">Not set</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label text-muted">Venue</label>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0">
                                @if($customization->venue)
                                    <i class="fas fa-map-marker-alt me-2 text-muted"></i>{{ $customization->venue }}
                                @else
                                    <span class="text-muted">Not set</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <!-- Style Settings -->
                    <h6 class="text-muted mb-3"><i class="fas fa-paint-brush me-2"></i>Style Settings</h6>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label text-muted">Language</label>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0">
                                <span class="badge bg-secondary">{{ strtoupper($customization->language ?? 'EN') }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label text-muted">Wording Style</label>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0">{{ ucfirst($customization->wording_style ?? 'Not set') }}</p>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <!-- RSVP Settings -->
                    <h6 class="text-muted mb-3"><i class="fas fa-envelope-open-text me-2"></i>RSVP Settings</h6>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label text-muted">RSVP Status</label>
                        </div>
                        <div class="col-md-8">
                            @if($customization->rsvp_enabled)
                                <span class="badge bg-success"><i class="fas fa-check me-1"></i>Enabled</span>
                            @else
                                <span class="badge bg-secondary"><i class="fas fa-times me-1"></i>Disabled</span>
                            @endif
                        </div>
                    </div>
                    @if($customization->rsvp_deadline)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label text-muted">RSVP Deadline</label>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0">
                                <i class="fas fa-calendar-times me-2 text-muted"></i>{{ $customization->rsvp_deadline->format('F d, Y') }}
                            </p>
                        </div>
                    </div>
                    @endif
                    
                    <hr>
                    
                    <!-- Timestamps -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label text-muted">Created At</label>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0">
                                <i class="fas fa-calendar-alt me-2 text-muted"></i>
                                {{ $customization->created_at->format('F d, Y \a\t h:i A') }}
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label text-muted">Last Updated</label>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0">
                                <i class="fas fa-clock me-2 text-muted"></i>
                                {{ $customization->updated_at->format('F d, Y \a\t h:i A') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt me-2"></i>Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.customizations.edit', $customization->id) }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit me-2"></i>Edit Customization
                        </a>
                        @if($customization->design)
                        <a href="{{ route('admin.designs.show', $customization->design->id) }}" class="btn btn-outline-info">
                            <i class="fas fa-palette me-2"></i>View Design
                        </a>
                        @endif
                        <a href="{{ route('admin.customizations.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
