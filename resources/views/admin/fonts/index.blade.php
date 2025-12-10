{{-- Fonts Index - Admin Panel --}}
{{-- Updated to Bootstrap 5 + custom admin theme --}}

@php
    $totalFonts = $fonts->total() ?? count($fonts);
    $activeFonts = $fonts->where('is_active', true)->count();
    $inactiveFonts = $fonts->where('is_active', false)->count();
@endphp

<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Fonts</li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card stat-card-primary">
                <div class="stat-card-icon">
                    <i class="fas fa-font"></i>
                </div>
                <div class="stat-card-body">
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $totalFonts }}</span>
                        <span class="stat-card-label">Total Fonts</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card stat-card-success">
                <div class="stat-card-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-card-body">
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $activeFonts }}</span>
                        <span class="stat-card-label">Active Fonts</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card stat-card-warning">
                <div class="stat-card-icon">
                    <i class="fas fa-pause-circle"></i>
                </div>
                <div class="stat-card-body">
                    <div class="stat-card-content">
                        <span class="stat-card-value">{{ $inactiveFonts }}</span>
                        <span class="stat-card-label">Inactive Fonts</span>
                    </div>
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
                    <input type="text" id="searchInput" class="form-control" placeholder="Search fonts...">
                </div>
                <div class="toolbar-actions ms-auto">
                    <select id="statusFilter" class="form-select">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
                        <i class="fas fa-upload me-2"></i>Upload Font
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover data-table mb-0">
                    <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>Font Name</th>
                            <th>Font Family</th>
                            <th width="300">Preview</th>
                            <th>Status</th>
                            <th width="160">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($fonts as $font)
                        <tr data-status="{{ $font->is_active ? 'active' : 'inactive' }}">
                            <td><span class="text-muted">#{{ $font->id }}</span></td>
                            <td>
                                <span class="fw-medium">{{ $font->font_name }}</span>
                            </td>
                            <td>
                                <code class="small">{{ $font->font_family }}</code>
                            </td>
                            <td>
                                <div style="font-family: '{{ $font->font_family }}', sans-serif; font-size: 14px;" class="text-truncate">
                                    The quick brown fox jumps over the lazy dog
                                </div>
                            </td>
                            <td>
                                @if($font->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="table-actions">
                                    <button type="button" class="btn btn-icon btn-outline-info preview-font-btn" title="Preview" data-font-id="{{ $font->id }}" data-font-family="{{ $font->font_family }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <a href="{{ route('admin.fonts.edit', $font->id) }}" class="btn btn-icon btn-outline-secondary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-icon btn-outline-danger" title="Delete" onclick="confirmDelete({{ $font->id }}, '{{ addslashes($font->font_name) }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-font"></i>
                                    </div>
                                    <h4>No Fonts Found</h4>
                                    <p>Get started by uploading your first font.</p>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
                                        <i class="fas fa-upload me-2"></i>Upload Font
                                    </button>
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
            @if($fonts->hasPages())
            <div>
                {{ $fonts->links() }}
            </div>
            @endif
        </div>
    </div>

    <!-- Upload Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">
                        <i class="fas fa-upload me-2"></i>Upload Font
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.fonts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="fontName" class="form-label">Font Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="fontName" name="font_name" required placeholder="e.g., Great Vibes">
                        </div>
                        <div class="mb-3">
                            <label for="fontFamily" class="form-label">Font Family <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="fontFamily" name="font_family" required placeholder="e.g., 'Great Vibes', cursive">
                        </div>
                        <div class="mb-3">
                            <label for="fontFile" class="form-label">Font File <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="fontFile" name="font_file" accept=".ttf,.otf,.woff,.woff2" required>
                            <div class="form-text">Accepted formats: TTF, OTF, WOFF, WOFF2</div>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="isActive" name="is_active" value="1" checked>
                            <label class="form-check-label" for="isActive">Active</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload me-2"></i>Upload Font
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Font Preview Modal -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewModalLabel">
                        <i class="fas fa-font me-2"></i>Font Preview
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="fontPreviewContent" class="p-4 bg-light rounded">
                        <p style="font-size: 48px;" class="mb-3">Aa Bb Cc Dd Ee Ff</p>
                        <p style="font-size: 32px;" class="mb-3">The quick brown fox jumps over the lazy dog</p>
                        <p style="font-size: 24px;" class="mb-3">ABCDEFGHIJKLMNOPQRSTUVWXYZ</p>
                        <p style="font-size: 24px;" class="mb-3">abcdefghijklmnopqrstuvwxyz</p>
                        <p style="font-size: 24px;" class="mb-0">0123456789 !@#$%^&*()</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="deleteFontName"></strong>?</p>
                    <p class="text-muted small mb-0">This action cannot be undone. Designs using this font may be affected.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete Font</button>
                    </form>
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
        document.getElementById('statusFilter').addEventListener('change', function() {
            filterTable();
        });

        function filterTable() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
            const rows = document.querySelectorAll('.data-table tbody tr[data-status]');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const status = row.dataset.status;

                const matchesSearch = text.includes(searchTerm);
                const matchesStatus = !statusFilter || status === statusFilter;

                row.style.display = matchesSearch && matchesStatus ? '' : 'none';
            });
        }

        // Font preview
        document.querySelectorAll('.preview-font-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const fontFamily = this.dataset.fontFamily;
                const previewContent = document.getElementById('fontPreviewContent');
                previewContent.style.fontFamily = `'${fontFamily}', sans-serif`;
                new bootstrap.Modal(document.getElementById('previewModal')).show();
            });
        });

        // Delete confirmation
        function confirmDelete(id, name) {
            document.getElementById('deleteFontName').textContent = name;
            document.getElementById('deleteForm').action = `{{ route('admin.fonts.index') }}/${id}`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }

        // Export functionality
        document.getElementById('exportCsv').addEventListener('click', function() {
            window.location.href = '{{ route("admin.fonts.index") }}?export=csv';
        });

        document.getElementById('exportExcel').addEventListener('click', function() {
            window.location.href = '{{ route("admin.fonts.index") }}?export=excel';
        });
    </script>
    @endpush
</x-admin-layout>
