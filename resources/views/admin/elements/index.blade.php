{{-- Elements Index - Admin Panel --}}
{{-- Updated to Bootstrap 5 + custom admin theme --}}

@php
    $totalElements = $elements->total() ?? count($elements);
    $activeCount = $elements->where('is_active', true)->count();
    $inactiveCount = $elements->where('is_active', false)->count();
@endphp

<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Elements</li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card stat-card-primary">
                <div class="stat-card-icon">
                    <i class="fas fa-shapes"></i>
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
            <div class="stat-card stat-card-success">
                <div class="stat-card-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-card-body">
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $activeCount }}</span>
                        <span class="stat-card-label">Active Elements</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card stat-card-warning">
                <div class="stat-card-icon">
                    <i class="fas fa-pause-circle"></i>
                </div>
                <div class="stat-card-body">
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $inactiveCount }}</span>
                        <span class="stat-card-label">Inactive Elements</span>
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
                    <select id="categoryFilter" class="form-select">
                        <option value="">All Categories</option>
                        <option value="icons">Icons</option>
                        <option value="graphics">Graphics</option>
                        <option value="borders">Borders</option>
                        <option value="backgrounds">Backgrounds</option>
                    </select>
                    <select id="typeFilter" class="form-select">
                        <option value="">All Types</option>
                        <option value="icon">Icon</option>
                        <option value="graphic">Graphic</option>
                        <option value="border">Border</option>
                        <option value="background">Background</option>
                    </select>
                    <select id="statusFilter" class="form-select">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    <a href="{{ route('admin.elements.create') }}" class="btn btn-primary">
                        <i class="fas fa-upload me-2"></i>Upload Element
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
                            <th>Status</th>
                            <th width="140">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($elements as $element)
                        <tr data-category="{{ strtolower($element->category ?? '') }}" data-type="{{ strtolower($element->type) }}" data-status="{{ $element->is_active ? 'active' : 'inactive' }}">
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
                                <span class="badge badge-info">{{ ucfirst($element->type) }}</span>
                            </td>
                            <td>{{ ucfirst($element->category ?? 'Uncategorized') }}</td>
                            <td>
                                @if($element->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('admin.elements.show', $element->id) }}" class="btn btn-icon btn-outline-primary" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.elements.edit', $element->id) }}" class="btn btn-icon btn-outline-secondary" title="Edit">
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
                                        <i class="fas fa-shapes"></i>
                                    </div>
                                    <h4>No Elements Found</h4>
                                    <p>Get started by uploading your first element.</p>
                                    <a href="{{ route('admin.elements.create') }}" class="btn btn-primary">
                                        <i class="fas fa-upload me-2"></i>Upload Element
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-secondary" id="exportCsv">
                    <i class="fas fa-file-csv me-2"></i>Export CSV
                </button>
                <button type="button" class="btn btn-outline-secondary" id="exportExcel">
                    <i class="fas fa-file-excel me-2"></i>Export Excel
                </button>
            </div>
            @if($elements->hasPages())
            <div>
                {{ $elements->links() }}
            </div>
            @endif
        </div>
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
        ['categoryFilter', 'typeFilter', 'statusFilter'].forEach(id => {
            document.getElementById(id).addEventListener('change', function() {
                filterTable();
            });
        });

        function filterTable() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const categoryFilter = document.getElementById('categoryFilter').value.toLowerCase();
            const typeFilter = document.getElementById('typeFilter').value.toLowerCase();
            const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
            const rows = document.querySelectorAll('.data-table tbody tr[data-type]');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const category = row.dataset.category;
                const type = row.dataset.type;
                const status = row.dataset.status;

                const matchesSearch = text.includes(searchTerm);
                const matchesCategory = !categoryFilter || category === categoryFilter;
                const matchesType = !typeFilter || type === typeFilter;
                const matchesStatus = !statusFilter || status === statusFilter;

                row.style.display = matchesSearch && matchesCategory && matchesType && matchesStatus ? '' : 'none';
            });
        }

        // Delete confirmation
        function confirmDelete(id, name) {
            document.getElementById('deleteElementName').textContent = name;
            document.getElementById('deleteForm').action = `{{ route('admin.elements.index') }}/${id}`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }

        // Export functionality
        document.getElementById('exportCsv').addEventListener('click', function() {
            window.location.href = '{{ route("admin.elements.index") }}?export=csv';
        });

        document.getElementById('exportExcel').addEventListener('click', function() {
            window.location.href = '{{ route("admin.elements.index") }}?export=excel';
        });
    </script>
    @endpush
</x-admin-layout>
