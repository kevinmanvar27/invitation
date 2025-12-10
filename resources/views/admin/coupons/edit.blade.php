<x-admin-layout>
    <!-- Page Header -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.coupons.index') }}">Coupons</a></li>
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
                                <i class="fas fa-ticket-alt"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">{{ $coupon->code }}</h5>
                                <small class="text-muted">
                                    @if($coupon->discount_type === 'percentage')
                                        {{ $coupon->discount_value }}% off
                                    @else
                                        ${{ number_format($coupon->discount_value, 2) }} off
                                    @endif
                                </small>
                            </div>
                        </div>
                        <a href="{{ route('admin.coupons.show', $coupon) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye me-1"></i> View
                        </a>
                    </div>
                </div>

                <!-- Meta Info -->
                <div class="card-body border-bottom bg-light">
                    <div class="row text-center">
                        <div class="col-md-3">
                            <small class="text-muted d-block">Discount</small>
                            <span class="fw-medium">
                                @if($coupon->discount_type === 'percentage')
                                    {{ $coupon->discount_value }}%
                                @else
                                    ${{ number_format($coupon->discount_value, 2) }}
                                @endif
                            </span>
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted d-block">Usage</small>
                            <span class="fw-medium">{{ $coupon->times_used ?? 0 }} / {{ $coupon->usage_limit ?? '∞' }}</span>
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted d-block">Valid From</small>
                            <span class="fw-medium">{{ $coupon->valid_from->format('M d, Y') }}</span>
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted d-block">Valid Until</small>
                            <span class="fw-medium">{{ $coupon->valid_until ? $coupon->valid_until->format('M d, Y') : 'No expiry' }}</span>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.coupons.update', $coupon) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row g-3">
                            <!-- Coupon Code -->
                            <div class="col-md-6">
                                <label for="code" class="form-label">Coupon Code <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code', $coupon->code) }}" placeholder="e.g., SUMMER2024" required>
                                @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Discount Type -->
                            <div class="col-md-6">
                                <label for="discount_type" class="form-label">Discount Type <span class="text-danger">*</span></label>
                                <select class="form-select @error('discount_type') is-invalid @enderror" id="discount_type" name="discount_type" required>
                                    <option value="">Select Discount Type</option>
                                    <option value="percentage" {{ old('discount_type', $coupon->discount_type) == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                                    <option value="fixed" {{ old('discount_type', $coupon->discount_type) == 'fixed' ? 'selected' : '' }}>Fixed Amount ($)</option>
                                </select>
                                @error('discount_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Discount Value -->
                            <div class="col-md-6">
                                <label for="discount_value" class="form-label">Discount Value <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="discount-prefix">{{ $coupon->discount_type === 'percentage' ? '%' : '$' }}</span>
                                    <input type="number" step="0.01" min="0" class="form-control @error('discount_value') is-invalid @enderror" id="discount_value" name="discount_value" value="{{ old('discount_value', $coupon->discount_value) }}" placeholder="0.00" required>
                                    @error('discount_value')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Minimum Purchase -->
                            <div class="col-md-6">
                                <label for="min_purchase" class="form-label">Minimum Purchase</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" min="0" class="form-control @error('min_purchase') is-invalid @enderror" id="min_purchase" name="min_purchase" value="{{ old('min_purchase', $coupon->min_purchase) }}" placeholder="0.00">
                                    @error('min_purchase')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="text-muted">Leave empty for no minimum</small>
                            </div>

                            <hr class="my-4">

                            <h6 class="text-muted mb-3"><i class="fas fa-calendar-alt me-2"></i>Validity Period</h6>

                            <!-- Valid From -->
                            <div class="col-md-6">
                                <label for="valid_from" class="form-label">Valid From <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control @error('valid_from') is-invalid @enderror" id="valid_from" name="valid_from" value="{{ old('valid_from', $coupon->valid_from->format('Y-m-d\TH:i')) }}" required>
                                @error('valid_from')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Valid Until -->
                            <div class="col-md-6">
                                <label for="valid_until" class="form-label">Valid Until</label>
                                <input type="datetime-local" class="form-control @error('valid_until') is-invalid @enderror" id="valid_until" name="valid_until" value="{{ old('valid_until', $coupon->valid_until ? $coupon->valid_until->format('Y-m-d\TH:i') : '') }}">
                                @error('valid_until')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Leave empty for no expiration</small>
                            </div>

                            <hr class="my-4">

                            <h6 class="text-muted mb-3"><i class="fas fa-chart-bar me-2"></i>Usage Limits</h6>

                            <!-- Usage Limit -->
                            <div class="col-md-6">
                                <label for="usage_limit" class="form-label">Usage Limit</label>
                                <input type="number" min="0" class="form-control @error('usage_limit') is-invalid @enderror" id="usage_limit" name="usage_limit" value="{{ old('usage_limit', $coupon->usage_limit) }}" placeholder="Unlimited">
                                @error('usage_limit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Leave empty for unlimited uses</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.coupons.show', $coupon) }}" class="btn btn-outline-primary">
                                <i class="fas fa-eye me-1"></i> View
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check me-1"></i> Update Coupon
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Update discount prefix based on type selection
        document.getElementById('discount_type').addEventListener('change', function() {
            const prefix = document.getElementById('discount-prefix');
            if (this.value === 'percentage') {
                prefix.textContent = '%';
            } else {
                prefix.textContent = '$';
            }
        });
    </script>
    @endpush
</x-admin-layout>