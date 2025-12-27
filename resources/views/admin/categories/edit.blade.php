<x-admin-layout>
    <x-slot name="header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 rounded p-2 me-3">
                            <i class="fas {{ $category->icon ?? 'fa-folder' }} text-warning fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">{{ $category->name }}</h5>
                            <small class="text-muted">{{ $category->slug }}</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" id="editCategoryForm">
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
                                       value="{{ old('name', $category->name) }}" 
                                       placeholder="Enter category name"
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
                                       value="{{ old('slug', $category->slug) }}" 
                                       placeholder="category-url-slug"
                                       required>
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Parent Category -->
                            <div class="col-md-6">
                                <label for="parent_id" class="form-label">Parent Category</label>
                                <select name="parent_id" id="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
                                    <option value="">None (Top Level)</option>
                                    @foreach($categories as $cat)
                                        @if($cat->id !== $category->id)
                                            <option value="{{ $cat->id }}" {{ old('parent_id', $category->parent_id) == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('parent_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Order -->
                            <div class="col-md-3">
                                <label for="order" class="form-label">Display Order</label>
                                <input type="number" 
                                       name="order" 
                                       id="order" 
                                       class="form-control @error('order') is-invalid @enderror" 
                                       value="{{ old('order', $category->order) }}"
                                       min="0">
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Icon -->
                            <div class="col-md-3">
                                <label for="icon" class="form-label">Icon</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas {{ $category->icon ?? 'fa-icons' }}"></i></span>
                                    <input type="text" 
                                           name="icon" 
                                           id="icon" 
                                           class="form-control @error('icon') is-invalid @enderror" 
                                           value="{{ old('icon', $category->icon) }}"
                                           placeholder="fa-heart">
                                </div>
                                @error('icon')
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
                                          placeholder="Describe this category...">{{ old('description', $category->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Category Meta Info -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="bg-light rounded p-3">
                                    <div class="row text-center">
                                        <div class="col-md-4">
                                            <small class="text-muted d-block">Created</small>
                                            <strong>{{ $category->created_at->format('M d, Y') }}</strong>
                                        </div>
                                        <div class="col-md-4">
                                            <small class="text-muted d-block">Last Updated</small>
                                            <strong>{{ $category->updated_at->format('M d, Y') }}</strong>
                                        </div>
                                        <div class="col-md-4">
                                            <small class="text-muted d-block">Designs</small>
                                            <strong>{{ $category->designs_count ?? $category->designs()->count() }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back to Categories
                        </a>
                        <div>
                            <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-outline-primary me-2">
                                <i class="fas fa-eye me-1"></i> View
                            </a>
                            <button type="submit" form="editCategoryForm" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Update Category
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>