<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">
            <h1 class="text-3xl font-bold text-gray-900">Manage RSVP Responses</h1>
            <p class="text-gray-500 text-sm mt-1">View and manage all RSVP responses</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Header with Search -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                        <div class="flex-1">
                            <div class="relative">
                                <input type="text" id="searchInput" class="search-input" placeholder="Search RSVP responses...">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
                                <label class="block text-sm font-medium text-gray-700 mb-1">Response</label>
                                <select id="responseFilter" class="search-input">
                                    <option value="">All Responses</option>
                                    <option value="attending">Attending</option>
                                    <option value="not_attending">Not Attending</option>
                                    <option value="maybe">Maybe</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Date Range</label>
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

                    <!-- RSVP Analytics Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div class="stat-card">
                            <div class="flex items-center">
                                <div class="p-3 rounded-lg bg-blue-100 mr-4">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Acceptance Rate</p>
                                    <p class="text-2xl font-semibold text-gray-900">72.5%</p>
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
                                    <p class="text-sm font-medium text-gray-500">Total Guests</p>
                                    <p class="text-2xl font-semibold text-gray-900">1,245</p>
                                </div>
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="flex items-center">
                                <div class="p-3 rounded-lg bg-yellow-100 mr-4">
                                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Pending Responses</p>
                                    <p class="text-2xl font-semibold text-gray-900">87</p>
                                </div>
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="flex items-center">
                                <div class="p-3 rounded-lg bg-purple-100 mr-4">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Dietary Requests</p>
                                    <p class="text-2xl font-semibold text-gray-900">34</p>
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
                                    <th class="text-table-header">Invitation Title</th>
                                    <th class="text-table-header">Guest Name</th>
                                    <th class="text-table-header">Email</th>
                                    <th class="text-table-header">Phone</th>
                                    <th class="text-table-header">Response</th>
                                    <th class="text-table-header">Guest Count</th>
                                    <th class="text-table-header">Meal Preference</th>
                                    <th class="text-table-header">Response Date</th>
                                    <th class="text-table-header">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rsvpResponses as $rsvpResponse)
                                <tr>
                                    <td class="text-table-body">{{ $rsvpResponse->id }}</td>
                                    <td class="text-table-body">{{ $rsvpResponse->sharedInvitation->design->design_name ?? 'N/A' }}</td>
                                    <td class="text-table-body">{{ $rsvpResponse->guest_name ?? 'N/A' }}</td>
                                    <td class="text-table-body">{{ $rsvpResponse->guest_email ?? 'N/A' }}</td>
                                    <td class="text-table-body">{{ $rsvpResponse->guest_phone ?? 'N/A' }}</td>
                                    <td class="text-table-body">
                                        @if($rsvpResponse->response === 'attending')
                                            <span class="badge badge-success">
                                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Attending
                                            </span>
                                        @elseif($rsvpResponse->response === 'not_attending')
                                            <span class="badge badge-error">
                                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                Not Attending
                                            </span>
                                        @else
                                            <span class="badge badge-warning">
                                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Maybe
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-table-body">{{ $rsvpResponse->plus_ones_count }}</td>
                                    <td class="text-table-body">{{ Str::limit($rsvpResponse->meal_preference, 30) }}</td>
                                    <td class="text-table-body">{{ $rsvpResponse->responded_at ? $rsvpResponse->responded_at->format('M d, Y H:i') : $rsvpResponse->created_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        <div class="action-buttons flex gap-2">
                                            <button data-response-id="{{ $rsvpResponse->id }}" class="email-respondent-btn btn-action btn-edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                </svg>
                                                Email
                                            </button>
                                            <a href="{{ route('admin.rsvp-responses.show', $rsvpResponse->id) }}" class="btn-action btn-view">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                View
                                            </a>
                                            <button class="btn-action btn-delete" onclick="confirmDelete('{{ $rsvpResponse->id }}')">
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
                        {{ $rsvpResponses->links() }}
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
        function confirmDelete(responseId) {
            if (confirm('Are you sure you want to delete this RSVP response? This action cannot be undone.')) {
                // Create a form dynamically and submit it
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ url("admin/rsvp-responses") }}/' + responseId;
                
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
            $('#responseFilter').on('change', function() {
                // In a real application, this would filter the table
                alert('Filtering functionality would be implemented here');
            });
            
            // Email respondent functionality
            $('.email-respondent-btn').on('click', function() {
                const responseId = $(this).data('response-id');
                alert(`Opening email composer for response #${responseId}`);
                // In a real application, this would open an email composer
            });
        });
    </script>
</x-admin-layout>