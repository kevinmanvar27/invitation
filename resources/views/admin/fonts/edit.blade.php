<x-admin-layout>
    <x-slot name="title">Edit Font</x-slot>
    <x-slot name="page_title">Edit Font</x-slot>

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.fonts.index') }}">Fonts</a></li>
                    <li class="breadcrumb-item active">Edit {{ $font->font_name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="avatar me-3" style="width: 48px; height: 48px; background: linear-gradient(135deg, #6f42c1, #5a32a3);">
                                <i class="fas fa-font text-white"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">{{ $font->font_name }}</h5>
                                <small class="text-muted">Font #{{ $font->id }}</small>
                            </div>
                        </div>
                        <a href="{{ route('admin.fonts.show', $font->id) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye me-1"></i>View
                        </a>
                    </div>
                </div>
                
                <!-- Meta Info Row -->
                <div class="card-body bg-light border-bottom py-3">
                    <div class="row text-center">
                        <div class="col-md-3">
                            <small class="text-muted d-block">Status</small>
                            <strong>
                                @if($font->is_premium)
                                    <span class="badge bg-warning"><i class="fas fa-crown me-1"></i>Premium</span>
                                @else
                                    <span class="badge bg-success">Free</span>
                                @endif
                            </strong>
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted d-block">Weight</small>
                            <strong>{{ $font->font_weight ?? 'N/A' }}</strong>
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted d-block">Languages</small>
                            <strong>
                                @php
                                    $languages = is_array($font->language_support) ? $font->language_support : ($font->language_support ? explode(',', $font->language_support) : []);
                                @endphp
                                {{ count($languages) }}
                            </strong>
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted d-block">Created</small>
                            <strong>{{ $font->created_at->format('M d, Y') }}</strong>
                        </div>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('admin.fonts.update', $font->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <!-- Basic Information Section -->
                        <h6 class="text-muted mb-3"><i class="fas fa-info-circle me-2"></i>Basic Information</h6>
                        
                        <div class="row g-3">
                            <!-- Font Name -->
                            <div class="col-md-6">
                                <label for="font_name" class="form-label">Font Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                    <input type="text" name="font_name" id="font_name" 
                                           class="form-control @error('font_name') is-invalid @enderror" 
                                           value="{{ old('font_name', $font->font_name) }}" 
                                           placeholder="Enter font name" required>
                                    @error('font_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Font Family -->
                            <div class="col-md-6">
                                <label for="font_family" class="form-label">Font Family <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-text-height"></i></span>
                                    <input type="text" name="font_family" id="font_family" 
                                           class="form-control @error('font_family') is-invalid @enderror" 
                                           value="{{ old('font_family', $font->font_family) }}" 
                                           placeholder="e.g., 'Roboto', sans-serif" required>
                                    @error('font_family')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Font Details Section -->
                        <h6 class="text-muted mb-3"><i class="fas fa-cog me-2"></i>Font Details</h6>
                        
                        <div class="row g-3">
                            <!-- Font File Path -->
                            <div class="col-md-6">
                                <label for="font_file_path" class="form-label">Font File Path</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-file"></i></span>
                                    <input type="text" name="font_file_path" id="font_file_path" 
                                           class="form-control @error('font_file_path') is-invalid @enderror" 
                                           value="{{ old('font_file_path', $font->font_file_path) }}" 
                                           placeholder="/fonts/example.woff2">
                                    @error('font_file_path')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Font Weight -->
                            <div class="col-md-6">
                                <label for="font_weight" class="form-label">Font Weight</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-bold"></i></span>
                                    <input type="text" name="font_weight" id="font_weight" 
                                           class="form-control @error('font_weight') is-invalid @enderror" 
                                           value="{{ old('font_weight', $font->font_weight) }}" 
                                           placeholder="e.g., 400, 700, bold">
                                    @error('font_weight')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Language Support -->
                            <div class="col-12">
                                <label for="language_support" class="form-label">Language Support</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                    <input type="text" name="language_support" id="language_support" 
                                           class="form-control @error('language_support') is-invalid @enderror" 
                                           value="{{ old('language_support', is_array($font->language_support) ? implode(',', $font->language_support) : $font->language_support) }}" 
                                           placeholder="e.g., latin, cyrillic, arabic (comma separated)">
                                    @error('language_support')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="text-muted">Enter supported languages separated by commas</small>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Settings Section -->
                        <h6 class="text-muted mb-3"><i class="fas fa-sliders-h me-2"></i>Settings</h6>
                        
                        <div class="row g-3">
                            <!-- Premium Toggle -->
                            <div class="col-12">
                                <div class="form-check form-switch">
                                    <input type="checkbox" name="is_premium" id="is_premium" 
                                           class="form-check-input" value="1"
                                           {{ old('is_premium', $font->is_premium) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_premium">
                                        <i class="fas fa-crown text-warning me-1"></i>Premium Font
                                    </label>
                                </div>
                                <small class="text-muted">Premium fonts are only available to subscribed users</small>
                                @error('is_premium')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.fonts.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Back
                        </a>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.fonts.show', $font->id) }}" class="btn btn-outline-primary">
                                <i class="fas fa-eye me-1"></i>View
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Update Font
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>