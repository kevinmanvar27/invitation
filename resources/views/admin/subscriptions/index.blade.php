<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">
            <h1 class="text-3xl font-bold text-gray-900">Manage Subscriptions</h1>
            <p class="text-gray-500 text-sm mt-1">View and manage all user subscriptions</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Header with Search and Add Button -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <input type="text" id="searchInput" class="search-input" placeholder="Search subscriptions...">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('admin.subscriptions.create') }}" class="btn-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add Subscription
                        </a>
                    </div>

                    <!-- Filters -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                        <div class="flex gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Plan</label>
                                <select id="planFilter" class="search-input">
                                    <option value="">All Plans</option>
                                    <option value="basic">Basic</option>
                                    <option value="premium">Premium</option>
                                    <option value="enterprise">Enterprise</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select id="statusFilter" class="search-input">
                                    <option value="">All Statuses</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
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

                    <!-- KPI Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <div class="stat-card">
                            <div class="flex items-center">
                                <div class="p-3 rounded-lg bg-blue-100 mr-4">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">MRR</p>
                                    <p class="text-2xl font-semibold text-gray-900">₹{{ number_format($mrr ?? 0, 2) }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="flex items-center">
                                <div class="p-3 rounded-lg bg-green-100 mr-4">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Active Subscriptions</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ $activeSubscriptions ?? 0 }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="flex items-center">
                                <div class="p-3 rounded-lg bg-yellow-100 mr-4">
                                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Churn Rate</p>
                                    <p class="text-2xl font-semibold text-gray-900">{{ $churnRate ?? 0 }}%</p>
                                </div>
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="flex items-center">
                                <div class="p-3 rounded-lg bg-purple-100 mr-4">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Avg. Revenue/User</p>
                                    <p class="text-2xl font-semibold text-gray-900">₹{{ number_format($avgRevenue ?? 0, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Table -->
                    <div class="overflow-x-auto">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th class="text-table-header">ID</th>
                                    <th class="text-table-header">User Name</th>
                                    <th class="text-table-header">Plan Name</th>
                                    <th class="text-table-header text-right">Price</th>
                                    <th class="text-table-header">Start Date</th>
                                    <th class="text-table-header">End Date</th>
                                    <th class="text-table-header">Status</th>
                                    <th class="text-table-header">Auto-renewal</th>
                                    <th class="text-table-header">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subscriptions as $subscription)
                                <tr>
                                    <td class="text-table-body">{{ $subscription->id }}</td>
                                    <td class="text-table-body">{{ $subscription->user->name ?? 'N/A' }}</td>
                                    <td class="text-table-body">{{ $subscription->plan_name }}</td>
                                    <td class="text-table-body text-right">₹{{ number_format($subscription->price, 2) }}</td>
                                    <td class="text-table-body">{{ $subscription->start_date ? $subscription->start_date->format('M d, Y') : 'N/A' }}</td>
                                    <td class="text-table-body">{{ $subscription->end_date ? $subscription->end_date->format('M d, Y') : 'N/A' }}</td>
                                    <td class="text-table-body">
                                        @if($subscription->status === 'active')
                                            <span class="badge badge-success">Active</span>
                                        @elseif($subscription->status === 'cancelled')
                                            <span class="badge badge-error">Cancelled</span>
                                        @else
                                            <span class="badge badge-warning">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-table-body">
                                        @if($subscription->auto_renewal)
                                            <span class="badge badge-info">Yes</span>
                                        @else
                                            <span class="badge badge-neutral">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-buttons flex gap-2">
                                            <button data-subscription-id="{{ $subscription->id }}" class="extend-subscription-btn btn-action btn-edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Extend
                                            </button>
                                            <a href="{{ route('admin.subscriptions.edit', $subscription->id) }}" class="btn-action btn-edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Edit
                                            </a>
                                            <button class="btn-action btn-delete" onclick="confirmDelete('{{ $subscription->id }}')">
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
                        {{ $subscriptions->links() }}
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

    <script>
        function confirmDelete(subscriptionId) {
            if (confirm('Are you sure you want to delete this subscription? This action cannot be undone.')) {
                // Create a form dynamically and submit it
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ url("admin/subscriptions") }}/' + subscriptionId;
                
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
            $('#planFilter, #statusFilter').on('change', function() {
                // In a real application, this would filter the table
                alert('Filtering functionality would be implemented here');
            });
            
            // Extend subscription functionality
            $('.extend-subscription-btn').on('click', function() {
                const subscriptionId = $(this).data('subscription-id');
                alert(`Extending subscription with ID: ${subscriptionId}`);
                // In a real application, this would open a modal or form to extend the subscription
            });
        });
    </script>
</x-admin-layout>