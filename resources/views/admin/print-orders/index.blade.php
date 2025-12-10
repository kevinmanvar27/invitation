@php
    $pendingCount = $printOrders->where('status', 'pending')->count();
    $processingCount = $printOrders->where('status', 'processing')->count();
    $printedCount = $printOrders->where('status', 'printed')->count();
    $shippedCount = $printOrders->where('status', 'shipped')->count();
    $deliveredCount = $printOrders->where('status', 'delivered')->count();
@endphp

<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Print Orders</li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <!-- KPI Stats Row -->
    <div class="row g-4 mb-4">
        <div class="col-6 col-lg">
            <div class="stat-card stat-card-warning">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $pendingCount }}</span>
                        <span class="stat-card-label">Pending</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg">
            <div class="stat-card stat-card-info">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-cog"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $processingCount }}</span>
                        <span class="stat-card-label">Processing</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg">
            <div class="stat-card stat-card-primary">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-print"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $printedCount }}</span>
                        <span class="stat-card-label">Printed</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg">
            <div class="stat-card stat-card-secondary">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $shippedCount }}</span>
                        <span class="stat-card-label">Shipped</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg">
            <div class="stat-card stat-card-success">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $deliveredCount }}</span>
                        <span class="stat-card-label">Delivered</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toolbar -->
    <div class="toolbar mb-4">
        <div class="input-group" style="max-width: 300px;">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            <input type="text" id="searchInput" class="form-control" placeholder="Search orders...">
        </div>
        
        <div class="toolbar-actions ms-auto">
            <select id="statusFilter" class="form-select">
                <option value="">All Statuses</option>
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="printed">Printed</option>
                <option value="shipped">Shipped</option>
                <option value="delivered">Delivered</option>
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
                    <li><a class="dropdown-item" href="#" id="exportCsv"><i class="fas fa-file-csv me-2"></i>Export CSV</a></li>
                    <li><a class="dropdown-item" href="#" id="exportExcel"><i class="fas fa-file-excel me-2"></i>Export Excel</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Print Orders Table -->
    <div class="card">
        <div class="card-body p-0">
            @if($printOrders->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover data-table mb-0">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Design</th>
                                <th class="text-center">Qty</th>
                                <th>Paper/Size</th>
                                <th>Delivery Address</th>
                                <th>Status</th>
                                <th>Order Date</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($printOrders as $printOrder)
                            <tr>
                                <td>
                                    <span class="fw-medium text-primary">#{{ $printOrder->id }}</span>
                                </td>
                                <td>
                                    @if($printOrder->user)
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar avatar-sm">
                                                @if($printOrder->user->avatar)
                                                    <img src="{{ asset('storage/' . $printOrder->user->avatar) }}" alt="{{ $printOrder->user->name }}">
                                                @else
                                                    <span class="avatar-initials">{{ strtoupper(substr($printOrder->user->name, 0, 1)) }}</span>
                                                @endif
                                            </div>
                                            <span>{{ $printOrder->user->name }}</span>
                                        </div>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if($printOrder->design)
                                        <a href="{{ route('admin.designs.show', $printOrder->design->id) }}" class="text-primary">
                                            {{ Str::limit($printOrder->design->design_name ?? 'Untitled', 20) }}
                                        </a>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-light">{{ $printOrder->quantity }}</span>
                                </td>
                                <td>
                                    <div class="small">
                                        <span class="text-muted">{{ $printOrder->paper_type ?? 'N/A' }}</span>
                                        @if($printOrder->size)
                                            <br><span class="badge badge-secondary">{{ $printOrder->size }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($printOrder->delivery_address)
                                        <span class="text-muted" title="{{ $printOrder->delivery_address }}">
                                            <i class="fas fa-map-marker-alt me-1"></i>{{ Str::limit($printOrder->delivery_address, 25) }}
                                        </span>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @switch($printOrder->status)
                                        @case('pending')
                                            <span class="badge badge-warning">
                                                <i class="fas fa-clock me-1"></i>Pending
                                            </span>
                                            @break
                                        @case('processing')
                                            <span class="badge badge-info">
                                                <i class="fas fa-cog me-1"></i>Processing
                                            </span>
                                            @break
                                        @case('printed')
                                            <span class="badge badge-primary">
                                                <i class="fas fa-print me-1"></i>Printed
                                            </span>
                                            @break
                                        @case('shipped')
                                            <span class="badge badge-secondary">
                                                <i class="fas fa-shipping-fast me-1"></i>Shipped
                                            </span>
                                            @break
                                        @case('delivered')
                                            <span class="badge badge-success">
                                                <i class="fas fa-check me-1"></i>Delivered
                                            </span>
                                            @break
                                        @default
                                            <span class="badge badge-light">{{ ucfirst($printOrder->status ?? 'Unknown') }}</span>
                                    @endswitch
                                </td>
                                <td>
                                    <span class="text-muted">{{ $printOrder->created_at->format('M d, Y') }}</span>
                                    <br>
                                    <small class="text-muted">{{ $printOrder->created_at->format('H:i') }}</small>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.print-orders.show', $printOrder->id) }}" 
                                           class="btn btn-icon btn-outline-primary" 
                                           title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-icon btn-outline-warning update-status-btn" 
                                                data-order-id="{{ $printOrder->id }}"
                                                data-current-status="{{ $printOrder->status }}"
                                                title="Update Status">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" 
                                                class="btn btn-icon btn-outline-danger" 
                                                onclick="confirmDelete({{ $printOrder->id }}, '#{{ $printOrder->id }}')"
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
                
                @if($printOrders->hasPages())
                    <div class="card-footer">
                        {{ $printOrders->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-print"></i>
                    </div>
                    <h3>No Print Orders Found</h3>
                    <p>No print orders have been placed yet.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Update Status Modal -->
    <div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateStatusModalLabel">Update Order Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateStatusForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <p class="text-muted mb-3">Update the status for order <strong id="statusOrderId"></strong></p>
                        <div class="mb-3">
                            <label class="form-label">New Status</label>
                            <select id="newStatus" name="status" class="form-select">
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="printed">Printed</option>
                                <option value="shipped">Shipped</option>
                                <option value="delivered">Delivered</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Print Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete order "<strong id="deleteItemName"></strong>"?</p>
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
            document.getElementById('deleteForm').action = `/admin/print-orders/${id}`;
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
                const status = statusFilter.value.toLowerCase();
                
                tableRows.forEach(row => {
                    const rowStatus = row.querySelector('td:nth-child(7)').textContent.toLowerCase();
                    const statusMatch = !status || rowStatus.includes(status);
                    
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
            
            // Update status modal
            const updateStatusModal = new bootstrap.Modal(document.getElementById('updateStatusModal'));
            
            document.querySelectorAll('.update-status-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const orderId = this.dataset.orderId;
                    const currentStatus = this.dataset.currentStatus;
                    
                    document.getElementById('statusOrderId').textContent = '#' + orderId;
                    document.getElementById('newStatus').value = currentStatus;
                    document.getElementById('updateStatusForm').action = `/admin/print-orders/${orderId}/status`;
                    
                    updateStatusModal.show();
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