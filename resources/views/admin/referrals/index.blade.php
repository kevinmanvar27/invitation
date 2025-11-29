<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary-dark leading-tight">
            {{ __('Manage Referrals') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-primary-dark">
                    <!-- Search and Add Button -->
                    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                        <div class="w-full md:w-1/3">
                            <div class="relative">
                                <input type="text" id="searchInput" class="w-full px-4 py-2 border border-accent rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" placeholder="Search referrals...">
                                <button class="absolute right-2 top-2 bg-primary hover:bg-primary-dark text-primary-dark px-4 py-1 rounded">Search</button>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <div class="bg-primary-light rounded-lg p-6 shadow">
                            <div class="text-primary-dark font-semibold text-lg">Total Referrals</div>
                            <div class="text-3xl font-bold mt-2">0</div>
                            <div class="text-sm text-secondary-dark mt-1">↑ 0% from last month</div>
                        </div>
                        <div class="bg-secondary-light rounded-lg p-6 shadow">
                            <div class="text-secondary-dark font-semibold text-lg">Active Referrers</div>
                            <div class="text-3xl font-bold mt-2">0</div>
                        </div>
                        <div class="bg-accent-light rounded-lg p-6 shadow">
                            <div class="text-accent-dark font-semibold text-lg">Total Rewards Earned</div>
                            <div class="text-3xl font-bold mt-2">₹0</div>
                        </div>
                        <div class="bg-primary-light rounded-lg p-6 shadow">
                            <div class="text-primary-dark font-semibold text-lg">Conversion Rate</div>
                            <div class="text-3xl font-bold mt-2">0%</div>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                        <div class="flex flex-wrap gap-4">
                            <div>
                                <label class="block text-sm font-medium text-primary-dark mb-1">Status</label>
                                <select class="px-3 py-2 border border-accent rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                                    <option>All</option>
                                    <option>Active</option>
                                    <option>Completed</option>
                                    <option>Expired</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-primary-dark mb-1">Start Date</label>
                                <input type="date" class="px-3 py-2 border border-accent rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-primary-dark mb-1">End Date</label>
                                <input type="date" class="px-3 py-2 border border-accent rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>
                        </div>
                    </div>

                    <!-- DataTable -->
                    <div class="overflow-x-auto">
                        <table id="referralsTable" class="min-w-full divide-y divide-secondary-light">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">REFERRER</th>
                                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">REFERRED_USER</th>
                                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">REWARD_EARNED</th>
                                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">STATUS</th>
                                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">CREATED_AT</th>
                                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-secondary-light">
                                @foreach($referrals as $referral)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $referral->id }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $referral->referrer->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $referral->referred->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">₹{{ $referral->reward_earned }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $referral->status === 'completed' ? 'bg-secondary-light text-secondary-dark' : 'bg-accent-light text-accent-dark' }}">
                                            {{ ucfirst($referral->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $referral->created_at->format('M d, Y H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <a href="{{ route('admin.referrals.show', $referral->id) }}" class="text-primary hover:text-primary-dark mr-3">View</a>
                                        <a href="{{ route('admin.referrals.edit', $referral->id) }}" class="text-secondary hover:text-secondary-dark mr-3">Edit</a>
                                        <form action="{{ route('admin.referrals.destroy', $referral->id) }}" method="POST" class="inline">
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

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $referrals->links() }}
                    </div>

                    <!-- Export Buttons -->
                    <div class="mt-6 flex justify-end space-x-4">
                        <button class="bg-primary hover:bg-primary-dark text-primary-dark font-bold py-2 px-4 rounded">
                            Export CSV
                        </button>
                        <button class="bg-secondary hover:bg-secondary-dark text-primary-dark font-bold py-2 px-4 rounded">
                            Export Excel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include DataTables CSS and JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#referralsTable').DataTable({
                "pageLength": 25,
                "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
                "ordering": true,
                "searching": true,
                "paging": true
            });
        });
    </script>
</x-admin-layout>