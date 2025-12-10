{{-- Design Elements Index - Admin Panel --}}
{{-- Updated to Bootstrap 5 + custom admin theme --}}

@php
    $totalElements = $designElements->total() ?? count($designElements);
    $premiumCount = $designElements->where('is_premium', true)->count();
    $freeCount = $designElements->where('is_premium', false)->count();
@endphp

<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Design Elements</li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card stat-card-primary">
                <div class="stat-card-icon">
                    <i class="fas fa-puzzle-piece"></i>
                </div>
                <div class="stat-card-body">
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $totalElements }}</span>
                        <span class="stat-card-label">Total Elements</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card stat-card-warning">
                <div class="stat-card-icon">
                    <i class="fas fa-crown"></i>
                </div>
                <div class="stat-card-body">
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $premiumCount }}</span>
                        <span class="stat-card-label">Premium Elements</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card stat-card-success">
                <div class="stat-card-icon">
                    <i class="fas fa-gift"></i>
                </div>
                <div class="stat-card-body">
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $freeCount }}</span>
                        <span class="stat-card-label">Free Elements</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="card">
        <div class="card-header">
            <div class="toolbar">
                <div class="input-group" style="max-width: 300px;">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" id="searchInput" class="form-control" placeholder="Search elements...">
                </div>
                <div class="toolbar-actions ms-auto">
                    <select id="typeFilter" class="form-select">
                        <option value="">All Types</option>
                        <option value="icon">Icon</option>
                        <option value="graphic">Graphic</option>
                        <option value="border">Border</option>
                        <option value="background">Background</option>
                    </select>
                    <select id="premiumFilter" class="form-select">
                        <option value="">All</option>
                        <option value="premium">Premium Only</option>
                        <option value="free">Free Only</option>
                    </select>
                    <a href="{{ route('admin.design-elements.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Add Element
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover data-table mb-0">
                    <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th width="80">Preview</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>Premium</th>
                            <th width="140">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($designElements as $element)
                        <tr data-type="{{ strtolower($element->type) }}" data-premium="{{ $element->is_premium ? 'premium' : 'free' }}">
                            <td><span class="text-muted">#{{ $element->id }}</span></td>
                            <td>
                                @if($element->file_path)
                                    <img src="{{ asset($element->file_path) }}" alt="{{ $element->name }}" class="rounded" style="width: 48px; height: 48px; object-fit: cover;">
                                @else
                                    <div class="d-flex align-items-center justify-content-center bg-light rounded" style="width: 48px; height: 48px;">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span class="fw-medium">{{ $element->name }}</span>
                            </td>
                            <td>
                                <span class="badge badge-light">{{ ucfirst($element->type) }}</span>
                            </td>
                            <td>{{ $element->category ?? 'Uncategorized' }}</td>
                            <td>
                                @if($element->is_premium)
                                    <span class="badge badge-warning">
                                        <i class="fas fa-crown me-1"></i>Premium
                                    </span>
                                @else
                                    <span class="badge badge-success">Free</span>
                                @endif
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('admin.design-elements.show', $element->id) }}" class="btn btn-icon btn-outline-primary" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.design-elements.edit', $element->id) }}" class="btn btn-icon btn-outline-secondary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-icon btn-outline-danger" title="Delete" onclick="confirmDelete({{ $element->id }}, '{{ addslashes($element->name) }}')">
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
                                        <i class="fas fa-puzzle-piece"></i>
                                    </div>
                                    <h4>No Design Elements Found</h4>
                                    <p>Get started by adding your first design element.</p>
                                    <a href="{{ route('admin.design-elements.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i>Add Element
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($designElements->hasPages())
        <div class="card-footer">
            {{ $designElements->links() }}
        </div>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="deleteElementName"></strong>?</p>
                    <p class="text-muted small mb-0">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Element</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            filterTable();
        });

        // Filter functionality
        document.getElementById('typeFilter').addEventListener('change', function() {
            filterTable();
        });

        document.getElementById('premiumFilter').addEventListener('change', function() {
            filterTable();
        });

        function filterTable() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const typeFilter = document.getElementById('typeFilter').value.toLowerCase();
            const premiumFilter = document.getElementById('premiumFilter').value.toLowerCase();
            const rows = document.querySelectorAll('.data-table tbody tr[data-type]');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const type = row.dataset.type;
                const premium = row.dataset.premium;

                const matchesSearch = text.includes(searchTerm);
                const matchesType = !typeFilter || type === typeFilter;
                const matchesPremium = !premiumFilter || premium === premiumFilter;

                row.style.display = matchesSearch && matchesType && matchesPremium ? '' : 'none';
            });
        }

        // Delete confirmation
        function confirmDelete(id, name) {
            document.getElementById('deleteElementName').textContent = name;
            document.getElementById('deleteForm').action = `{{ route('admin.design-elements.index') }}/${id}`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
    </script>
    @endpush
</x-admin-layout>