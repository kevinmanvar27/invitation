<x-admin-layout>
    <x-slot name="title">Create Design Element</x-slot>
    <x-slot name="page_title">Create Design Element</x-slot>

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.design-elements.index') }}">Design Elements</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Create Form Card -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="avatar me-3" style="width: 48px; height: 48px; background: linear-gradient(135deg, #6f42c1, #5a32a3);">
                            <i class="fas fa-shapes text-white"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">New Design Element</h5>
                            <small class="text-muted">Add a new element for invitation designs</small>
                        </div>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('admin.design-elements.store') }}">
                    @csrf
                    
                    <div class="card-body">
                        <!-- Basic Information Section -->
                        <h6 class="text-muted mb-3"><i class="fas fa-info-circle me-2"></i>Basic Information</h6>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                    <input type="text" name="name" id="name" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           value="{{ old('name') }}" 
                                           placeholder="Element name" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                                    <input type="text" name="type" id="type" 
                                           class="form-control @error('type') is-invalid @enderror" 
                                           value="{{ old('type') }}" 
                                           placeholder="e.g., shape, icon, decoration" required>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="category" class="form-label">Category</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-folder"></i></span>
                                    <input type="text" name="category" id="category" 
                                           class="form-control @error('category') is-invalid @enderror" 
                                           value="{{ old('category') }}" 
                                           placeholder="e.g., floral, geometric">
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="tags" class="form-label">Tags</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                    <input type="text" name="tags" id="tags" 
                                           class="form-control @error('tags') is-invalid @enderror" 
                                           value="{{ old('tags') }}" 
                                           placeholder="tag1, tag2, tag3">
                                    @error('tags')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text">Comma-separated list of tags</div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- File Paths Section -->
                        <h6 class="text-muted mb-3"><i class="fas fa-file-image me-2"></i>File Paths</h6>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="svg_path" class="form-label">SVG Path</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-vector-square"></i></span>
                                    <input type="text" name="svg_path" id="svg_path" 
                                           class="form-control @error('svg_path') is-invalid @enderror" 
                                           value="{{ old('svg_path') }}" 
                                           placeholder="/path/to/element.svg">
                                    @error('svg_path')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="png_path" class="form-label">PNG Path</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-image"></i></span>
                                    <input type="text" name="png_path" id="png_path" 
                                           class="form-control @error('png_path') is-invalid @enderror" 
                                           value="{{ old('png_path') }}" 
                                           placeholder="/path/to/element.png">
                                    @error('png_path')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Settings Section -->
                        <h6 class="text-muted mb-3"><i class="fas fa-cog me-2"></i>Settings</h6>
                        
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-check form-switch">
                                    <input type="checkbox" name="is_premium" id="is_premium" 
                                           class="form-check-input @error('is_premium') is-invalid @enderror" 
                                           value="1" {{ old('is_premium') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_premium">
                                        <i class="fas fa-crown text-warning me-1"></i>Premium Element
                                    </label>
                                    @error('is_premium')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text">Premium elements are only available to premium subscribers</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.design-elements.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Create Design Element
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>