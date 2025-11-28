<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">
            <h1 class="page-header-title">Manage User Designs</h1>
            <p class="page-header-subtitle">View and manage all user created designs</p>
        </div>
    </x-slot>

    <!-- Header with Search -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-medium">User Designs</h3>
        <div class="flex space-x-2">
            <input type="text" id="searchInput" placeholder="Search designs..." class="border rounded px-4 py-2">
            <button id="searchButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Search
            </button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 data-table">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Thumbnail</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">User Name</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Template Used</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Design Name</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Creation Date</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
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

    <!-- Design Preview Modal -->
    <div id="previewModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-3/4 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-between">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Design Preview</h3>
                    <button id="closeModal" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="mt-2 px-7 py-3">
                    <div id="previewContent" class="h-96 overflow-auto">
                        <!-- Preview content will be loaded here -->
                    </div>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="downloadDesign" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        Download Design
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Load initial data
            loadDesigns();
            
            // Search functionality
            $('#searchButton').on('click', function() {
                loadDesigns();
            });
            
            $('#searchInput').on('keypress', function(e) {
                if (e.which === 13) {
                    loadDesigns();
                }
            });
            
            // Export functionality
            $('#exportCsv').on('click', function() {
                exportData('csv');
            });
            
            $('#exportExcel').on('click', function() {
                exportData('excel');
            });
            
            // Modal functionality
            $('#closeModal').on('click', function() {
                $('#previewModal').addClass('hidden');
            });
            
            $('#downloadDesign').on('click', function() {
                alert('Design downloaded successfully!');
                $('#previewModal').addClass('hidden');
            });
        });
        
        function loadDesigns() {
            // In a real application, this would make an AJAX request to fetch data
            // For now, we'll simulate with sample data
            const sampleData = [
                {
                    id: 1,
                    thumbnail: 'https://placehold.co/100x100',
                    user_name: 'John Doe',
                    template: 'Wedding Invitation Classic',
                    design_name: 'John & Jane\'s Wedding',
                    creation_date: '2023-05-15',
                    status: 'Published'
                },
                {
                    id: 2,
                    thumbnail: 'https://placehold.co/100x100',
                    user_name: 'Jane Smith',
                    template: 'Modern Elegance',
                    design_name: 'Jane & John\'s Wedding',
                    creation_date: '2023-06-20',
                    status: 'Draft'
                }
            ];
            
            renderDesigns(sampleData);
        }
        
        function renderDesigns(data) {
            const tbody = $('.data-table tbody');
            tbody.empty();
            
            data.forEach(design => {
                const row = `
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap">${design.id}</td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <img src="${design.thumbnail}" alt="Thumbnail" class="w-16 h-16 object-cover rounded">
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap">${design.user_name}</td>
                        <td class="px-6 py-4 whitespace-no-wrap">${design.template}</td>
                        <td class="px-6 py-4 whitespace-no-wrap">${design.design_name}</td>
                        <td class="px-6 py-4 whitespace-no-wrap">${design.creation_date}</td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                ${design.status === 'Published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'}">
                                ${design.status}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap">
                            <button onclick="viewDesign(${design.id})" class="text-blue-600 hover:text-blue-900 mr-3">View</button>
                            <button onclick="downloadDesign(${design.id})" class="text-green-600 hover:text-green-900">Download</button>
                        </td>
                    </tr>
                `;
                tbody.append(row);
            });
        }
        
        function viewDesign(id) {
            // In a real application, this would fetch the design details
            $('#previewContent').html(`
                <div class="bg-gray-100 p-4 rounded">
                    <h4 class="text-lg font-semibold mb-2">Design Preview for ID: ${id}</h4>
                    <img src="https://placehold.co/600x400" alt="Design Preview" class="w-full h-auto rounded">
                    <div class="mt-4 text-left">
                        <p><strong>User:</strong> John Doe</p>
                        <p><strong>Template:</strong> Wedding Invitation Classic</p>
                        <p><strong>Created:</strong> 2023-05-15</p>
                        <p><strong>Status:</strong> Published</p>
                    </div>
                </div>
            `);
            $('#previewModal').removeClass('hidden');
        }
        
        function downloadDesign(id) {
            alert(`Downloading design with ID: ${id}`);
        }
        
        function exportData(format) {
            alert(`Exporting data as ${format.toUpperCase()}`);
        }
    </script>
</x-admin-layout>