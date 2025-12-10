<x-admin-layout>
    <!-- Page Header -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.shared-invitations.index') }}">Shared Invitations</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <div class="avatar bg-primary text-white d-flex align-items-center justify-content-center">
                                <i class="fas fa-share-alt"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">
                                    Shared Invitation #{{ $sharedInvitation->id }}
                                    <span class="badge bg-{{ $sharedInvitation->share_method == 'email' ? 'primary' : ($sharedInvitation->share_method == 'sms' ? 'success' : 'info') }} ms-2">
                                        {{ ucfirst($sharedInvitation->share_method) }}
                                    </span>
                                </h5>
                                <small class="text-muted">{{ $sharedInvitation->design->name ?? 'No Design' }}</small>
                            </div>
                        </div>
                        <a href="{{ route('admin.shared-invitations.show', $sharedInvitation->id) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-eye me-1"></i>View
                        </a>
                    </div>
                </div>

                <!-- Meta Information -->
                <div class="card-body border-bottom bg-light">
                    <div class="row text-center">
                        <div class="col-md-3">
                            <small class="text-muted d-block">Share Method</small>
                            <strong>
                                @if($sharedInvitation->share_method == 'email')
                                    <i class="fas fa-envelope text-primary me-1"></i>
                                @elseif($sharedInvitation->share_method == 'sms')
                                    <i class="fas fa-sms text-success me-1"></i>
                                @else
                                    <i class="fas fa-link text-info me-1"></i>
                                @endif
                                {{ ucfirst($sharedInvitation->share_method) }}
                            </strong>
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted d-block">View Count</small>
                            <strong>{{ number_format($sharedInvitation->view_count) }}</strong>
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted d-block">Sent At</small>
                            <strong>{{ $sharedInvitation->sent_at ? $sharedInvitation->sent_at->format('M d, Y') : 'Not Sent' }}</strong>
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted d-block">Viewed At</small>
                            <strong>{{ $sharedInvitation->viewed_at ? $sharedInvitation->viewed_at->format('M d, Y') : 'Not Viewed' }}</strong>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.shared-invitations.update', $sharedInvitation->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row g-3">
                            <!-- Assignment Section -->
                            <h6 class="text-muted mb-3"><i class="fas fa-link me-2"></i>Assignment</h6>

                            <!-- Design -->
                            <div class="col-md-6">
                                <label for="design_id" class="form-label">Design <span class="text-danger">*</span></label>
                                <select class="form-select @error('design_id') is-invalid @enderror" id="design_id" name="design_id" required>
                                    <option value="">Select a Design</option>
                                    @foreach($designs as $design)
                                        <option value="{{ $design->id }}" {{ old('design_id', $sharedInvitation->design_id) == $design->id ? 'selected' : '' }}>
                                            {{ $design->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('design_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Design to share</small>
                            </div>

                            <!-- User -->
                            <div class="col-md-6">
                                <label for="user_id" class="form-label">User <span class="text-danger">*</span></label>
                                <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                                    <option value="">Select a User</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id', $sharedInvitation->user_id) == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">User sharing the invitation</small>
                            </div>

                            <hr class="my-4">

                            <h6 class="text-muted mb-3"><i class="fas fa-paper-plane me-2"></i>Sharing Method</h6>

                            <!-- Share Method -->
                            <div class="col-md-6">
                                <label for="share_method" class="form-label">Share Method <span class="text-danger">*</span></label>
                                <select class="form-select @error('share_method') is-invalid @enderror" id="share_method" name="share_method" required>
                                    <option value="">Select Share Method</option>
                                    <option value="email" {{ old('share_method', $sharedInvitation->share_method) == 'email' ? 'selected' : '' }}>Email</option>
                                    <option value="sms" {{ old('share_method', $sharedInvitation->share_method) == 'sms' ? 'selected' : '' }}>SMS</option>
                                    <option value="link" {{ old('share_method', $sharedInvitation->share_method) == 'link' ? 'selected' : '' }}>Link</option>
                                </select>
                                @error('share_method')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Share Token -->
                            <div class="col-md-6">
                                <label for="share_token" class="form-label">Share Token</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    <input type="text" class="form-control @error('share_token') is-invalid @enderror" id="share_token" name="share_token" value="{{ old('share_token', $sharedInvitation->share_token) }}">
                                </div>
                                @error('share_token')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="my-4">

                            <h6 class="text-muted mb-3"><i class="fas fa-user-tag me-2"></i>Recipient Information</h6>

                            <!-- Recipient Email -->
                            <div class="col-md-6">
                                <label for="recipient_email" class="form-label">Recipient Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control @error('recipient_email') is-invalid @enderror" id="recipient_email" name="recipient_email" value="{{ old('recipient_email', $sharedInvitation->recipient_email) }}" placeholder="recipient@example.com">
                                </div>
                                @error('recipient_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Recipient Phone -->
                            <div class="col-md-6">
                                <label for="recipient_phone" class="form-label">Recipient Phone</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="text" class="form-control @error('recipient_phone') is-invalid @enderror" id="recipient_phone" name="recipient_phone" value="{{ old('recipient_phone', $sharedInvitation->recipient_phone) }}" placeholder="+1234567890">
                                </div>
                                @error('recipient_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="my-4">

                            <h6 class="text-muted mb-3"><i class="fas fa-chart-bar me-2"></i>Statistics & Timestamps</h6>

                            <!-- View Count -->
                            <div class="col-md-4">
                                <label for="view_count" class="form-label">View Count</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-eye"></i></span>
                                    <input type="number" class="form-control @error('view_count') is-invalid @enderror" id="view_count" name="view_count" value="{{ old('view_count', $sharedInvitation->view_count) }}" min="0">
                                </div>
                                @error('view_count')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sent At -->
                            <div class="col-md-4">
                                <label for="sent_at" class="form-label">Sent At</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-paper-plane"></i></span>
                                    <input type="datetime-local" class="form-control @error('sent_at') is-invalid @enderror" id="sent_at" name="sent_at" value="{{ old('sent_at', $sharedInvitation->sent_at ? $sharedInvitation->sent_at->format('Y-m-d\TH:i') : '') }}">
                                </div>
                                @error('sent_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Viewed At -->
                            <div class="col-md-4">
                                <label for="viewed_at" class="form-label">Viewed At</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-eye"></i></span>
                                    <input type="datetime-local" class="form-control @error('viewed_at') is-invalid @enderror" id="viewed_at" name="viewed_at" value="{{ old('viewed_at', $sharedInvitation->viewed_at ? $sharedInvitation->viewed_at->format('Y-m-d\TH:i') : '') }}">
                                </div>
                                @error('viewed_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.shared-invitations.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back
                        </a>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.shared-invitations.show', $sharedInvitation->id) }}" class="btn btn-outline-primary">
                                <i class="fas fa-eye me-2"></i>View
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Shared Invitation
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>