<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">
            <h1 class="page-header-title">Customizations</h1>
            <p class="page-header-subtitle">Track and manage user design customizations</p>
        </div>
    </x-slot>

    <!-- Header with Filters -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-medium">Customizations</h3>
        <div class="flex space-x-2">
            <select id="customizationTypeFilter" class="border rounded px-4 py-2">
                <option value="">All Types</option>
                <option value="color">Color</option>
                <option value="font">Font</option>
                <option value="layout">Layout</option>
                <option value="image">Image</option>
            </select>
            <input type="text" id="searchInput" placeholder="Search customizations..." class="border rounded px-4 py-2">
            <button id="searchButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Search
            </button>
        </div>
    </div>

    <!-- Analytics Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-blue-50 p-4 rounded-lg">
            <h4 class="text-lg font-semibold text-blue-800">Most Used Elements</h4>
            <ul class="mt-2">
                <li class="flex justify-between py-1">
                    <span>Heart Icon</span>
                    <span class="font-medium">1,245 uses</span>
                </li>
                <li class="flex justify-between py-1">
                    <span>Floral Border</span>
                    <span class="font-medium">987 uses</span>
                </li>
                <li class="flex justify-between py-1">
                    <span>Rose Gold Frame</span>
                    <span class="font-medium">876 uses</span>
                </li>
            </ul>
        </div>
        
        <div class="bg-green-50 p-4 rounded-lg">
            <h4 class="text-lg font-semibold text-green-800">Most Used Colors</h4>
            <ul class="mt-2">
                <li class="flex justify-between py-1">
                    <span>#E8C4B8 (Rose Gold)</span>
                    <span class="font-medium">2,134 uses</span>
                </li>
                <li class="flex justify-between py-1">
                    <span>#6B4C3B (Brown)</span>
                    <span class="font-medium">1,876 uses</span>
                </li>
                <li class="flex justify-between py-1">
                    <span>#FFFFFF (White)</span>
                    <span class="font-medium">1,543 uses</span>
                </li>
            </ul>
        </div>
        
        <div class="bg-purple-50 p-4 rounded-lg">
            <h4 class="text-lg font-semibold text-purple-800">Most Used Fonts</h4>
            <ul class="mt-2">
                <li class="flex justify-between py-1">
                    <span>Great Vibes</span>
                    <span class="font-medium">3,456 uses</span>
                </li>
                <li class="flex justify-between py-1">
                    <span>Playfair Display</span>
                    <span class="font-medium">2,987 uses</span>
                </li>
                <li class="flex justify-between py-1">
                    <span>Lora</span>
                    <span class="font-medium">2,123 uses</span>
                </li>
            </ul>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 data-table">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">User Name</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Design ID</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Customization Type</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Elements Used</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Colors Used</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Fonts Used</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Data will be populated by JavaScript -->
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
        <div id="pagination">
            <!-- Pagination will be populated by JavaScript -->
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Load initial data
            loadCustomizations();
            
            // Search functionality
            $('#searchButton').on('click', function() {
                loadCustomizations();
            });
            
            $('#searchInput').on('keypress', function(e) {
                if (e.which === 13) {
                    loadCustomizations();
                }
            });
            
            // Filter functionality
            $('#customizationTypeFilter').on('change', function() {
                loadCustomizations();
            });
            
            // Export functionality
            $('#exportCsv').on('click', function() {
                exportData('csv');
            });
            
            $('#exportExcel').on('click', function() {
                exportData('excel');
            });
        });
        
        function loadCustomizations() {
            // In a real application, this would make an AJAX request to fetch data
            // For now, we'll simulate with sample data
            const sampleData = [
                {
                    id: 1,
                    user_name: 'John Doe',
                    design_id: 101,
                    customization_type: 'Color',
                    elements_used: 'Heart Icon, Floral Border',
                    colors_used: '#E8C4B8, #6B4C3B',
                    fonts_used: 'Great Vibes, Lora',
                    date: '2023-05-15'
                },
                {
                    id: 2,
                    user_name: 'Jane Smith',
                    design_id: 102,
                    customization_type: 'Font',
                    elements_used: 'Rose Gold Frame',
                    colors_used: '#FFFFFF, #E8C4B8',
                    fonts_used: 'Playfair Display, Lora',
                    date: '2023-06-20'
                },
                {
                    id: 3,
                    user_name: 'Robert Johnson',
                    design_id: 103,
                    customization_type: 'Layout',
                    elements_used: 'Heart Icon, Floral Border',
                    colors_used: '#6B4C3B, #FFFFFF',
                    fonts_used: 'Great Vibes, Playfair Display',
                    date: '2023-07-10'
                }
            ];
            
            renderCustomizations(sampleData);
        }
        
        function renderCustomizations(data) {
            const tbody = $('.data-table tbody');
            tbody.empty();
            
            data.forEach(customization => {
                const row = `
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap">${customization.id}</td>
                        <td class="px-6 py-4 whitespace-no-wrap">${customization.user_name}</td>
                        <td class="px-6 py-4 whitespace-no-wrap">${customization.design_id}</td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                ${customization.customization_type}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap">${customization.elements_used}</td>
                        <td class="px-6 py-4 whitespace-no-wrap">${customization.colors_used}</td>
                        <td class="px-6 py-4 whitespace-no-wrap">${customization.fonts_used}</td>
                        <td class="px-6 py-4 whitespace-no-wrap">${customization.date}</td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <button onclick="viewCustomization(${customization.id})" class="text-blue-600 hover:text-blue-900 mr-3">View</button>
                            <button onclick="downloadCustomization(${customization.id})" class="text-green-600 hover:text-green-900">Download</button>
                        </td>
                    </tr>
                `;
                tbody.append(row);
            });
        }
        
        function viewCustomization(id) {
            alert(`Viewing customization with ID: ${id}`);
        }
        
        function downloadCustomization(id) {
            alert(`Downloading customization with ID: ${id}`);
        }
        
        function exportData(format) {
            alert(`Exporting data as ${format.toUpperCase()}`);
        }
    </script>
</x-admin-layout>