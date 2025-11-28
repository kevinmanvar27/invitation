<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Downloads') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Downloads</h3>
                        <div class="flex space-x-2">
                            <select id="formatFilter" class="border rounded px-4 py-2">
                                <option value="">All Formats</option>
                                <option value="pdf">PDF</option>
                                <option value="jpg">JPG</option>
                                <option value="png">PNG</option>
                                <option value="svg">SVG</option>
                            </select>
                            <input type="date" id="startDate" class="border rounded px-4 py-2" placeholder="Start Date">
                            <input type="date" id="endDate" class="border rounded px-4 py-2" placeholder="End Date">
                            <input type="text" id="searchInput" placeholder="Search downloads..." class="border rounded px-4 py-2">
                            <button id="searchButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Search
                            </button>
                        </div>
                    </div>

                    <!-- Download Statistics -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h4 class="text-lg font-semibold text-blue-800">Total Downloads</h4>
                            <p class="text-2xl font-bold mt-2">24,567</p>
                            <p class="text-sm text-gray-600">+12% from last month</p>
                        </div>
                        
                        <div class="bg-green-50 p-4 rounded-lg">
                            <h4 class="text-lg font-semibold text-green-800">Unique Users</h4>
                            <p class="text-2xl font-bold mt-2">8,765</p>
                            <p class="text-sm text-gray-600">+8% from last month</p>
                        </div>
                        
                        <div class="bg-yellow-50 p-4 rounded-lg">
                            <h4 class="text-lg font-semibold text-yellow-800">Top Format</h4>
                            <p class="text-2xl font-bold mt-2">PDF</p>
                            <p class="text-sm text-gray-600">65% of all downloads</p>
                        </div>
                        
                        <div class="bg-purple-50 p-4 rounded-lg">
                            <h4 class="text-lg font-semibold text-purple-800">Avg. File Size</h4>
                            <p class="text-2xl font-bold mt-2">2.4 MB</p>
                            <p class="text-sm text-gray-600">-0.3 MB from last month</p>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 data-table">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">User Name</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Design Name</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">File Format</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">File Size</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Download Date</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">IP Address</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($downloads as $download)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $download->id }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $download->user->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $download->design->design_name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ strtoupper($download->file_format) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ number_format($download->file_size / 1024, 1) }} KB</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $download->created_at->format('M d, Y H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $download->ip_address }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <button data-download-id="{{ $download->id }}" class="track-download-btn text-blue-600 hover:text-blue-900 mr-3">Track</button>
                                        <a href="{{ route('admin.downloads.show', $download->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">View</a>
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
                            {{ $downloads->links() }}
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
                const formatFilter = $('#formatFilter').val();
                const startDate = $('#startDate').val();
                const endDate = $('#endDate').val();
                alert(`Searching for: ${searchTerm}, Format: ${formatFilter}, Start: ${startDate}, End: ${endDate}`);
                // In a real application, this would filter the table
            });
            
            $('#searchInput').on('keypress', function(e) {
                if (e.which === 13) {
                    $('#searchButton').click();
                }
            });
            
            // Filter functionality
            $('#formatFilter').on('change', function() {
                $('#searchButton').click();
            });
            
            // Track download functionality
            $('.track-download-btn').on('click', function() {
                const downloadId = $(this).data('download-id');
                alert(`Tracking download with ID: ${downloadId}`);
                // In a real application, this would show detailed tracking info
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