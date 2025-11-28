<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">
            <h1 class="page-header-title">Manage Template Categories</h1>
            <p class="page-header-subtitle">View and manage all template categories</p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Header with Search and Add Button -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                        <div class="flex-1 flex flex-col sm:flex-row gap-3">
                            <div class="relative flex-1">
                                <input type="text" id="searchInput" class="modern-search-input" placeholder="Search categories by name...">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('admin.categories.create') }}" class="modern-btn modern-btn-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add Category
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="modern-table datatable">
                            <thead>
                                <tr>
                                    <th class="text-table-header">ID</th>
                                    <th class="text-table-header">Name</th>
                                    <th class="text-table-header">Slug</th>
                                    <th class="text-table-header">Parent Category</th>
                                    <th class="text-table-header">Order</th>
                                    <th class="text-table-header">Templates Count</th>
                                    <th class="text-table-header text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td class="text-table-body">{{ $category->id }}</td>
                                    <td class="text-table-body">{{ $category->name }}</td>
                                    <td class="text-table-body">{{ $category->slug }}</td>
                                    <td class="text-table-body">{{ $category->parent ? $category->parent->name : 'None' }}</td>
                                    <td class="text-table-body">{{ $category->order }}</td>
                                    <td class="text-table-body">{{ $category->templates_count }}</td>
                                    <td class="text-right">
                                        <div class="action-buttons flex gap-2 justify-end">
                                            <a href="{{ route('admin.categories.show', $category->id) }}" class="modern-action-btn modern-action-btn-view">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 4.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                View
                                            </a>
                                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="modern-action-btn modern-action-btn-edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Edit
                                            </a>
                                            <button class="modern-action-btn modern-action-btn-delete" onclick="confirmDelete('{{ $category->id }}')">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Modern Pagination -->
                    <div class="modern-pagination mt-6">
                        <div class="modern-pagination-info">
                            Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of {{ $categories->total() }} entries
                        </div>
                        <div class="modern-pagination-controls">
                            @if ($categories->onFirstPage())
                                <button class="modern-pagination-btn disabled">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>
                            @else
                                <a href="{{ $categories->previousPageUrl() }}" class="modern-pagination-btn">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </a>
                            @endif

                            @for ($i = 1; $i <= $categories->lastPage(); $i++)
                                @if ($i == $categories->currentPage())
                                    <button class="modern-pagination-btn active">{{ $i }}</button>
                                @else
                                    <a href="{{ $categories->url($i) }}" class="modern-pagination-btn">{{ $i }}</a>
                                @endif
                            @endfor

                            @if ($categories->hasMorePages())
                                <a href="{{ $categories->nextPageUrl() }}" class="modern-pagination-btn">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            @else
                                <button class="modern-pagination-btn disabled">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

<script>
    function confirmDelete(categoryId) {
        if (confirm('Are you sure you want to delete this category? This action cannot be undone.')) {
            // Create a form dynamically and submit it
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `{{ url('admin/categories') }}/${categoryId}`;
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            form.appendChild(csrfToken);
            
            const method = document.createElement('input');
            method.type = 'hidden';
            method.name = '_method';
            method.value = 'DELETE';
            form.appendChild(method);
            
            document.body.appendChild(form);
            form.submit();
        }
    }
    
    $(document).ready(function() {
        // Search functionality
        $('#searchInput').on('keyup', function() {
            const value = $(this).val().toLowerCase();
            $('tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>