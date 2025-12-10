@php
    $totalReferrals = $referrals->count();
    $completedReferrals = $referrals->where('status', 'completed')->count();
    $pendingReferrals = $referrals->where('status', 'pending')->count();
    $totalRewards = $referrals->sum('reward_earned');
@endphp

<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Referrals</li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <!-- KPI Stats Row -->
    <div class="row g-4 mb-4">
        <div class="col-6 col-lg-3">
            <div class="stat-card stat-card-primary">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $totalReferrals }}</span>
                        <span class="stat-card-label">Total Referrals</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card stat-card-success">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $completedReferrals }}</span>
                        <span class="stat-card-label">Completed</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card stat-card-warning">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $pendingReferrals }}</span>
                        <span class="stat-card-label">Pending</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card stat-card-info">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-rupee-sign"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">₹{{ number_format($totalRewards) }}</span>
                        <span class="stat-card-label">Total Rewards</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toolbar -->
    <div class="toolbar mb-4">
        <div class="input-group" style="max-width: 300px;">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            <input type="text" id="searchInput" class="form-control" placeholder="Search referrals...">
        </div>
        
        <div class="toolbar-actions ms-auto">
            <select id="statusFilter" class="form-select">
                <option value="">All Status</option>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
                <option value="expired">Expired</option>
            </select>
            
            <input type="date" id="startDate" class="form-control" style="width: auto;" title="Start Date">
            <input type="date" id="endDate" class="form-control" style="width: auto;" title="End Date">
            
            <button type="button" class="btn btn-outline-secondary" id="clearFilters">
                <i class="fas fa-times me-1"></i>Clear
            </button>
            
            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-download me-1"></i>Export
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-file-csv me-2"></i>Export CSV</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-file-excel me-2"></i>Export Excel</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Referrals Table -->
    <div class="card">
        <div class="card-body p-0">
            @if($referrals->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover data-table mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Referrer</th>
                                <th>Referred User</th>
                                <th>Reward Earned</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($referrals as $referral)
                            <tr data-status="{{ $referral->status }}">
                                <td>
                                    <span class="fw-medium text-primary">#{{ $referral->id }}</span>
                                </td>
                                <td>
                                    @if($referral->referrer)
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar avatar-sm">
                                                @if($referral->referrer->avatar)
                                                    <img src="{{ asset('storage/' . $referral->referrer->avatar) }}" alt="{{ $referral->referrer->name }}">
                                                @else
                                                    <span class="avatar-initials">{{ strtoupper(substr($referral->referrer->name, 0, 1)) }}</span>
                                                @endif
                                            </div>
                                            <div>
                                                <span class="fw-medium">{{ $referral->referrer->name }}</span>
                                                <br><small class="text-muted">{{ $referral->referrer->email }}</small>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if($referral->referred)
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar avatar-sm">
                                                @if($referral->referred->avatar)
                                                    <img src="{{ asset('storage/' . $referral->referred->avatar) }}" alt="{{ $referral->referred->name }}">
                                                @else
                                                    <span class="avatar-initials">{{ strtoupper(substr($referral->referred->name, 0, 1)) }}</span>
                                                @endif
                                            </div>
                                            <span>{{ $referral->referred->name }}</span>
                                        </div>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-success">
                                        <i class="fas fa-rupee-sign me-1"></i>{{ number_format($referral->reward_earned) }}
                                    </span>
                                </td>
                                <td>
                                    @switch($referral->status)
                                        @case('completed')
                                            <span class="badge badge-success">
                                                <i class="fas fa-check me-1"></i>Completed
                                            </span>
                                            @break
                                        @case('pending')
                                            <span class="badge badge-warning">
                                                <i class="fas fa-clock me-1"></i>Pending
                                            </span>
                                            @break
                                        @case('expired')
                                            <span class="badge badge-danger">
                                                <i class="fas fa-times me-1"></i>Expired
                                            </span>
                                            @break
                                        @default
                                            <span class="badge badge-light">{{ ucfirst($referral->status ?? 'Unknown') }}</span>
                                    @endswitch
                                </td>
                                <td>
                                    <span class="text-muted">{{ $referral->created_at->format('M d, Y') }}</span>
                                    <br>
                                    <small class="text-muted">{{ $referral->created_at->format('H:i') }}</small>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.referrals.show', $referral->id) }}" 
                                           class="btn btn-icon btn-outline-primary" 
                                           title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.referrals.edit', $referral->id) }}" 
                                           class="btn btn-icon btn-outline-warning" 
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-icon btn-outline-danger" 
                                                onclick="confirmDelete({{ $referral->id }}, '{{ $referral->referrer->name ?? 'N/A' }}')"
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
                
                @if($referrals->hasPages())
                    <div class="card-footer">
                        {{ $referrals->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <h3>No Referrals Found</h3>
                    <p>No referrals have been made yet.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Referral</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the referral by "<strong id="deleteItemName"></strong>"?</p>
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
            document.getElementById('deleteForm').action = `/admin/referrals/${id}`;
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
            const statusFilter = document.getElementById('statusFilter');
            
            function applyFilters() {
                const status = statusFilter.value;
                
                tableRows.forEach(row => {
                    const rowStatus = row.dataset.status;
                    const statusMatch = !status || rowStatus === status;
                    
                    row.style.display = statusMatch ? '' : 'none';
                });
            }
            
            statusFilter.addEventListener('change', applyFilters);
            
            // Clear filters
            document.getElementById('clearFilters').addEventListener('click', function() {
                searchInput.value = '';
                statusFilter.value = '';
                document.getElementById('startDate').value = '';
                document.getElementById('endDate').value = '';
                tableRows.forEach(row => row.style.display = '');
            });
        });
    </script>
    @endpush
</x-admin-layout>