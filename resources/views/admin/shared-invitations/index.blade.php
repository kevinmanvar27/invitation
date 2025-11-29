<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary-dark leading-tight">
            {{ __('Manage Shared Invitations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-primary-dark">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-primary-dark">Shared Invitations</h3>
                        <div class="flex space-x-2">
                            <select id="methodFilter" class="border rounded px-4 py-2">
                                <option value="">All Methods</option>
                                <option value="email">Email</option>
                                <option value="sms">SMS</option>
                                <option value="link">Link</option>
                                <option value="social">Social Media</option>
                            </select>
                            <select id="statusFilter" class="border rounded px-4 py-2">
                                <option value="">All Statuses</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="expired">Expired</option>
                            </select>
                            <input type="text" id="searchInput" placeholder="Search invitations..." class="border border-accent rounded px-4 py-2">
                            <button id="searchButton" class="bg-primary hover:bg-primary-dark text-primary-dark font-bold py-2 px-4 rounded">
                                Search
                            </button>
                        </div>
                    </div>

                    <!-- Share Analytics -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div class="bg-primary-light p-4 rounded-lg">
                            <h4 class="text-lg font-semibold text-primary-dark">Total Shares</h4>
                            <p class="text-2xl font-bold mt-2">12,456</p>
                            <p class="text-sm text-accent-dark">+15% from last month</p>
                        </div>
                        
                        <div class="bg-secondary-light p-4 rounded-lg">
                            <h4 class="text-lg font-semibold text-secondary-dark">Views</h4>
                            <p class="text-2xl font-bold mt-2">45,789</p>
                            <p class="text-sm text-accent-dark">+18% from last month</p>
                        </div>
                        
                        <div class="bg-accent-light p-4 rounded-lg">
                            <h4 class="text-lg font-semibold text-accent-dark">Click-Through Rate</h4>
                            <p class="text-2xl font-bold mt-2">36.7%</p>
                            <p class="text-sm text-accent-dark">+2.3% from last month</p>
                        </div>
                        
                        <div class="bg-secondary-light p-4 rounded-lg">
                            <h4 class="text-lg font-semibold text-secondary-dark">Responses</h4>
                            <p class="text-2xl font-bold mt-2">8,923</p>
                            <p class="text-sm text-accent-dark">+12% from last month</p>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-accent data-table">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">Invitation Title</th>
                                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">Shared By</th>
                                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">Share Method</th>
                                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">Share Link</th>
                                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">Views Count</th>
                                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">Sent Date</th>
                                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-accent">
                                @foreach($sharedInvitations as $sharedInvitation)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $sharedInvitation->id }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $sharedInvitation->design->design_name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $sharedInvitation->user->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-primary-light text-primary-dark">
                                            {{ ucfirst($sharedInvitation->share_method) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <a href="{{ $sharedInvitation->share_link }}" target="_blank" class="text-primary hover:text-primary-dark">
                                            {{ Str::limit($sharedInvitation->share_link, 30) }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $sharedInvitation->view_count }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $sharedInvitation->created_at->format('M d, Y H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $sharedInvitation->status === 'active' ? 'bg-secondary-light text-secondary-dark' : 
                                               ($sharedInvitation->status === 'expired' ? 'bg-error-light text-error-dark' : 
                                               'bg-accent-light text-accent-dark') }}">
                                            {{ ucfirst($sharedInvitation->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <button data-invitation-id="{{ $sharedInvitation->id }}" class="resend-invitation-btn text-primary hover:text-primary-dark mr-3">Resend</button>
                                        <a href="{{ route('admin.shared-invitations.show', $sharedInvitation->id) }}" class="text-primary hover:text-primary-dark mr-3">View</a>
                                        <form action="{{ route('admin.shared-invitations.destroy', $sharedInvitation->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-error hover:text-error-dark" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 flex justify-between items-center">
                        <div>
                            <button id="exportCsv" class="bg-secondary hover:bg-secondary-dark text-primary-dark font-bold py-2 px-4 rounded mr-2">
                                Export CSV
                            </button>
                            <button id="exportExcel" class="bg-secondary hover:bg-secondary-dark text-primary-dark font-bold py-2 px-4 rounded">
                                Export Excel
                            </button>
                        </div>
                        <div>
                            {{ $sharedInvitations->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Search functionality
            $('#searchButton').on('click', function() {
                const searchTerm = $('#searchInput').val();
                const methodFilter = $('#methodFilter').val();
                const statusFilter = $('#statusFilter').val();
                alert(`Searching for: ${searchTerm}, Method: ${methodFilter}, Status: ${statusFilter}`);
                // In a real application, this would filter the table
            });
            
            $('#searchInput').on('keypress', function(e) {
                if (e.which === 13) {
                    $('#searchButton').click();
                }
            });
            
            // Filter functionality
            $('#methodFilter, #statusFilter').on('change', function() {
                $('#searchButton').click();
            });
            
            // Resend invitation functionality
            $('.resend-invitation-btn').on('click', function() {
                const invitationId = $(this).data('invitation-id');
                if (confirm(`Are you sure you want to resend invitation #${invitationId}?`)) {
                    alert(`Resending invitation with ID: ${invitationId}`);
                    // In a real application, this would process the resend via AJAX
                }
            });
            
            // Export functionality
            $('#exportCsv').on('click', function() {
                alert('Exporting data as CSV');
            });
            
            $('#exportExcel').on('click', function() {
                alert('Exporting data as Excel');
            });
        });
    </script>
</x-admin-layout>