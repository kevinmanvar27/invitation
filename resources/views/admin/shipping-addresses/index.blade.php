@php
    $totalAddresses = $shippingAddresses->count();
    $defaultAddresses = $shippingAddresses->where('is_default', true)->count();
@endphp

<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shipping Addresses</li>
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
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $totalAddresses }}</span>
                        <span class="stat-card-label">Total Addresses</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card stat-card-success">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $defaultAddresses }}</span>
                        <span class="stat-card-label">Default Addresses</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toolbar -->
    <div class="toolbar mb-4">
        <div class="input-group" style="max-width: 300px;">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            <input type="text" id="searchInput" class="form-control" placeholder="Search addresses...">
        </div>
        
        <div class="toolbar-actions ms-auto">
            <select id="defaultFilter" class="form-select">
                <option value="">All Addresses</option>
                <option value="default">Default Only</option>
                <option value="non-default">Non-Default</option>
            </select>
            
            <a href="{{ route('admin.shipping-addresses.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Add Address
            </a>
        </div>
    </div>

    <!-- Shipping Addresses Table -->
    <div class="card">
        <div class="card-body p-0">
            @if($shippingAddresses->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover data-table mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Full Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Default</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shippingAddresses as $shippingAddress)
                            <tr data-default="{{ $shippingAddress->is_default ? 'default' : 'non-default' }}">
                                <td>
                                    <span class="fw-medium text-primary">#{{ $shippingAddress->id }}</span>
                                </td>
                                <td>
                                    @if($shippingAddress->user)
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar avatar-sm">
                                                @if($shippingAddress->user->avatar)
                                                    <img src="{{ asset('storage/' . $shippingAddress->user->avatar) }}" alt="{{ $shippingAddress->user->name }}">
                                                @else
                                                    <span class="avatar-initials">{{ strtoupper(substr($shippingAddress->user->name, 0, 1)) }}</span>
                                                @endif
                                            </div>
                                            <span>{{ $shippingAddress->user->name }}</span>
                                        </div>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="fw-medium">{{ $shippingAddress->full_name }}</span>
                                </td>
                                <td>
                                    <div class="small">
                                        <i class="fas fa-map-marker-alt text-muted me-1"></i>
                                        {{ $shippingAddress->address_line1 }}
                                        @if($shippingAddress->address_line2)
                                            <br><span class="ms-3">{{ $shippingAddress->address_line2 }}</span>
                                        @endif
                                        <br><span class="ms-3 text-muted">{{ $shippingAddress->city }}, {{ $shippingAddress->state }} {{ $shippingAddress->postal_code }}</span>
                                        <br><span class="ms-3 text-muted">{{ $shippingAddress->country }}</span>
                                    </div>
                                </td>
                                <td>
                                    <a href="tel:{{ $shippingAddress->phone }}" class="text-muted">
                                        <i class="fas fa-phone me-1"></i>{{ $shippingAddress->phone }}
                                    </a>
                                </td>
                                <td>
                                    @if($shippingAddress->is_default)
                                        <span class="badge badge-success">
                                            <i class="fas fa-star me-1"></i>Default
                                        </span>
                                    @else
                                        <span class="badge badge-light">No</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.shipping-addresses.show', $shippingAddress->id) }}" 
                                           class="btn btn-icon btn-outline-primary" 
                                           title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.shipping-addresses.edit', $shippingAddress->id) }}" 
                                           class="btn btn-icon btn-outline-warning" 
                                           title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-icon btn-outline-danger" 
                                                onclick="confirmDelete({{ $shippingAddress->id }}, '{{ $shippingAddress->full_name }}')"
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
                
                @if($shippingAddresses->hasPages())
                    <div class="card-footer">
                        {{ $shippingAddresses->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3>No Shipping Addresses Found</h3>
                    <p>No shipping addresses have been added yet.</p>
                    <a href="{{ route('admin.shipping-addresses.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>Add Address
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
                    <h5 class="modal-title" id="deleteModalLabel">Delete Shipping Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the address for "<strong id="deleteItemName"></strong>"?</p>
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
            document.getElementById('deleteForm').action = `/admin/shipping-addresses/${id}`;
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
            const defaultFilter = document.getElementById('defaultFilter');
            
            function applyFilters() {
                const filter = defaultFilter.value;
                
                tableRows.forEach(row => {
                    const rowDefault = row.dataset.default;
                    const match = !filter || rowDefault === filter;
                    
                    row.style.display = match ? '' : 'none';
                });
            }
            
            defaultFilter.addEventListener('change', applyFilters);
        });
    </script>
    @endpush
</x-admin-layout>