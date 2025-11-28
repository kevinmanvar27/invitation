<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">
            <h1 class="page-header-title">User Profiles</h1>
            <p class="page-header-subtitle">Manage user profile information and track completeness</p>
        </div>
    </x-slot>

    <!-- Header with Search and Add Button -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-medium">User Profiles</h3>
        <div class="flex space-x-2">
            <input type="text" id="searchInput" placeholder="Search profiles..." class="border rounded px-4 py-2">
            <button id="searchButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Search
            </button>
            <a href="{{ route('admin.user-profiles.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add User Profile
            </a>
        </div>
    </div>

    <!-- Profile Completeness Tracking -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-blue-50 p-4 rounded-lg">
            <h4 class="text-lg font-semibold text-blue-800">Profile Statistics</h4>
            <div class="mt-2">
                <p>Total Profiles: <span class="font-medium">{{ $totalProfiles ?? 0 }}</span></p>
                <p>Complete Profiles: <span class="font-medium">{{ $completeProfiles ?? 0 }} ({{ $completePercentage ?? 0 }}%)</span></p>
                <p>Incomplete Profiles: <span class="font-medium">{{ $incompleteProfiles ?? 0 }} ({{ $incompletePercentage ?? 0 }}%)</span></p>
            </div>
        </div>
        
        <div class="bg-green-50 p-4 rounded-lg">
            <h4 class="text-lg font-semibold text-green-800">Activity Overview</h4>
            <div class="mt-2">
                <p>Active Users: <span class="font-medium">{{ $profiles->count() }}</span></p>
                <p>New This Week: <span class="font-medium">0</span></p>
                <p>Updated Today: <span class="font-medium">0</span></p>
            </div>
        </div>
        
        <div class="bg-purple-50 p-4 rounded-lg">
            <h4 class="text-lg font-semibold text-purple-800">Preferences</h4>
            <div class="mt-2">
                <p>Email Notifications: <span class="font-medium">0</span></p>
                <p>SMS Alerts: <span class="font-medium">0</span></p>
                <p>Push Notifications: <span class="font-medium">0</span></p>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 data-table">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">User Name</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Partner Name</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Wedding Date</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Profile Completeness</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Last Activity</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($profiles as $profile)
                <tr>
                    <td class="px-6 py-4 whitespace-no-wrap">{{ $profile->id }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap">{{ $profile->user->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap">{{ $profile->user->email ?? 'N/A' }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap">{{ $profile->first_name }} {{ $profile->last_name }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap">{{ $profile->wedding_date ? $profile->wedding_date->format('M d, Y') : 'N/A' }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <div class="flex items-center">
                            <div class="w-24 bg-gray-200 rounded-full h-2 mr-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: 75%"></div>
                            </div>
                            <span>75%</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap">{{ $profile->updated_at->format('M d, Y H:i') }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <a href="{{ route('admin.user-profiles.show', $profile->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                        <a href="{{ route('admin.user-profiles.edit', $profile->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                        <form action="{{ route('admin.user-profiles.destroy', $profile->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4 flex justify-between items-center">
        <div>
            <button id="exportCsv" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2">
                Export CSV
            </button>
            <button id="exportExcel" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Export Excel
            </button>
        </div>
        <div>
            {{ $profiles->links() }}
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Search functionality
            $('#searchButton').on('click', function() {
                const searchTerm = $('#searchInput').val();
                alert(`Searching for: ${searchTerm}`);
                // In a real application, this would filter the table
            });
            
            $('#searchInput').on('keypress', function(e) {
                if (e.which === 13) {
                    $('#searchButton').click();
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