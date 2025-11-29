<x-admin-layout>
    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ __('Manage Users') }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
            </div>
        </div>
        <p class="text-muted">View and manage all users in the system</p>
    </x-slot>

    <div class="container-fluid">
        <!-- Unified Toolbar -->
        <div class="toolbar">
            <form method="GET" action="{{ route('admin.users.index') }}" class="d-flex flex-column flex-sm-row gap-2 flex-grow-1">
                <input type="text" name="search" value="{{ request('search') }}" class="toolbar-search" placeholder="Search users by name or email...">
                
                <div class="toolbar-filters">
                    <select name="role" class="toolbar-select">
                        <option value="">All Roles</option>
                        <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ request('role') === 'user' ? 'selected' : '' }}>User</option>
                    </select>
                    
                    <select name="status" class="toolbar-select">
                        <option value="">All Statuses</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    
                    <button type="submit" class="btn btn-secondary">
                        <i class="fas fa-filter"></i>
                        Filter
                    </button>
                    
                    <a href="{{ route('admin.users.index') }}" class="btn btn-ghost">
                        Clear
                    </a>
                </div>
            </form>
            
            <div class="d-flex gap-2 ms-auto">
                <a href="{{ route('admin.users.export') }}" class="btn btn-ghost">
                    <i class="fas fa-download"></i>
                    Export
                </a>
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Add User
                </a>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <!-- Data Table -->
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->is_admin)
                                            <span class="badge badge-info">
                                                <i class="fas fa-shield-alt"></i>
                                                Admin
                                            </span>
                                        @else
                                            <span class="badge badge-secondary">
                                                <i class="fas fa-user"></i>
                                                User
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->is_active)
                                            <span class="badge badge-success">
                                                <i class="fas fa-check-circle"></i>
                                                Active
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                <i class="fas fa-times-circle"></i>
                                                Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                                    <td class="text-end">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-ghost btn-sm">
                                                <i class="fas fa-eye"></i>
                                                View
                                            </a>
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-secondary btn-sm">
                                                <i class="fas fa-pencil-alt"></i>
                                                Edit
                                            </a>
                                            <button class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $user->id }}')">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center empty-state">
                                        <div class="empty-state-icon">
                                            <i class="fas fa-users"></i>
                                        </div>
                                        <div class="empty-state-text">No users found.</div>
                                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add New User</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(userId) {
            if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
                // Create a form dynamically and submit it
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `{{ url('admin/users') }}/${userId}`;
                
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
            // Initialize DataTables
            $("#usersTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            });
        });
    </script>
</x-admin-layout>