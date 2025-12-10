<x-admin-layout>
    <x-slot name="title">Design Element Details</x-slot>
    <x-slot name="page_title">Design Element Details</x-slot>

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.design-elements.index') }}">Design Elements</a></li>
                    <li class="breadcrumb-item active">{{ $designElement->name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <!-- Left Column - Profile Card -->
        <div class="col-lg-4 mb-4">
            <!-- Main Element Card -->
            <div class="card">
                <div class="card-body text-center">
                    @if($designElement->png_path)
                        <img src="{{ asset($designElement->png_path) }}" alt="{{ $designElement->name }}" 
                             class="mb-3" style="max-width: 100px; max-height: 100px; object-fit: contain;">
                    @elseif($designElement->svg_path)
                        <img src="{{ asset($designElement->svg_path) }}" alt="{{ $designElement->name }}" 
                             class="mb-3" style="max-width: 100px; max-height: 100px; object-fit: contain;">
                    @else
                        <div class="avatar mx-auto mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #6f42c1, #5a32a3);">
                            <i class="fas fa-shapes fa-2x text-white"></i>
                        </div>
                    @endif
                    <h5 class="mb-1">{{ $designElement->name }}</h5>
                    <p class="text-muted mb-3">Element #{{ $designElement->id }}</p>
                    
                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        <span class="badge bg-info">{{ ucfirst($designElement->type) }}</span>
                        @if($designElement->category)
                            <span class="badge bg-secondary">{{ $designElement->category }}</span>
                        @endif
                        @if($designElement->is_premium)
                            <span class="badge bg-warning"><i class="fas fa-crown me-1"></i>Premium</span>
                        @else
                            <span class="badge bg-success">Free</span>
                        @endif
                    </div>
                    
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <a href="{{ route('admin.design-elements.edit', $designElement->id) }}" class="btn btn-primary btn-sm">
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
                            <strong>{{ $designElement->created_at->format('M d, Y') }}</strong>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Updated</small>
                            <strong>{{ $designElement->updated_at->format('M d, Y') }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h6>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('admin.design-elements.edit', $designElement->id) }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-edit me-2 text-primary"></i>Edit Element
                        </a>
                        <a href="{{ route('admin.design-elements.create') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-plus me-2 text-success"></i>Create New Element
                        </a>
                        <a href="{{ route('admin.design-elements.index') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-list me-2 text-secondary"></i>All Design Elements
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
                        <div class="stat-value">{{ $designElement->id }}</div>
                        <div class="stat-label">Element ID</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-card-info">
                        <div class="stat-icon">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <div class="stat-value">{{ ucfirst(substr($designElement->type, 0, 6)) }}</div>
                        <div class="stat-label">Type</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-card-success">
                        <div class="stat-icon">
                            <i class="fas fa-tags"></i>
                        </div>
                        <div class="stat-value">
                            @if(is_array($designElement->tags))
                                {{ count($designElement->tags) }}
                            @elseif($designElement->tags)
                                {{ count(explode(',', $designElement->tags)) }}
                            @else
                                0
                            @endif
                        </div>
                        <div class="stat-label">Tags</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-card-warning">
                        <div class="stat-icon">
                            <i class="fas fa-crown"></i>
                        </div>
                        <div class="stat-value">{{ $designElement->is_premium ? 'Yes' : 'No' }}</div>
                        <div class="stat-label">Premium</div>
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
                            <span class="detail-label">Element ID</span>
                            <span class="detail-value">#{{ $designElement->id }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Name</span>
                            <span class="detail-value">{{ $designElement->name }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Type</span>
                            <span class="detail-value">
                                <span class="badge bg-info">{{ ucfirst($designElement->type) }}</span>
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Category</span>
                            <span class="detail-value">
                                @if($designElement->category)
                                    <span class="badge bg-secondary">{{ $designElement->category }}</span>
                                @else
                                    <span class="text-muted">Not specified</span>
                                @endif
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Premium Status</span>
                            <span class="detail-value">
                                @if($designElement->is_premium)
                                    <span class="badge bg-warning"><i class="fas fa-crown me-1"></i>Premium</span>
                                @else
                                    <span class="badge bg-success">Free</span>
                                @endif
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Tags</span>
                            <span class="detail-value">
                                @php
                                    $tags = is_array($designElement->tags) ? $designElement->tags : ($designElement->tags ? explode(',', $designElement->tags) : []);
                                @endphp
                                @if(count($tags) > 0)
                                    @foreach($tags as $tag)
                                        <span class="badge bg-light text-dark me-1">{{ trim($tag) }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">No tags</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- File Paths Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-file-image me-2"></i>File Paths</h5>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">SVG Path</span>
                            <span class="detail-value">
                                @if($designElement->svg_path)
                                    <code>{{ $designElement->svg_path }}</code>
                                @else
                                    <span class="text-muted">Not specified</span>
                                @endif
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">PNG Path</span>
                            <span class="detail-value">
                                @if($designElement->png_path)
                                    <code>{{ $designElement->png_path }}</code>
                                @else
                                    <span class="text-muted">Not specified</span>
                                @endif
                            </span>
                        </div>
                    </div>
                    
                    <!-- Preview Section -->
                    @if($designElement->svg_path || $designElement->png_path)
                        <hr class="my-3">
                        <h6 class="text-muted mb-3">Preview</h6>
                        <div class="row">
                            @if($designElement->svg_path)
                                <div class="col-md-6 text-center">
                                    <p class="text-muted mb-2"><small>SVG</small></p>
                                    <div class="border rounded p-3 bg-light">
                                        <img src="{{ asset($designElement->svg_path) }}" alt="SVG Preview" 
                                             style="max-width: 150px; max-height: 150px; object-fit: contain;">
                                    </div>
                                </div>
                            @endif
                            @if($designElement->png_path)
                                <div class="col-md-6 text-center">
                                    <p class="text-muted mb-2"><small>PNG</small></p>
                                    <div class="border rounded p-3 bg-light">
                                        <img src="{{ asset($designElement->png_path) }}" alt="PNG Preview" 
                                             style="max-width: 150px; max-height: 150px; object-fit: contain;">
                                    </div>
                                </div>
                            @endif
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
                                {{ $designElement->created_at->format('F d, Y \a\t h:i A') }}
                                <small class="text-muted">({{ $designElement->created_at->diffForHumans() }})</small>
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Last Updated</span>
                            <span class="detail-value">
                                {{ $designElement->updated_at->format('F d, Y \a\t h:i A') }}
                                <small class="text-muted">({{ $designElement->updated_at->diffForHumans() }})</small>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <a href="{{ route('admin.design-elements.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Back to Design Elements
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
                    <p>Are you sure you want to delete this design element?</p>
                    <div class="alert alert-warning">
                        <strong>{{ $designElement->name }}</strong><br>
                        Type: {{ ucfirst($designElement->type) }}<br>
                        @if($designElement->category)
                            Category: {{ $designElement->category }}
                        @endif
                    </div>
                    <p class="text-danger mb-0"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.design-elements.destroy', $designElement->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i>Delete Element
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