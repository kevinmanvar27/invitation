<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">RSVP Settings</li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <!-- Configuration Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-cog me-2 text-primary"></i>Form Configuration
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Default Response Deadline</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Email Notification Settings</label>
                        <select class="form-select">
                            <option>Immediately</option>
                            <option>Daily Summary</option>
                            <option>Weekly Summary</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bell me-2 text-warning"></i>Automated Reminders
                    </h5>
                </div>
                <div class="card-body">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="reminder1">
                        <label class="form-check-label" for="reminder1">
                            Send 1 week before deadline
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="reminder2">
                        <label class="form-check-label" for="reminder2">
                            Send 3 days before deadline
                        </label>
                    </div>
                    <div class="form-check mb-0">
                        <input class="form-check-input" type="checkbox" id="reminder3">
                        <label class="form-check-label" for="reminder3">
                            Send 1 day before deadline
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toolbar -->
    <div class="toolbar mb-4">
        <div class="input-group" style="max-width: 300px;">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            <input type="text" id="searchInput" class="form-control" placeholder="Search settings...">
        </div>
        
        <div class="toolbar-actions ms-auto">
            <a href="{{ route('admin.rsvp-settings.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Add Setting
            </a>
        </div>
    </div>

    <!-- Settings Table -->
    <div class="card">
        <div class="card-body p-0">
            @if($rsvpSettings->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover data-table mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Setting Name</th>
                                <th>Value</th>
                                <th>Description</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rsvpSettings as $rsvpSetting)
                            <tr>
                                <td><span class="text-muted">#{{ $rsvpSetting->id }}</span></td>
                                <td>
                                    <span class="fw-medium">{{ $rsvpSetting->setting_name ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    @if($rsvpSetting->setting_value)
                                        <code class="text-primary">{{ Str::limit($rsvpSetting->setting_value, 40) }}</code>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-muted">{{ $rsvpSetting->description ? Str::limit($rsvpSetting->description, 40) : 'No description' }}</span>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.rsvp-settings.show', $rsvpSetting->id) }}" 
                                           class="btn btn-icon btn-outline-primary" 
                                           title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.rsvp-settings.edit', $rsvpSetting->id) }}" 
                                           class="btn btn-icon btn-outline-warning" 
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-icon btn-outline-danger" 
                                                onclick="confirmDelete({{ $rsvpSetting->id }}, '{{ $rsvpSetting->setting_name ?? 'this setting' }}')"
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
                
                @if($rsvpSettings->hasPages())
                    <div class="card-footer">
                        {{ $rsvpSettings->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-cog"></i>
                    </div>
                    <h3>No RSVP Settings Found</h3>
                    <p>Get started by creating your first RSVP setting.</p>
                    <a href="{{ route('admin.rsvp-settings.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>Add Setting
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
                    <h5 class="modal-title" id="deleteModalLabel">Delete RSVP Setting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete "<strong id="deleteItemName"></strong>"?</p>
                    <p class="text-muted small">This action cannot be undone and may affect RSVP forms using this setting.</p>
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
            document.getElementById('deleteForm').action = `/admin/rsvp-settings/${id}`;
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
        });
    </script>
    @endpush
</x-admin-layout>