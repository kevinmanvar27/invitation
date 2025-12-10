<x-admin-layout>
    <!-- Page Header -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.print-orders.index') }}">Print Orders</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Create Form -->
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar bg-primary text-white d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="fas fa-print fs-5"></i>
                        </div>
                        <div>
                            <h5 class="mb-0">Order Details</h5>
                            <small class="text-muted">Enter the print order information below</small>
                        </div>
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.print-orders.store') }}">
                    @csrf
                    <div class="card-body">
                        <!-- Customer & Design Section -->
                        <h6 class="text-muted mb-3"><i class="fas fa-user me-2"></i>Customer & Design</h6>
                        <div class="row g-3 mb-4">
                            <!-- User -->
                            <div class="col-md-6">
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

                            <!-- Design -->
                            <div class="col-md-6">
                                <label for="design_id" class="form-label">Design <span class="text-danger">*</span></label>
                                <select name="design_id" id="design_id" class="form-select @error('design_id') is-invalid @enderror" required>
                                    <option value="">Select a Design</option>
                                    @foreach($designs as $design)
                                        <option value="{{ $design->id }}" {{ old('design_id') == $design->id ? 'selected' : '' }}>
                                            {{ $design->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('design_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Print Specifications Section -->
                        <h6 class="text-muted mb-3"><i class="fas fa-cog me-2"></i>Print Specifications</h6>
                        <div class="row g-3 mb-4">
                            <!-- Quantity -->
                            <div class="col-md-4">
                                <label for="quantity" class="form-label">Quantity <span class="text-danger">*</span></label>
                                <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity', 1) }}" min="1" required>
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Paper Type -->
                            <div class="col-md-4">
                                <label for="paper_type" class="form-label">Paper Type <span class="text-danger">*</span></label>
                                <select name="paper_type" id="paper_type" class="form-select @error('paper_type') is-invalid @enderror" required>
                                    <option value="">Select Paper Type</option>
                                    <option value="glossy" {{ old('paper_type') == 'glossy' ? 'selected' : '' }}>Glossy</option>
                                    <option value="matte" {{ old('paper_type') == 'matte' ? 'selected' : '' }}>Matte</option>
                                    <option value="premium" {{ old('paper_type') == 'premium' ? 'selected' : '' }}>Premium</option>
                                </select>
                                @error('paper_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Finish -->
                            <div class="col-md-4">
                                <label for="finish" class="form-label">Finish <span class="text-danger">*</span></label>
                                <select name="finish" id="finish" class="form-select @error('finish') is-invalid @enderror" required>
                                    <option value="">Select Finish</option>
                                    <option value="none" {{ old('finish') == 'none' ? 'selected' : '' }}>None</option>
                                    <option value="glossy" {{ old('finish') == 'glossy' ? 'selected' : '' }}>Glossy</option>
                                    <option value="matte" {{ old('finish') == 'matte' ? 'selected' : '' }}>Matte</option>
                                </select>
                                @error('finish')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Size -->
                            <div class="col-md-4">
                                <label for="size" class="form-label">Size <span class="text-danger">*</span></label>
                                <select name="size" id="size" class="form-select @error('size') is-invalid @enderror" required>
                                    <option value="">Select Size</option>
                                    <option value="4x6" {{ old('size') == '4x6' ? 'selected' : '' }}>4x6</option>
                                    <option value="5x7" {{ old('size') == '5x7' ? 'selected' : '' }}>5x7</option>
                                    <option value="8x10" {{ old('size') == '8x10' ? 'selected' : '' }}>8x10</option>
                                </select>
                                @error('size')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Orientation -->
                            <div class="col-md-4">
                                <label for="orientation" class="form-label">Orientation <span class="text-danger">*</span></label>
                                <select name="orientation" id="orientation" class="form-select @error('orientation') is-invalid @enderror" required>
                                    <option value="">Select Orientation</option>
                                    <option value="portrait" {{ old('orientation') == 'portrait' ? 'selected' : '' }}>Portrait</option>
                                    <option value="landscape" {{ old('orientation') == 'landscape' ? 'selected' : '' }}>Landscape</option>
                                </select>
                                @error('orientation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-md-4">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ old('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="shipped" {{ old('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="delivered" {{ old('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <hr class="my-4">

                        <!-- Pricing Section -->
                        <h6 class="text-muted mb-3"><i class="fas fa-dollar-sign me-2"></i>Pricing</h6>
                        <div class="row g-3 mb-4">
                            <!-- Unit Price -->
                            <div class="col-md-4">
                                <label for="unit_price" class="form-label">Unit Price <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" name="unit_price" id="unit_price" class="form-control @error('unit_price') is-invalid @enderror" value="{{ old('unit_price') }}" placeholder="0.00" required>
                                    @error('unit_price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Discount -->
                            <div class="col-md-4">
                                <label for="discount" class="form-label">Discount</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" name="discount" id="discount" class="form-control @error('discount') is-invalid @enderror" value="{{ old('discount', 0) }}" placeholder="0.00">
                                    @error('discount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tracking Number -->
                            <div class="col-md-4">
                                <label for="tracking_number" class="form-label">Tracking Number</label>
                                <input type="text" name="tracking_number" id="tracking_number" class="form-control @error('tracking_number') is-invalid @enderror" value="{{ old('tracking_number') }}" placeholder="Optional">
                                @error('tracking_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.print-orders.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i> Create Print Order
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>