<x-admin-layout>
    <x-slot name="title">Edit Subscription</x-slot>

    <!-- Page Header -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.subscriptions.index') }}">Subscriptions</a></li>
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
                                <i class="fas fa-credit-card"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">{{ ucfirst($subscription->plan_type) }} Plan</h5>
                                <small class="text-muted">Subscription #{{ $subscription->id }}</small>
                            </div>
                        </div>
                        <div>
                            @if($subscription->status === 'active')
                                <span class="badge bg-success">Active</span>
                            @elseif($subscription->status === 'inactive')
                                <span class="badge bg-warning text-dark">Inactive</span>
                            @else
                                <span class="badge bg-danger">Expired</span>
                            @endif
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.subscriptions.update', $subscription->id) }}" id="editSubscriptionForm">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <!-- Meta Info -->
                        <div class="bg-light rounded p-3 mb-4">
                            <div class="row text-center">
                                <div class="col-4">
                                    <small class="text-muted d-block">Price</small>
                                    <span class="fw-medium">${{ number_format($subscription->price, 2) }}</span>
                                </div>
                                <div class="col-4">
                                    <small class="text-muted d-block">Started</small>
                                    <span class="fw-medium">{{ $subscription->started_at ? $subscription->started_at->format('M d, Y') : 'N/A' }}</span>
                                </div>
                                <div class="col-4">
                                    <small class="text-muted d-block">Expires</small>
                                    <span class="fw-medium">{{ $subscription->expires_at ? $subscription->expires_at->format('M d, Y') : 'N/A' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <!-- User -->
                            <div class="col-12">
                                <label for="user_id" class="form-label">User <span class="text-danger">*</span></label>
                                <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                                    <option value="">Select a User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id', $subscription->user_id) == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Plan Type -->
                            <div class="col-md-6">
                                <label for="plan_type" class="form-label">Plan Type <span class="text-danger">*</span></label>
                                <select name="plan_type" id="plan_type" class="form-select @error('plan_type') is-invalid @enderror" required>
                                    <option value="">Select a Plan</option>
                                    <option value="basic" {{ old('plan_type', $subscription->plan_type) == 'basic' ? 'selected' : '' }}>Basic</option>
                                    <option value="premium" {{ old('plan_type', $subscription->plan_type) == 'premium' ? 'selected' : '' }}>Premium</option>
                                    <option value="enterprise" {{ old('plan_type', $subscription->plan_type) == 'enterprise' ? 'selected' : '' }}>Enterprise</option>
                                </select>
                                @error('plan_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="active" {{ old('status', $subscription->status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status', $subscription->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    <option value="expired" {{ old('status', $subscription->status) == 'expired' ? 'selected' : '' }}>Expired</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div class="col-md-6">
                                <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" 
                                           step="0.01" 
                                           name="price" 
                                           id="price" 
                                           class="form-control @error('price') is-invalid @enderror" 
                                           value="{{ old('price', $subscription->price) }}" 
                                           required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Currency -->
                            <div class="col-md-6">
                                <label for="currency" class="form-label">Currency <span class="text-danger">*</span></label>
                                <select name="currency" id="currency" class="form-select @error('currency') is-invalid @enderror" required>
                                    <option value="USD" {{ old('currency', $subscription->currency) == 'USD' ? 'selected' : '' }}>USD</option>
                                    <option value="EUR" {{ old('currency', $subscription->currency) == 'EUR' ? 'selected' : '' }}>EUR</option>
                                    <option value="GBP" {{ old('currency', $subscription->currency) == 'GBP' ? 'selected' : '' }}>GBP</option>
                                </select>
                                @error('currency')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Started At -->
                            <div class="col-md-6">
                                <label for="started_at" class="form-label">Start Date <span class="text-danger">*</span></label>
                                <input type="date" 
                                       name="started_at" 
                                       id="started_at" 
                                       class="form-control @error('started_at') is-invalid @enderror" 
                                       value="{{ old('started_at', $subscription->started_at ? $subscription->started_at->format('Y-m-d') : '') }}" 
                                       required>
                                @error('started_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Expires At -->
                            <div class="col-md-6">
                                <label for="expires_at" class="form-label">Expiry Date <span class="text-danger">*</span></label>
                                <input type="date" 
                                       name="expires_at" 
                                       id="expires_at" 
                                       class="form-control @error('expires_at') is-invalid @enderror" 
                                       value="{{ old('expires_at', $subscription->expires_at ? $subscription->expires_at->format('Y-m-d') : '') }}" 
                                       required>
                                @error('expires_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.subscriptions.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                        <div>
                            <a href="{{ route('admin.subscriptions.show', $subscription->id) }}" class="btn btn-outline-primary me-2">
                                <i class="fas fa-eye me-1"></i> View
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check me-1"></i> Update Subscription
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>