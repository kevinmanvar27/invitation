<x-admin-layout>
    <!-- Page Header -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.print-orders.index') }}">Print Orders</a></li>
                    <li class="breadcrumb-item active">#{{ $printOrder->id }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <!-- Left Column - Order Profile -->
        <div class="col-lg-4 mb-4">
            <!-- Order Card -->
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                        <i class="fas fa-print fs-2"></i>
                    </div>
                    <h5 class="mb-1">Order #{{ $printOrder->id }}</h5>
                    <p class="text-muted mb-3">{{ $printOrder->quantity }} × {{ $printOrder->size }}</p>
                    
                    @if($printOrder->status == 'delivered')
                        <span class="badge bg-success fs-6 px-3 py-2">Delivered</span>
                    @elseif($printOrder->status == 'shipped')
                        <span class="badge bg-info fs-6 px-3 py-2">Shipped</span>
                    @elseif($printOrder->status == 'processing')
                        <span class="badge bg-primary fs-6 px-3 py-2">Processing</span>
                    @else
                        <span class="badge bg-warning fs-6 px-3 py-2">Pending</span>
                    @endif

                    <div class="d-flex gap-2 justify-content-center mt-4">
                        <a href="{{ route('admin.print-orders.edit', $printOrder) }}" class="btn btn-primary">
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
                            <small class="text-muted d-block">Ordered</small>
                            <span class="fw-medium">{{ $printOrder->ordered_at ? $printOrder->ordered_at->format('M d, Y') : 'N/A' }}</span>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Updated</small>
                            <span class="fw-medium">{{ $printOrder->updated_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer Card -->
            @if($printOrder->user)
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-user me-2"></i>Customer</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            {{ strtoupper(substr($printOrder->user->name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <h6 class="mb-0">{{ $printOrder->user->name }}</h6>
                            <small class="text-muted">{{ $printOrder->user->email }}</small>
                        </div>
                    </div>
                    <a href="{{ route('admin.users.show', $printOrder->user) }}" class="btn btn-sm btn-outline-primary w-100 mt-3">
                        <i class="fas fa-external-link-alt me-1"></i> View Customer
                    </a>
                </div>
            </div>
            @endif

            <!-- Quick Actions -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h6>
                </div>
                <div class="list-group list-group-flush">
                    @if($printOrder->status == 'pending')
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-play-circle text-primary me-3"></i>
                            <span>Start Processing</span>
                        </a>
                    @endif
                    @if($printOrder->status == 'processing')
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-shipping-fast text-info me-3"></i>
                            <span>Mark as Shipped</span>
                        </a>
                    @endif
                    @if($printOrder->status == 'shipped')
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-check-circle text-success me-3"></i>
                            <span>Mark as Delivered</span>
                        </a>
                    @endif
                    @if($printOrder->tracking_number)
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-map-marker-alt text-warning me-3"></i>
                            <span>Track Package</span>
                        </a>
                    @endif
                    <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="fas fa-file-invoice text-primary me-3"></i>
                        <span>Generate Invoice</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="fas fa-envelope text-info me-3"></i>
                        <span>Send Notification</span>
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
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stat-value">${{ number_format($printOrder->total_price, 2) }}</div>
                        <div class="stat-label">Total Price</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card stat-card-primary h-100">
                        <div class="stat-icon">
                            <i class="fas fa-copy"></i>
                        </div>
                        <div class="stat-value">{{ $printOrder->quantity }}</div>
                        <div class="stat-label">Quantity</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card stat-card-info h-100">
                        <div class="stat-icon">
                            <i class="fas fa-tag"></i>
                        </div>
                        <div class="stat-value">${{ number_format($printOrder->unit_price, 2) }}</div>
                        <div class="stat-label">Unit Price</div>
                    </div>
                </div>
            </div>

            <!-- Order Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Order Information</h6>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Order ID</span>
                            <span class="detail-value">#{{ $printOrder->id }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Design</span>
                            <span class="detail-value">{{ $printOrder->design->name ?? 'N/A' }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Status</span>
                            <span class="detail-value">
                                @if($printOrder->status == 'delivered')
                                    <span class="badge bg-success">Delivered</span>
                                @elseif($printOrder->status == 'shipped')
                                    <span class="badge bg-info">Shipped</span>
                                @elseif($printOrder->status == 'processing')
                                    <span class="badge bg-primary">Processing</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Tracking Number</span>
                            <span class="detail-value">
                                @if($printOrder->tracking_number)
                                    <code class="bg-light px-2 py-1 rounded">{{ $printOrder->tracking_number }}</code>
                                @else
                                    <span class="text-muted">Not assigned</span>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Print Specifications -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-cog me-2"></i>Print Specifications</h6>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Size</span>
                            <span class="detail-value">{{ $printOrder->size }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Orientation</span>
                            <span class="detail-value">{{ ucfirst($printOrder->orientation) }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Paper Type</span>
                            <span class="detail-value">{{ ucfirst($printOrder->paper_type) }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Finish</span>
                            <span class="detail-value">{{ ucfirst($printOrder->finish) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pricing Details -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-receipt me-2"></i>Pricing Details</h6>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Unit Price</span>
                            <span class="detail-value">${{ number_format($printOrder->unit_price, 2) }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Quantity</span>
                            <span class="detail-value">{{ $printOrder->quantity }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Discount</span>
                            <span class="detail-value text-danger">-${{ number_format($printOrder->discount ?? 0, 2) }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Total Price</span>
                            <span class="detail-value fw-bold text-success">${{ number_format($printOrder->total_price, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delivery Address -->
            @if($printOrder->delivery_address)
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>Delivery Address</h6>
                </div>
                <div class="card-body">
                    <p class="mb-0">{{ $printOrder->delivery_address }}</p>
                </div>
            </div>
            @endif

            <!-- Timestamps -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-clock me-2"></i>Timestamps</h6>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <span class="detail-label">Ordered At</span>
                            <span class="detail-value">{{ $printOrder->ordered_at ? $printOrder->ordered_at->format('M d, Y \a\t H:i') : 'N/A' }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Created At</span>
                            <span class="detail-value">{{ $printOrder->created_at->format('M d, Y \a\t H:i') }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Updated At</span>
                            <span class="detail-value">{{ $printOrder->updated_at->format('M d, Y \a\t H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <a href="{{ route('admin.print-orders.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Print Orders
            </a>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle text-danger me-2"></i>Delete Print Order
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this print order?</p>
                    <div class="bg-light rounded p-3">
                        <strong>Order:</strong> #{{ $printOrder->id }}<br>
                        <strong>Customer:</strong> {{ $printOrder->user->name ?? 'Unknown' }}<br>
                        <strong>Total:</strong> ${{ number_format($printOrder->total_price, 2) }}
                    </div>
                    <p class="text-danger mt-3 mb-0"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.print-orders.destroy', $printOrder) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i> Delete Order
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
    </script>
    @endpush
</x-admin-layout>