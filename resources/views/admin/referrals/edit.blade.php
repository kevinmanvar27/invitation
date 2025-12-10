<x-admin-layout>
    <!-- Page Header -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.referrals.index') }}">Referrals</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <div class="avatar bg-primary text-white d-flex align-items-center justify-content-center">
                                <i class="fas fa-user-friends"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">Referral #{{ $referral->id }}</h5>
                                <small class="text-muted">
                                    @if($referral->status == 'completed')
                                        <span class="badge bg-success">Completed</span>
                                    @else
                                        <span class="badge bg-warning">Pending</span>
                                    @endif
                                </small>
                            </div>
                        </div>
                        <a href="{{ route('admin.referrals.show', $referral) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye me-1"></i> View
                        </a>
                    </div>
                </div>

                <!-- Meta Info -->
                <div class="card-body border-bottom bg-light">
                    <div class="row text-center">
                        <div class="col-md-3">
                            <small class="text-muted d-block">Referrer</small>
                            <span class="fw-medium">{{ $referral->referrer->name ?? 'N/A' }}</span>
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted d-block">Referred</small>
                            <span class="fw-medium">{{ $referral->referred->name ?? 'N/A' }}</span>
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted d-block">Reward</small>
                            <span class="fw-medium">${{ number_format($referral->reward_earned, 2) }}</span>
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted d-block">Created</small>
                            <span class="fw-medium">{{ $referral->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.referrals.update', $referral) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row g-3">
                            <!-- Referrer User -->
                            <div class="col-md-6">
                                <label for="referrer_user_id" class="form-label">Referrer User <span class="text-danger">*</span></label>
                                <select class="form-select @error('referrer_user_id') is-invalid @enderror" id="referrer_user_id" name="referrer_user_id" required>
                                    <option value="">Select Referrer</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('referrer_user_id', $referral->referrer_user_id) == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('referrer_user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">User who made the referral</small>
                            </div>

                            <!-- Referred User -->
                            <div class="col-md-6">
                                <label for="referred_user_id" class="form-label">Referred User <span class="text-danger">*</span></label>
                                <select class="form-select @error('referred_user_id') is-invalid @enderror" id="referred_user_id" name="referred_user_id" required>
                                    <option value="">Select Referred User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('referred_user_id', $referral->referred_user_id) == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('referred_user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">User who was referred</small>
                            </div>

                            <hr class="my-4">

                            <h6 class="text-muted mb-3"><i class="fas fa-gift me-2"></i>Reward Information</h6>

                            <!-- Reward Earned -->
                            <div class="col-md-6">
                                <label for="reward_earned" class="form-label">Reward Earned</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" min="0" class="form-control @error('reward_earned') is-invalid @enderror" id="reward_earned" name="reward_earned" value="{{ old('reward_earned', $referral->reward_earned) }}" placeholder="0.00">
                                    @error('reward_earned')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="pending" {{ old('status', $referral->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="completed" {{ old('status', $referral->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.referrals.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.referrals.show', $referral) }}" class="btn btn-outline-primary">
                                <i class="fas fa-eye me-1"></i> View
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check me-1"></i> Update Referral
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>