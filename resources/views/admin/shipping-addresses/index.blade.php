<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">
            <h1 class="text-3xl font-bold text-gray-900">Manage Shipping Addresses</h1>
            <p class="text-gray-500 text-sm mt-1">View and manage all shipping addresses</p>
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
                                <input type="text" id="searchInput" class="search-input" placeholder="Search addresses...">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('admin.shipping-addresses.create') }}" class="btn-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add Shipping Address
                        </a>
                    </div>

                    <!-- Filters -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                        <div class="w-full md:w-1/3">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Filter by User</label>
                            <select class="search-input">
                                <option>All Users</option>
                                <!-- Add user options here -->
                            </select>
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

                    <!-- Data Table -->
                    <div class="overflow-x-auto">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th class="text-table-header">ID</th>
                                    <th class="text-table-header">User</th>
                                    <th class="text-table-header">Full Name</th>
                                    <th class="text-table-header">Address</th>
                                    <th class="text-table-header">Phone</th>
                                    <th class="text-table-header">Default</th>
                                    <th class="text-table-header">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($shippingAddresses as $shippingAddress)
                                <tr>
                                    <td class="text-table-body">{{ $shippingAddress->id }}</td>
                                    <td class="text-table-body">{{ $shippingAddress->user->name ?? 'N/A' }}</td>
                                    <td class="text-table-body">{{ $shippingAddress->full_name }}</td>
                                    <td class="text-table-body">
                                        {{ $shippingAddress->address_line1 }}
                                        @if($shippingAddress->address_line2)
                                            <br>{{ $shippingAddress->address_line2 }}
                                        @endif
                                        <br>{{ $shippingAddress->city }}, {{ $shippingAddress->state }} {{ $shippingAddress->postal_code }}
                                        <br>{{ $shippingAddress->country }}
                                    </td>
                                    <td class="text-table-body">{{ $shippingAddress->phone }}</td>
                                    <td class="text-table-body">
                                        @if($shippingAddress->is_default)
                                            <span class="badge badge-success">Yes</span>
                                        @else
                                            <span class="badge badge-neutral">No</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="action-buttons flex gap-2">
                                            <a href="{{ route('admin.shipping-addresses.show', $shippingAddress->id) }}" class="btn-action btn-view">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                View
                                            </a>
                                            <a href="{{ route('admin.shipping-addresses.edit', $shippingAddress->id) }}" class="btn-action btn-edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Edit
                                            </a>
                                            <button class="btn-action btn-delete" onclick="confirmDelete('{{ $shippingAddress->id }}')">
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
                        {{ $shippingAddresses->links() }}
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
        function confirmDelete(addressId) {
            if (confirm('Are you sure you want to delete this shipping address? This action cannot be undone.')) {
                // Create a form dynamically and submit it
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ url("admin/shipping-addresses") }}/' + addressId;
                
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