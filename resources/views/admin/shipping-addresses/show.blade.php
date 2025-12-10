<x-admin-layout>
    <x-slot name="title">Shipping Address Details</x-slot>

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.shipping-addresses.index') }}">Shipping Addresses</a></li>
                    <li class="breadcrumb-item active">{{ $shippingAddress->full_name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <!-- Left Column - Profile Card -->
        <div class="col-lg-4 mb-4">
            <!-- Address Profile Card -->
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar bg-primary bg-opacity-10 text-primary mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem;">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h5 class="mb-1">{{ $shippingAddress->full_name }}</h5>
                    <p class="text-muted mb-2">{{ $shippingAddress->city }}, {{ $shippingAddress->country }}</p>
                    @if($shippingAddress->is_default)
                        <span class="badge bg-success mb-3">Default Address</span>
                    @else
                        <span class="badge bg-secondary mb-3">Secondary Address</span>
                    @endif
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="{{ route('admin.shipping-addresses.edit', $shippingAddress->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                        <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                            <i class="fas fa-trash me-1"></i> Delete
                        </button>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row text-center">
                        <div class="col-6">
                            <small class="text-muted d-block">Created</small>
                            <strong>{{ $shippingAddress->created_at->format('M d, Y') }}</strong>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Updated</small>
                            <strong>{{ $shippingAddress->updated_at->format('M d, Y') }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Card -->
            @if($shippingAddress->user)
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-user me-2"></i>User</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar bg-info bg-opacity-10 text-info me-3">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0">{{ $shippingAddress->user->name }}</h6>
                            <small class="text-muted">{{ $shippingAddress->user->email }}</small>
                        </div>
                        <a href="{{ route('admin.users.show', $shippingAddress->user->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <!-- Quick Actions -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h6>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @if(!$shippingAddress->is_default)
                        <a href="#" class="list-group-item list-group-item-action" onclick="event.preventDefault(); document.getElementById('set-default-form').submit();">
                            <i class="fas fa-star text-warning me-2"></i> Set as Default
                        </a>
                        <form id="set-default-form" action="{{ route('admin.shipping-addresses.update', $shippingAddress->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="user_id" value="{{ $shippingAddress->user_id }}">
                            <input type="hidden" name="full_name" value="{{ $shippingAddress->full_name }}">
                            <input type="hidden" name="phone" value="{{ $shippingAddress->phone }}">
                            <input type="hidden" name="address_line1" value="{{ $shippingAddress->address_line1 }}">
                            <input type="hidden" name="address_line2" value="{{ $shippingAddress->address_line2 }}">
                            <input type="hidden" name="city" value="{{ $shippingAddress->city }}">
                            <input type="hidden" name="state" value="{{ $shippingAddress->state }}">
                            <input type="hidden" name="postal_code" value="{{ $shippingAddress->postal_code }}">
                            <input type="hidden" name="country" value="{{ $shippingAddress->country }}">
                            <input type="hidden" name="is_default" value="1">
                        </form>
                        @endif
                        <a href="{{ route('admin.shipping-addresses.edit', $shippingAddress->id) }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-edit text-primary me-2"></i> Edit Address
                        </a>
                        @if($shippingAddress->user)
                        <a href="{{ route('admin.users.show', $shippingAddress->user->id) }}" class="list-group-item list-group-item-action">
                            <i class="fas fa-user text-info me-2"></i> View User Profile
                        </a>
                        @endif
                        <a href="#" class="list-group-item list-group-item-action" onclick="copyAddress()">
                            <i class="fas fa-copy text-secondary me-2"></i> Copy Address
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Details -->
        <div class="col-lg-8">
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="stat-card stat-card-primary">
                        <div class="stat-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="stat-value">{{ $shippingAddress->city }}</div>
                        <div class="stat-label">City</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card stat-card-success">
                        <div class="stat-icon">
                            <i class="fas fa-globe"></i>
                        </div>
                        <div class="stat-value">{{ $shippingAddress->country }}</div>
                        <div class="stat-label">Country</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card stat-card-info">
                        <div class="stat-icon">
                            <i class="fas fa-mail-bulk"></i>
                        </div>
                        <div class="stat-value">{{ $shippingAddress->postal_code }}</div>
                        <div class="stat-label">Postal Code</div>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-address-card me-2"></i>Contact Information</h6>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Full Name</span>
                            <span class="detail-value">{{ $shippingAddress->full_name }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Phone</span>
                            <span class="detail-value">
                                @if($shippingAddress->phone)
                                    <i class="fas fa-phone text-muted me-1"></i>{{ $shippingAddress->phone }}
                                @else
                                    <span class="text-muted">Not provided</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address Details -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-home me-2"></i>Address Details</h6>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Address Line 1</span>
                            <span class="detail-value">{{ $shippingAddress->address_line1 }}</span>
                        </div>
                        @if($shippingAddress->address_line2)
                        <div class="detail-item">
                            <span class="detail-label">Address Line 2</span>
                            <span class="detail-value">{{ $shippingAddress->address_line2 }}</span>
                        </div>
                        @endif
                        <div class="detail-item">
                            <span class="detail-label">City</span>
                            <span class="detail-value">{{ $shippingAddress->city }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">State/Province</span>
                            <span class="detail-value">{{ $shippingAddress->state }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Postal Code</span>
                            <span class="detail-value">{{ $shippingAddress->postal_code }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Country</span>
                            <span class="detail-value">{{ $shippingAddress->country }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Full Address Preview -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-envelope me-2"></i>Full Address Preview</h6>
                </div>
                <div class="card-body">
                    <div class="bg-light p-3 rounded" id="full-address">
                        <strong>{{ $shippingAddress->full_name }}</strong><br>
                        {{ $shippingAddress->address_line1 }}<br>
                        @if($shippingAddress->address_line2)
                            {{ $shippingAddress->address_line2 }}<br>
                        @endif
                        {{ $shippingAddress->city }}, {{ $shippingAddress->state }} {{ $shippingAddress->postal_code }}<br>
                        {{ $shippingAddress->country }}<br>
                        @if($shippingAddress->phone)
                            <i class="fas fa-phone text-muted me-1"></i>{{ $shippingAddress->phone }}
                        @endif
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
                            <span class="detail-value">{{ $shippingAddress->created_at->format('F d, Y \a\t h:i A') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Last Updated</span>
                            <span class="detail-value">{{ $shippingAddress->updated_at->format('F d, Y \a\t h:i A') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <a href="{{ route('admin.shipping-addresses.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Shipping Addresses
            </a>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this shipping address?</p>
                    <div class="bg-light p-3 rounded">
                        <strong>{{ $shippingAddress->full_name }}</strong><br>
                        <small class="text-muted">{{ $shippingAddress->city }}, {{ $shippingAddress->country }}</small>
                    </div>
                    <div class="alert alert-warning mt-3 mb-0">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        This action cannot be undone.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.shipping-addresses.destroy', $shippingAddress->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i> Delete
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

        function copyAddress() {
            var addressText = document.getElementById('full-address').innerText;
            navigator.clipboard.writeText(addressText).then(function() {
                alert('Address copied to clipboard!');
            }, function() {
                alert('Failed to copy address.');
            });
        }
    </script>
    @endpush
</x-admin-layout>