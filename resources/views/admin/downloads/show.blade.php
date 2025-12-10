<x-admin-layout>
    <x-slot name="header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.downloads.index') }}">Downloads</a></li>
                <li class="breadcrumb-item active">#{{ $download->id }}</li>
            </ol>
        </nav>
    </x-slot>

    <div class="row g-4">
        <!-- Profile Card -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body text-center py-4">
                    <div class="avatar bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; border-radius: 50%;">
                        <i class="fas fa-download fa-2x"></i>
                    </div>
                    <h4 class="mb-1">Download #{{ $download->id }}</h4>
                    <p class="text-muted mb-2">{{ strtoupper($download->file_type) }} File</p>
                    <span class="badge bg-info px-3 py-2">{{ number_format($download->download_count) }} downloads</span>
                    
                    <div class="d-flex justify-content-center gap-2 mt-4">
                        <a href="{{ route('admin.downloads.edit', $download->id) }}" class="btn btn-primary">
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
                            <span class="fw-medium">{{ $download->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Updated</small>
                            <span class="fw-medium">{{ $download->updated_at->format('M d, Y') }}</span>
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
                    @if($download->user)
                        <a href="{{ route('admin.users.show', $download->user->id) }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-user me-3 text-muted"></i>
                            <span>View User</span>
                        </a>
                    @endif
                    @if($download->design)
                        <a href="{{ route('admin.designs.show', $download->design->id) }}" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-palette me-3 text-muted"></i>
                            <span>View Design</span>
                        </a>
                    @endif
                    <a href="{{ route('admin.downloads.create') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="fas fa-plus me-3 text-muted"></i>
                        <span>Create New Download</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Details Column -->
        <div class="col-lg-8">
            <!-- Stats -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="stat-card h-100">
                        <div class="stat-card-content">
                            <div class="stat-card-value">{{ number_format($download->download_count) }}</div>
                            <div class="stat-card-label">Total Downloads</div>
                        </div>
                        <div class="stat-card-icon primary">
                            <i class="fas fa-download"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card h-100">
                        <div class="stat-card-content">
                            <div class="stat-card-value">{{ strtoupper($download->file_type) }}</div>
                            <div class="stat-card-label">File Type</div>
                        </div>
                        <div class="stat-card-icon info">
                            <i class="fas fa-file"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card h-100">
                        <div class="stat-card-content">
                            <div class="stat-card-value">{{ $download->file_size ? number_format($download->file_size / 1024, 1) . ' KB' : 'N/A' }}</div>
                            <div class="stat-card-label">File Size</div>
                        </div>
                        <div class="stat-card-icon secondary">
                            <i class="fas fa-hdd"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Download Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Download Information</h6>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <div class="detail-label">Download ID</div>
                            <div class="detail-value">#{{ $download->id }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">User</div>
                            <div class="detail-value">
                                @if($download->user)
                                    <a href="{{ route('admin.users.show', $download->user->id) }}" class="text-decoration-none">
                                        {{ $download->user->name }}
                                    </a>
                                    <small class="text-muted d-block">{{ $download->user->email }}</small>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Design</div>
                            <div class="detail-value">
                                @if($download->design)
                                    <a href="{{ route('admin.designs.show', $download->design->id) }}" class="text-decoration-none">
                                        {{ $download->design->name }}
                                    </a>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">File Type</div>
                            <div class="detail-value">
                                <span class="badge bg-secondary">{{ strtoupper($download->file_type) }}</span>
                            </div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Resolution</div>
                            <div class="detail-value">{{ $download->resolution ?: 'N/A' }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">File Size</div>
                            <div class="detail-value">
                                @if($download->file_size)
                                    {{ number_format($download->file_size) }} bytes
                                    <small class="text-muted">({{ number_format($download->file_size / 1024, 2) }} KB)</small>
                                @else
                                    N/A
                                @endif
                            </div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Download Count</div>
                            <div class="detail-value">{{ number_format($download->download_count) }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Created At</div>
                            <div class="detail-value">{{ $download->created_at->format('M d, Y \a\t h:i A') }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Updated At</div>
                            <div class="detail-value">{{ $download->updated_at->format('M d, Y \a\t h:i A') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- File Path -->
            @if($download->file_path)
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-folder me-2"></i>File Path</h6>
                </div>
                <div class="card-body">
                    <code class="d-block p-3 bg-light rounded">{{ $download->file_path }}</code>
                </div>
            </div>
            @endif

            <!-- Back Button -->
            <a href="{{ route('admin.downloads.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Downloads
            </a>
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
                    <p>Are you sure you want to delete this download record?</p>
                    <p class="text-muted small mb-0">This action cannot be undone.</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.downloads.destroy', $download->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i> Delete Download
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