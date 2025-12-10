<x-admin-layout>
    <x-slot name="header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.templates.index') }}">Templates</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        @if($template->preview_image)
                            <img src="{{ asset('storage/' . $template->preview_image) }}" 
                                 class="rounded me-3" 
                                 width="60" 
                                 height="60" 
                                 style="object-fit: cover;"
                                 alt="{{ $template->name }}">
                        @else
                            <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" 
                                 style="width: 60px; height: 60px;">
                                <i class="fas fa-image text-muted fa-lg"></i>
                            </div>
                        @endif
                        <div>
                            <h5 class="card-title mb-0">{{ $template->name }}</h5>
                            <small class="text-muted">{{ $template->slug }}</small>
                        </div>
                        <div class="ms-auto">
                            @if($template->is_premium)
                                <span class="badge badge-warning"><i class="fas fa-crown me-1"></i>Premium</span>
                            @endif
                            @if($template->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-secondary">Inactive</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.templates.update', $template->id) }}" enctype="multipart/form-data" id="editTemplateForm">
                        @csrf
                        @method('PUT')
                        
                        <div class="row g-3">
                            <!-- Name -->
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       value="{{ old('name', $template->name) }}" 
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
                                       value="{{ old('slug', $template->slug) }}" 
                                       placeholder="template-url-slug"
                                       required>
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Description -->
                            <div class="col-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" 
                                          id="description" 
                                          class="form-control @error('description') is-invalid @enderror" 
                                          rows="3" 
                                          placeholder="Describe this template...">{{ old('description', $template->description) }}</textarea>
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
                                        <option value="{{ $category->id }}" {{ old('category_id', $template->category_id) == $category->id ? 'selected' : '' }}>
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
                                       value="{{ old('theme', $template->theme) }}"
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
                                       value="{{ old('style', $template->style) }}"
                                       placeholder="e.g., Minimalist, Floral, Classic">
                                @error('style')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Orientation -->
                            <div class="col-md-6">
                                <label for="orientation" class="form-label">Orientation</label>
                                <select name="orientation" id="orientation" class="form-select @error('orientation') is-invalid @enderror">
                                    <option value="portrait" {{ old('orientation', $template->orientation) == 'portrait' ? 'selected' : '' }}>Portrait</option>
                                    <option value="landscape" {{ old('orientation', $template->orientation) == 'landscape' ? 'selected' : '' }}>Landscape</option>
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
                                           value="{{ old('price', $template->price) }}"
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
                                           {{ old('is_premium', $template->is_premium) ? 'checked' : '' }}>
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
                                           {{ old('is_active', $template->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        <i class="fas fa-check-circle text-success me-1"></i>Active
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Template Meta Info -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="bg-light rounded p-3">
                                    <div class="row text-center">
                                        <div class="col-md-3">
                                            <small class="text-muted d-block">Created</small>
                                            <strong>{{ $template->created_at->format('M d, Y') }}</strong>
                                        </div>
                                        <div class="col-md-3">
                                            <small class="text-muted d-block">Last Updated</small>
                                            <strong>{{ $template->updated_at->format('M d, Y') }}</strong>
                                        </div>
                                        <div class="col-md-3">
                                            <small class="text-muted d-block">Designs Using</small>
                                            <strong>{{ $template->designs_count ?? $template->designs()->count() }}</strong>
                                        </div>
                                        <div class="col-md-3">
                                            <small class="text-muted d-block">Category</small>
                                            <strong>{{ $template->category->name ?? 'None' }}</strong>
                                        </div>
                                    </div>
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
                        <div>
                            <a href="{{ route('admin.templates.show', $template->id) }}" class="btn btn-outline-primary me-2">
                                <i class="fas fa-eye me-1"></i> View
                            </a>
                            <button type="submit" form="editTemplateForm" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Update Template
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>