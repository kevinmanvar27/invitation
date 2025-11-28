<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">
            <h1 class="page-header-title">Manage Templates</h1>
            <p class="page-header-subtitle">View and manage all wedding invitation templates</p>
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
                                <input type="text" id="searchInput" class="modern-search-input" placeholder="Search templates by name...">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('admin.templates.create') }}" class="modern-btn modern-btn-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add Template
                        </a>
                    </div>

                    <!-- Data Table -->
                    <div class="overflow-x-auto">
                        <table class="modern-table datatable">
                            <thead>
                                <tr>
                                    <th class="text-table-header">Thumbnail</th>
                                    <th class="text-table-header">ID</th>
                                    <th class="text-table-header">Name</th>
                                    <th class="text-table-header">Category</th>
                                    <th class="text-table-header text-right">Price</th>
                                    <th class="text-table-header">Premium</th>
                                    <th class="text-table-header">Active</th>
                                    <th class="text-table-header text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($templates as $template)
                                <tr>
                                    <td class="text-table-body">
                                        <!-- Placeholder for thumbnail -->
                                        <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    </td>
                                    <td class="text-table-body">{{ $template->id }}</td>
                                    <td class="text-table-body">{{ $template->name }}</td>
                                    <td class="text-table-body">
                                        <span class="modern-badge modern-badge-neutral">{{ $template->category->name ?? 'N/A' }}</span>
                                    </td>
                                    <td class="text-table-body text-right">
                                                                            @if($template->is_premium && !is_null($template->price))
                                                                                ₹{{ $template->price }}
                                                                            @elseif($template->is_premium)
                                                                                ₹0.00
                                                                            @else
                                                                                Free
                                                                            @endif
                                                                        </td>
                                    <td class="text-table-body">
                                        @if($template->is_premium)
                                            <span class="modern-badge modern-badge-success">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Yes
                                            </span>
                                        @else
                                            <span class="modern-badge modern-badge-neutral">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                No
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-table-body">
                                        @if($template->is_active)
                                            <span class="modern-badge modern-badge-success">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Active
                                            </span>
                                        @else
                                            <span class="modern-badge modern-badge-error">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <div class="action-buttons flex gap-2 justify-end">
                                            <a href="{{ route('admin.templates.show', $template->id) }}" class="modern-action-btn modern-action-btn-view">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 4.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                View
                                            </a>
                                            <a href="{{ route('admin.templates.edit', $template->id) }}" class="modern-action-btn modern-action-btn-edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Edit
                                            </a>
                                            <button class="modern-action-btn modern-action-btn-delete" onclick="confirmDelete('{{ $template->id }}')">
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
                            Showing {{ $templates->firstItem() }} to {{ $templates->lastItem() }} of {{ $templates->total() }} entries
                        </div>
                        <div class="modern-pagination-controls">
                            @if ($templates->onFirstPage())
                                <button class="modern-pagination-btn disabled">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>
                            @else
                                <a href="{{ $templates->previousPageUrl() }}" class="modern-pagination-btn">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </a>
                            @endif

                            @for ($i = 1; $i <= $templates->lastPage(); $i++)
                                @if ($i == $templates->currentPage())
                                    <button class="modern-pagination-btn active">{{ $i }}</button>
                                @else
                                    <a href="{{ $templates->url($i) }}" class="modern-pagination-btn">{{ $i }}</a>
                                @endif
                            @endfor

                            @if ($templates->hasMorePages())
                                <a href="{{ $templates->nextPageUrl() }}" class="modern-pagination-btn">
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

    <script>
        function confirmDelete(templateId) {
            if (confirm('Are you sure you want to delete this template? This action cannot be undone.')) {
                // Create a form dynamically and submit it
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ url("admin/templates") }}/' + templateId;
                
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
</x-admin-layout>