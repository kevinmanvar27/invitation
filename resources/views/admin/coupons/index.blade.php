@php
    $totalCoupons = $coupons->count();
    $activeCoupons = $coupons->filter(fn($c) => $c->valid_until === null || $c->valid_until->isFuture())->count();
    $expiredCoupons = $totalCoupons - $activeCoupons;
    $percentageCoupons = $coupons->where('discount_type', 'percentage')->count();
@endphp

<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Coupons</li>
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
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $totalCoupons }}</span>
                        <span class="stat-card-label">Total Coupons</span>
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
                        <span class="stat-card-value">{{ $activeCoupons }}</span>
                        <span class="stat-card-label">Active</span>
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
                        <span class="stat-card-value">{{ $expiredCoupons }}</span>
                        <span class="stat-card-label">Expired</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card stat-card-info">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-percent"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $percentageCoupons }}</span>
                        <span class="stat-card-label">Percentage Type</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toolbar -->
    <div class="toolbar mb-4">
        <div class="input-group" style="max-width: 300px;">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            <input type="text" id="searchInput" class="form-control" placeholder="Search coupons...">
        </div>
        
        <div class="toolbar-actions ms-auto">
            <select id="typeFilter" class="form-select">
                <option value="">All Types</option>
                <option value="percentage">Percentage</option>
                <option value="fixed">Fixed Amount</option>
            </select>
            
            <select id="statusFilter" class="form-select">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="expired">Expired</option>
            </select>
            
            <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Add Coupon
            </a>
        </div>
    </div>

    <!-- Coupons Table -->
    <div class="card">
        <div class="card-body p-0">
            @if($coupons->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover data-table mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Discount</th>
                                <th>Min Purchase</th>
                                <th>Valid Period</th>
                                <th>Usage</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($coupons as $coupon)
                            @php
                                $isExpired = $coupon->valid_until && $coupon->valid_until->isPast();
                                $isActive = !$isExpired && ($coupon->valid_from === null || $coupon->valid_from->isPast());
                            @endphp
                            <tr data-type="{{ $coupon->discount_type }}" data-status="{{ $isExpired ? 'expired' : 'active' }}">
                                <td>
                                    <span class="fw-medium text-primary">#{{ $coupon->id }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <code class="bg-light px-2 py-1 rounded">{{ $coupon->code }}</code>
                                        <button type="button" class="btn btn-sm btn-link p-0 copy-code" data-code="{{ $coupon->code }}" title="Copy code">
                                            <i class="fas fa-copy text-muted"></i>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    @if($coupon->discount_type === 'percentage')
                                        <span class="badge badge-info">
                                            <i class="fas fa-percent me-1"></i>{{ $coupon->discount_value }}%
                                        </span>
                                    @else
                                        <span class="badge badge-success">
                                            <i class="fas fa-rupee-sign me-1"></i>{{ number_format($coupon->discount_value) }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($coupon->min_purchase)
                                        <span class="text-muted">₹{{ number_format($coupon->min_purchase) }}</span>
                                    @else
                                        <span class="text-muted">No minimum</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="small">
                                        <span class="text-muted">From:</span> {{ $coupon->valid_from->format('M d, Y') }}
                                        <br>
                                        <span class="text-muted">Until:</span> 
                                        @if($coupon->valid_until)
                                            {{ $coupon->valid_until->format('M d, Y') }}
                                        @else
                                            <span class="text-success">No expiry</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($coupon->usage_limit)
                                        <span class="badge badge-light">{{ $coupon->times_used ?? 0 }} / {{ $coupon->usage_limit }}</span>
                                    @else
                                        <span class="text-muted">Unlimited</span>
                                    @endif
                                </td>
                                <td>
                                    @if($isExpired)
                                        <span class="badge badge-danger">
                                            <i class="fas fa-times-circle me-1"></i>Expired
                                        </span>
                                    @elseif($isActive)
                                        <span class="badge badge-success">
                                            <i class="fas fa-check-circle me-1"></i>Active
                                        </span>
                                    @else
                                        <span class="badge badge-warning">
                                            <i class="fas fa-clock me-1"></i>Scheduled
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.coupons.show', $coupon->id) }}" 
                                           class="btn btn-icon btn-outline-primary" 
                                           title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.coupons.edit', $coupon->id) }}" 
                                           class="btn btn-icon btn-outline-warning" 
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-icon btn-outline-danger" 
                                                onclick="confirmDelete({{ $coupon->id }}, '{{ $coupon->code }}')"
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
                
                @if($coupons->hasPages())
                    <div class="card-footer">
                        {{ $coupons->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <h3>No Coupons Found</h3>
                    <p>Create your first discount coupon to attract customers.</p>
                    <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>Create Coupon
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Coupon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete coupon "<strong id="deleteItemName"></strong>"?</p>
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
            document.getElementById('deleteForm').action = `/admin/coupons/${id}`;
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
            const typeFilter = document.getElementById('typeFilter');
            const statusFilter = document.getElementById('statusFilter');
            
            function applyFilters() {
                const type = typeFilter.value;
                const status = statusFilter.value;
                
                tableRows.forEach(row => {
                    const rowType = row.dataset.type;
                    const rowStatus = row.dataset.status;
                    
                    const typeMatch = !type || rowType === type;
                    const statusMatch = !status || rowStatus === status;
                    
                    row.style.display = (typeMatch && statusMatch) ? '' : 'none';
                });
            }
            
            typeFilter.addEventListener('change', applyFilters);
            statusFilter.addEventListener('change', applyFilters);
            
            // Copy code functionality
            document.querySelectorAll('.copy-code').forEach(btn => {
                btn.addEventListener('click', function() {
                    const code = this.dataset.code;
                    navigator.clipboard.writeText(code).then(() => {
                        const icon = this.querySelector('i');
                        icon.classList.remove('fa-copy');
                        icon.classList.add('fa-check', 'text-success');
                        setTimeout(() => {
                            icon.classList.remove('fa-check', 'text-success');
                            icon.classList.add('fa-copy', 'text-muted');
                        }, 2000);
                    });
                });
            });
        });
    </script>
    @endpush
</x-admin-layout>