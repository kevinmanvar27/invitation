<x-admin-layout>
    <x-slot name="title">Create Tag</x-slot>

    <!-- Page Header -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.tags.index') }}">Tags</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Create Form -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-sm bg-primary text-white me-3">
                            <i class="fas fa-tag"></i>
                        </div>
                        <h5 class="mb-0">Tag Information</h5>
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.tags.store') }}" id="createTagForm">
                    @csrf
                    <div class="card-body">
                        <div class="row g-3">
                            <!-- Category -->
                            <div class="col-12">
                                <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                                <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
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

                            <!-- Tag Name -->
                            <div class="col-12">
                                <label for="tag_name" class="form-label">Tag Name <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="tag_name" 
                                       id="tag_name" 
                                       class="form-control @error('tag_name') is-invalid @enderror" 
                                       value="{{ old('tag_name') }}" 
                                       placeholder="Enter tag name (e.g., wedding, birthday, elegant)"
                                       required>
                                @error('tag_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Tags help users find designs by keywords</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.tags.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-check me-1"></i> Create Tag
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>