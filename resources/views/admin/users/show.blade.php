<x-admin-layout>
    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ __('User Details') }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
                    <li class="breadcrumb-item active">Details</li>
                </ol>
            </div>
        </div>
        <p class="text-muted">View user details and statistics</p>
    </x-slot>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">User Details</h3>
                <div>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary me-2">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Users
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="mb-3">Basic Information</h5>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="mb-3">
                                    <strong>ID:</strong>
                                    <span class="ms-2">{{ $user->id }}</span>
                                </div>
                                <div class="mb-3">
                                    <strong>Name:</strong>
                                    <span class="ms-2">{{ $user->name }}</span>
                                </div>
                                <div class="mb-3">
                                    <strong>Email:</strong>
                                    <span class="ms-2">{{ $user->email }}</span>
                                </div>
                                <div class="mb-3">
                                    <strong>Email Verified At:</strong>
                                    <span class="ms-2">{{ $user->email_verified_at ? $user->email_verified_at->format('M d, Y H:i') : 'Not verified' }}</span>
                                </div>
                                <div class="mb-3">
                                    <strong>Created At:</strong>
                                    <span class="ms-2">{{ $user->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                <div>
                                    <strong>Updated At:</strong>
                                    <span class="ms-2">{{ $user->updated_at->format('M d, Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5 class="mb-3">Profile Information</h5>
                        <div class="card mb-4">
                            <div class="card-body">
                                @if($user->profile)
                                    <div class="mb-3">
                                        <strong>Wedding Date:</strong>
                                        <span class="ms-2">{{ $user->profile->wedding_date ?? 'N/A' }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <strong>Partner Name:</strong>
                                        <span class="ms-2">{{ $user->profile->partner_name ?? 'N/A' }}</span>
                                    </div>
                                @else
                                    <p>No profile information available.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <h5 class="mb-3">Statistics</h5>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <div class="display-6 fw-bold">{{ $user->designs->count() }}</div>
                                    <div class="text-muted">Designs</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <div class="display-6 fw-bold">{{ $user->subscriptions->count() }}</div>
                                    <div class="text-muted">Subscriptions</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <div class="display-6 fw-bold">{{ $user->payments->count() }}</div>
                                    <div class="text-muted">Payments</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <div class="display-6 fw-bold">{{ $user->sharedInvitations->count() }}</div>
                                    <div class="text-muted">Shared Invitations</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>