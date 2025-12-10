<x-admin-layout>
    <x-slot name="header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Templates</li>
            </ol>
        </nav>
    </x-slot>

    <!-- Toolbar -->
    <div class="toolbar mb-4">
        <form method="GET" action="{{ route('admin.templates.index') }}" class="toolbar-search-form">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" 
                       class="form-control border-start-0" 
                       placeholder="Search templates by name...">
            </div>
            
            <select name="category" class="form-select">
                <option value="">All Categories</option>
                @foreach($categories ?? [] as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            
            <select name="status" class="form-select">
                <option value="">All Statuses</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            
            <select name="premium" class="form-select">
                <option value="">All Types</option>
                <option value="1" {{ request('premium') === '1' ? 'selected' : '' }}>Premium</option>
                <option value="0" {{ request('premium') === '0' ? 'selected' : '' }}>Free</option>
            </select>
            
            <button type="submit" class="btn btn-secondary">
                <i class="fas fa-filter me-1"></i> Filter
            </button>
            
            @if(request()->hasAny(['search', 'category', 'status', 'premium']))
                <a href="{{ route('admin.templates.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times me-1"></i> Clear
                </a>
            @endif
        </form>
        
        <div class="toolbar-actions">
            <a href="{{ route('admin.templates.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Add Template
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
                            <th width="80">Preview</th>
                            <th width="60">ID</th>
                            <th>Name</th>
                            <th width="140">Category</th>
                            <th width="100" class="text-end">Price</th>
                            <th width="100">Type</th>
                            <th width="100">Status</th>
                            <th width="150" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($templates as $template)
                            <tr>
                                <td>
                                    @if($template->thumbnail_path)
                                        <img src="{{ asset('storage/' . $template->thumbnail_path) }}" 
                                             class="thumbnail" 
                                             alt="{{ $template->name }}">
                                    @else
                                        <div class="img-placeholder">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-muted">#{{ $template->id }}</td>
                                <td>
                                    <span class="fw-medium">{{ $template->name }}</span>
                                    @if($template->description)
                                        <br><small class="text-muted">{{ Str::limit($template->description, 50) }}</small>
                                    @endif
                                </td>
                                <td>
                                    @if($template->category)
                                        <span class="badge badge-secondary">
                                            {{ $template->category->name }}
                                        </span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    @if($template->is_premium && !is_null($template->price))
                                        <span class="fw-medium">₹{{ number_format($template->price, 2) }}</span>
                                    @elseif($template->is_premium)
                                        <span class="fw-medium">₹0.00</span>
                                    @else
                                        <span class="text-success fw-medium">Free</span>
                                    @endif
                                </td>
                                <td>
                                    @if($template->is_premium)
                                        <span class="badge badge-warning">
                                            <i class="fas fa-crown me-1"></i>Premium
                                        </span>
                                    @else
                                        <span class="badge badge-secondary">
                                            <i class="fas fa-gift me-1"></i>Free
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($template->is_active)
                                        <span class="badge badge-success">
                                            <i class="fas fa-check-circle me-1"></i>Active
                                        </span>
                                    @else
                                        <span class="badge badge-danger">
                                            <i class="fas fa-times-circle me-1"></i>Inactive
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.templates.show', $template->id) }}" 
                                           class="btn btn-icon btn-outline-secondary" 
                                           data-bs-toggle="tooltip" 
                                           title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.templates.edit', $template->id) }}" 
                                           class="btn btn-icon btn-outline-primary" 
                                           data-bs-toggle="tooltip" 
                                           title="Edit">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-icon btn-outline-danger" 
                                                data-bs-toggle="tooltip" 
                                                title="Delete"
                                                onclick="confirmDelete('{{ $template->id }}', '{{ $template->name }}')">
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
                                            <i class="fas fa-palette"></i>
                                        </div>
                                        <h5 class="empty-state-title">No templates found</h5>
                                        <p class="empty-state-description">Get started by creating a new template.</p>
                                        <a href="{{ route('admin.templates.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-1"></i> Add Template
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($templates->hasPages())
            <div class="card-footer bg-transparent">
                {{ $templates->links() }}
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
                    <p>Are you sure you want to delete <strong id="deleteTemplateName"></strong>?</p>
                    <p class="text-muted mb-0">This action cannot be undone. All associated designs may be affected.</p>
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
        function confirmDelete(templateId, templateName) {
            document.getElementById('deleteTemplateName').textContent = templateName;
            document.getElementById('deleteForm').action = `{{ url('admin/templates') }}/${templateId}`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
    </script>
    @endpush
</x-admin-layout>