<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">
            <h1 class="page-header-title">Fonts</h1>
            <p class="page-header-subtitle">Manage fonts used in invitation designs</p>
        </div>
    </x-slot>

    <!-- Header with Search and Upload Button -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-medium">Fonts</h3>
        <div class="flex space-x-2">
            <input type="text" id="searchInput" placeholder="Search fonts..." class="border rounded px-4 py-2">
            <button id="searchButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Search
            </button>
            <button id="uploadButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Upload Font
            </button>
        </div>
    </div>

    <!-- Upload Modal -->
    <div id="uploadModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Upload Font</h3>
                    <button id="closeUploadModal" class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <form id="uploadForm">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="fontName">
                            Font Name
                        </label>
                        <input type="text" id="fontName" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="fontFamily">
                            Font Family
                        </label>
                        <input type="text" id="fontFamily" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="fontFile">
                            Font File (TTF, OTF, WOFF)
                        </label>
                        <input type="file" id="fontFile" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" accept=".ttf,.otf,.woff" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            <input type="checkbox" id="isActive" class="mr-2"> Active
                        </label>
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="button" id="cancelUpload" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Cancel
                        </button>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 data-table">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Font Name</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Font Family</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Preview</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($fonts as $font)
                <tr>
                    <td class="px-6 py-4 whitespace-no-wrap">{{ $font->id }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap">{{ $font->font_name }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap">{{ $font->font_family }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <div style="font-family: '{{ $font->font_family }}', sans-serif;">
                            The quick brown fox jumps over the lazy dog
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $font->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $font->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <button data-font-id="{{ $font->id }}" class="preview-font-btn text-blue-600 hover:text-blue-900 mr-3">Preview</button>
                        <a href="{{ route('admin.fonts.edit', $font->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                        <form action="{{ route('admin.fonts.destroy', $font->id) }}" method="POST" class="inline">
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
            {{ $fonts->links() }}
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
            
            // Upload modal functionality
            $('#uploadButton').on('click', function() {
                $('#uploadModal').removeClass('hidden');
            });
            
            $('#closeUploadModal, #cancelUpload').on('click', function() {
                $('#uploadModal').addClass('hidden');
            });
            
            $('#uploadForm').on('submit', function(e) {
                e.preventDefault();
                alert('Font uploaded successfully!');
                $('#uploadModal').addClass('hidden');
                // In a real application, this would submit the form via AJAX
            });
            
            // Font preview functionality
            $('.preview-font-btn').on('click', function() {
                const fontId = $(this).data('font-id');
                alert(`Previewing font with ID: ${fontId}`);
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