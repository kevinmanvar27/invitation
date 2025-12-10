<x-admin-layout>
    <x-slot name="title">Create Customization</x-slot>
    <x-slot name="page_title">Create Customization</x-slot>

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.customizations.index') }}">Customizations</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="avatar me-3" style="width: 48px; height: 48px; background: linear-gradient(135deg, #ff6b6b, #ee5a5a);">
                            <i class="fas fa-sliders-h text-white"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Add New Customization</h5>
                            <small class="text-muted">Create a new user customization for a design</small>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.customizations.store') }}">
                    @csrf
                    <div class="card-body">
                        <!-- Association Section -->
                        <h6 class="text-muted mb-3"><i class="fas fa-link me-2"></i>Association</h6>
                        
                        <div class="row g-3">
                            <!-- Design -->
                            <div class="col-md-6">
                                <label for="design_id" class="form-label">Design <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-palette"></i></span>
                                    <select name="design_id" id="design_id" 
                                            class="form-select @error('design_id') is-invalid @enderror" required>
                                        <option value="">Select a Design</option>
                                        @foreach($designs as $design)
                                            <option value="{{ $design->id }}" {{ old('design_id') == $design->id ? 'selected' : '' }}>
                                                {{ $design->design_name }} (User: {{ $design->user->name ?? 'N/A' }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('design_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- User -->
                            <div class="col-md-6">
                                <label for="user_id" class="form-label">User <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <select name="user_id" id="user_id" 
                                            class="form-select @error('user_id') is-invalid @enderror" required>
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
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Couple Information Section -->
                        <h6 class="text-muted mb-3"><i class="fas fa-heart me-2"></i>Couple Information</h6>
                        
                        <div class="row g-3">
                            <!-- Bride Name -->
                            <div class="col-md-6">
                                <label for="bride_name" class="form-label">Bride Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-female"></i></span>
                                    <input type="text" name="bride_name" id="bride_name" 
                                           class="form-control @error('bride_name') is-invalid @enderror" 
                                           value="{{ old('bride_name') }}" 
                                           placeholder="Enter bride's name">
                                    @error('bride_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Groom Name -->
                            <div class="col-md-6">
                                <label for="groom_name" class="form-label">Groom Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-male"></i></span>
                                    <input type="text" name="groom_name" id="groom_name" 
                                           class="form-control @error('groom_name') is-invalid @enderror" 
                                           value="{{ old('groom_name') }}" 
                                           placeholder="Enter groom's name">
                                    @error('groom_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Wedding Details Section -->
                        <h6 class="text-muted mb-3"><i class="fas fa-calendar-alt me-2"></i>Wedding Details</h6>
                        
                        <div class="row g-3">
                            <!-- Wedding Date -->
                            <div class="col-md-6">
                                <label for="wedding_date" class="form-label">Wedding Date</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    <input type="date" name="wedding_date" id="wedding_date" 
                                           class="form-control @error('wedding_date') is-invalid @enderror" 
                                           value="{{ old('wedding_date') }}">
                                    @error('wedding_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Wedding Time -->
                            <div class="col-md-6">
                                <label for="wedding_time" class="form-label">Wedding Time</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    <input type="time" name="wedding_time" id="wedding_time" 
                                           class="form-control @error('wedding_time') is-invalid @enderror" 
                                           value="{{ old('wedding_time') }}">
                                    @error('wedding_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Venue -->
                            <div class="col-12">
                                <label for="venue" class="form-label">Venue</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                    <input type="text" name="venue" id="venue" 
                                           class="form-control @error('venue') is-invalid @enderror" 
                                           value="{{ old('venue') }}" 
                                           placeholder="Enter wedding venue">
                                    @error('venue')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Style Settings Section -->
                        <h6 class="text-muted mb-3"><i class="fas fa-paint-brush me-2"></i>Style Settings</h6>
                        
                        <div class="row g-3">
                            <!-- Language -->
                            <div class="col-md-6">
                                <label for="language" class="form-label">Language</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                    <select name="language" id="language" 
                                            class="form-select @error('language') is-invalid @enderror">
                                        <option value="en" {{ old('language') == 'en' ? 'selected' : '' }}>English</option>
                                        <option value="es" {{ old('language') == 'es' ? 'selected' : '' }}>Spanish</option>
                                        <option value="fr" {{ old('language') == 'fr' ? 'selected' : '' }}>French</option>
                                    </select>
                                    @error('language')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Wording Style -->
                            <div class="col-md-6">
                                <label for="wording_style" class="form-label">Wording Style</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-font"></i></span>
                                    <select name="wording_style" id="wording_style" 
                                            class="form-select @error('wording_style') is-invalid @enderror">
                                        <option value="formal" {{ old('wording_style') == 'formal' ? 'selected' : '' }}>Formal</option>
                                        <option value="casual" {{ old('wording_style') == 'casual' ? 'selected' : '' }}>Casual</option>
                                        <option value="traditional" {{ old('wording_style') == 'traditional' ? 'selected' : '' }}>Traditional</option>
                                    </select>
                                    @error('wording_style')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- RSVP Settings Section -->
                        <h6 class="text-muted mb-3"><i class="fas fa-envelope-open-text me-2"></i>RSVP Settings</h6>
                        
                        <div class="row g-3">
                            <!-- RSVP Enabled -->
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input type="checkbox" name="rsvp_enabled" id="rsvp_enabled" 
                                           class="form-check-input" value="1"
                                           {{ old('rsvp_enabled') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="rsvp_enabled">
                                        <i class="fas fa-check-circle text-success me-1"></i>Enable RSVP
                                    </label>
                                </div>
                                <small class="text-muted">Allow guests to respond to the invitation</small>
                                @error('rsvp_enabled')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- RSVP Deadline -->
                            <div class="col-md-6">
                                <label for="rsvp_deadline" class="form-label">RSVP Deadline</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-times"></i></span>
                                    <input type="date" name="rsvp_deadline" id="rsvp_deadline" 
                                           class="form-control @error('rsvp_deadline') is-invalid @enderror" 
                                           value="{{ old('rsvp_deadline') }}">
                                    @error('rsvp_deadline')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.customizations.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Create Customization
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>