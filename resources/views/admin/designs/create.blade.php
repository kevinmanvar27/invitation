<x-admin-layout>
    <!-- Page Header -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.designs.index') }}">Designs</a></li>
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
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar bg-primary text-white d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="fas fa-palette fs-5"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Design Details</h5>
                            <small class="text-muted">Enter the design information below</small>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.designs.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="row g-3">
                            <!-- User -->
                            <div class="col-md-6">
                                <label for="user_id" class="form-label">User <span class="text-danger">*</span></label>
                                <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                                    <option value="">Select a User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Template -->
                            <div class="col-md-6">
                                <label for="template_id" class="form-label">Template <span class="text-danger">*</span></label>
                                <select name="template_id" id="template_id" class="form-select @error('template_id') is-invalid @enderror" required>
                                    <option value="">Select a Template</option>
                                    @foreach($templates as $template)
                                        <option value="{{ $template->id }}" {{ old('template_id') == $template->id ? 'selected' : '' }}>{{ $template->name }}</option>
                                    @endforeach
                                </select>
                                @error('template_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Design Name -->
                            <div class="col-12">
                                <label for="design_name" class="form-label">Design Name <span class="text-danger">*</span></label>
                                <input type="text" name="design_name" id="design_name" class="form-control @error('design_name') is-invalid @enderror" value="{{ old('design_name') }}" placeholder="Enter design name" required>
                                @error('design_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Is Completed -->
                            <div class="col-md-6">
                                <label class="form-label d-block">Completion Status</label>
                                <div class="form-check form-switch mt-2">
                                    <input type="hidden" name="is_completed" value="0">
                                    <input class="form-check-input" type="checkbox" name="is_completed" id="is_completed" value="1" {{ old('is_completed') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_completed">Mark as Completed</label>
                                </div>
                                @error('is_completed')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.designs.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Create Design
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>