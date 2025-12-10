@php
    $totalRevenue = $payments->sum('amount');
    $completedCount = $payments->where('status', 'completed')->count();
    $pendingCount = $payments->where('status', 'pending')->count();
    $refundedCount = $payments->where('status', 'refunded')->count();
@endphp

<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Payments</li>
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
                        <i class="fas fa-rupee-sign"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">₹{{ number_format($totalRevenue, 2) }}</span>
                        <span class="stat-card-label">Total Revenue</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card stat-card-success">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $completedCount }}</span>
                        <span class="stat-card-label">Completed</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
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
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card stat-card-info">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-undo"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $refundedCount }}</span>
                        <span class="stat-card-label">Refunded</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toolbar -->
    <div class="toolbar mb-4">
        <div class="input-group" style="max-width: 300px;">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            <input type="text" id="searchInput" class="form-control" placeholder="Search payments...">
        </div>
        
        <div class="toolbar-actions ms-auto">
            <select id="gatewayFilter" class="form-select">
                <option value="">All Gateways</option>
                <option value="stripe">Stripe</option>
                <option value="paypal">PayPal</option>
                <option value="bank">Bank Transfer</option>
            </select>
            
            <select id="statusFilter" class="form-select">
                <option value="">All Statuses</option>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
                <option value="failed">Failed</option>
                <option value="refunded">Refunded</option>
            </select>
            
            <button type="button" class="btn btn-outline-secondary" id="clearFilters">
                <i class="fas fa-times me-1"></i>Clear
            </button>
        </div>
    </div>

    <!-- Payments Table -->
    <div class="card">
        <div class="card-body p-0">
            @if($payments->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover data-table mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Transaction ID</th>
                                <th>User</th>
                                <th class="text-end">Amount</th>
                                <th>Method</th>
                                <th>Gateway</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                <td><span class="text-muted">#{{ $payment->id }}</span></td>
                                <td>
                                    <code class="text-primary">{{ Str::limit($payment->transaction_id, 20) }}</code>
                                </td>
                                <td>
                                    @if($payment->user)
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar avatar-sm">
                                                @if($payment->user->avatar)
                                                    <img src="{{ asset('storage/' . $payment->user->avatar) }}" alt="{{ $payment->user->name }}">
                                                @else
                                                    <span class="avatar-initials">{{ strtoupper(substr($payment->user->name, 0, 1)) }}</span>
                                                @endif
                                            </div>
                                            <span>{{ $payment->user->name }}</span>
                                        </div>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <strong>₹{{ number_format($payment->amount, 2) }}</strong>
                                </td>
                                <td>
                                    <span class="text-capitalize">{{ $payment->payment_method ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    @if($payment->gateway === 'stripe')
                                        <i class="fab fa-stripe text-primary me-1"></i>
                                    @elseif($payment->gateway === 'paypal')
                                        <i class="fab fa-paypal text-info me-1"></i>
                                    @else
                                        <i class="fas fa-university text-secondary me-1"></i>
                                    @endif
                                    <span class="text-capitalize">{{ $payment->gateway ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    @switch($payment->status)
                                        @case('completed')
                                            <span class="badge badge-success">
                                                <i class="fas fa-check me-1"></i>Completed
                                            </span>
                                            @break
                                        @case('failed')
                                            <span class="badge badge-danger">
                                                <i class="fas fa-times me-1"></i>Failed
                                            </span>
                                            @break
                                        @case('refunded')
                                            <span class="badge badge-warning">
                                                <i class="fas fa-undo me-1"></i>Refunded
                                            </span>
                                            @break
                                        @default
                                            <span class="badge badge-info">
                                                <i class="fas fa-clock me-1"></i>Pending
                                            </span>
                                    @endswitch
                                </td>
                                <td>
                                    <span class="text-muted">{{ $payment->created_at->format('M d, Y') }}</span>
                                    <br>
                                    <small class="text-muted">{{ $payment->created_at->format('H:i') }}</small>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.payments.show', $payment->id) }}" 
                                           class="btn btn-icon btn-outline-primary" 
                                           title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($payment->status === 'completed')
                                            <button type="button" 
                                                    class="btn btn-icon btn-outline-warning refund-btn" 
                                                    data-payment-id="{{ $payment->id }}"
                                                    data-transaction-id="{{ $payment->transaction_id }}"
                                                    data-amount="{{ $payment->amount }}"
                                                    title="Process Refund">
                                                <i class="fas fa-undo"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if($payments->hasPages())
                    <div class="card-footer">
                        {{ $payments->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <h3>No Payments Found</h3>
                    <p>No payment transactions have been recorded yet.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Refund Modal -->
    <div class="modal fade" id="refundModal" tabindex="-1" aria-labelledby="refundModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="refundModalLabel">Process Refund</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Warning:</strong> This action cannot be undone.
                    </div>
                    <p>Are you sure you want to refund this payment?</p>
                    <div class="detail-grid mt-3">
                        <div class="detail-item">
                            <span class="detail-label">Transaction ID</span>
                            <span class="detail-value" id="refundTransactionId"></span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Amount</span>
                            <span class="detail-value text-success" id="refundAmount"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="refundForm" method="POST" style="display: inline;">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-undo me-1"></i>Process Refund
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
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
            const gatewayFilter = document.getElementById('gatewayFilter');
            const statusFilter = document.getElementById('statusFilter');
            
            function applyFilters() {
                const gateway = gatewayFilter.value.toLowerCase();
                const status = statusFilter.value.toLowerCase();
                
                tableRows.forEach(row => {
                    const rowGateway = row.querySelector('td:nth-child(6)').textContent.toLowerCase();
                    const rowStatus = row.querySelector('td:nth-child(7)').textContent.toLowerCase();
                    
                    const gatewayMatch = !gateway || rowGateway.includes(gateway);
                    const statusMatch = !status || rowStatus.includes(status);
                    
                    row.style.display = (gatewayMatch && statusMatch) ? '' : 'none';
                });
            }
            
            gatewayFilter.addEventListener('change', applyFilters);
            statusFilter.addEventListener('change', applyFilters);
            
            // Clear filters
            document.getElementById('clearFilters').addEventListener('click', function() {
                searchInput.value = '';
                gatewayFilter.value = '';
                statusFilter.value = '';
                tableRows.forEach(row => row.style.display = '');
            });
            
            // Refund modal
            const refundModal = new bootstrap.Modal(document.getElementById('refundModal'));
            const refundBtns = document.querySelectorAll('.refund-btn');
            
            refundBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const paymentId = this.dataset.paymentId;
                    const transactionId = this.dataset.transactionId;
                    const amount = this.dataset.amount;
                    
                    document.getElementById('refundTransactionId').textContent = transactionId;
                    document.getElementById('refundAmount').textContent = '₹' + parseFloat(amount).toFixed(2);
                    document.getElementById('refundForm').action = `/admin/payments/${paymentId}/refund`;
                    
                    refundModal.show();
                });
            });
        });
    </script>
    @endpush
</x-admin-layout>