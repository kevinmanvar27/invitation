<x-admin-layout>
    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ __('Create Template') }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.templates.index') }}">Templates</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
        </div>
    </x-slot>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add New Template</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.templates.store') }}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <!-- Slug -->
                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}" required>
                                @error('slug')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Category -->
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" id="category_id" class="form-select">
                                    <option value="">Select a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <!-- Theme -->
                            <div class="mb-3">
                                <label for="theme" class="form-label">Theme</label>
                                <input type="text" name="theme" id="theme" class="form-control" value="{{ old('theme') }}">
                                @error('theme')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Style -->
                            <div class="mb-3">
                                <label for="style" class="form-label">Style</label>
                                <input type="text" name="style" id="style" class="form-control" value="{{ old('style') }}">
                                @error('style')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <!-- Orientation -->
                            <div class="mb-3">
                                <label for="orientation" class="form-label">Orientation</label>
                                <select name="orientation" id="orientation" class="form-select">
                                    <option value="portrait" {{ old('orientation') == 'portrait' ? 'selected' : '' }}>Portrait</option>
                                    <option value="landscape" {{ old('orientation') == 'landscape' ? 'selected' : '' }}>Landscape</option>
                                </select>
                                @error('orientation')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Premium -->
                            <div class="mb-3 form-check">
                                <input type="hidden" name="is_premium" value="0">
                                <input type="checkbox" name="is_premium" id="is_premium" class="form-check-input" value="1" {{ old('is_premium') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_premium">Is Premium Template</label>
                                @error('is_premium')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Price -->
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price', 0) }}">
                                @error('price')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <!-- Active -->
                            <div class="mb-3 form-check">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Is Active</label>
                                @error('is_active')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.templates.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Create Template
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>