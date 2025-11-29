<x-admin-layout>
    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Manage Templates</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Templates</li>
                </ol>
            </div>
        </div>
        <p class="text-muted">View and manage all wedding invitation templates</p>
    </x-slot>

    <div class="container-fluid">
        <!-- Unified Toolbar -->
        <div class="toolbar">
            <div class="d-flex flex-column flex-sm-row gap-2 flex-grow-1">
                <input type="text" id="searchInput" class="toolbar-search" placeholder="Search templates by name...">
                
                <div class="toolbar-filters">
                    <select id="categoryFilter" class="toolbar-select">
                        <option value="">All Categories</option>
                        <!-- Categories will be populated dynamically -->
                    </select>
                    
                    <select id="statusFilter" class="toolbar-select">
                        <option value="">All Statuses</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    
                    <button type="button" class="btn btn-secondary" id="filterButton">
                        <i class="fas fa-filter"></i>
                        Filter
                    </button>
                    
                    <a href="#" class="btn btn-ghost" id="clearFilters">
                        Clear
                    </a>
                </div>
            </div>
            
            <div class="d-flex gap-2 ms-auto">
                <a href="{{ route('admin.templates.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Add Template
                </a>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <!-- Data Table -->
                <div class="table-container">
                    <table id="templatesTable" class="data-table">
                        <thead>
                            <tr>
                                <th>Thumbnail</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th class="text-right">Price</th>
                                <th>Premium</th>
                                <th>Active</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($templates as $template)
                            <tr>
                                <td>
                                    <!-- Placeholder for thumbnail -->
                                    <div class="bg-light border rounded w-16 h-16 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                </td>
                                <td>{{ $template->id }}</td>
                                <td>{{ $template->name }}</td>
                                <td>
                                    <span class="badge badge-secondary">{{ $template->category->name ?? 'N/A' }}</span>
                                </td>
                                <td class="text-right">
                                    @if($template->is_premium && !is_null($template->price))
                                        ₹{{ $template->price }}
                                    @elseif($template->is_premium)
                                        ₹0.00
                                    @else
                                        Free
                                    @endif
                                </td>
                                <td>
                                    @if($template->is_premium)
                                        <span class="badge badge-success">
                                            <i class="fas fa-check"></i>
                                            Yes
                                        </span>
                                    @else
                                        <span class="badge badge-secondary">
                                            <i class="fas fa-times"></i>
                                            No
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($template->is_active)
                                        <span class="badge badge-success">
                                            <i class="fas fa-check"></i>
                                            Active
                                        </span>
                                    @else
                                        <span class="badge badge-danger">
                                            <i class="fas fa-times"></i>
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.templates.show', $template->id) }}" class="btn btn-ghost btn-sm">
                                            <i class="fas fa-eye"></i>
                                            View
                                        </a>
                                        <a href="{{ route('admin.templates.edit', $template->id) }}" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-pencil-alt"></i>
                                            Edit
                                        </a>
                                        <button class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $template->id }}')">
                                            <i class="fas fa-trash"></i>
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination mt-4">
                    {{ $templates->links() }}
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
            
            // Initialize DataTables
            $("#templatesTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            });
        });
    </script>
</x-admin-layout>