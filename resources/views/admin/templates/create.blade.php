<x-admin-layout>
    <x-slot name="header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.templates.index') }}">Templates</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-plus-circle me-2"></i>New Template Details
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.templates.store') }}" enctype="multipart/form-data" id="createTemplateForm">
                        @csrf
                        
                        <div class="row g-3">
                            <!-- Name -->
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       value="{{ old('name') }}" 
                                       placeholder="Enter template name"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Slug -->
                            <div class="col-md-6">
                                <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="slug" 
                                       id="slug" 
                                       class="form-control @error('slug') is-invalid @enderror" 
                                       value="{{ old('slug') }}" 
                                       placeholder="template-url-slug"
                                       required>
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">URL-friendly identifier (auto-generated from name)</small>
                            </div>
                            
                            <!-- Description -->
                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" 
                                          id="description" 
                                          class="form-control @error('description') is-invalid @enderror" 
                                          rows="3" 
                                          placeholder="Describe this template...">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Category -->
                            <div class="col-md-6">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Theme -->
                            <div class="col-md-6">
                                <label for="theme" class="form-label">Theme</label>
                                <input type="text" 
                                       name="theme" 
                                       id="theme" 
                                       class="form-control @error('theme') is-invalid @enderror" 
                                       value="{{ old('theme') }}"
                                       placeholder="e.g., Romantic, Modern, Rustic">
                                @error('theme')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Style -->
                            <div class="col-md-6">
                                <label for="style" class="form-label">Style</label>
                                <input type="text" 
                                       name="style" 
                                       id="style" 
                                       class="form-control @error('style') is-invalid @enderror" 
                                       value="{{ old('style') }}"
                                       placeholder="e.g., Minimalist, Floral, Classic">
                                @error('style')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Orientation -->
                            <div class="col-md-6">
                                <label for="orientation" class="form-label">Orientation</label>
                                <select name="orientation" id="orientation" class="form-select @error('orientation') is-invalid @enderror">
                                    <option value="portrait" {{ old('orientation') == 'portrait' ? 'selected' : '' }}>Portrait</option>
                                    <option value="landscape" {{ old('orientation') == 'landscape' ? 'selected' : '' }}>Landscape</option>
                                </select>
                                @error('orientation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Price -->
                            <div class="col-md-6">
                                <label for="price" class="form-label">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" 
                                           step="0.01" 
                                           name="price" 
                                           id="price" 
                                           class="form-control @error('price') is-invalid @enderror" 
                                           value="{{ old('price', 0) }}"
                                           min="0">
                                </div>
                                @error('price')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Status Toggles -->
                            <div class="col-md-6">
                                <label class="form-label d-block">Options</label>
                                <div class="form-check form-check-inline">
                                    <input type="hidden" name="is_premium" value="0">
                                    <input type="checkbox" 
                                           name="is_premium" 
                                           id="is_premium" 
                                           class="form-check-input" 
                                           value="1" 
                                           {{ old('is_premium') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_premium">
                                        <i class="fas fa-crown text-warning me-1"></i>Premium
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" 
                                           name="is_active" 
                                           id="is_active" 
                                           class="form-check-input" 
                                           value="1" 
                                           {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        <i class="fas fa-check-circle text-success me-1"></i>Active
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.templates.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back to Templates
                        </a>
                        <button type="submit" form="createTemplateForm" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Create Template
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Auto-generate slug from name
        document.getElementById('name').addEventListener('input', function() {
            const slug = this.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
            document.getElementById('slug').value = slug;
        });
    </script>
    @endpush
</x-admin-layout>