<x-admin-layout>
    <x-slot name="header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.payments.index') }}">Payments</a></li>
                <li class="breadcrumb-item active">{{ $payment->transaction_id ?? '#' . $payment->id }}</li>
            </ol>
        </nav>
    </x-slot>

    <div class="row g-4">
        <!-- Left Column - Payment Profile -->
        <div class="col-lg-4">
            <!-- Payment Card -->
            <div class="card">
                <div class="card-body text-center py-4">
                    <div class="avatar bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; border-radius: 50%;">
                        <i class="fas fa-credit-card fa-2x"></i>
                    </div>
                    <h4 class="mb-1">${{ number_format($payment->amount, 2) }}</h4>
                    <p class="text-muted mb-3">{{ strtoupper($payment->currency ?? 'USD') }}</p>
                    
                    @if($payment->status == 'completed')
                        <span class="badge bg-success px-3 py-2">Completed</span>
                    @elseif($payment->status == 'pending')
                        <span class="badge bg-warning px-3 py-2">Pending</span>
                    @elseif($payment->status == 'failed')
                        <span class="badge bg-danger px-3 py-2">Failed</span>
                    @elseif($payment->status == 'refunded')
                        <span class="badge bg-info px-3 py-2">Refunded</span>
                    @else
                        <span class="badge bg-secondary px-3 py-2">{{ ucfirst($payment->status) }}</span>
                    @endif

                    <div class="d-flex gap-2 justify-content-center mt-4">
                        <a href="{{ route('admin.payments.edit', $payment) }}" class="btn btn-primary">
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
                            <span class="fw-medium">{{ $payment->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Updated</small>
                            <span class="fw-medium">{{ $payment->updated_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Card -->
            @if($payment->user)
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-user me-2"></i>Customer</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; border-radius: 50%;">
                            {{ strtoupper(substr($payment->user->name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <h6 class="mb-0">{{ $payment->user->name }}</h6>
                            <small class="text-muted">{{ $payment->user->email }}</small>
                        </div>
                    </div>
                    <a href="{{ route('admin.users.show', $payment->user) }}" class="btn btn-sm btn-outline-primary w-100 mt-3">
                        <i class="fas fa-external-link-alt me-1"></i> View User Profile
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
                    @if($payment->status == 'pending')
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-check-circle text-success me-3"></i>
                            <span>Mark as Completed</span>
                        </a>
                    @endif
                    @if($payment->status == 'completed')
                        <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                            <i class="fas fa-undo text-warning me-3"></i>
                            <span>Process Refund</span>
                        </a>
                    @endif
                    <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="fas fa-file-invoice text-primary me-3"></i>
                        <span>Generate Invoice</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="fas fa-envelope text-info me-3"></i>
                        <span>Send Receipt</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Column - Details -->
        <div class="col-lg-8">
            <!-- Stats Row -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="stat-card h-100">
                        <div class="stat-card-content">
                            <div class="stat-card-value">${{ number_format($payment->amount, 2) }}</div>
                            <div class="stat-card-label">Amount</div>
                        </div>
                        <div class="stat-card-icon primary">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card h-100">
                        <div class="stat-card-content">
                            <div class="stat-card-value">{{ ucfirst($payment->gateway ?? 'N/A') }}</div>
                            <div class="stat-card-label">Gateway</div>
                        </div>
                        <div class="stat-card-icon secondary">
                            <i class="fas fa-{{ $payment->gateway == 'stripe' ? 'stripe-s' : ($payment->gateway == 'paypal' ? 'paypal' : 'university') }}"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card h-100">
                        <div class="stat-card-content">
                            <div class="stat-card-value">{{ ucwords(str_replace('_', ' ', $payment->payment_method ?? 'N/A')) }}</div>
                            <div class="stat-card-label">Method</div>
                        </div>
                        <div class="stat-card-icon info">
                            <i class="fas fa-credit-card"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Payment Information</h6>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <div class="detail-label">Payment ID</div>
                            <div class="detail-value">#{{ $payment->id }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Transaction ID</div>
                            <div class="detail-value">
                                <code class="bg-light px-2 py-1 rounded">{{ $payment->transaction_id ?? 'N/A' }}</code>
                            </div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Amount</div>
                            <div class="detail-value fw-bold text-success">${{ number_format($payment->amount, 2) }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Currency</div>
                            <div class="detail-value">{{ strtoupper($payment->currency ?? 'USD') }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Payment Method</div>
                            <div class="detail-value">{{ ucwords(str_replace('_', ' ', $payment->payment_method ?? 'N/A')) }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Gateway</div>
                            <div class="detail-value">{{ ucfirst($payment->gateway ?? 'N/A') }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Status</div>
                            <div class="detail-value">
                                @if($payment->status == 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @elseif($payment->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($payment->status == 'failed')
                                    <span class="badge bg-danger">Failed</span>
                                @elseif($payment->status == 'refunded')
                                    <span class="badge bg-info">Refunded</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($payment->status) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Subscription Information -->
            @if($payment->subscription)
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-sync-alt me-2"></i>Related Subscription</h6>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <div class="detail-label">Subscription ID</div>
                            <div class="detail-value">#{{ $payment->subscription->id }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Plan Type</div>
                            <div class="detail-value">{{ ucfirst($payment->subscription->plan_type) }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Status</div>
                            <div class="detail-value">
                                <span class="badge bg-{{ $payment->subscription->status == 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($payment->subscription->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('admin.subscriptions.show', $payment->subscription) }}" class="btn btn-sm btn-outline-primary mt-3">
                        <i class="fas fa-external-link-alt me-1"></i> View Subscription
                    </a>
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
                            <div class="detail-label">Created At</div>
                            <div class="detail-value">{{ $payment->created_at->format('M d, Y \a\t H:i') }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Updated At</div>
                            <div class="detail-value">{{ $payment->updated_at->format('M d, Y \a\t H:i') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <a href="{{ route('admin.payments.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Payments
            </a>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle text-danger me-2"></i>Delete Payment
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this payment record?</p>
                    <div class="bg-light rounded p-3">
                        <strong>Transaction:</strong> {{ $payment->transaction_id ?? '#' . $payment->id }}<br>
                        <strong>Amount:</strong> ${{ number_format($payment->amount, 2) }}<br>
                        <strong>User:</strong> {{ $payment->user->name ?? 'Unknown' }}
                    </div>
                    <p class="text-danger mt-3 mb-0"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.payments.destroy', $payment) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i> Delete Payment
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