@php
    $totalProfiles = $profiles->count();
    $completeProfiles = $profiles->filter(fn($p) => $p->first_name && $p->last_name && $p->wedding_date)->count();
    $incompleteProfiles = $totalProfiles - $completeProfiles;
    $completePercentage = $totalProfiles > 0 ? round(($completeProfiles / $totalProfiles) * 100) : 0;
@endphp

<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Profiles</li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <!-- KPI Stats Row -->
    <div class="row g-4 mb-4">
        <div class="col-6 col-lg-3">
            <div class="stat-card stat-card-primary">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $totalProfiles }}</span>
                        <span class="stat-card-label">Total Profiles</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card stat-card-success">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $completeProfiles }}</span>
                        <span class="stat-card-label">Complete</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card stat-card-warning">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $incompleteProfiles }}</span>
                        <span class="stat-card-label">Incomplete</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card stat-card-info">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-percentage"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $completePercentage }}%</span>
                        <span class="stat-card-label">Completion Rate</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toolbar -->
    <div class="toolbar mb-4">
        <div class="input-group" style="max-width: 300px;">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            <input type="text" id="searchInput" class="form-control" placeholder="Search profiles...">
        </div>
        
        <div class="toolbar-actions ms-auto">
            <select id="completenessFilter" class="form-select">
                <option value="">All Profiles</option>
                <option value="complete">Complete</option>
                <option value="incomplete">Incomplete</option>
            </select>
            
            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-download me-1"></i>Export
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-file-csv me-2"></i>Export CSV</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-file-excel me-2"></i>Export Excel</a></li>
                </ul>
            </div>
            
            <a href="{{ route('admin.user-profiles.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Add Profile
            </a>
        </div>
    </div>

    <!-- User Profiles Table -->
    <div class="card">
        <div class="card-body p-0">
            @if($profiles->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover data-table mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Partner Name</th>
                                <th>Wedding Date</th>
                                <th>Completeness</th>
                                <th>Last Activity</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($profiles as $profile)
                            @php
                                $fields = ['first_name', 'last_name', 'wedding_date', 'phone'];
                                $filledFields = collect($fields)->filter(fn($f) => !empty($profile->$f))->count();
                                $completeness = round(($filledFields / count($fields)) * 100);
                                $isComplete = $completeness >= 75;
                            @endphp
                            <tr data-completeness="{{ $isComplete ? 'complete' : 'incomplete' }}">
                                <td>
                                    <span class="fw-medium text-primary">#{{ $profile->id }}</span>
                                </td>
                                <td>
                                    @if($profile->user)
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar avatar-sm">
                                                @if($profile->user->avatar)
                                                    <img src="{{ asset('storage/' . $profile->user->avatar) }}" alt="{{ $profile->user->name }}">
                                                @else
                                                    <span class="avatar-initials">{{ strtoupper(substr($profile->user->name, 0, 1)) }}</span>
                                                @endif
                                            </div>
                                            <div>
                                                <span class="fw-medium">{{ $profile->user->name }}</span>
                                                <br><small class="text-muted">{{ $profile->user->email }}</small>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if($profile->first_name || $profile->last_name)
                                        <span class="fw-medium">{{ $profile->first_name }} {{ $profile->last_name }}</span>
                                    @else
                                        <span class="text-muted">Not set</span>
                                    @endif
                                </td>
                                <td>
                                    @if($profile->wedding_date)
                                        <span class="badge badge-primary">
                                            <i class="fas fa-calendar me-1"></i>{{ $profile->wedding_date->format('M d, Y') }}
                                        </span>
                                    @else
                                        <span class="text-muted">Not set</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress" style="width: 100px; height: 8px;">
                                            <div class="progress-bar {{ $completeness >= 75 ? 'bg-success' : ($completeness >= 50 ? 'bg-warning' : 'bg-danger') }}" 
                                                 role="progressbar" 
                                                 style="width: {{ $completeness }}%"
                                                 aria-valuenow="{{ $completeness }}" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100"></div>
                                        </div>
                                        <span class="small {{ $completeness >= 75 ? 'text-success' : ($completeness >= 50 ? 'text-warning' : 'text-danger') }}">
                                            {{ $completeness }}%
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $profile->updated_at->format('M d, Y') }}</span>
                                    <br>
                                    <small class="text-muted">{{ $profile->updated_at->diffForHumans() }}</small>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.user-profiles.show', $profile->id) }}" 
                                           class="btn btn-icon btn-outline-primary" 
                                           title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.user-profiles.edit', $profile->id) }}" 
                                           class="btn btn-icon btn-outline-warning" 
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-icon btn-outline-danger" 
                                                onclick="confirmDelete({{ $profile->id }}, '{{ $profile->user->name ?? 'Profile' }}')"
                                                title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if($profiles->hasPages())
                    <div class="card-footer">
                        {{ $profiles->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <h3>No User Profiles Found</h3>
                    <p>No user profiles have been created yet.</p>
                    <a href="{{ route('admin.user-profiles.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>Create Profile
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete User Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the profile for "<strong id="deleteItemName"></strong>"?</p>
                    <p class="text-muted small">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Delete confirmation
        function confirmDelete(id, name) {
            document.getElementById('deleteItemName').textContent = name;
            document.getElementById('deleteForm').action = `/admin/user-profiles/${id}`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const tableRows = document.querySelectorAll('.data-table tbody tr');
            
            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                
                tableRows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });
            
            // Filter functionality
            const completenessFilter = document.getElementById('completenessFilter');
            
            function applyFilters() {
                const filter = completenessFilter.value;
                
                tableRows.forEach(row => {
                    const rowCompleteness = row.dataset.completeness;
                    const match = !filter || rowCompleteness === filter;
                    
                    row.style.display = match ? '' : 'none';
                });
            }
            
            completenessFilter.addEventListener('change', applyFilters);
        });
    </script>
    @endpush
</x-admin-layout>