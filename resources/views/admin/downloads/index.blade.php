@php
    $totalDownloads = $downloads->count();
    $uniqueUsers = $downloads->unique('user_id')->count();
    $pdfCount = $downloads->where('file_format', 'pdf')->count();
    $avgFileSize = $downloads->avg('file_size') ?? 0;
@endphp

<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Downloads</li>
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
                        <i class="fas fa-download"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ number_format($totalDownloads) }}</span>
                        <span class="stat-card-label">Total Downloads</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card stat-card-success">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ number_format($uniqueUsers) }}</span>
                        <span class="stat-card-label">Unique Users</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card stat-card-warning">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-file-pdf"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $pdfCount }}</span>
                        <span class="stat-card-label">PDF Downloads</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card stat-card-info">
                <div class="stat-card-body">
                    <div class="stat-card-icon">
                        <i class="fas fa-hdd"></i>
                    </div>
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ number_format($avgFileSize / 1024, 1) }} KB</span>
                        <span class="stat-card-label">Avg. File Size</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Toolbar -->
    <div class="toolbar mb-4">
        <div class="input-group" style="max-width: 300px;">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            <input type="text" id="searchInput" class="form-control" placeholder="Search downloads...">
        </div>
        
        <div class="toolbar-actions ms-auto">
            <select id="formatFilter" class="form-select">
                <option value="">All Formats</option>
                <option value="pdf">PDF</option>
                <option value="jpg">JPG</option>
                <option value="png">PNG</option>
                <option value="svg">SVG</option>
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

    <!-- Downloads Table -->
    <div class="card">
        <div class="card-body p-0">
            @if($downloads->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover data-table mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Design</th>
                                <th>Format</th>
                                <th>File Size</th>
                                <th>Downloaded</th>
                                <th>IP Address</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($downloads as $download)
                            <tr>
                                <td><span class="text-muted">#{{ $download->id }}</span></td>
                                <td>
                                    @if($download->user)
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar avatar-sm">
                                                @if($download->user->avatar)
                                                    <img src="{{ asset('storage/' . $download->user->avatar) }}" alt="{{ $download->user->name }}">
                                                @else
                                                    <span class="avatar-initials">{{ strtoupper(substr($download->user->name, 0, 1)) }}</span>
                                                @endif
                                            </div>
                                            <span>{{ $download->user->name }}</span>
                                        </div>
                                    @else
                                        <span class="text-muted">Guest</span>
                                    @endif
                                </td>
                                <td>
                                    @if($download->design)
                                        <a href="{{ route('admin.designs.show', $download->design->id) }}" class="text-primary">
                                            {{ Str::limit($download->design->design_name ?? 'Untitled', 30) }}
                                        </a>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $format = strtoupper($download->file_format ?? 'N/A');
                                        $formatClass = match(strtolower($download->file_format ?? '')) {
                                            'pdf' => 'badge-danger',
                                            'jpg', 'jpeg' => 'badge-warning',
                                            'png' => 'badge-info',
                                            'svg' => 'badge-success',
                                            default => 'badge-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $formatClass }}">{{ $format }}</span>
                                </td>
                                <td>
                                    <span class="text-muted">{{ number_format(($download->file_size ?? 0) / 1024, 1) }} KB</span>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $download->created_at->format('M d, Y') }}</span>
                                    <br>
                                    <small class="text-muted">{{ $download->created_at->format('H:i') }}</small>
                                </td>
                                <td>
                                    <code class="text-muted">{{ $download->ip_address ?? 'N/A' }}</code>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('admin.downloads.show', $download->id) }}" 
                                           class="btn btn-icon btn-outline-primary" 
                                           title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-icon btn-outline-info track-btn" 
                                                data-download-id="{{ $download->id }}"
                                                title="Track Download">
                                            <i class="fas fa-chart-line"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if($downloads->hasPages())
                    <div class="card-footer">
                        {{ $downloads->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-download"></i>
                    </div>
                    <h3>No Downloads Found</h3>
                    <p>No download activity has been recorded yet.</p>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
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
            const formatFilter = document.getElementById('formatFilter');
            const startDate = document.getElementById('startDate');
            const endDate = document.getElementById('endDate');
            
            function applyFilters() {
                const format = formatFilter.value.toLowerCase();
                
                tableRows.forEach(row => {
                    const rowFormat = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
                    const formatMatch = !format || rowFormat.includes(format);
                    
                    row.style.display = formatMatch ? '' : 'none';
                });
            }
            
            formatFilter.addEventListener('change', applyFilters);
            
            // Clear filters
            document.getElementById('clearFilters').addEventListener('click', function() {
                searchInput.value = '';
                formatFilter.value = '';
                startDate.value = '';
                endDate.value = '';
                tableRows.forEach(row => row.style.display = '');
            });
            
            // Track button
            document.querySelectorAll('.track-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const downloadId = this.dataset.downloadId;
                    // In a real app, this would open a tracking modal or navigate to tracking page
                    alert('Tracking download #' + downloadId);
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