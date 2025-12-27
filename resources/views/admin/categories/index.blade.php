<x-admin-layout>
    <x-slot name="header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Categories</li>
            </ol>
        </nav>
    </x-slot>

    <!-- Toolbar -->
    <div class="toolbar mb-4">
        <form method="GET" action="{{ route('admin.categories.index') }}" class="toolbar-search-form">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" 
                       class="form-control border-start-0" 
                       placeholder="Search categories by name...">
            </div>
            
            <select name="parent" class="form-select">
                <option value="">All Parents</option>
                <option value="root" {{ request('parent') === 'root' ? 'selected' : '' }}>Root Categories</option>
                @foreach($categories->where('parent_id', null) as $parent)
                    <option value="{{ $parent->id }}" {{ request('parent') == $parent->id ? 'selected' : '' }}>
                        {{ $parent->name }}
                    </option>
                @endforeach
            </select>
            
            <button type="submit" class="btn btn-secondary">
                <i class="fas fa-filter me-1"></i> Filter
            </button>
            
            @if(request()->hasAny(['search', 'parent']))
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times me-1"></i> Clear
                </a>
            @endif
        </form>
        
        <div class="toolbar-actions">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Add Category
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
                            <th>Name</th>
                            <th>Slug</th>
                            <th width="150">Parent</th>
                            <th width="80" class="text-center">Order</th>
                            <th width="100" class="text-center">Designs</th>
                            <th width="150" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td class="text-muted">#{{ $category->id }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="me-3" style="width: 32px; height: 32px; background: var(--primary-100); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-folder text-primary" style="font-size: 14px;"></i>
                                        </div>
                                        <span class="fw-medium">{{ $category->name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <code class="text-muted">{{ $category->slug }}</code>
                                </td>
                                <td>
                                    @if($category->parent)
                                        <span class="badge badge-secondary">
                                            {{ $category->parent->name }}
                                        </span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-info">{{ $category->order }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="fw-medium">{{ $category->designs_count ?? 0 }}</span>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.categories.show', $category->id) }}" 
                                           class="btn btn-icon btn-outline-secondary" 
                                           data-bs-toggle="tooltip" 
                                           title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" 
                                           class="btn btn-icon btn-outline-primary" 
                                           data-bs-toggle="tooltip" 
                                           title="Edit">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-icon btn-outline-danger" 
                                                data-bs-toggle="tooltip" 
                                                title="Delete"
                                                onclick="confirmDelete('{{ $category->id }}', '{{ $category->name }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <div class="empty-state-icon">
                                            <i class="fas fa-folder-open"></i>
                                        </div>
                                        <h5 class="empty-state-title">No categories found</h5>
                                        <p class="empty-state-description">Get started by creating a new category.</p>
                                        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-1"></i> Add Category
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($categories->hasPages())
            <div class="card-footer bg-transparent">
                {{ $categories->links() }}
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
                    <p>Are you sure you want to delete <strong id="deleteCategoryName"></strong>?</p>
                    <p class="text-muted mb-0">This action cannot be undone. Designs in this category may be affected.</p>
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
        function confirmDelete(categoryId, categoryName) {
            document.getElementById('deleteCategoryName').textContent = categoryName;
            document.getElementById('deleteForm').action = `{{ url('admin/categories') }}/${categoryId}`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
    </script>
    @endpush
</x-admin-layout>