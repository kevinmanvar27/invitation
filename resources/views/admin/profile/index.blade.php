{{-- Admin Profile - Admin Panel --}}
{{-- Updated to Bootstrap 5 + custom admin theme --}}

<x-admin-layout>
    <x-slot name="header">
        <div class="page-header">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>
        </div>
    </x-slot>

    <div class="row g-4">
        <!-- Profile Card -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body text-center">
                    <div class="avatar mb-3" style="width: 100px; height: 100px; font-size: 2.5rem; margin: 0 auto;">
                        @if($admin->avatar ?? false)
                            <img src="{{ asset($admin->avatar) }}" alt="{{ $admin->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <span class="avatar-initials" style="width: 100%; height: 100%; font-size: 2.5rem;">{{ substr($admin->name, 0, 1) }}</span>
                        @endif
                    </div>
                    <h4 class="mb-1">{{ $admin->name }}</h4>
                    <p class="text-muted mb-3">{{ $admin->email }}</p>
                    <span class="badge badge-primary">Administrator</span>
                </div>
            </div>
        </div>

        <!-- Profile Details -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-user me-2"></i>Profile Information
                    </h5>
                    <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit me-2"></i>Edit Profile
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label text-muted">Full Name</label>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0 fw-medium">{{ $admin->name }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label text-muted">Email Address</label>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0 fw-medium">{{ $admin->email }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label text-muted">Account Created</label>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0">
                                <i class="fas fa-calendar-alt me-2 text-muted"></i>
                                {{ $admin->created_at->format('F d, Y') }}
                                <span class="text-muted ms-2">({{ $admin->created_at->diffForHumans() }})</span>
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label text-muted">Last Updated</label>
                        </div>
                        <div class="col-md-8">
                            <p class="mb-0">
                                <i class="fas fa-clock me-2 text-muted"></i>
                                {{ $admin->updated_at->format('F d, Y \a\t h:i A') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Security Card -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-shield-alt me-2"></i>Security
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">Password</h6>
                            <p class="text-muted small mb-0">Last changed: {{ $admin->password_changed_at ?? 'Never' }}</p>
                        </div>
                        <a href="{{ route('admin.profile.password') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-key me-2"></i>Change Password
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>