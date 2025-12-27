<x-admin-layout>
    <x-slot name="header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">User Designs</li>
            </ol>
        </nav>
    </x-slot>

    <!-- Toolbar -->
    <div class="toolbar mb-4">
        <form method="GET" action="{{ route('admin.designs.index') }}" class="toolbar-search-form">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" 
                       class="form-control border-start-0" 
                       placeholder="Search designs by name or user...">
            </div>
            
            <select name="status" class="form-select">
                <option value="">All Statuses</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archived</option>
            </select>
            
            <button type="submit" class="btn btn-secondary">
                <i class="fas fa-filter me-1"></i> Filter
            </button>
            
            @if(request()->hasAny(['search', 'status']))
                <a href="{{ route('admin.designs.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times me-1"></i> Clear
                </a>
            @endif
        </form>
        
        <div class="toolbar-actions">
            <a href="{{ route('admin.designs.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Create Design
            </a>
            <a href="{{ route('admin.designs.export', ['format' => 'csv']) }}" class="btn btn-outline-secondary">
                <i class="fas fa-download me-1"></i> Export CSV
            </a>
        </div>
    </div>
    
    <!-- Data Card -->
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover data-table mb-0">
                    <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th width="80">Preview</th>
                            <th>Design Name</th>
                            <th>User</th>
                            <th>Category</th>
                            <th width="100">Status</th>
                            <th width="120">Created</th>
                            <th width="150" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($designs ?? [] as $design)
                            <tr>
                                <td class="text-muted">#{{ $design->id }}</td>
                                <td>
                                    @if($design->thumbnail_path)
                                        <img src="{{ asset('storage/' . $design->thumbnail_path) }}" 
                                             class="thumbnail" 
                                             alt="{{ $design->name }}">
                                    @else
                                        <div class="img-placeholder">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <span class="fw-medium">{{ $design->design_name ?? 'Untitled Design' }}</span>
                                </td>
                                <td>
                                    @if($design->user)
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($design->user->name) }}&color=ffffff&background=ff6b6b&size=28" 
                                                 class="rounded-circle me-2" 
                                                 width="28" 
                                                 height="28" 
                                                 alt="{{ $design->user->name }}">
                                            <span>{{ $design->user->name }}</span>
                                        </div>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($design->category)
                                        <a href="{{ route('admin.categories.show', $design->category->id) }}" class="text-decoration-none">
                                            {{ $design->category->name }}
                                        </a>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($design->status === 'completed')
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i>Completed
                                        </span>
                                    @elseif($design->status === 'archived')
                                        <span class="badge bg-secondary">
                                            <i class="fas fa-archive me-1"></i>Archived
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-file me-1"></i>Draft
                                        </span>
                                    @endif
                                </td>
                                <td class="text-muted">{{ $design->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.designs.show', $design->id) }}" 
                                           class="btn btn-icon btn-outline-secondary" 
                                           data-bs-toggle="tooltip" 
                                           title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.designs.edit', $design->id) }}" 
                                           class="btn btn-icon btn-outline-primary" 
                                           data-bs-toggle="tooltip" 
                                           title="Edit">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-icon btn-outline-danger" 
                                                data-bs-toggle="tooltip" 
                                                title="Delete"
                                                onclick="confirmDelete('{{ $design->id }}', '{{ $design->design_name ?? 'this design' }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="empty-state">
                                        <div class="empty-state-icon">
                                            <i class="fas fa-paint-brush"></i>
                                        </div>
                                        <h5 class="empty-state-title">No designs found</h5>
                                        <p class="empty-state-description">User designs will appear here once created.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if(isset($designs) && $designs->hasPages())
            <div class="card-footer bg-transparent">
                {{ $designs->links() }}
            </div>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle text-danger me-2"></i>Confirm Delete
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="deleteDesignName"></strong>?</p>
                    <p class="text-muted mb-0">This action cannot be undone.</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" class="d-inline">
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
        function confirmDelete(designId, designName) {
            document.getElementById('deleteDesignName').textContent = designName;
            document.getElementById('deleteForm').action = `{{ url('admin/designs') }}/${designId}`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
    </script>
    @endpush
</x-admin-layout>