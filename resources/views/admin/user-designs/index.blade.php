{{-- User Designs Index - Admin Panel --}}
{{-- Updated to Bootstrap 5 + custom admin theme --}}

@php
    $totalDesigns = $designs->total() ?? count($designs);
    $completedCount = $designs->where('is_completed', true)->count();
    $draftCount = $designs->where('is_completed', false)->count();
@endphp

<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Designs</li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card stat-card-primary">
                <div class="stat-card-icon">
                    <i class="fas fa-palette"></i>
                </div>
                <div class="stat-card-body">
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $totalDesigns }}</span>
                        <span class="stat-card-label">Total Designs</span>
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
                        <span class="stat-card-value">{{ $completedCount }}</span>
                        <span class="stat-card-label">Completed</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card stat-card-warning">
                <div class="stat-card-icon">
                    <i class="fas fa-edit"></i>
                </div>
                <div class="stat-card-body">
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $draftCount }}</span>
                        <span class="stat-card-label">Drafts</span>
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
                    <input type="text" id="searchInput" class="form-control" placeholder="Search designs...">
                </div>
                <div class="toolbar-actions ms-auto">
                    <select id="statusFilter" class="form-select">
                        <option value="">All Status</option>
                        <option value="completed">Completed</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover data-table mb-0">
                    <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>User</th>
                            <th>Template</th>
                            <th>Design Name</th>
                            <th>Completed</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th width="120">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($designs as $design)
                        <tr data-status="{{ $design->is_completed ? 'completed' : 'draft' }}">
                            <td><span class="text-muted">#{{ $design->id }}</span></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm me-2">
                                        @if($design->user && $design->user->avatar)
                                            <img src="{{ asset($design->user->avatar) }}" alt="{{ $design->user->name }}">
                                        @else
                                            <span class="avatar-initials">{{ substr($design->user->name ?? 'U', 0, 1) }}</span>
                                        @endif
                                    </div>
                                    <div>
                                        <span class="fw-medium">{{ $design->user->name ?? 'Unknown User' }}</span>
                                        @if($design->user && $design->user->email)
                                            <br><small class="text-muted">{{ $design->user->email }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($design->template)
                                    <a href="{{ route('admin.templates.show', $design->template->id) }}" class="text-primary">
                                        {{ $design->template->name }}
                                    </a>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>
                                <span class="fw-medium">{{ $design->design_name ?? 'Untitled' }}</span>
                            </td>
                            <td>
                                @if($design->is_completed)
                                    <span class="badge badge-success">
                                        <i class="fas fa-check me-1"></i>Yes
                                    </span>
                                @else
                                    <span class="badge badge-warning">
                                        <i class="fas fa-clock me-1"></i>No
                                    </span>
                                @endif
                            </td>
                            <td>
                                @php
                                    $statusClass = match($design->status ?? 'draft') {
                                        'published' => 'badge-success',
                                        'pending' => 'badge-warning',
                                        'rejected' => 'badge-danger',
                                        default => 'badge-light'
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }}">{{ ucfirst($design->status ?? 'Draft') }}</span>
                            </td>
                            <td>
                                <span class="text-muted">{{ $design->created_at ? $design->created_at->format('M d, Y') : '-' }}</span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <a href="{{ route('admin.user-designs.show', $design->id) }}" class="btn btn-icon btn-outline-primary" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button type="button" class="btn btn-icon btn-outline-danger" title="Delete" onclick="confirmDelete({{ $design->id }}, '{{ addslashes($design->design_name ?? 'this design') }}')">
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
                                    <h4>No User Designs Found</h4>
                                    <p>User designs will appear here once users start creating their invitations.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($designs->hasPages())
        <div class="card-footer">
            {{ $designs->links() }}
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
                    <p>Are you sure you want to delete <strong id="deleteDesignName"></strong>?</p>
                    <p class="text-muted small mb-0">This action cannot be undone. The user will lose access to this design.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Design</button>
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
        document.getElementById('statusFilter').addEventListener('change', function() {
            filterTable();
        });

        function filterTable() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
            const rows = document.querySelectorAll('.data-table tbody tr[data-status]');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const status = row.dataset.status;

                const matchesSearch = text.includes(searchTerm);
                const matchesStatus = !statusFilter || status === statusFilter;

                row.style.display = matchesSearch && matchesStatus ? '' : 'none';
            });
        }

        // Delete confirmation
        function confirmDelete(id, name) {
            document.getElementById('deleteDesignName').textContent = name;
            document.getElementById('deleteForm').action = `{{ route('admin.user-designs.index') }}/${id}`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
    </script>
    @endpush
</x-admin-layout>