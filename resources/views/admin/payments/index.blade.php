<x-admin-layout>
    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Manage Payments</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Payments</li>
                </ol>
            </div>
        </div>
        <p class="text-muted">View and manage all payment transactions</p>
    </x-slot>

    <div class="container-fluid">
        <!-- Unified Toolbar -->
        <div class="toolbar">
            <div class="d-flex flex-column flex-sm-row gap-2 flex-grow-1">
                <input type="text" id="searchInput" class="toolbar-search" placeholder="Search payments...">
                
                <div class="toolbar-filters">
                    <select id="gatewayFilter" class="toolbar-select">
                        <option value="">All Gateways</option>
                        <option value="stripe">Stripe</option>
                        <option value="paypal">PayPal</option>
                        <option value="bank">Bank Transfer</option>
                    </select>
                    
                    <select id="statusFilter" class="toolbar-select">
                        <option value="">All Statuses</option>
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                        <option value="failed">Failed</option>
                        <option value="refunded">Refunded</option>
                    </select>
                    
                    <button type="button" class="btn btn-secondary" id="filterButton">
                        <i class="fas fa-filter"></i>
                        Filter
                    </button>
                    
                    <a href="#" class="btn btn-ghost" id="clearFilters">
                        Clear
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Payment Gateway Status Cards -->
        <div class="row mb-4">
            <div class="col-lg-4 col-6 mb-4">
                <div class="card card-stat">
                    <div class="inner">
                        <h3>Active</h3>
                        <p>Stripe Integration</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-6 mb-4">
                <div class="card card-stat">
                    <div class="inner">
                        <h3>Active</h3>
                        <p>PayPal Integration</p>
                    </div>
                    <div class="icon">
                        <i class="fab fa-paypal"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-6 mb-4">
                <div class="card card-stat">
                    <div class="inner">
                        <h3>Active</h3>
                        <p>Bank Transfer</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-university"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <!-- Data Table -->
                <div class="table-container">
                    <table id="paymentsTable" class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Transaction ID</th>
                                <th>User</th>
                                <th class="text-right">Amount</th>
                                <th>Payment Method</th>
                                <th>Gateway</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                            <tr>
                                <td>{{ $payment->id }}</td>
                                <td>{{ $payment->transaction_id }}</td>
                                <td>{{ $payment->user->name ?? 'N/A' }}</td>
                                <td class="text-right">₹{{ number_format($payment->amount, 2) }}</td>
                                <td>{{ $payment->payment_method }}</td>
                                <td>{{ $payment->gateway }}</td>
                                <td>
                                    @if($payment->status === 'completed')
                                        <span class="badge badge-success">
                                            <i class="fas fa-check"></i>
                                            Completed
                                        </span>
                                    @elseif($payment->status === 'failed')
                                        <span class="badge badge-danger">
                                            <i class="fas fa-times"></i>
                                            Failed
                                        </span>
                                    @elseif($payment->status === 'refunded')
                                        <span class="badge badge-warning">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            Refunded
                                        </span>
                                    @else
                                        <span class="badge badge-info">
                                            <i class="fas fa-clock"></i>
                                            Pending
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $payment->created_at->format('M d, Y H:i') }}</td>
                                <td class="text-right">
                                    <div class="btn-group" role="group">
                                        <button data-payment-id="{{ $payment->id }}" class="refund-payment-btn btn btn-secondary btn-sm">
                                            <i class="fas fa-undo"></i>
                                            Refund
                                        </button>
                                        <a href="{{ route('admin.payments.show', $payment->id) }}" class="btn btn-ghost btn-sm">
                                            <i class="fas fa-eye"></i>
                                            View
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination mt-4">
                    {{ $payments->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Initialize DataTables
            $("#paymentsTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            });
            
            // Search functionality
            $('#searchInput').on('keyup', function() {
                const value = $(this).val().toLowerCase();
                $('tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</x-admin-layout>