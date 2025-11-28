<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">
            <h1 class="page-header-title">Manage Payments</h1>
            <p class="page-header-subtitle">View and manage all payment transactions</p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Header with Search -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                        <div class="flex-1 flex flex-col sm:flex-row gap-3">
                            <div class="relative flex-1">
                                <input type="text" id="searchInput" class="modern-search-input" placeholder="Search payments...">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                        <div class="flex gap-4 flex-wrap">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Gateway</label>
                                <select id="gatewayFilter" class="modern-filter-dropdown">
                                    <option value="">All Gateways</option>
                                    <option value="stripe">Stripe</option>
                                    <option value="paypal">PayPal</option>
                                    <option value="bank">Bank Transfer</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select id="statusFilter" class="modern-filter-dropdown">
                                    <option value="">All Statuses</option>
                                    <option value="pending">Pending</option>
                                    <option value="completed">Completed</option>
                                    <option value="failed">Failed</option>
                                    <option value="refunded">Refunded</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button class="modern-btn modern-btn-secondary">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                </svg>
                                Filter
                            </button>
                            <button class="modern-btn modern-btn-secondary">
                                Clear
                            </button>
                        </div>
                    </div>

                    <!-- Payment Gateway Status Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="modern-stat-card">
                            <div class="modern-stat-card-icon" style="background: linear-gradient(to bottom right, #dbeafe, #bfdbfe);">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                            </div>
                            <p class="modern-stat-card-number">Active</p>
                            <p class="modern-stat-card-label">Stripe Integration</p>
                        </div>

                        <div class="modern-stat-card">
                            <div class="modern-stat-card-icon" style="background: linear-gradient(to bottom right, #dcfce7, #bbf7d0);">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                            </div>
                            <p class="modern-stat-card-number">Active</p>
                            <p class="modern-stat-card-label">PayPal Integration</p>
                        </div>

                        <div class="modern-stat-card">
                            <div class="modern-stat-card-icon" style="background: linear-gradient(to bottom right, #fef3c7, #fde68a);">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                </svg>
                            </div>
                            <p class="modern-stat-card-number">Active</p>
                            <p class="modern-stat-card-label">Bank Transfer</p>
                        </div>
                    </div>

                    <!-- Data Table -->
                    <div class="overflow-x-auto">
                        <table class="modern-table datatable">
                            <thead>
                                <tr>
                                    <th class="text-table-header">ID</th>
                                    <th class="text-table-header">Transaction ID</th>
                                    <th class="text-table-header">User</th>
                                    <th class="text-table-header text-right">Amount</th>
                                    <th class="text-table-header">Payment Method</th>
                                    <th class="text-table-header">Gateway</th>
                                    <th class="text-table-header">Status</th>
                                    <th class="text-table-header">Date</th>
                                    <th class="text-table-header text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $payment)
                                <tr>
                                    <td class="text-table-body">{{ $payment->id }}</td>
                                    <td class="text-table-body">{{ $payment->transaction_id }}</td>
                                    <td class="text-table-body">{{ $payment->user->name ?? 'N/A' }}</td>
                                    <td class="text-table-body text-right">₹{{ number_format($payment->amount, 2) }}</td>
                                    <td class="text-table-body">{{ $payment->payment_method }}</td>
                                    <td class="text-table-body">{{ $payment->gateway }}</td>
                                    <td class="text-table-body">
                                        @if($payment->status === 'completed')
                                            <span class="modern-badge modern-badge-success">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Completed
                                            </span>
                                        @elseif($payment->status === 'failed')
                                            <span class="modern-badge modern-badge-error">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                Failed
                                            </span>
                                        @elseif($payment->status === 'refunded')
                                            <span class="modern-badge modern-badge-warning">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                                </svg>
                                                Refunded
                                            </span>
                                        @else
                                            <span class="modern-badge modern-badge-info">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-table-body">{{ $payment->created_at->format('M d, Y H:i') }}</td>
                                    <td class="text-right">
                                        <div class="action-buttons flex gap-2 justify-end">
                                            <button data-payment-id="{{ $payment->id }}" class="refund-payment-btn modern-action-btn modern-action-btn-edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Refund
                                            </button>
                                            <a href="{{ route('admin.payments.show', $payment->id) }}" class="modern-action-btn modern-action-btn-view">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 4.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                View
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Modern Pagination -->
                    <div class="modern-pagination mt-6">
                        <div class="modern-pagination-info">
                            Showing {{ $payments->firstItem() }} to {{ $payments->lastItem() }} of {{ $payments->total() }} entries
                        </div>
                        <div class="modern-pagination-controls">
                            @if ($payments->onFirstPage())
                                <button class="modern-pagination-btn disabled">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>
                            @else
                                <a href="{{ $payments->previousPageUrl() }}" class="modern-pagination-btn">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </a>
                            @endif

                            @for ($i = 1; $i <= $payments->lastPage(); $i++)
                                @if ($i == $payments->currentPage())
                                    <button class="modern-pagination-btn active">{{ $i }}</button>
                                @else
                                    <a href="{{ $payments->url($i) }}" class="modern-pagination-btn">{{ $i }}</a>
                                @endif
                            @endfor

                            @if ($payments->hasMorePages())
                                <a href="{{ $payments->nextPageUrl() }}" class="modern-pagination-btn">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            @else
                                <button class="modern-pagination-btn disabled">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>

                    <!-- Export Buttons -->
                    <div class="mt-6 flex justify-end space-x-4">
                        <button id="exportCsv" class="modern-btn modern-btn-secondary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Export CSV
                        </button>
                        <button id="exportExcel" class="modern-btn modern-btn-secondary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Export Excel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Search functionality
            $('#searchInput').on('keyup', function() {
                const value = $(this).val().toLowerCase();
                $('tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            
            // Filter functionality
            $('#gatewayFilter, #statusFilter').on('change', function() {
                // In a real application, this would filter the table
                alert('Filtering functionality would be implemented here');
            });
            
            // Refund payment functionality
            $('.refund-payment-btn').on('click', function() {
                const paymentId = $(this).data('payment-id');
                if (confirm(`Are you sure you want to refund payment #${paymentId}?`)) {
                    alert(`Refunding payment with ID: ${paymentId}`);
                    // In a real application, this would process the refund via AJAX
                }
            });
        });
    </script>
</x-admin-layout>