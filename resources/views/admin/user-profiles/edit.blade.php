<x-admin-layout>
    <x-slot name="title">Edit User Profile</x-slot>
    <x-slot name="page_title">Edit User Profile</x-slot>

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.user-profiles.index') }}">User Profiles</a></li>
                    <li class="breadcrumb-item active">Edit #{{ $userProfile->id }}</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.user-profiles.show', $userProfile->id) }}" class="btn btn-info">
            <i class="fas fa-eye me-1"></i>View Profile
        </a>
    </div>

    <!-- Edit Form Card -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="avatar me-3" style="width: 48px; height: 48px; background: linear-gradient(135deg, #17a2b8, #138496);">
                            <i class="fas fa-id-card text-white"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Edit User Profile #{{ $userProfile->id }}</h5>
                            <small class="text-muted">Update profile information for {{ $userProfile->user->name ?? 'User' }}</small>
                        </div>
                    </div>
                </div>

                <!-- Meta Info Row -->
                <div class="card-body bg-light border-bottom py-3">
                    <div class="row text-center">
                        <div class="col-md-3">
                            <small class="text-muted d-block">User</small>
                            <strong>{{ $userProfile->user->name ?? 'N/A' }}</strong>
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted d-block">Partner</small>
                            <strong>{{ $userProfile->partner_name ?? 'Not Set' }}</strong>
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted d-block">Wedding Date</small>
                            <strong>{{ $userProfile->wedding_date ? $userProfile->wedding_date->format('M d, Y') : 'Not Set' }}</strong>
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted d-block">Created</small>
                            <strong>{{ $userProfile->created_at->format('M d, Y') }}</strong>
                        </div>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('admin.user-profiles.update', $userProfile->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="card-body">
                        <!-- User Assignment Section -->
                        <h6 class="text-muted mb-3"><i class="fas fa-user me-2"></i>User Assignment</h6>
                        
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="user_id" class="form-label">User <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                                        <option value="">Select a User</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ (old('user_id', $userProfile->user_id) == $user->id) ? 'selected' : '' }}>
                                                {{ $user->name }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Wedding Information Section -->
                        <h6 class="text-muted mb-3"><i class="fas fa-heart me-2"></i>Wedding Information</h6>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="partner_name" class="form-label">Partner Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-friends"></i></span>
                                    <input type="text" name="partner_name" id="partner_name" 
                                           class="form-control @error('partner_name') is-invalid @enderror" 
                                           value="{{ old('partner_name', $userProfile->partner_name) }}"
                                           placeholder="Enter partner's name">
                                    @error('partner_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="wedding_date" class="form-label">Wedding Date</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="date" name="wedding_date" id="wedding_date" 
                                           class="form-control @error('wedding_date') is-invalid @enderror" 
                                           value="{{ old('wedding_date', $userProfile->wedding_date ? $userProfile->wedding_date->format('Y-m-d') : '') }}">
                                    @error('wedding_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Profile Picture Section -->
                        <h6 class="text-muted mb-3"><i class="fas fa-camera me-2"></i>Profile Picture</h6>
                        
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="profile_picture" class="form-label">Profile Picture</label>
                                <input type="file" name="profile_picture" id="profile_picture" 
                                       class="form-control @error('profile_picture') is-invalid @enderror"
                                       accept="image/*">
                                <div class="form-text">Accepted formats: JPG, PNG, GIF. Max size: 2MB. Leave empty to keep current picture.</div>
                                @error('profile_picture')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                
                                @if($userProfile->profile_picture)
                                    <div class="mt-3">
                                        <label class="form-label text-muted">Current Picture:</label>
                                        <div class="border rounded p-2 d-inline-block">
                                            <img src="{{ asset($userProfile->profile_picture) }}" alt="Current Profile Picture" 
                                                 style="max-width: 150px; max-height: 150px; object-fit: cover;" class="rounded">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Preferences Section -->
                        <h6 class="text-muted mb-3"><i class="fas fa-cog me-2"></i>Preferences</h6>
                        
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="preferences" class="form-label">Preferences (JSON format)</label>
                                <textarea name="preferences" id="preferences" rows="5"
                                          class="form-control @error('preferences') is-invalid @enderror"
                                          placeholder='{"theme": "classic", "notifications": true}'>{{ old('preferences', json_encode($userProfile->preferences, JSON_PRETTY_PRINT)) }}</textarea>
                                <div class="form-text">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Enter a valid JSON object with user preferences. Example: <code>{"theme": "classic", "color_scheme": "light"}</code>
                                </div>
                                @error('preferences')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.user-profiles.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Back
                        </a>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.user-profiles.show', $userProfile->id) }}" class="btn btn-outline-info">
                                <i class="fas fa-eye me-1"></i>View
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Update User Profile
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>