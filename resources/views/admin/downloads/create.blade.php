<x-admin-layout>
    <x-slot name="title">Create Download</x-slot>

    <!-- Page Header -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.downloads.index') }}">Downloads</a></li>
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
                            <i class="fas fa-download"></i>
                        </div>
                        <h5 class="mb-0">Download Information</h5>
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.downloads.store') }}" id="createDownloadForm">
                    @csrf
                    <div class="card-body">
                        <div class="row g-3">
                            <!-- User -->
                            <div class="col-md-6">
                                <label for="user_id" class="form-label">User <span class="text-danger">*</span></label>
                                <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                                    <option value="">Select a User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Design -->
                            <div class="col-md-6">
                                <label for="design_id" class="form-label">Design <span class="text-danger">*</span></label>
                                <select name="design_id" id="design_id" class="form-select @error('design_id') is-invalid @enderror" required>
                                    <option value="">Select a Design</option>
                                    @foreach($designs as $design)
                                        <option value="{{ $design->id }}" {{ old('design_id') == $design->id ? 'selected' : '' }}>
                                            {{ $design->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('design_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- File Type -->
                            <div class="col-md-6">
                                <label for="file_type" class="form-label">File Type <span class="text-danger">*</span></label>
                                <select name="file_type" id="file_type" class="form-select @error('file_type') is-invalid @enderror" required>
                                    <option value="">Select File Type</option>
                                    <option value="jpg" {{ old('file_type') == 'jpg' ? 'selected' : '' }}>JPG</option>
                                    <option value="png" {{ old('file_type') == 'png' ? 'selected' : '' }}>PNG</option>
                                    <option value="pdf" {{ old('file_type') == 'pdf' ? 'selected' : '' }}>PDF</option>
                                    <option value="svg" {{ old('file_type') == 'svg' ? 'selected' : '' }}>SVG</option>
                                </select>
                                @error('file_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Resolution -->
                            <div class="col-md-6">
                                <label for="resolution" class="form-label">Resolution</label>
                                <input type="text" 
                                       name="resolution" 
                                       id="resolution" 
                                       class="form-control @error('resolution') is-invalid @enderror" 
                                       value="{{ old('resolution') }}" 
                                       placeholder="e.g. 1920x1080">
                                @error('resolution')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- File Size -->
                            <div class="col-md-6">
                                <label for="file_size" class="form-label">File Size (bytes)</label>
                                <input type="number" 
                                       name="file_size" 
                                       id="file_size" 
                                       class="form-control @error('file_size') is-invalid @enderror" 
                                       value="{{ old('file_size') }}"
                                       min="0">
                                @error('file_size')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Download Count -->
                            <div class="col-md-6">
                                <label for="download_count" class="form-label">Download Count</label>
                                <input type="number" 
                                       name="download_count" 
                                       id="download_count" 
                                       class="form-control @error('download_count') is-invalid @enderror" 
                                       value="{{ old('download_count', 0) }}" 
                                       min="0">
                                @error('download_count')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- File Path -->
                            <div class="col-12">
                                <label for="file_path" class="form-label">File Path</label>
                                <input type="text" 
                                       name="file_path" 
                                       id="file_path" 
                                       class="form-control @error('file_path') is-invalid @enderror" 
                                       value="{{ old('file_path') }}" 
                                       placeholder="path/to/file.pdf">
                                @error('file_path')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Path to the downloaded file on the server</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.downloads.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-check me-1"></i> Create Download
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>