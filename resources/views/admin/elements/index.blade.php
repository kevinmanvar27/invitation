<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">
            <h1 class="page-header-title">Design Elements</h1>
            <p class="page-header-subtitle">Manage design elements used in invitations</p>
        </div>
    </x-slot>

    <!-- Header with Filters and Upload Button -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-medium">Design Elements</h3>
        <div class="flex space-x-2">
            <select id="categoryFilter" class="border rounded px-4 py-2">
                <option value="">All Categories</option>
                <option value="icons">Icons</option>
                <option value="graphics">Graphics</option>
                <option value="borders">Borders</option>
                <option value="backgrounds">Backgrounds</option>
            </select>
            <select id="typeFilter" class="border rounded px-4 py-2">
                <option value="">All Types</option>
                <option value="icon">Icon</option>
                <option value="graphic">Graphic</option>
                <option value="border">Border</option>
                <option value="background">Background</option>
            </select>
            <input type="text" id="searchInput" placeholder="Search elements..." class="border rounded px-4 py-2">
            <button id="searchButton" class="bg-primary hover:bg-primary-dark text-primary-dark font-bold py-2 px-4 rounded">
                Search
            </button>
            <a href="{{ route('admin.elements.create') }}" class="bg-primary hover:bg-primary-dark text-primary-dark font-bold py-2 px-4 rounded">
                Upload Element
            </a>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-secondary-light data-table">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">Preview</th>
                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-secondary-light">
                @foreach($elements as $element)
                <tr>
                    <td class="px-6 py-4 whitespace-no-wrap">{{ $element->id }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        @if($element->file_path)
                            <img src="{{ asset($element->file_path) }}" alt="Preview" class="w-12 h-12 object-cover rounded">
                        @else
                            <div class="bg-secondary-light border-2 border-dashed rounded-xl w-12 h-12" />
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap">{{ $element->name }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-primary-light text-primary-dark">
                            {{ $element->type }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap">{{ $element->category }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $element->is_active ? 'bg-primary-light text-primary-dark' : 'bg-error-light text-error-dark' }}">
                            {{ $element->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap">
                        <a href="{{ route('admin.elements.show', $element->id) }}" class="text-primary hover:text-primary-dark mr-3">View</a>
                        <a href="{{ route('admin.elements.edit', $element->id) }}" class="text-secondary hover:text-secondary-dark mr-3">Edit</a>
                        <form action="{{ route('admin.elements.destroy', $element->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-error hover:text-error-dark" onclick="return confirm('Are you sure you want to delete this element?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4 flex justify-between items-center">
        <div>
            <button id="exportCsv" class="bg-primary hover:bg-primary-dark text-primary-dark font-bold py-2 px-4 rounded mr-2">
                Export CSV
            </button>
            <button id="exportExcel" class="bg-primary hover:bg-primary-dark text-primary-dark font-bold py-2 px-4 rounded">
                Export Excel
            </button>
        </div>
        <div>
            {{ $elements->links() }}
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Search functionality
            $('#searchButton').on('click', function() {
                const searchTerm = $('#searchInput').val();
                const categoryFilter = $('#categoryFilter').val();
                const typeFilter = $('#typeFilter').val();
                alert(`Searching for: ${searchTerm}, Category: ${categoryFilter}, Type: ${typeFilter}`);
                // In a real application, this would filter the table
            });
            
            $('#searchInput').on('keypress', function(e) {
                if (e.which === 13) {
                    $('#searchButton').click();
                }
            });
            
            // Filter functionality
            $('#categoryFilter, #typeFilter').on('change', function() {
                $('#searchButton').click();
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