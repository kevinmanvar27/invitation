<x-admin-layout>
    <x-slot name="title">Create RSVP Response</x-slot>

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.rsvp-responses.index') }}">RSVP Responses</a></li>
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
                        <div class="avatar bg-primary bg-opacity-10 text-primary me-3" style="width: 48px; height: 48px;">
                            <i class="fas fa-reply"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">New RSVP Response</h5>
                            <small class="text-muted">Record a guest's response to an invitation</small>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.rsvp-responses.store') }}">
                    @csrf
                    <div class="card-body">
                        <!-- Invitation Selection -->
                        <h6 class="text-muted mb-3"><i class="fas fa-envelope-open me-2"></i>Invitation</h6>
                        
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="shared_invitation_id" class="form-label">Shared Invitation <span class="text-danger">*</span></label>
                                <select name="shared_invitation_id" id="shared_invitation_id" class="form-select @error('shared_invitation_id') is-invalid @enderror" required>
                                    <option value="">Select a Shared Invitation</option>
                                    @foreach($sharedInvitations as $sharedInvitation)
                                        <option value="{{ $sharedInvitation->id }}" {{ old('shared_invitation_id') == $sharedInvitation->id ? 'selected' : '' }}>
                                            Invitation #{{ $sharedInvitation->id }} - {{ $sharedInvitation->user->name ?? 'N/A' }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('shared_invitation_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Guest Information -->
                        <h6 class="text-muted mb-3"><i class="fas fa-user me-2"></i>Guest Information</h6>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="guest_name" class="form-label">Guest Name <span class="text-danger">*</span></label>
                                <input type="text" name="guest_name" id="guest_name" class="form-control @error('guest_name') is-invalid @enderror" value="{{ old('guest_name') }}" required>
                                @error('guest_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="guest_email" class="form-label">Guest Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" name="guest_email" id="guest_email" class="form-control @error('guest_email') is-invalid @enderror" value="{{ old('guest_email') }}">
                                    @error('guest_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="guest_phone" class="form-label">Guest Phone</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="text" name="guest_phone" id="guest_phone" class="form-control @error('guest_phone') is-invalid @enderror" value="{{ old('guest_phone') }}">
                                    @error('guest_phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Response Details -->
                        <h6 class="text-muted mb-3"><i class="fas fa-check-circle me-2"></i>Response Details</h6>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="response" class="form-label">Response <span class="text-danger">*</span></label>
                                <select name="response" id="response" class="form-select @error('response') is-invalid @enderror" required>
                                    <option value="">Select Response</option>
                                    <option value="yes" {{ old('response') == 'yes' ? 'selected' : '' }}>Yes - Attending</option>
                                    <option value="no" {{ old('response') == 'no' ? 'selected' : '' }}>No - Not Attending</option>
                                    <option value="maybe" {{ old('response') == 'maybe' ? 'selected' : '' }}>Maybe - Undecided</option>
                                </select>
                                @error('response')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="plus_ones_count" class="form-label">Plus Ones Count</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user-plus"></i></span>
                                    <input type="number" name="plus_ones_count" id="plus_ones_count" class="form-control @error('plus_ones_count') is-invalid @enderror" value="{{ old('plus_ones_count', 0) }}" min="0">
                                    @error('plus_ones_count')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Preferences -->
                        <h6 class="text-muted mb-3"><i class="fas fa-utensils me-2"></i>Preferences</h6>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="meal_preference" class="form-label">Meal Preference</label>
                                <input type="text" name="meal_preference" id="meal_preference" class="form-control @error('meal_preference') is-invalid @enderror" value="{{ old('meal_preference') }}" placeholder="e.g., Vegetarian, Vegan, Gluten-free">
                                @error('meal_preference')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="special_requests" class="form-label">Special Requests</label>
                                <textarea name="special_requests" id="special_requests" class="form-control @error('special_requests') is-invalid @enderror" rows="3" placeholder="Any dietary restrictions, accessibility needs, or other requests...">{{ old('special_requests') }}</textarea>
                                @error('special_requests')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.rsvp-responses.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Create RSVP Response
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>