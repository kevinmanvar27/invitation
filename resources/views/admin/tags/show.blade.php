<x-admin-layout>
    <x-slot name="title">Tag Details</x-slot>

    <!-- Page Header -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.tags.index') }}">Tags</a></li>
                    <li class="breadcrumb-item active">{{ $templateTag->tag_name }}</li>
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
                        <i class="fas fa-tag"></i>
                    </div>
                    <h4 class="mb-1">{{ $templateTag->tag_name }}</h4>
                    <p class="text-muted mb-3">Tag #{{ $templateTag->id }}</p>
                    
                    <div class="d-flex justify-content-center gap-2 mb-3">
                        <a href="{{ route('admin.tags.edit', $templateTag->id) }}" class="btn btn-primary">
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
                            <span class="fw-medium">{{ $templateTag->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Updated</small>
                            <span class="fw-medium">{{ $templateTag->updated_at->format('M d, Y') }}</span>
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
                    @if($templateTag->category)
                        <a href="{{ route('admin.categories.show', $templateTag->category->id) }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-folder me-2 text-muted"></i> View Category
                        </a>
                    @endif
                    <a href="{{ route('admin.tags.create') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-plus me-2 text-muted"></i> Create New Tag
                    </a>
                    <a href="{{ route('admin.tags.index') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-list me-2 text-muted"></i> View All Tags
                    </a>
                </div>
            </div>
        </div>

        <!-- Details Column -->
        <div class="col-lg-8">
            <!-- Tag Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Tag Information</h5>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Tag ID</span>
                            <span class="detail-value">#{{ $templateTag->id }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Tag Name</span>
                            <span class="detail-value">
                                <span class="badge bg-primary">{{ $templateTag->tag_name }}</span>
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Category</span>
                            <span class="detail-value">
                                @if($templateTag->category)
                                    <a href="{{ route('admin.categories.show', $templateTag->category->id) }}" class="text-decoration-none">
                                        {{ $templateTag->category->name }}
                                    </a>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Created At</span>
                            <span class="detail-value">{{ $templateTag->created_at->format('M d, Y \a\t h:i A') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Updated At</span>
                            <span class="detail-value">{{ $templateTag->updated_at->format('M d, Y \a\t h:i A') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Associated Category Details -->
            @if($templateTag->category)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-folder me-2"></i>Associated Category</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar me-3" style="width: 80px; height: 80px; font-size: 1.5rem;">
                            <i class="fas fa-folder"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">{{ $templateTag->category->name }}</h6>
                            <p class="text-muted mb-1 small">{{ Str::limit($templateTag->category->description, 100) }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Back Button -->
            <div class="d-flex justify-content-start">
                <a href="{{ route('admin.tags.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Back to Tags
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
                    <p>Are you sure you want to delete the tag <strong>"{{ $templateTag->tag_name }}"</strong>?</p>
                    <p class="text-muted small mb-0">This action cannot be undone.</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.tags.destroy', $templateTag->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i> Delete Tag
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