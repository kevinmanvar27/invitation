<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">
            <h1 class="text-3xl font-bold text-primary-dark">Manage Coupons</h1>
            <p class="text-accent-dark text-sm mt-1">View and manage all discount coupons</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-primary-dark">
                    <!-- Header with Search and Add Button -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <input type="text" id="searchInput" class="search-input" placeholder="Search coupons...">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="w-5 h-5 text-accent-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('admin.coupons.create') }}" class="btn-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add Coupon
                        </a>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <div class="stat-card">
                            <div class="flex items-center">
                                <div class="p-3 rounded-lg bg-primary-light mr-4">
                                    <svg class="w-6 h-6 text-primary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-accent-dark">Total Coupons</p>
                                    <p class="text-2xl font-semibold text-primary-dark">0</p>
                                </div>
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="flex items-center">
                                <div class="p-3 rounded-lg bg-secondary-light mr-4">
                                    <svg class="w-6 h-6 text-accent-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-accent-dark">Active Coupons</p>
                                    <p class="text-2xl font-semibold text-primary-dark">0%</p>
                                </div>
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="flex items-center">
                                <div class="p-3 rounded-lg bg-accent-light mr-4">
                                    <svg class="w-6 h-6 text-accent-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-accent-dark">Total Discount Given</p>
                                    <p class="text-2xl font-semibold text-primary-dark">₹0</p>
                                </div>
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="flex items-center">
                                <div class="p-3 rounded-lg bg-secondary-light mr-4">
                                    <svg class="w-6 h-6 text-accent-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-accent-dark">Most Used Coupon</p>
                                    <p class="text-xl font-semibold text-primary-dark">N/A</p>
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
                                    <th class="text-table-header">Code</th>
                                    <th class="text-table-header">Discount Type</th>
                                    <th class="text-table-header">Discount Value</th>
                                    <th class="text-table-header">Min Purchase</th>
                                    <th class="text-table-header">Valid From</th>
                                    <th class="text-table-header">Valid Until</th>
                                    <th class="text-table-header">Usage Limit</th>
                                    <th class="text-table-header">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coupons as $coupon)
                                <tr>
                                    <td class="text-table-body">{{ $coupon->id }}</td>
                                    <td class="text-table-body">{{ $coupon->code }}</td>
                                    <td class="text-table-body">{{ ucfirst($coupon->discount_type) }}</td>
                                    <td class="text-table-body">
                                        @if($coupon->discount_type === 'percentage')
                                            {{ $coupon->discount_value }}%
                                        @else
                                            ₹{{ $coupon->discount_value }}
                                        @endif
                                    </td>
                                    <td class="text-table-body">₹{{ $coupon->min_purchase ?? 'N/A' }}</td>
                                    <td class="text-table-body">{{ $coupon->valid_from->format('M d, Y') }}</td>
                                    <td class="text-table-body">{{ $coupon->valid_until ? $coupon->valid_until->format('M d, Y') : 'N/A' }}</td>
                                    <td class="text-table-body">{{ $coupon->usage_limit ?? 'Unlimited' }}</td>
                                    <td>
                                        <div class="action-buttons flex gap-2">
                                            <a href="{{ route('admin.coupons.show', $coupon->id) }}" class="btn-action btn-view">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                View
                                            </a>
                                            <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn-action btn-edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Edit
                                            </a>
                                            <button class="btn-action btn-delete" onclick="confirmDelete('{{ $coupon->id }}')">
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
                        {{ $coupons->links() }}
                    </div>

                    <!-- Export Buttons -->
                    <div class="mt-6 flex justify-end space-x-4">
                        <button class="btn-secondary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Export CSV
                        </button>
                        <button class="btn-secondary">
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
        function confirmDelete(couponId) {
            if (confirm('Are you sure you want to delete this coupon? This action cannot be undone.')) {
                // Create a form dynamically and submit it
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ url("admin/coupons") }}/' + couponId;
                
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
        });
    </script>
</x-admin-layout>