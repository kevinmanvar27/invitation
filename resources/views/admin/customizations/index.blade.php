{{-- Customizations Index - Admin Panel --}}
{{-- Updated to Bootstrap 5 + custom admin theme --}}

@php
    $totalCustomizations = $customizations->total() ?? count($customizations ?? []);
@endphp

<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Customizations</li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <!-- Analytics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-shapes me-2 text-primary"></i>Most Used Elements
                    </h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Heart Icon</span>
                            <span class="badge badge-primary rounded-pill">1,245</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Floral Border</span>
                            <span class="badge badge-primary rounded-pill">987</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Rose Gold Frame</span>
                            <span class="badge badge-primary rounded-pill">876</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-palette me-2 text-warning"></i>Most Used Colors
                    </h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <span class="d-inline-block rounded me-2" style="width: 16px; height: 16px; background-color: #E8C4B8;"></span>
                                Rose Gold
                            </span>
                            <span class="badge badge-warning rounded-pill">2,134</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <span class="d-inline-block rounded me-2" style="width: 16px; height: 16px; background-color: #6B4C3B;"></span>
                                Brown
                            </span>
                            <span class="badge badge-warning rounded-pill">1,876</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>
                                <span class="d-inline-block rounded me-2 border" style="width: 16px; height: 16px; background-color: #FFFFFF;"></span>
                                White
                            </span>
                            <span class="badge badge-warning rounded-pill">1,543</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header">
                    <h6 class="card-title mb-0">
                        <i class="fas fa-font me-2 text-success"></i>Most Used Fonts
                    </h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Great Vibes</span>
                            <span class="badge badge-success rounded-pill">3,456</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Playfair Display</span>
                            <span class="badge badge-success rounded-pill">2,987</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Lora</span>
                            <span class="badge badge-success rounded-pill">2,123</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Card -->
    <div class="card">
        <div class="card-header">
            <div class="toolbar">
                <div class="input-group" style="max-width: 300px;">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                    <input type="text" id="searchInput" class="form-control" placeholder="Search customizations...">
                </div>
                <div class="toolbar-actions ms-auto">
                    <select id="typeFilter" class="form-select">
                        <option value="">All Types</option>
                        <option value="color">Color</option>
                        <option value="font">Font</option>
                        <option value="layout">Layout</option>
                        <option value="image">Image</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover data-table mb-0">
                    <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>User</th>
                            <th>Design</th>
                            <th>Type</th>
                            <th>Elements Used</th>
                            <th>Colors Used</th>
                            <th>Fonts Used</th>
                            <th>Date</th>
                            <th width="120">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customizations ?? [] as $customization)
                        <tr data-type="{{ strtolower($customization->customization_type ?? '') }}">
                            <td><span class="text-muted">#{{ $customization->id }}</span></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm me-2">
                                        @if($customization->user && $customization->user->avatar)
                                            <img src="{{ asset($customization->user->avatar) }}" alt="{{ $customization->user->name }}">
                                        @else
                                            <span class="avatar-initials">{{ substr($customization->user->name ?? 'U', 0, 1) }}</span>
                                        @endif
                                    </div>
                                    <span>{{ $customization->user->name ?? 'Unknown User' }}</span>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('admin.designs.show', $customization->design_id ?? 0) }}" class="text-primary">
                                    Design #{{ $customization->design_id ?? 'N/A' }}
                                </a>
                            </td>
                            <td>
                                <span class="badge badge-info">{{ ucfirst($customization->customization_type ?? 'Unknown') }}</span>
                            </td>
                            <td>
                                <span class="text-truncate d-inline-block" style="max-width: 150px;" title="{{ $customization->elements_used ?? '' }}">
                                    {{ $customization->elements_used ?? '-' }}
                                </span>
                            </td>
                            <td>
                                @if($customization->colors_used)
                                    @foreach(explode(',', $customization->colors_used) as $color)
                                        <span class="d-inline-block rounded border" style="width: 20px; height: 20px; background-color: {{ trim($color) }};" title="{{ trim($color) }}"></span>
                                    @endforeach
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <span class="text-truncate d-inline-block" style="max-width: 120px;" title="{{ $customization->fonts_used ?? '' }}">
                                    {{ $customization->fonts_used ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <span class="text-muted">{{ $customization->created_at ? $customization->created_at->format('M d, Y') : '-' }}</span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <button type="button" class="btn btn-icon btn-outline-primary" title="View" onclick="viewCustomization({{ $customization->id }})">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-icon btn-outline-secondary" title="Download" onclick="downloadCustomization({{ $customization->id }})">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9">
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-paint-brush"></i>
                                    </div>
                                    <h4>No Customizations Found</h4>
                                    <p>User customizations will appear here once users start customizing their designs.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-secondary" id="exportCsv">
                    <i class="fas fa-file-csv me-2"></i>Export CSV
                </button>
                <button type="button" class="btn btn-outline-secondary" id="exportExcel">
                    <i class="fas fa-file-excel me-2"></i>Export Excel
                </button>
            </div>
            @if(isset($customizations) && $customizations->hasPages())
            <div>
                {{ $customizations->links() }}
            </div>
            @endif
        </div>
    </div>

    <!-- View Customization Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">
                        <i class="fas fa-paint-brush me-2"></i>Customization Details
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="viewModalContent">
                    <!-- Content will be loaded dynamically -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            filterTable();
        });

        // Filter functionality
        document.getElementById('typeFilter').addEventListener('change', function() {
            filterTable();
        });

        function filterTable() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const typeFilter = document.getElementById('typeFilter').value.toLowerCase();
            const rows = document.querySelectorAll('.data-table tbody tr[data-type]');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const type = row.dataset.type;

                const matchesSearch = text.includes(searchTerm);
                const matchesType = !typeFilter || type === typeFilter;

                row.style.display = matchesSearch && matchesType ? '' : 'none';
            });
        }

        // View customization
        function viewCustomization(id) {
            // In a real application, this would fetch data via AJAX
            document.getElementById('viewModalContent').innerHTML = `
                <div class="text-center py-4">
                    <i class="fas fa-spinner fa-spin fa-2x text-primary mb-3"></i>
                    <p>Loading customization details...</p>
                </div>
            `;
            new bootstrap.Modal(document.getElementById('viewModal')).show();
            
            // Simulate loading
            setTimeout(() => {
                document.getElementById('viewModalContent').innerHTML = `
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Customization #${id} details would be loaded here.
                    </div>
                `;
            }, 500);
        }

        // Download customization
        function downloadCustomization(id) {
            window.location.href = `{{ route('admin.customizations.index') }}/${id}/download`;
        }

        // Export functionality
        document.getElementById('exportCsv').addEventListener('click', function() {
            window.location.href = '{{ route("admin.customizations.index") }}?export=csv';
        });

        document.getElementById('exportExcel').addEventListener('click', function() {
            window.location.href = '{{ route("admin.customizations.index") }}?export=excel';
        });
    </script>
    @endpush
</x-admin-layout>
