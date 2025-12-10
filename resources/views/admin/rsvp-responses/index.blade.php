@php
    $totalResponses = $rsvpResponses->count();
    $attendingCount = $rsvpResponses->where('response', 'attending')->count();
    $notAttendingCount = $rsvpResponses->where('response', 'not_attending')->count();
    $maybeCount = $rsvpResponses->where('response', 'maybe')->count();
    $totalGuests = $rsvpResponses->sum('plus_ones_count') + $attendingCount;
@endphp

<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">RSVP Responses</li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <!-- KPI Stats Row -->
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card stat-card-primary">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-reply-all"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ number_format($totalResponses) }}</span>
                        <span class="stat-card-label">Total Responses</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card stat-card-success">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $attendingCount }}</span>
                        <span class="stat-card-label">Attending</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card stat-card-warning">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-question-circle"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $maybeCount }}</span>
                        <span class="stat-card-label">Maybe</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card stat-card-info">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ number_format($totalGuests) }}</span>
                        <span class="stat-card-label">Total Guests</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toolbar -->
    <div class="toolbar mb-4">
        <div class="input-group" style="max-width: 300px;">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            <input type="text" id="searchInput" class="form-control" placeholder="Search responses...">
        </div>
        
        <div class="toolbar-actions ms-auto">
            <select id="responseFilter" class="form-select">
                <option value="">All Responses</option>
                <option value="attending">Attending</option>
                <option value="not_attending">Not Attending</option>
                <option value="maybe">Maybe</option>
            </select>
            
            <input type="date" id="startDate" class="form-control" style="width: auto;" title="Start Date">
            <input type="date" id="endDate" class="form-control" style="width: auto;" title="End Date">
            
            <button type="button" class="btn btn-outline-secondary" id="clearFilters">
                <i class="fas fa-times me-1"></i>Clear
            </button>
            
            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-download me-1"></i>Export
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" id="exportCsv"><i class="fas fa-file-csv me-2"></i>Export CSV</a></li>
                    <li><a class="dropdown-item" href="#" id="exportExcel"><i class="fas fa-file-excel me-2"></i>Export Excel</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- RSVP Responses Table -->
    <div class="card">
        <div class="card-body p-0">
            @if($rsvpResponses->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover data-table mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Invitation</th>
                                <th>Guest Name</th>
                                <th>Contact</th>
                                <th>Response</th>
                                <th class="text-center">Guests</th>
                                <th>Meal Preference</th>
                                <th>Responded</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rsvpResponses as $rsvpResponse)
                            <tr>
                                <td><span class="text-muted">#{{ $rsvpResponse->id }}</span></td>
                                <td>
                                    @if($rsvpResponse->sharedInvitation && $rsvpResponse->sharedInvitation->design)
                                        <a href="{{ route('admin.designs.show', $rsvpResponse->sharedInvitation->design->id) }}" class="text-primary fw-medium">
                                            {{ Str::limit($rsvpResponse->sharedInvitation->design->design_name ?? 'Untitled', 20) }}
                                        </a>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar avatar-sm">
                                            <span class="avatar-initials">{{ strtoupper(substr($rsvpResponse->guest_name ?? 'G', 0, 1)) }}</span>
                                        </div>
                                        <span>{{ $rsvpResponse->guest_name ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if($rsvpResponse->guest_email)
                                        <div class="small">
                                            <i class="fas fa-envelope text-muted me-1"></i>
                                            <a href="mailto:{{ $rsvpResponse->guest_email }}">{{ Str::limit($rsvpResponse->guest_email, 20) }}</a>
                                        </div>
                                    @endif
                                    @if($rsvpResponse->guest_phone)
                                        <div class="small text-muted">
                                            <i class="fas fa-phone me-1"></i>{{ $rsvpResponse->guest_phone }}
                                        </div>
                                    @endif
                                    @if(!$rsvpResponse->guest_email && !$rsvpResponse->guest_phone)
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @switch($rsvpResponse->response)
                                        @case('attending')
                                            <span class="badge badge-success">
                                                <i class="fas fa-check me-1"></i>Attending
                                            </span>
                                            @break
                                        @case('not_attending')
                                            <span class="badge badge-danger">
                                                <i class="fas fa-times me-1"></i>Not Attending
                                            </span>
                                            @break
                                        @default
                                            <span class="badge badge-warning">
                                                <i class="fas fa-question me-1"></i>Maybe
                                            </span>
                                    @endswitch
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-light">
                                        <i class="fas fa-user-plus me-1"></i>{{ $rsvpResponse->plus_ones_count ?? 0 }}
                                    </span>
                                </td>
                                <td>
                                    @if($rsvpResponse->meal_preference)
                                        <span class="badge badge-secondary">
                                            <i class="fas fa-utensils me-1"></i>{{ Str::limit($rsvpResponse->meal_preference, 15) }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $responseDate = $rsvpResponse->responded_at ?? $rsvpResponse->created_at;
                                    @endphp
                                    <span class="text-muted">{{ $responseDate->format('M d, Y') }}</span>
                                    <br>
                                    <small class="text-muted">{{ $responseDate->format('H:i') }}</small>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.rsvp-responses.show', $rsvpResponse->id) }}" 
                                           class="btn btn-icon btn-outline-primary" 
                                           title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($rsvpResponse->guest_email)
                                            <button type="button" 
                                                    class="btn btn-icon btn-outline-info email-btn" 
                                                    data-email="{{ $rsvpResponse->guest_email }}"
                                                    data-name="{{ $rsvpResponse->guest_name }}"
                                                    title="Send Email">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                        @endif
                                        <button type="button" 
                                                class="btn btn-icon btn-outline-danger" 
                                                onclick="confirmDelete({{ $rsvpResponse->id }}, '{{ $rsvpResponse->guest_name ?? 'this response' }}')"
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
                
                @if($rsvpResponses->hasPages())
                    <div class="card-footer">
                        {{ $rsvpResponses->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-reply-all"></i>
                    </div>
                    <h3>No RSVP Responses Found</h3>
                    <p>No guests have responded to invitations yet.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete RSVP Response</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the RSVP response from "<strong id="deleteItemName"></strong>"?</p>
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
            document.getElementById('deleteForm').action = `/admin/rsvp-responses/${id}`;
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
            const responseFilter = document.getElementById('responseFilter');
            
            function applyFilters() {
                const response = responseFilter.value.toLowerCase();
                
                tableRows.forEach(row => {
                    const rowResponse = row.querySelector('td:nth-child(5)').textContent.toLowerCase();
                    const responseMatch = !response || rowResponse.includes(response.replace('_', ' '));
                    
                    row.style.display = responseMatch ? '' : 'none';
                });
            }
            
            responseFilter.addEventListener('change', applyFilters);
            
            // Clear filters
            document.getElementById('clearFilters').addEventListener('click', function() {
                searchInput.value = '';
                responseFilter.value = '';
                document.getElementById('startDate').value = '';
                document.getElementById('endDate').value = '';
                tableRows.forEach(row => row.style.display = '');
            });
            
            // Email button
            document.querySelectorAll('.email-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const email = this.dataset.email;
                    const name = this.dataset.name;
                    window.location.href = `mailto:${email}?subject=Regarding Your RSVP Response`;
                });
            });
            
            // Export functionality
            document.getElementById('exportCsv')?.addEventListener('click', function(e) {
                e.preventDefault();
                alert('Exporting data as CSV');
            });
            
            document.getElementById('exportExcel')?.addEventListener('click', function(e) {
                e.preventDefault();
                alert('Exporting data as Excel');
            });
        });
    </script>
    @endpush
</x-admin-layout>