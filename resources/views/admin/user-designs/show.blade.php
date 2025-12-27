<x-admin-layout>
    <x-slot name="title">User Design Details</x-slot>
    <x-slot name="page_title">User Design Details</x-slot>

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.user-designs.index') }}">User Designs</a></li>
                    <li class="breadcrumb-item active">{{ $design->design_name ?? 'Design #' . $design->id }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <!-- Left Column - Profile Card -->
        <div class="col-lg-4 mb-4">
            <!-- Main Design Card -->
            <div class="card">
                <div class="card-body text-center">
                    @if($design->thumbnail_path)
                        <img src="{{ asset($design->thumbnail_path) }}" alt="Design Thumbnail" 
                             class="rounded mb-3 shadow-sm" style="max-width: 150px; max-height: 150px; object-fit: cover;">
                    @else
                        <div class="avatar mx-auto mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #ff6b6b, #ee5a5a);">
                            <i class="fas fa-paint-brush fa-2x text-white"></i>
                        </div>
                    @endif
                    <h5 class="mb-1">{{ $design->design_name ?? 'Unnamed Design' }}</h5>
                    <p class="text-muted mb-3">Design #{{ $design->id }}</p>
                    
                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        @if($design->is_completed)
                            <span class="badge bg-success">Completed</span>
                        @else
                            <span class="badge bg-warning">In Progress</span>
                        @endif
                        
                        @if($design->status)
                            <span class="badge bg-info">{{ ucfirst($design->status) }}</span>
                        @endif
                    </div>
                    
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <a href="{{ route('admin.user-designs.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Back
                        </a>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row text-center">
                        <div class="col-6 border-end">
                            <small class="text-muted d-block">Created</small>
                            <strong>{{ $design->created_at->format('M d, Y') }}</strong>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Updated</small>
                            <strong>{{ $design->updated_at->format('M d, Y') }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Associated User Card -->
            @if($design->user)
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
                            <h6 class="mb-0">{{ $design->user->name }}</h6>
                            <small class="text-muted">{{ $design->user->email }}</small>
                        </div>
                        <a href="{{ route('admin.users.show', $design->user->id) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <!-- Associated Category Card -->
            @if($design->category)
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-folder me-2"></i>Category</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar me-3" style="width: 50px; height: 50px; background: linear-gradient(135deg, #5eaa6a, #4a9a5a);">
                            <i class="fas fa-folder text-white"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0">{{ $design->category->name ?? 'Unnamed Category' }}</h6>
                            <small class="text-muted">Category #{{ $design->category->id }}</small>
                        </div>
                        <a href="{{ route('admin.categories.show', $design->category->id) }}" class="btn btn-outline-primary btn-sm">
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
                        @if($design->user)
                        <a href="{{ route('admin.users.show', $design->user->id) }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-user me-2 text-info"></i>View User
                        </a>
                        @endif
                        @if($design->category)
                        <a href="{{ route('admin.categories.show', $design->category->id) }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-folder me-2 text-success"></i>View Category
                        </a>
                        @endif
                        <a href="{{ route('admin.user-designs.index') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-list me-2 text-secondary"></i>All User Designs
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
                            <i class="fas fa-download"></i>
                        </div>
                        <div class="stat-value">{{ $design->downloads->count() }}</div>
                        <div class="stat-label">Downloads</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-card-success">
                        <div class="stat-icon">
                            <i class="fas fa-print"></i>
                        </div>
                        <div class="stat-value">{{ $design->printOrders->count() }}</div>
                        <div class="stat-label">Print Orders</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-card-info">
                        <div class="stat-icon">
                            <i class="fas fa-share-alt"></i>
                        </div>
                        <div class="stat-value">{{ $design->sharedInvitations->count() }}</div>
                        <div class="stat-label">Shared</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-card-warning">
                        <div class="stat-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-value">{{ $design->is_completed ? 'Yes' : 'No' }}</div>
                        <div class="stat-label">Completed</div>
                    </div>
                </div>
            </div>

            <!-- Basic Information Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Basic Information</h5>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Design ID</span>
                            <span class="detail-value">#{{ $design->id }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Design Name</span>
                            <span class="detail-value">{{ $design->design_name ?? 'Unnamed' }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">User</span>
                            <span class="detail-value">{{ $design->user->name ?? 'N/A' }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Category</span>
                            <span class="detail-value">{{ $design->category->name ?? 'N/A' }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Status</span>
                            <span class="detail-value">
                                <span class="badge bg-{{ $design->status === 'active' ? 'success' : ($design->status === 'draft' ? 'warning' : 'secondary') }}">
                                    {{ ucfirst($design->status ?? 'Unknown') }}
                                </span>
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Completed</span>
                            <span class="detail-value">
                                @if($design->is_completed)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-warning">No</span>
                                @endif
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Thumbnail</span>
                            <span class="detail-value">
                                @if($design->thumbnail_path)
                                    <span class="badge bg-success">Uploaded</span>
                                    <small class="text-muted d-block">{{ $design->thumbnail_path }}</small>
                                @else
                                    <span class="badge bg-secondary">Not uploaded</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thumbnail Preview Card (if exists) -->
            @if($design->thumbnail_path)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-image me-2"></i>Thumbnail Preview</h5>
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset($design->thumbnail_path) }}" alt="Design Thumbnail" 
                         class="img-fluid rounded shadow" style="max-height: 300px;">
                    <p class="text-muted mt-2 mb-0">
                        <small>{{ $design->thumbnail_path }}</small>
                    </p>
                </div>
            </div>
            @endif

            <!-- Canvas Data Card -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-code me-2"></i>Canvas Data</h5>
                    @if($design->canvas_data)
                        <span class="badge bg-info">JSON</span>
                    @endif
                </div>
                <div class="card-body">
                    @if($design->canvas_data)
                        <pre class="bg-light p-3 rounded mb-0" style="max-height: 400px; overflow: auto;"><code>{{ json_encode($design->canvas_data, JSON_PRETTY_PRINT) }}</code></pre>
                    @else
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-code fa-3x mb-3 opacity-50"></i>
                            <p class="mb-0">No canvas data available</p>
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
                                {{ $design->created_at->format('F d, Y \a\t h:i A') }}
                                <small class="text-muted">({{ $design->created_at->diffForHumans() }})</small>
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Last Updated</span>
                            <span class="detail-value">
                                {{ $design->updated_at->format('F d, Y \a\t h:i A') }}
                                <small class="text-muted">({{ $design->updated_at->diffForHumans() }})</small>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <a href="{{ route('admin.user-designs.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Back to User Designs
            </a>
        </div>
    </div>
</x-admin-layout>