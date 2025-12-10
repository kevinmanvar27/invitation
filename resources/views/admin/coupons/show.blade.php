<x-admin-layout>
    <!-- Page Header -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.coupons.index') }}">Coupons</a></li>
                    <li class="breadcrumb-item active">{{ $coupon->code }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <!-- Left Column - Coupon Profile -->
        <div class="col-lg-4 mb-4">
            <!-- Coupon Card -->
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-ticket-alt fs-2"></i>
                    </div>
                    <h5 class="mb-1">{{ $coupon->code }}</h5>
                    <p class="text-muted mb-3">
                        @if($coupon->discount_type === 'percentage')
                            {{ $coupon->discount_value }}% off
                        @else
                            ${{ number_format($coupon->discount_value, 2) }} off
                        @endif
                    </p>
                    
                    @php
                        $now = now();
                        $isExpired = $coupon->valid_until && $coupon->valid_until < $now;
                        $isNotStarted = $coupon->valid_from > $now;
                        $isActive = !$isExpired && !$isNotStarted;
                    @endphp

                    @if($isExpired)
                        <span class="badge bg-danger fs-6 px-3 py-2">Expired</span>
                    @elseif($isNotStarted)
                        <span class="badge bg-warning fs-6 px-3 py-2">Scheduled</span>
                    @else
                        <span class="badge bg-success fs-6 px-3 py-2">Active</span>
                    @endif

                    <div class="d-flex gap-2 justify-content-center mt-4">
                        <a href="{{ route('admin.coupons.edit', $coupon) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                        <button type="button" class="btn btn-outline-danger" onclick="confirmDelete()">
                            <i class="fas fa-trash me-1"></i> Delete
                        </button>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <div class="row text-center">
                        <div class="col-6">
                            <small class="text-muted d-block">Created</small>
                            <span class="fw-medium">{{ $coupon->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Updated</small>
                            <span class="fw-medium">{{ $coupon->updated_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h6>
                </div>
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action d-flex align-items-center" onclick="copyCode()">
                        <i class="fas fa-copy text-primary me-3"></i>
                        <span>Copy Coupon Code</span>
                    </a>
                    @if($isActive)
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-pause-circle text-warning me-3"></i>
                            <span>Deactivate Coupon</span>
                        </a>
                    @else
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-play-circle text-success me-3"></i>
                            <span>Activate Coupon</span>
                        </a>
                    @endif
                    <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="fas fa-chart-line text-info me-3"></i>
                        <span>View Usage Stats</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="fas fa-clone text-secondary me-3"></i>
                        <span>Duplicate Coupon</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Column - Details -->
        <div class="col-lg-8">
            <!-- Stats Row -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="stat-card stat-card-success h-100">
                        <div class="stat-icon">
                            <i class="fas fa-percentage"></i>
                        </div>
                        <div class="stat-value">
                            @if($coupon->discount_type === 'percentage')
                                {{ $coupon->discount_value }}%
                            @else
                                ${{ number_format($coupon->discount_value, 2) }}
                            @endif
                        </div>
                        <div class="stat-label">Discount</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card stat-card-primary h-100">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-value">{{ $coupon->times_used ?? 0 }}</div>
                        <div class="stat-label">Times Used</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card stat-card-info h-100">
                        <div class="stat-icon">
                            <i class="fas fa-infinity"></i>
                        </div>
                        <div class="stat-value">{{ $coupon->usage_limit ?? '∞' }}</div>
                        <div class="stat-label">Usage Limit</div>
                    </div>
                </div>
            </div>

            <!-- Coupon Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Coupon Information</h6>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Coupon ID</span>
                            <span class="detail-value">#{{ $coupon->id }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Coupon Code</span>
                            <span class="detail-value">
                                <code class="bg-light px-2 py-1 rounded">{{ $coupon->code }}</code>
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Discount Type</span>
                            <span class="detail-value">{{ ucfirst($coupon->discount_type) }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Discount Value</span>
                            <span class="detail-value">
                                @if($coupon->discount_type === 'percentage')
                                    {{ $coupon->discount_value }}%
                                @else
                                    ${{ number_format($coupon->discount_value, 2) }}
                                @endif
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Minimum Purchase</span>
                            <span class="detail-value">
                                @if($coupon->min_purchase)
                                    ${{ number_format($coupon->min_purchase, 2) }}
                                @else
                                    <span class="text-muted">No minimum</span>
                                @endif
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Status</span>
                            <span class="detail-value">
                                @if($isExpired)
                                    <span class="badge bg-danger">Expired</span>
                                @elseif($isNotStarted)
                                    <span class="badge bg-warning">Scheduled</span>
                                @else
                                    <span class="badge bg-success">Active</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Validity Period -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Validity Period</h6>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Valid From</span>
                            <span class="detail-value">{{ $coupon->valid_from->format('M d, Y \a\t H:i') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Valid Until</span>
                            <span class="detail-value">
                                @if($coupon->valid_until)
                                    {{ $coupon->valid_until->format('M d, Y \a\t H:i') }}
                                @else
                                    <span class="text-muted">No expiration</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Usage Statistics -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Usage Statistics</h6>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Times Used</span>
                            <span class="detail-value">{{ $coupon->times_used ?? 0 }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Usage Limit</span>
                            <span class="detail-value">{{ $coupon->usage_limit ?? 'Unlimited' }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Remaining Uses</span>
                            <span class="detail-value">
                                @if($coupon->usage_limit)
                                    {{ max(0, $coupon->usage_limit - ($coupon->times_used ?? 0)) }}
                                @else
                                    <span class="text-muted">Unlimited</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Timestamps -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-clock me-2"></i>Timestamps</h6>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Created At</span>
                            <span class="detail-value">{{ $coupon->created_at->format('M d, Y \a\t H:i') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Updated At</span>
                            <span class="detail-value">{{ $coupon->updated_at->format('M d, Y \a\t H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <a href="{{ route('admin.coupons.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Coupons
            </a>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle text-danger me-2"></i>Delete Coupon
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this coupon?</p>
                    <div class="bg-light rounded p-3">
                        <strong>Code:</strong> {{ $coupon->code }}<br>
                        <strong>Discount:</strong> 
                        @if($coupon->discount_type === 'percentage')
                            {{ $coupon->discount_value }}%
                        @else
                            ${{ number_format($coupon->discount_value, 2) }}
                        @endif
                    </div>
                    <p class="text-danger mt-3 mb-0"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i> Delete Coupon
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function confirmDelete() {
            var modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }

        function copyCode() {
            navigator.clipboard.writeText('{{ $coupon->code }}').then(function() {
                alert('Coupon code copied to clipboard!');
            });
        }
    </script>
    @endpush
</x-admin-layout>