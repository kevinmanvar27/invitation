<x-admin-layout>
    <x-slot name="title">Font Details</x-slot>
    <x-slot name="page_title">Font Details</x-slot>

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.fonts.index') }}">Fonts</a></li>
                    <li class="breadcrumb-item active">{{ $font->font_name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <!-- Left Column - Profile Card -->
        <div class="col-lg-4 mb-4">
            <!-- Main Font Card -->
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar mx-auto mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #6f42c1, #5a32a3);">
                        <i class="fas fa-font fa-2x text-white"></i>
                    </div>
                    <h5 class="mb-1">{{ $font->font_name }}</h5>
                    <p class="text-muted mb-3">Font #{{ $font->id }}</p>
                    
                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                        @if($font->is_premium)
                            <span class="badge bg-warning"><i class="fas fa-crown me-1"></i>Premium</span>
                        @else
                            <span class="badge bg-success">Free</span>
                        @endif
                        @if($font->font_weight)
                            <span class="badge bg-info">{{ $font->font_weight }}</span>
                        @endif
                    </div>
                    
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <a href="{{ route('admin.fonts.edit', $font->id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete()">
                            <i class="fas fa-trash me-1"></i>Delete
                        </button>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row text-center">
                        <div class="col-6 border-end">
                            <small class="text-muted d-block">Created</small>
                            <strong>{{ $font->created_at->format('M d, Y') }}</strong>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Updated</small>
                            <strong>{{ $font->updated_at->format('M d, Y') }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Font Preview Card -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-eye me-2"></i>Font Preview</h6>
                </div>
                <div class="card-body">
                    <div class="text-center p-3 bg-light rounded" style="font-family: {{ $font->font_family }};">
                        <p class="mb-2" style="font-size: 24px;">Aa Bb Cc Dd Ee</p>
                        <p class="mb-2" style="font-size: 18px;">The quick brown fox jumps over the lazy dog</p>
                        <p class="mb-0 text-muted" style="font-size: 14px;">1234567890 !@#$%^&*()</p>
                    </div>
                    <p class="text-muted text-center mt-2 mb-0"><small>{{ $font->font_family }}</small></p>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h6>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('admin.fonts.edit', $font->id) }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-edit me-2 text-primary"></i>Edit Font
                        </a>
                        <a href="{{ route('admin.fonts.create') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-plus me-2 text-success"></i>Create New Font
                        </a>
                        <a href="{{ route('admin.fonts.index') }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-list me-2 text-secondary"></i>All Fonts
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Details -->
        <div class="col-lg-8">
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="stat-card stat-card-primary">
                        <div class="stat-icon">
                            <i class="fas fa-hashtag"></i>
                        </div>
                        <div class="stat-value">{{ $font->id }}</div>
                        <div class="stat-label">Font ID</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-card-info">
                        <div class="stat-icon">
                            <i class="fas fa-bold"></i>
                        </div>
                        <div class="stat-value">{{ $font->font_weight ?? 'N/A' }}</div>
                        <div class="stat-label">Weight</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-card-success">
                        <div class="stat-icon">
                            <i class="fas fa-globe"></i>
                        </div>
                        <div class="stat-value">
                            @php
                                $languages = is_array($font->language_support) ? $font->language_support : ($font->language_support ? explode(',', $font->language_support) : []);
                            @endphp
                            {{ count($languages) }}
                        </div>
                        <div class="stat-label">Languages</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card stat-card-warning">
                        <div class="stat-icon">
                            <i class="fas fa-crown"></i>
                        </div>
                        <div class="stat-value">{{ $font->is_premium ? 'Yes' : 'No' }}</div>
                        <div class="stat-label">Premium</div>
                    </div>
                </div>
            </div>

            <!-- Basic Information Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Basic Information</h5>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Font ID</span>
                            <span class="detail-value">#{{ $font->id }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Font Name</span>
                            <span class="detail-value">{{ $font->font_name }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Font Family</span>
                            <span class="detail-value"><code>{{ $font->font_family }}</code></span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Font Weight</span>
                            <span class="detail-value">
                                @if($font->font_weight)
                                    <span class="badge bg-info">{{ $font->font_weight }}</span>
                                @else
                                    <span class="text-muted">Not specified</span>
                                @endif
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Premium Status</span>
                            <span class="detail-value">
                                @if($font->is_premium)
                                    <span class="badge bg-warning"><i class="fas fa-crown me-1"></i>Premium</span>
                                @else
                                    <span class="badge bg-success">Free</span>
                                @endif
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Font File Path</span>
                            <span class="detail-value">
                                @if($font->font_file_path)
                                    <code>{{ $font->font_file_path }}</code>
                                @else
                                    <span class="text-muted">Not specified</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Language Support Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-globe me-2"></i>Language Support</h5>
                </div>
                <div class="card-body">
                    @php
                        $languages = is_array($font->language_support) ? $font->language_support : ($font->language_support ? explode(',', $font->language_support) : []);
                    @endphp
                    @if(count($languages) > 0)
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($languages as $language)
                                <span class="badge bg-light text-dark border">
                                    <i class="fas fa-language me-1"></i>{{ trim($language) }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted mb-0">No language support information specified</p>
                    @endif
                </div>
            </div>

            <!-- Timestamps Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Timestamps</h5>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Created At</span>
                            <span class="detail-value">
                                {{ $font->created_at->format('F d, Y \a\t h:i A') }}
                                <small class="text-muted">({{ $font->created_at->diffForHumans() }})</small>
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Last Updated</span>
                            <span class="detail-value">
                                {{ $font->updated_at->format('F d, Y \a\t h:i A') }}
                                <small class="text-muted">({{ $font->updated_at->diffForHumans() }})</small>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <a href="{{ route('admin.fonts.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Back to Fonts
            </a>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle text-danger me-2"></i>Confirm Delete
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this font?</p>
                    <div class="alert alert-warning">
                        <strong>{{ $font->font_name }}</strong><br>
                        Family: {{ $font->font_family }}
                    </div>
                    <p class="text-danger mb-0"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.fonts.destroy', $font->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i>Delete Font
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function confirmDelete() {
            var modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }
    </script>
    @endpush
</x-admin-layout>