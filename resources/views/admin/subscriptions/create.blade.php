<x-admin-layout>
    <x-slot name="title">Create Subscription</x-slot>

    <!-- Page Header -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.subscriptions.index') }}">Subscriptions</a></li>
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
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <h5 class="mb-0">Subscription Information</h5>
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.subscriptions.store') }}" id="createSubscriptionForm">
                    @csrf
                    <div class="card-body">
                        <div class="row g-3">
                            <!-- User -->
                            <div class="col-12">
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

                            <!-- Plan Type -->
                            <div class="col-md-6">
                                <label for="plan_type" class="form-label">Plan Type <span class="text-danger">*</span></label>
                                <select name="plan_type" id="plan_type" class="form-select @error('plan_type') is-invalid @enderror" required>
                                    <option value="">Select a Plan</option>
                                    <option value="basic" {{ old('plan_type') == 'basic' ? 'selected' : '' }}>Basic</option>
                                    <option value="premium" {{ old('plan_type') == 'premium' ? 'selected' : '' }}>Premium</option>
                                    <option value="enterprise" {{ old('plan_type') == 'enterprise' ? 'selected' : '' }}>Enterprise</option>
                                </select>
                                @error('plan_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    <option value="expired" {{ old('status') == 'expired' ? 'selected' : '' }}>Expired</option>
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
                                           value="{{ old('price') }}" 
                                           placeholder="0.00"
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
                                    <option value="USD" {{ old('currency', 'USD') == 'USD' ? 'selected' : '' }}>USD</option>
                                    <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>EUR</option>
                                    <option value="GBP" {{ old('currency') == 'GBP' ? 'selected' : '' }}>GBP</option>
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
                                       value="{{ old('started_at', date('Y-m-d')) }}" 
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
                                       value="{{ old('expires_at') }}" 
                                       required>
                                @error('expires_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.subscriptions.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-check me-1"></i> Create Subscription
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>