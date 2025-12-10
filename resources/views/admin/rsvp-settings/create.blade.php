<x-admin-layout>
    <!-- Page Header -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.rsvp-settings.index') }}">RSVP Settings</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar bg-primary text-white d-flex align-items-center justify-content-center">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">RSVP Setting Details</h5>
                            <small class="text-muted">Configure response collection settings</small>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.rsvp-settings.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="row g-3">
                            <!-- Design Selection -->
                            <h6 class="text-muted mb-3"><i class="fas fa-palette me-2"></i>Assignment</h6>

                            <div class="col-md-6">
                                <label for="design_id" class="form-label">Design <span class="text-danger">*</span></label>
                                <select class="form-select @error('design_id') is-invalid @enderror" id="design_id" name="design_id" required>
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
                                <small class="text-muted">Design to apply RSVP settings to</small>
                            </div>

                            <!-- User Selection -->
                            <div class="col-md-6">
                                <label for="user_id" class="form-label">User <span class="text-danger">*</span></label>
                                <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
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
                                <small class="text-muted">Owner of the RSVP settings</small>
                            </div>

                            <hr class="my-4">

                            <h6 class="text-muted mb-3"><i class="fas fa-sliders-h me-2"></i>RSVP Configuration</h6>

                            <!-- RSVP Enabled -->
                            <div class="col-md-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input @error('rsvp_enabled') is-invalid @enderror" type="checkbox" id="rsvp_enabled" name="rsvp_enabled" value="1" {{ old('rsvp_enabled') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="rsvp_enabled">RSVP Enabled</label>
                                </div>
                                @error('rsvp_enabled')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Allow guests to respond</small>
                            </div>

                            <!-- Collect Meal Preferences -->
                            <div class="col-md-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input @error('collect_meal_preferences') is-invalid @enderror" type="checkbox" id="collect_meal_preferences" name="collect_meal_preferences" value="1" {{ old('collect_meal_preferences') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="collect_meal_preferences">Collect Meal Preferences</label>
                                </div>
                                @error('collect_meal_preferences')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Ask for dietary info</small>
                            </div>

                            <!-- Max Guests Per Invite -->
                            <div class="col-md-4">
                                <label for="max_guests_per_invite" class="form-label">Max Guests Per Invite</label>
                                <input type="number" class="form-control @error('max_guests_per_invite') is-invalid @enderror" id="max_guests_per_invite" name="max_guests_per_invite" value="{{ old('max_guests_per_invite', 1) }}" min="1">
                                @error('max_guests_per_invite')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Deadline -->
                            <div class="col-md-6">
                                <label for="deadline" class="form-label">RSVP Deadline</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                    <input type="date" class="form-control @error('deadline') is-invalid @enderror" id="deadline" name="deadline" value="{{ old('deadline') }}">
                                </div>
                                @error('deadline')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Last date to accept responses</small>
                            </div>

                            <hr class="my-4">

                            <h6 class="text-muted mb-3"><i class="fas fa-question-circle me-2"></i>Custom Questions</h6>

                            <!-- Custom Questions -->
                            <div class="col-12">
                                <label for="custom_questions" class="form-label">Custom Questions (JSON format)</label>
                                <textarea class="form-control @error('custom_questions') is-invalid @enderror" id="custom_questions" name="custom_questions" rows="4" placeholder='["Dietary restrictions?", "Song requests?"]'>{{ old('custom_questions') }}</textarea>
                                @error('custom_questions')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Enter a JSON array of custom questions to ask guests, e.g., <code>["Dietary restrictions?", "Song requests?"]</code></small>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.rsvp-settings.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Create RSVP Setting
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>