<x-admin-layout>
    <x-slot name="header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.templates.index') }}">Templates</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $template->name }}</li>
            </ol>
        </nav>
    </x-slot>

    <div class="row g-4">
        <!-- Template Preview Card -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body text-center py-4">
                    @if($template->preview_image)
                        <img src="{{ asset('storage/' . $template->preview_image) }}" 
                             class="rounded mb-3" 
                             style="max-width: 100%; max-height: 200px; object-fit: contain;"
                             alt="{{ $template->name }}">
                    @else
                        <div class="bg-light rounded mb-3 mx-auto d-flex align-items-center justify-content-center" 
                             style="width: 200px; height: 200px;">
                            <i class="fas fa-image text-muted fa-3x"></i>
                        </div>
                    @endif
                    <h4 class="mb-1">{{ $template->name }}</h4>
                    <p class="text-muted mb-3">{{ $template->slug }}</p>
                    
                    <div class="d-flex justify-content-center gap-2 mb-3">
                        @if($template->is_premium)
                            <span class="badge badge-warning">
                                <i class="fas fa-crown me-1"></i>Premium
                            </span>
                        @else
                            <span class="badge badge-secondary">
                                <i class="fas fa-gift me-1"></i>Free
                            </span>
                        @endif
                        
                        @if($template->is_active)
                            <span class="badge badge-success">
                                <i class="fas fa-check-circle me-1"></i>Active
                            </span>
                        @else
                            <span class="badge badge-danger">
                                <i class="fas fa-times-circle me-1"></i>Inactive
                            </span>
                        @endif
                    </div>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.templates.edit', $template->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i> Edit Template
                        </a>
                        <button type="button" class="btn btn-outline-danger" onclick="confirmDelete()">
                            <i class="fas fa-trash me-1"></i> Delete Template
                        </button>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="row text-center">
                        <div class="col-6 border-end">
                            <small class="text-muted d-block">Created</small>
                            <strong>{{ $template->created_at->format('M d, Y') }}</strong>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Updated</small>
                            <strong>{{ $template->updated_at->format('M d, Y') }}</strong>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions Card -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt me-2 text-warning"></i>Quick Actions
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('admin.designs.index', ['template_id' => $template->id]) }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-paint-brush me-2 text-primary"></i> View Designs Using This
                        </a>
                        <a href="{{ route('admin.categories.show', $template->category_id ?? 0) }}" class="list-group-item list-group-item-action {{ !$template->category_id ? 'disabled' : '' }}">
                            <i class="fas fa-folder me-2 text-warning"></i> View Category
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fas fa-copy me-2 text-info"></i> Duplicate Template
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Template Details -->
        <div class="col-lg-8">
            <!-- Statistics Cards -->
            <div class="row g-3 mb-4">
                <div class="col-md-4 col-6">
                    <div class="stat-card stat-card-primary">
                        <div class="stat-card-body">
                            <div class="stat-card-content">
                                <span class="stat-card-value">{{ $template->downloads_count ?? 0 }}</span>
                                <span class="stat-card-label">Downloads</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="stat-card stat-card-success">
                        <div class="stat-card-body">
                            <div class="stat-card-content">
                                <span class="stat-card-value">{{ $template->usage_count ?? 0 }}</span>
                                <span class="stat-card-label">Usage Count</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="stat-card stat-card-warning">
                        <div class="stat-card-body">
                            <div class="stat-card-content">
                                <span class="stat-card-value">
                                    @if($template->is_premium && !is_null($template->price))
                                        ₹{{ number_format($template->price, 2) }}
                                    @else
                                        Free
                                    @endif
                                </span>
                                <span class="stat-card-label">Price</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Basic Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-info-circle me-2 text-primary"></i>Basic Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Template ID</span>
                            <span class="detail-value">#{{ $template->id }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Name</span>
                            <span class="detail-value">{{ $template->name }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Slug</span>
                            <span class="detail-value"><code>{{ $template->slug }}</code></span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Category</span>
                            <span class="detail-value">
                                @if($template->category)
                                    <a href="{{ route('admin.categories.show', $template->category->id) }}">
                                        {{ $template->category->name }}
                                    </a>
                                @else
                                    <span class="text-muted">Not assigned</span>
                                @endif
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Theme</span>
                            <span class="detail-value">{{ $template->theme ?? 'Not specified' }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Style</span>
                            <span class="detail-value">{{ $template->style ?? 'Not specified' }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Orientation</span>
                            <span class="detail-value">
                                <i class="fas fa-{{ $template->orientation == 'portrait' ? 'mobile-alt' : 'tablet-alt fa-rotate-90' }} me-1"></i>
                                {{ ucfirst($template->orientation) }}
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Created At</span>
                            <span class="detail-value">{{ $template->created_at->format('M d, Y H:i') }}</span>
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
                    @if($template->description)
                        <p class="mb-0">{{ $template->description }}</p>
                    @else
                        <div class="text-center py-3 text-muted">
                            <i class="fas fa-file-alt fa-2x mb-2"></i>
                            <p class="mb-0">No description provided</p>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Recent Designs Using This Template -->
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-paint-brush me-2 text-secondary"></i>Recent Designs
                    </h5>
                    <a href="{{ route('admin.designs.index', ['template_id' => $template->id]) }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body p-0">
                    @if($template->designs && $template->designs->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Design</th>
                                        <th>User</th>
                                        <th>Created</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($template->designs->take(5) as $design)
                                        <tr>
                                            <td>
                                                <strong>{{ $design->name ?? 'Untitled Design' }}</strong>
                                            </td>
                                            <td>{{ $design->user->name ?? 'N/A' }}</td>
                                            <td class="text-muted">{{ $design->created_at->diffForHumans() }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('admin.designs.show', $design->id) }}" class="btn btn-icon btn-outline-secondary btn-sm">
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
                            <i class="fas fa-paint-brush fa-2x mb-2"></i>
                            <p class="mb-0">No designs using this template yet</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Back Button -->
    <div class="mt-4">
        <a href="{{ route('admin.templates.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to Templates
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
                    <p>Are you sure you want to delete <strong>{{ $template->name }}</strong>?</p>
                    <p class="text-muted mb-0">This action cannot be undone. All designs using this template may be affected.</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.templates.destroy', $template->id) }}" method="POST" class="d-inline">
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