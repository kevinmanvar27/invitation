{{-- Admin Design Show - Admin Panel --}}
{{-- Bootstrap 5 + custom admin theme --}}

<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.designs.index') }}">Designs</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $design->design_name }}</li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <div class="row g-4">
        <!-- Design Info Card -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-palette me-2"></i>Design Information
                    </h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.designs.edit', $design->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <form action="{{ route('admin.designs.destroy', $design->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this design?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash me-1"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label text-muted">Design Name</label>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0 fw-medium">{{ $design->design_name }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label text-muted">User</label>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0">
                                @if($design->user)
                                    <a href="{{ route('admin.users.show', $design->user->id) }}">{{ $design->user->name }}</a>
                                    <span class="text-muted">({{ $design->user->email }})</span>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label text-muted">Template</label>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0">
                                @if($design->template)
                                    <a href="{{ route('admin.templates.show', $design->template->id) }}">{{ $design->template->name }}</a>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label text-muted">Status</label>
                        </div>
                        <div class="col-md-8">
                            @if($design->status == 'published')
                                <span class="badge bg-success">Published</span>
                            @elseif($design->status == 'completed')
                                <span class="badge bg-info">Completed</span>
                            @else
                                <span class="badge bg-warning">Draft</span>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label text-muted">Completion</label>
                        </div>
                        <div class="col-md-8">
                            @if($design->is_completed)
                                <span class="badge bg-success"><i class="fas fa-check me-1"></i>Completed</span>
                            @else
                                <span class="badge bg-secondary"><i class="fas fa-clock me-1"></i>In Progress</span>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label text-muted">Created At</label>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0">
                                <i class="fas fa-calendar-alt me-2 text-muted"></i>
                                {{ $design->created_at->format('F d, Y \a\t h:i A') }}
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label text-muted">Last Updated</label>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0">
                                <i class="fas fa-clock me-2 text-muted"></i>
                                {{ $design->updated_at->format('F d, Y \a\t h:i A') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customization Card -->
            @if($design->customization)
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-sliders-h me-2"></i>Customization Details
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if($design->customization->bride_name)
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Bride Name</label>
                            <p class="mb-0 fw-medium">{{ $design->customization->bride_name }}</p>
                        </div>
                        @endif
                        @if($design->customization->groom_name)
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Groom Name</label>
                            <p class="mb-0 fw-medium">{{ $design->customization->groom_name }}</p>
                        </div>
                        @endif
                        @if($design->customization->wedding_date)
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Wedding Date</label>
                            <p class="mb-0 fw-medium">{{ $design->customization->wedding_date->format('F d, Y') }}</p>
                        </div>
                        @endif
                        @if($design->customization->venue)
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Venue</label>
                            <p class="mb-0 fw-medium">{{ $design->customization->venue }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Thumbnail Card -->
            @if($design->thumbnail_path)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-image me-2"></i>Preview
                    </h5>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset($design->thumbnail_path) }}" alt="{{ $design->design_name }}" class="img-fluid rounded" style="max-height: 300px;">
                </div>
            </div>
            @endif

            <!-- Stats Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2"></i>Statistics
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Shared Invitations</span>
                        <span class="badge bg-primary">{{ $design->sharedInvitations->count() }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Downloads</span>
                        <span class="badge bg-info">{{ $design->downloads->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt me-2"></i>Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.designs.edit', $design->id) }}" class="btn btn-outline-primary">
                            <i class="fas fa-edit me-2"></i>Edit Design
                        </a>
                        <a href="{{ route('admin.designs.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
