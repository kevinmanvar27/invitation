<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary-dark leading-tight">
            {{ __('Manage RSVP Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-primary-dark">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-primary-dark">RSVP Settings</h3>
                        <div class="flex space-x-2">
                            <input type="text" id="searchInput" placeholder="Search settings..." class="border border-accent rounded px-4 py-2">
                            <button id="searchButton" class="bg-primary hover:bg-primary-dark text-primary-dark font-bold py-2 px-4 rounded">
                                Search
                            </button>
                            <a href="{{ route('admin.rsvp-settings.create') }}" class="bg-primary hover:bg-primary-dark text-primary-dark font-bold py-2 px-4 rounded">
                                Add RSVP Setting
                            </a>
                        </div>
                    </div>

                    <!-- Configuration Options -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-primary-light p-4 rounded-lg">
                            <h4 class="text-lg font-semibold text-primary-dark mb-3">Form Configuration</h4>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-primary-dark">Default Response Deadline</label>
                                    <input type="date" class="mt-1 block w-full border border-accent rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-primary-dark">Email Notification Settings</label>
                                    <select class="mt-1 block w-full border border-accent rounded-md shadow-sm focus:ring-primary focus:border-primary sm:text-sm">
                                        <option>Immediately</option>
                                        <option>Daily Summary</option>
                                        <option>Weekly Summary</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-secondary-light p-4 rounded-lg">
                            <h4 class="text-lg font-semibold text-secondary-dark mb-3">Automated Reminders</h4>
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <input type="checkbox" id="reminder1" class="mr-2">
                                    <label for="reminder1" class="text-sm font-medium text-primary-dark">Send 1 week before deadline</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="reminder2" class="mr-2">
                                    <label for="reminder2" class="text-sm font-medium text-primary-dark">Send 3 days before deadline</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" id="reminder3" class="mr-2">
                                    <label for="reminder3" class="text-sm font-medium text-primary-dark">Send 1 day before deadline</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-accent data-table">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">Setting Name</th>
                                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">Setting Value</th>
                                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">Description</th>
                                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-accent">
                                @foreach($rsvpSettings as $rsvpSetting)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $rsvpSetting->id }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $rsvpSetting->setting_name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $rsvpSetting->setting_value ? Str::limit($rsvpSetting->setting_value, 50) : 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $rsvpSetting->description ? Str::limit($rsvpSetting->description, 50) : 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <a href="{{ route('admin.rsvp-settings.show', $rsvpSetting->id) }}" class="text-primary hover:text-primary-dark mr-3">View</a>
                                        <a href="{{ route('admin.rsvp-settings.edit', $rsvpSetting->id) }}" class="text-primary hover:text-primary-dark mr-3">Edit</a>
                                        <form action="{{ route('admin.rsvp-settings.destroy', $rsvpSetting->id) }}" method="POST" class="inline">
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