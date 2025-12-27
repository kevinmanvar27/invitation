<x-admin-layout>
    <x-slot name="header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
            </ol>
        </nav>
    </x-slot>

    <div class="row g-4">
        <!-- Category Profile Card -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body text-center py-4">
                    <div class="bg-warning bg-opacity-10 rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" 
                         style="width: 100px; height: 100px;">
                        <i class="fas {{ $category->icon ?? 'fa-folder' }} text-warning fa-3x"></i>
                    </div>
                    <h4 class="mb-1">{{ $category->name }}</h4>
                    <p class="text-muted mb-3">{{ $category->slug }}</p>
                    
                    <div class="d-flex justify-content-center gap-2 mb-3">
                        @if($category->parent)
                            <span class="badge badge-info">
                                <i class="fas fa-level-up-alt me-1"></i>{{ $category->parent->name }}
                            </span>
                        @else
                            <span class="badge badge-secondary">
                                <i class="fas fa-sitemap me-1"></i>Top Level
                            </span>
                        @endif
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i> Edit Category
                        </a>
                        <button type="button" class="btn btn-outline-danger" onclick="confirmDelete()">
                            <i class="fas fa-trash me-1"></i> Delete Category
                        </button>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="row text-center">
                        <div class="col-6 border-end">
                            <small class="text-muted d-block">Order</small>
                            <strong>{{ $category->order }}</strong>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Created</small>
                            <strong>{{ $category->created_at->format('M d, Y') }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Category Details -->
        <div class="col-lg-8">
            <!-- Statistics Cards -->
            <div class="row g-3 mb-4">
                <div class="col-md-4 col-6">
                    <div class="stat-card stat-card-primary">
                        <div class="stat-card-body">
                            <div class="stat-card-content">
                                <span class="stat-card-value">{{ $category->designs->count() }}</span>
                                <span class="stat-card-label">Designs</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="stat-card stat-card-success">
                        <div class="stat-card-body">
                            <div class="stat-card-content">
                                <span class="stat-card-value">{{ $category->children->count() }}</span>
                                <span class="stat-card-label">Subcategories</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="stat-card stat-card-warning">
                        <div class="stat-card-body">
                            <div class="stat-card-content">
                                <span class="stat-card-value">{{ $category->order }}</span>
                                <span class="stat-card-label">Display Order</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Description -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-align-left me-2 text-info"></i>Description
                    </h5>
                </div>
                <div class="card-body">
                    @if($category->description)
                        <p class="mb-0">{{ $category->description }}</p>
                    @else
                        <div class="text-center py-3 text-muted">
                            <i class="fas fa-file-alt fa-2x mb-2"></i>
                            <p class="mb-0">No description provided</p>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Child Categories -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-folder-tree me-2 text-success"></i>Subcategories ({{ $category->children->count() }})
                    </h5>
                    <a href="{{ route('admin.categories.create') }}?parent_id={{ $category->id }}" class="btn btn-sm btn-outline-success">
                        <i class="fas fa-plus me-1"></i>Add Subcategory
                    </a>
                </div>
                <div class="card-body">
                    @if($category->children->count() > 0)
                        <div class="row g-3">
                            @foreach($category->children as $child)
                                <div class="col-md-4">
                                    <div class="border rounded p-3 h-100">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas {{ $child->icon ?? 'fa-folder' }} text-warning me-2"></i>
                                            <strong>{{ $child->name }}</strong>
                                        </div>
                                        <div class="text-muted small mb-2">{{ $child->designs_count ?? $child->designs()->count() }} designs</div>
                                        <a href="{{ route('admin.categories.show', $child->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-3 text-muted">
                            <i class="fas fa-folder-open fa-2x mb-2"></i>
                            <p class="mb-0">No subcategories</p>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Designs in Category -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-palette me-2 text-primary"></i>Designs ({{ $category->designs->count() }})
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if($category->designs->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Design</th>
                                        <th>User</th>
                                        <th>Status</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($category->designs->take(5) as $design)
                                        <tr>
                                            <td>
                                                <strong>{{ $design->name }}</strong>
                                            </td>
                                            <td>
                                                {{ $design->user->name ?? 'N/A' }}
                                            </td>
                                            <td>
                                                @if($design->is_published)
                                                    <span class="badge badge-success">Published</span>
                                                @else
                                                    <span class="badge badge-secondary">Draft</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <a href="{{ route('admin.user-designs.show', $design->id) }}" class="btn btn-icon btn-outline-secondary btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-palette fa-2x mb-2"></i>
                            <p class="mb-0">No designs in this category</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Back Button -->
    <div class="mt-4">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to Categories
        </a>
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
                    <p>Are you sure you want to delete <strong>{{ $category->name }}</strong>?</p>
                    @if($category->designs->count() > 0 || $category->children->count() > 0)
                        <div class="alert alert-warning mb-0">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            This category has {{ $category->designs->count() }} designs and {{ $category->children->count() }} subcategories that may be affected.
                        </div>
                    @else
                        <p class="text-muted mb-0">This action cannot be undone.</p>
                    @endif
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline">
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
        function confirmDelete() {
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
    </script>
    @endpush
</x-admin-layout>