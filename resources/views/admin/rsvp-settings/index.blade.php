<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage RSVP Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">RSVP Settings</h3>
                        <div class="flex space-x-2">
                            <input type="text" id="searchInput" placeholder="Search settings..." class="border rounded px-4 py-2">
                            <button id="searchButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Search
                            </button>
                            <a href="{{ route('admin.rsvp-settings.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Add RSVP Setting
                            </a>
                        </div>
                    </div>

                    <!-- Configuration Options -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h4 class="text-lg font-semibold text-blue-800 mb-3">Form Configuration</h4>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Default Response Deadline</label>
                                    <input type="date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Email Notification Settings</label>
                                    <select class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        <option>Immediately</option>
                                        <option>Daily Summary</option>
                                        <option>Weekly Summary</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-green-50 p-4 rounded-lg">
                            <h4 class="text-lg font-semibold text-green-800 mb-3">Automated Reminders</h4>
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <input type="checkbox" id="reminder1" class="mr-2">
                                    <label for="reminder1" class="text-sm font-medium text-gray-700">Send 1 week before deadline</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="reminder2" class="mr-2">
                                    <label for="reminder2" class="text-sm font-medium text-gray-700">Send 3 days before deadline</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="reminder3" class="mr-2">
                                    <label for="reminder3" class="text-sm font-medium text-gray-700">Send 1 day before deadline</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 data-table">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Setting Name</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Setting Value</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($rsvpSettings as $rsvpSetting)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $rsvpSetting->id }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $rsvpSetting->setting_name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $rsvpSetting->setting_value ? Str::limit($rsvpSetting->setting_value, 50) : 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $rsvpSetting->description ? Str::limit($rsvpSetting->description, 50) : 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <a href="{{ route('admin.rsvp-settings.show', $rsvpSetting->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                        <a href="{{ route('admin.rsvp-settings.edit', $rsvpSetting->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                        <form action="{{ route('admin.rsvp-settings.destroy', $rsvpSetting->id) }}" method="POST" class="inline">
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
                            {{ $rsvpSettings->links() }}
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