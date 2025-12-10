@php
    $totalShares = $sharedInvitations->count();
    $totalViews = $sharedInvitations->sum('view_count');
    $activeCount = $sharedInvitations->where('status', 'active')->count();
    $expiredCount = $sharedInvitations->where('status', 'expired')->count();
@endphp

<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shared Invitations</li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <!-- KPI Stats Row -->
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card stat-card-primary">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ number_format($totalShares) }}</span>
                        <span class="stat-card-label">Total Shares</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card stat-card-success">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ number_format($totalViews) }}</span>
                        <span class="stat-card-label">Total Views</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card stat-card-warning">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $activeCount }}</span>
                        <span class="stat-card-label">Active Links</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card stat-card-info">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $expiredCount }}</span>
                        <span class="stat-card-label">Expired</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toolbar -->
    <div class="toolbar mb-4">
        <div class="input-group" style="max-width: 300px;">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            <input type="text" id="searchInput" class="form-control" placeholder="Search invitations...">
        </div>
        
        <div class="toolbar-actions ms-auto">
            <select id="methodFilter" class="form-select">
                <option value="">All Methods</option>
                <option value="email">Email</option>
                <option value="sms">SMS</option>
                <option value="link">Link</option>
                <option value="social">Social Media</option>
            </select>
            
            <select id="statusFilter" class="form-select">
                <option value="">All Statuses</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                <option value="expired">Expired</option>
            </select>
            
            <button type="button" class="btn btn-outline-secondary" id="clearFilters">
                <i class="fas fa-times me-1"></i>Clear
            </button>
            
            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-download me-1"></i>Export
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" id="exportCsv"><i class="fas fa-file-csv me-2"></i>Export CSV</a></li>
                    <li><a class="dropdown-item" href="#" id="exportExcel"><i class="fas fa-file-excel me-2"></i>Export Excel</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Shared Invitations Table -->
    <div class="card">
        <div class="card-body p-0">
            @if($sharedInvitations->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover data-table mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Invitation</th>
                                <th>Shared By</th>
                                <th>Method</th>
                                <th>Share Link</th>
                                <th class="text-center">Views</th>
                                <th>Sent Date</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sharedInvitations as $sharedInvitation)
                            <tr>
                                <td><span class="text-muted">#{{ $sharedInvitation->id }}</span></td>
                                <td>
                                    @if($sharedInvitation->design)
                                        <a href="{{ route('admin.designs.show', $sharedInvitation->design->id) }}" class="text-primary fw-medium">
                                            {{ Str::limit($sharedInvitation->design->design_name ?? 'Untitled', 25) }}
                                        </a>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if($sharedInvitation->user)
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar avatar-sm">
                                                @if($sharedInvitation->user->avatar)
                                                    <img src="{{ asset('storage/' . $sharedInvitation->user->avatar) }}" alt="{{ $sharedInvitation->user->name }}">
                                                @else
                                                    <span class="avatar-initials">{{ strtoupper(substr($sharedInvitation->user->name, 0, 1)) }}</span>
                                                @endif
                                            </div>
                                            <span>{{ $sharedInvitation->user->name }}</span>
                                        </div>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $method = strtolower($sharedInvitation->share_method ?? '');
                                        $methodIcon = match($method) {
                                            'email' => 'fa-envelope',
                                            'sms' => 'fa-sms',
                                            'link' => 'fa-link',
                                            'social' => 'fa-share-nodes',
                                            default => 'fa-share'
                                        };
                                        $methodClass = match($method) {
                                            'email' => 'badge-primary',
                                            'sms' => 'badge-success',
                                            'link' => 'badge-info',
                                            'social' => 'badge-warning',
                                            default => 'badge-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $methodClass }}">
                                        <i class="fas {{ $methodIcon }} me-1"></i>{{ ucfirst($sharedInvitation->share_method ?? 'N/A') }}
                                    </span>
                                </td>
                                <td>
                                    @if($sharedInvitation->share_link)
                                        <div class="d-flex align-items-center gap-2">
                                            <code class="text-muted small">{{ Str::limit($sharedInvitation->share_link, 25) }}</code>
                                            <button type="button" class="btn btn-icon btn-sm btn-ghost copy-link-btn" 
                                                    data-link="{{ $sharedInvitation->share_link }}" 
                                                    title="Copy Link">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </div>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-light">
                                        <i class="fas fa-eye me-1"></i>{{ number_format($sharedInvitation->view_count ?? 0) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $sharedInvitation->created_at->format('M d, Y') }}</span>
                                    <br>
                                    <small class="text-muted">{{ $sharedInvitation->created_at->format('H:i') }}</small>
                                </td>
                                <td>
                                    @switch($sharedInvitation->status)
                                        @case('active')
                                            <span class="badge badge-success">
                                                <i class="fas fa-check me-1"></i>Active
                                            </span>
                                            @break
                                        @case('expired')
                                            <span class="badge badge-danger">
                                                <i class="fas fa-clock me-1"></i>Expired
                                            </span>
                                            @break
                                        @default
                                            <span class="badge badge-secondary">
                                                <i class="fas fa-pause me-1"></i>Inactive
                                            </span>
                                    @endswitch
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.shared-invitations.show', $sharedInvitation->id) }}" 
                                           class="btn btn-icon btn-outline-primary" 
                                           title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-icon btn-outline-info resend-btn" 
                                                data-invitation-id="{{ $sharedInvitation->id }}"
                                                title="Resend Invitation">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                        <button type="button" 
                                                class="btn btn-icon btn-outline-danger" 
                                                onclick="confirmDelete({{ $sharedInvitation->id }}, '{{ $sharedInvitation->design->design_name ?? 'this invitation' }}')"
                                                title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if($sharedInvitations->hasPages())
                    <div class="card-footer">
                        {{ $sharedInvitations->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-share-alt"></i>
                    </div>
                    <h3>No Shared Invitations Found</h3>
                    <p>No invitations have been shared yet.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Shared Invitation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the shared invitation for "<strong id="deleteItemName"></strong>"?</p>
                    <p class="text-muted small">This action cannot be undone and will invalidate the share link.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Delete confirmation
        function confirmDelete(id, name) {
            document.getElementById('deleteItemName').textContent = name;
            document.getElementById('deleteForm').action = `/admin/shared-invitations/${id}`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const tableRows = document.querySelectorAll('.data-table tbody tr');
            
            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                
                tableRows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });
            
            // Filter functionality
            const methodFilter = document.getElementById('methodFilter');
            const statusFilter = document.getElementById('statusFilter');
            
            function applyFilters() {
                const method = methodFilter.value.toLowerCase();
                const status = statusFilter.value.toLowerCase();
                
                tableRows.forEach(row => {
                    const rowMethod = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
                    const rowStatus = row.querySelector('td:nth-child(8)').textContent.toLowerCase();
                    
                    const methodMatch = !method || rowMethod.includes(method);
                    const statusMatch = !status || rowStatus.includes(status);
                    
                    row.style.display = (methodMatch && statusMatch) ? '' : 'none';
                });
            }
            
            methodFilter.addEventListener('change', applyFilters);
            statusFilter.addEventListener('change', applyFilters);
            
            // Clear filters
            document.getElementById('clearFilters').addEventListener('click', function() {
                searchInput.value = '';
                methodFilter.value = '';
                statusFilter.value = '';
                tableRows.forEach(row => row.style.display = '');
            });
            
            // Copy link functionality
            document.querySelectorAll('.copy-link-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const link = this.dataset.link;
                    navigator.clipboard.writeText(link).then(() => {
                        // Show feedback
                        const icon = this.querySelector('i');
                        icon.classList.remove('fa-copy');
                        icon.classList.add('fa-check');
                        setTimeout(() => {
                            icon.classList.remove('fa-check');
                            icon.classList.add('fa-copy');
                        }, 2000);
                    });
                });
            });
            
            // Resend button
            document.querySelectorAll('.resend-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const invitationId = this.dataset.invitationId;
                    if (confirm('Are you sure you want to resend this invitation?')) {
                        alert('Resending invitation #' + invitationId);
                    }
                });
            });
            
            // Export functionality
            document.getElementById('exportCsv')?.addEventListener('click', function(e) {
                e.preventDefault();
                alert('Exporting data as CSV');
            });
            
            document.getElementById('exportExcel')?.addEventListener('click', function(e) {
                e.preventDefault();
                alert('Exporting data as Excel');
            });
        });
    </script>
    @endpush
</x-admin-layout>