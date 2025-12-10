<x-admin-layout>
    <x-slot name="title">Edit Template Tag</x-slot>

    <!-- Page Header -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.tags.index') }}">Tags</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-sm bg-primary text-white me-3">
                                <i class="fas fa-tag"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">{{ $templateTag->tag_name }}</h5>
                                <small class="text-muted">Tag #{{ $templateTag->id }}</small>
                            </div>
                        </div>
                        <a href="{{ route('admin.tags.show', $templateTag->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-eye me-1"></i> View
                        </a>
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.tags.update', $templateTag->id) }}" id="editTagForm">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <!-- Meta Info -->
                        <div class="bg-light rounded p-3 mb-4">
                            <div class="row text-center">
                                <div class="col-6">
                                    <small class="text-muted d-block">Created</small>
                                    <span class="fw-medium">{{ $templateTag->created_at->format('M d, Y') }}</span>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Last Updated</small>
                                    <span class="fw-medium">{{ $templateTag->updated_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <!-- Template -->
                            <div class="col-12">
                                <label for="template_id" class="form-label">Template <span class="text-danger">*</span></label>
                                <select name="template_id" id="template_id" class="form-select @error('template_id') is-invalid @enderror" required>
                                    <option value="">Select a template</option>
                                    @foreach($templates as $template)
                                        <option value="{{ $template->id }}" {{ old('template_id', $templateTag->template_id) == $template->id ? 'selected' : '' }}>
                                            {{ $template->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('template_id')
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
                                       value="{{ old('tag_name', $templateTag->tag_name) }}" 
                                       placeholder="Enter tag name"
                                       required>
                                @error('tag_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Tags help users find templates by keywords</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.tags.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                        <div>
                            <a href="{{ route('admin.tags.show', $templateTag->id) }}" class="btn btn-outline-primary me-2">
                                <i class="fas fa-eye me-1"></i> View
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check me-1"></i> Update Tag
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>