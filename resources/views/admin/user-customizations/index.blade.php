@php
    $totalCustomizations = $customizations->count();
    $rsvpEnabled = $customizations->where('rsvp_enabled', true)->count();
    $upcomingWeddings = $customizations->filter(fn($c) => $c->wedding_date && $c->wedding_date->isFuture())->count();
@endphp

<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Customizations</li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <!-- KPI Stats Row -->
    <div class="row g-4 mb-4">
        <div class="col-6 col-lg-4">
            <div class="stat-card stat-card-primary">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-palette"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $totalCustomizations }}</span>
                        <span class="stat-card-label">Total Customizations</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-4">
            <div class="stat-card stat-card-success">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-envelope-open-text"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $rsvpEnabled }}</span>
                        <span class="stat-card-label">RSVP Enabled</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-4">
            <div class="stat-card stat-card-warning">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $upcomingWeddings }}</span>
                        <span class="stat-card-label">Upcoming Weddings</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toolbar -->
    <div class="toolbar mb-4">
        <div class="input-group" style="max-width: 300px;">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            <input type="text" id="searchInput" class="form-control" placeholder="Search customizations...">
        </div>
        
        <div class="toolbar-actions ms-auto">
            <select id="rsvpFilter" class="form-select">
                <option value="">All</option>
                <option value="rsvp">RSVP Enabled</option>
                <option value="no-rsvp">RSVP Disabled</option>
            </select>
        </div>
    </div>

    <!-- User Customizations Table -->
    <div class="card">
        <div class="card-body p-0">
            @if($customizations->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover data-table mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Design</th>
                                <th>User</th>
                                <th>Couple Names</th>
                                <th>Wedding Date</th>
                                <th>RSVP</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customizations as $customization)
                            <tr data-rsvp="{{ $customization->rsvp_enabled ? 'rsvp' : 'no-rsvp' }}">
                                <td>
                                    <span class="fw-medium text-primary">#{{ $customization->id }}</span>
                                </td>
                                <td>
                                    @if($customization->design)
                                        <a href="{{ route('admin.designs.show', $customization->design->id) }}" class="text-primary">
                                            {{ Str::limit($customization->design->design_name ?? 'Untitled', 25) }}
                                        </a>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if($customization->user)
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar avatar-sm">
                                                @if($customization->user->avatar)
                                                    <img src="{{ asset('storage/' . $customization->user->avatar) }}" alt="{{ $customization->user->name }}">
                                                @else
                                                    <span class="avatar-initials">{{ strtoupper(substr($customization->user->name, 0, 1)) }}</span>
                                                @endif
                                            </div>
                                            <span>{{ $customization->user->name }}</span>
                                        </div>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-1">
                                        <i class="fas fa-heart text-danger small"></i>
                                        <span>{{ $customization->bride_name ?? 'Bride' }}</span>
                                        <span class="text-muted">&</span>
                                        <span>{{ $customization->groom_name ?? 'Groom' }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if($customization->wedding_date)
                                        <span class="badge {{ $customization->wedding_date->isFuture() ? 'badge-primary' : 'badge-secondary' }}">
                                            <i class="fas fa-calendar me-1"></i>{{ $customization->wedding_date->format('M d, Y') }}
                                        </span>
                                    @else
                                        <span class="text-muted">Not set</span>
                                    @endif
                                </td>
                                <td>
                                    @if($customization->rsvp_enabled)
                                        <span class="badge badge-success">
                                            <i class="fas fa-check me-1"></i>Enabled
                                        </span>
                                    @else
                                        <span class="badge badge-light">Disabled</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.user-customizations.show', $customization->id) }}" 
                                           class="btn btn-icon btn-outline-primary" 
                                           title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-icon btn-outline-danger" 
                                                onclick="confirmDelete({{ $customization->id }}, '{{ $customization->bride_name ?? 'Bride' }} & {{ $customization->groom_name ?? 'Groom' }}')"
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
                
                @if($customizations->hasPages())
                    <div class="card-footer">
                        {{ $customizations->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-palette"></i>
                    </div>
                    <h3>No Customizations Found</h3>
                    <p>No user customizations have been created yet.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Customization</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the customization for "<strong id="deleteItemName"></strong>"?</p>
                    <p class="text-muted small">This action cannot be undone.</p>
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
            document.getElementById('deleteForm').action = `/admin/user-customizations/${id}`;
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
            const rsvpFilter = document.getElementById('rsvpFilter');
            
            function applyFilters() {
                const filter = rsvpFilter.value;
                
                tableRows.forEach(row => {
                    const rowRsvp = row.dataset.rsvp;
                    const match = !filter || rowRsvp === filter;
                    
                    row.style.display = match ? '' : 'none';
                });
            }
            
            rsvpFilter.addEventListener('change', applyFilters);
        });
    </script>
    @endpush
</x-admin-layout>