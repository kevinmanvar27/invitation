<x-admin-layout>
    <!-- Page Header -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.payments.index') }}">Payments</a></li>
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
                        <div class="d-flex align-items-center gap-3">
                            <div class="avatar bg-primary text-white d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fas fa-credit-card fs-5"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">{{ $payment->transaction_id ?? 'Payment #' . $payment->id }}</h5>
                                <small class="text-muted">{{ $payment->user->name ?? 'Unknown User' }}</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
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
                            <a href="{{ route('admin.payments.show', $payment) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye me-1"></i> View
                            </a>
                        </div>
                    </div>
                </div>
                <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <!-- Meta Info -->
                        <div class="bg-light rounded p-3 mb-4">
                            <div class="row text-center">
                                <div class="col-4">
                                    <small class="text-muted d-block">Amount</small>
                                    <span class="fw-medium">${{ number_format($payment->amount, 2) }}</span>
                                </div>
                                <div class="col-4">
                                    <small class="text-muted d-block">Created</small>
                                    <span class="fw-medium">{{ $payment->created_at->format('M d, Y') }}</span>
                                </div>
                                <div class="col-4">
                                    <small class="text-muted d-block">Last Updated</small>
                                    <span class="fw-medium">{{ $payment->updated_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <!-- User -->
                            <div class="col-md-6">
                                <label for="user_id" class="form-label">User <span class="text-danger">*</span></label>
                                <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                                    <option value="">Select User</option>
                                    @if(isset($users))
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id', $payment->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Amount -->
                            <div class="col-md-6">
                                <label for="amount" class="form-label">Amount <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" name="amount" id="amount" step="0.01" min="0" value="{{ old('amount', $payment->amount) }}" class="form-control @error('amount') is-invalid @enderror" required>
                                    @error('amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Currency -->
                            <div class="col-md-6">
                                <label for="currency" class="form-label">Currency <span class="text-danger">*</span></label>
                                <select name="currency" id="currency" class="form-select @error('currency') is-invalid @enderror" required>
                                    <option value="USD" {{ old('currency', $payment->currency) == 'USD' ? 'selected' : '' }}>USD - US Dollar</option>
                                    <option value="EUR" {{ old('currency', $payment->currency) == 'EUR' ? 'selected' : '' }}>EUR - Euro</option>
                                    <option value="GBP" {{ old('currency', $payment->currency) == 'GBP' ? 'selected' : '' }}>GBP - British Pound</option>
                                    <option value="CAD" {{ old('currency', $payment->currency) == 'CAD' ? 'selected' : '' }}>CAD - Canadian Dollar</option>
                                    <option value="AUD" {{ old('currency', $payment->currency) == 'AUD' ? 'selected' : '' }}>AUD - Australian Dollar</option>
                                </select>
                                @error('currency')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Payment Method -->
                            <div class="col-md-6">
                                <label for="payment_method" class="form-label">Payment Method <span class="text-danger">*</span></label>
                                <select name="payment_method" id="payment_method" class="form-select @error('payment_method') is-invalid @enderror" required>
                                    <option value="">Select Payment Method</option>
                                    <option value="credit_card" {{ old('payment_method', $payment->payment_method) == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                    <option value="debit_card" {{ old('payment_method', $payment->payment_method) == 'debit_card' ? 'selected' : '' }}>Debit Card</option>
                                    <option value="paypal" {{ old('payment_method', $payment->payment_method) == 'paypal' ? 'selected' : '' }}>PayPal</option>
                                    <option value="bank_transfer" {{ old('payment_method', $payment->payment_method) == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                </select>
                                @error('payment_method')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Payment Gateway -->
                            <div class="col-md-6">
                                <label for="gateway" class="form-label">Payment Gateway <span class="text-danger">*</span></label>
                                <select name="gateway" id="gateway" class="form-select @error('gateway') is-invalid @enderror" required>
                                    <option value="">Select Gateway</option>
                                    <option value="stripe" {{ old('gateway', $payment->gateway) == 'stripe' ? 'selected' : '' }}>Stripe</option>
                                    <option value="paypal" {{ old('gateway', $payment->gateway) == 'paypal' ? 'selected' : '' }}>PayPal</option>
                                    <option value="bank" {{ old('gateway', $payment->gateway) == 'bank' ? 'selected' : '' }}>Bank Transfer</option>
                                </select>
                                @error('gateway')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Transaction ID -->
                            <div class="col-md-6">
                                <label for="transaction_id" class="form-label">Transaction ID <span class="text-danger">*</span></label>
                                <input type="text" name="transaction_id" id="transaction_id" value="{{ old('transaction_id', $payment->transaction_id) }}" class="form-control @error('transaction_id') is-invalid @enderror" required>
                                @error('transaction_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="">Select Status</option>
                                    <option value="pending" {{ old('status', $payment->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="completed" {{ old('status', $payment->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="failed" {{ old('status', $payment->status) == 'failed' ? 'selected' : '' }}>Failed</option>
                                    <option value="refunded" {{ old('status', $payment->status) == 'refunded' ? 'selected' : '' }}>Refunded</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Subscription (Optional) -->

                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.payments.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.payments.show', $payment) }}" class="btn btn-outline-primary">
                                <i class="fas fa-eye me-1"></i> View
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Update Payment
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>