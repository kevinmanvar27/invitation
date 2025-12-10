<x-admin-layout>
    <x-slot name="header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tags</li>
            </ol>
        </nav>
    </x-slot>

    <!-- Toolbar -->
    <div class="toolbar mb-4">
        <form method="GET" action="{{ route('admin.tags.index') }}" class="toolbar-search-form">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" 
                       class="form-control border-start-0" 
                       placeholder="Search tags by name...">
            </div>
            
            <button type="submit" class="btn btn-secondary">
                <i class="fas fa-filter me-1"></i> Filter
            </button>
            
            @if(request()->hasAny(['search']))
                <a href="{{ route('admin.tags.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times me-1"></i> Clear
                </a>
            @endif
        </form>
        
        <div class="toolbar-actions">
            <a href="{{ route('admin.tags.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Add Tag
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
                            <th>Tag Name</th>
                            <th>Template</th>
                            <th width="140">Created</th>
                            <th width="150" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tags as $tag)
                            <tr>
                                <td class="text-muted">#{{ $tag->id }}</td>
                                <td>
                                    <span class="badge badge-primary">
                                        <i class="fas fa-tag me-1"></i>{{ $tag->tag_name }}
                                    </span>
                                </td>
                                <td>
                                    @if($tag->template)
                                        <a href="{{ route('admin.templates.show', $tag->template->id) }}" class="text-decoration-none">
                                            {{ $tag->template->name }}
                                        </a>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td class="text-muted">{{ $tag->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.tags.show', $tag->id) }}" 
                                           class="btn btn-icon btn-outline-secondary" 
                                           data-bs-toggle="tooltip" 
                                           title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.tags.edit', $tag->id) }}" 
                                           class="btn btn-icon btn-outline-primary" 
                                           data-bs-toggle="tooltip" 
                                           title="Edit">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-icon btn-outline-danger" 
                                                data-bs-toggle="tooltip" 
                                                title="Delete"
                                                onclick="confirmDelete('{{ $tag->id }}', '{{ $tag->tag_name }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <div class="empty-state-icon">
                                            <i class="fas fa-tags"></i>
                                        </div>
                                        <h5 class="empty-state-title">No tags found</h5>
                                        <p class="empty-state-description">Get started by creating a new tag.</p>
                                        <a href="{{ route('admin.tags.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-1"></i> Add Tag
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($tags->hasPages())
            <div class="card-footer bg-transparent">
                {{ $tags->links() }}
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
                    <p>Are you sure you want to delete the tag <strong id="deleteTagName"></strong>?</p>
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
        function confirmDelete(tagId, tagName) {
            document.getElementById('deleteTagName').textContent = tagName;
            document.getElementById('deleteForm').action = `{{ url('admin/tags') }}/${tagId}`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
    </script>
    @endpush
</x-admin-layout>