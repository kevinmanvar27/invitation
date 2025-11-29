<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">
            <h1 class="text-3xl font-bold text-primary-dark">Manage Print Orders</h1>
            <p class="text-secondary-dark text-sm mt-1">View and manage all print orders</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-primary-dark">
                    <!-- Header with Search -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <input type="text" id="searchInput" class="search-input" placeholder="Search print orders...">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                        <div class="flex gap-4">
                            <div>
                                <label class="block text-sm font-medium text-primary-dark mb-1">Status</label>
                                <select id="statusFilter" class="search-input">
                                    <option value="">All Statuses</option>
                                    <option value="pending">Pending</option>
                                    <option value="processing">Processing</option>
                                    <option value="printed">Printed</option>
                                    <option value="shipped">Shipped</option>
                                    <option value="delivered">Delivered</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-primary-dark mb-1">Date Range</label>
                                <div class="flex gap-2">
                                    <input type="date" id="startDate" class="search-input" placeholder="Start Date">
                                    <input type="date" id="endDate" class="search-input" placeholder="End Date">
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button class="btn-secondary">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                </svg>
                                Filter
                            </button>
                            <button class="btn-secondary">
                                Clear
                            </button>
                        </div>
                    </div>

                    <!-- Order Status Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
                        <div class="stat-card">
                            <div class="text-center">
                                <div class="text-sm font-medium text-secondary-dark mb-1">Pending</div>
                                <div class="text-2xl font-bold text-accent">24</div>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="text-center">
                                <div class="text-sm font-medium text-secondary-dark mb-1">Processing</div>
                                <div class="text-2xl font-bold text-primary">18</div>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="text-center">
                                <div class="text-sm font-medium text-secondary-dark mb-1">Printed</div>
                                <div class="text-2xl font-bold text-primary">12</div>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="text-center">
                                <div class="text-sm font-medium text-secondary-dark mb-1">Shipped</div>
                                <div class="text-2xl font-bold text-primary">8</div>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="text-center">
                                <div class="text-sm font-medium text-secondary-dark mb-1">Delivered</div>
                                <div class="text-2xl font-bold text-secondary">42</div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Table -->
                    <div class="overflow-x-auto">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th class="text-table-header">Order ID</th>
                                    <th class="text-table-header">User Name</th>
                                    <th class="text-table-header">Design</th>
                                    <th class="text-table-header">Quantity</th>
                                    <th class="text-table-header">Paper Type</th>
                                    <th class="text-table-header">Size</th>
                                    <th class="text-table-header">Delivery Address</th>
                                    <th class="text-table-header">Status</th>
                                    <th class="text-table-header">Order Date</th>
                                    <th class="text-table-header">Delivery Date</th>
                                    <th class="text-table-header">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($printOrders as $printOrder)
                                <tr>
                                    <td class="text-table-body">{{ $printOrder->id }}</td>
                                    <td class="text-table-body">{{ $printOrder->user->name ?? 'N/A' }}</td>
                                    <td class="text-table-body">{{ $printOrder->design->design_name ?? 'N/A' }}</td>
                                    <td class="text-table-body">{{ $printOrder->quantity }}</td>
                                    <td class="text-table-body">{{ $printOrder->paper_type }}</td>
                                    <td class="text-table-body">{{ $printOrder->size }}</td>
                                    <td class="text-table-body">{{ Str::limit($printOrder->delivery_address ?? 'N/A', 20) }}</td>
                                    <td class="text-table-body">
                                        @if($printOrder->status === 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($printOrder->status === 'processing')
                                            <span class="badge badge-info">Processing</span>
                                        @elseif($printOrder->status === 'printed')
                                            <span class="badge badge-info">Printed</span>
                                        @elseif($printOrder->status === 'shipped')
                                            <span class="badge badge-info">Shipped</span>
                                        @elseif($printOrder->status === 'delivered')
                                            <span class="badge badge-success">Delivered</span>
                                        @endif
                                    </td>
                                    <td class="text-table-body">{{ $printOrder->created_at->format('M d, Y H:i') }}</td>
                                    <td class="text-table-body">{{ $printOrder->delivery_date ? $printOrder->delivery_date->format('M d, Y') : 'N/A' }}</td>
                                    <td>
                                        <div class="action-buttons flex gap-2">
                                            <button data-order-id="{{ $printOrder->id }}" class="update-status-btn btn-action btn-edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                                </svg>
                                                Update
                                            </button>
                                            <a href="{{ route('admin.print-orders.show', $printOrder->id) }}" class="btn-action btn-view">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                View
                                            </a>
                                            <button class="btn-action btn-delete" onclick="confirmDelete('{{ $printOrder->id }}')">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $printOrders->links() }}
                    </div>

                    <!-- Export Buttons -->
                    <div class="mt-6 flex justify-end space-x-4">
                        <button id="exportCsv" class="btn-secondary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Export CSV
                        </button>
                        <button id="exportExcel" class="btn-secondary">
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

    <!-- Update Status Modal -->
    <div id="updateStatusModal" class="fixed inset-0 bg-secondary bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border border-accent w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-primary-dark">Update Order Status</h3>
                    <button id="closeStatusModal" class="text-secondary hover:bg-secondary-light hover:text-primary rounded-lg text-sm p-1.5">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <form id="updateStatusForm">
                    <input type="hidden" id="orderId" value="">
                    <div class="mb-4">
                        <label class="block text-primary-dark text-sm font-bold mb-2" for="status">
                            Status
                        </label>
                        <select id="status" class="search-input">
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="printed">Printed</option>
                            <option value="shipped">Shipped</option>
                            <option value="delivered">Delivered</option>
                        </select>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="button" id="cancelStatusUpdate" class="bg-secondary hover:bg-secondary-dark text-primary-dark font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Cancel
                        </button>
                        <button type="submit" class="btn-primary">
                            Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(orderId) {
            if (confirm('Are you sure you want to delete this print order? This action cannot be undone.')) {
                // Create a form dynamically and submit it
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ url("admin/print-orders") }}/' + orderId;
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);
                
                const method = document.createElement('input');
                method.type = 'hidden';
                method.name = '_method';
                method.value = 'DELETE';
                form.appendChild(method);
                
                document.body.appendChild(form);
                form.submit();
            }
        }
        
        $(document).ready(function() {
            // Search functionality
            $('#searchInput').on('keyup', function() {
                const value = $(this).val().toLowerCase();
                $('tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            
            // Filter functionality
            $('#statusFilter').on('change', function() {
                // In a real application, this would filter the table
                alert('Filtering functionality would be implemented here');
            });
            
            // Update status functionality
            $('.update-status-btn').on('click', function() {
                const orderId = $(this).data('order-id');
                $('#orderId').val(orderId);
                $('#updateStatusModal').removeClass('hidden');
            });
            
            $('#closeStatusModal, #cancelStatusUpdate').on('click', function() {
                $('#updateStatusModal').addClass('hidden');
            });
            
            $('#updateStatusForm').on('submit', function(e) {
                e.preventDefault();
                const orderId = $('#orderId').val();
                const status = $('#status').val();
                alert(`Updating order #${orderId} status to: ${status}`);
                $('#updateStatusModal').addClass('hidden');
                // In a real application, this would update the status via AJAX
            });
        });
    </script>
</x-admin-layout>