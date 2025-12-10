<x-admin-layout>
    <x-slot name="header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Subscriptions</li>
            </ol>
        </nav>
    </x-slot>

    <!-- KPI Stats Row -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card">
                <div class="stat-card-content">
                    <div class="stat-card-value">₹{{ number_format($mrr ?? 0, 2) }}</div>
                    <div class="stat-card-label">Monthly Recurring Revenue</div>
                </div>
                <div class="stat-card-icon primary">
                    <i class="fas fa-rupee-sign"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card">
                <div class="stat-card-content">
                    <div class="stat-card-value">{{ $activeSubscriptions ?? 0 }}</div>
                    <div class="stat-card-label">Active Subscriptions</div>
                </div>
                <div class="stat-card-icon secondary">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card">
                <div class="stat-card-content">
                    <div class="stat-card-value">{{ $churnRate ?? 0 }}%</div>
                    <div class="stat-card-label">Churn Rate</div>
                </div>
                <div class="stat-card-icon accent">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="stat-card">
                <div class="stat-card-content">
                    <div class="stat-card-value">₹{{ number_format($avgRevenue ?? 0, 2) }}</div>
                    <div class="stat-card-label">Avg. Revenue/User</div>
                </div>
                <div class="stat-card-icon info">
                    <i class="fas fa-chart-bar"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Toolbar -->
    <div class="toolbar mb-4">
        <form method="GET" action="{{ route('admin.subscriptions.index') }}" class="toolbar-search-form">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" 
                       class="form-control border-start-0" 
                       placeholder="Search subscriptions...">
            </div>
            
            <select name="plan" class="form-select">
                <option value="">All Plans</option>
                <option value="basic" {{ request('plan') === 'basic' ? 'selected' : '' }}>Basic</option>
                <option value="premium" {{ request('plan') === 'premium' ? 'selected' : '' }}>Premium</option>
                <option value="enterprise" {{ request('plan') === 'enterprise' ? 'selected' : '' }}>Enterprise</option>
            </select>
            
            <select name="status" class="form-select">
                <option value="">All Statuses</option>
                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            
            <button type="submit" class="btn btn-secondary">
                <i class="fas fa-filter me-1"></i> Filter
            </button>
            
            @if(request()->hasAny(['search', 'plan', 'status']))
                <a href="{{ route('admin.subscriptions.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times me-1"></i> Clear
                </a>
            @endif
        </form>
        
        <div class="toolbar-actions">
            <a href="{{ route('admin.subscriptions.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Add Subscription
            </a>
        </div>
    </div>
    
    <!-- Data Card -->
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover data-table mb-0">
                    <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>User</th>
                            <th>Plan</th>
                            <th width="100" class="text-end">Price</th>
                            <th width="110">Start Date</th>
                            <th width="110">End Date</th>
                            <th width="100">Status</th>
                            <th width="90" class="text-center">Renewal</th>
                            <th width="180" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subscriptions as $subscription)
                            <tr>
                                <td class="text-muted">#{{ $subscription->id }}</td>
                                <td>
                                    @if($subscription->user)
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($subscription->user->name) }}&color=ffffff&background=ff6b6b&size=28" 
                                                 class="rounded-circle me-2" 
                                                 width="28" 
                                                 height="28" 
                                                 alt="{{ $subscription->user->name }}">
                                            <span>{{ $subscription->user->name }}</span>
                                        </div>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-primary">{{ $subscription->plan_name }}</span>
                                </td>
                                <td class="text-end fw-medium">₹{{ number_format($subscription->price, 2) }}</td>
                                <td class="text-muted">
                                    {{ $subscription->start_date ? $subscription->start_date->format('M d, Y') : '—' }}
                                </td>
                                <td class="text-muted">
                                    {{ $subscription->end_date ? $subscription->end_date->format('M d, Y') : '—' }}
                                </td>
                                <td>
                                    @if($subscription->status === 'active')
                                        <span class="badge badge-success">
                                            <i class="fas fa-check-circle me-1"></i>Active
                                        </span>
                                    @elseif($subscription->status === 'cancelled')
                                        <span class="badge badge-danger">
                                            <i class="fas fa-times-circle me-1"></i>Cancelled
                                        </span>
                                    @else
                                        <span class="badge badge-warning">
                                            <i class="fas fa-pause-circle me-1"></i>Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($subscription->auto_renewal)
                                        <span class="badge badge-info">
                                            <i class="fas fa-sync me-1"></i>Yes
                                        </span>
                                    @else
                                        <span class="badge badge-secondary">No</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <button type="button" 
                                                class="btn btn-icon btn-outline-secondary" 
                                                data-bs-toggle="tooltip" 
                                                title="Extend"
                                                onclick="extendSubscription('{{ $subscription->id }}')">
                                            <i class="fas fa-redo"></i>
                                        </button>
                                        <a href="{{ route('admin.subscriptions.show', $subscription->id) }}" 
                                           class="btn btn-icon btn-outline-secondary" 
                                           data-bs-toggle="tooltip" 
                                           title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.subscriptions.edit', $subscription->id) }}" 
                                           class="btn btn-icon btn-outline-primary" 
                                           data-bs-toggle="tooltip" 
                                           title="Edit">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-icon btn-outline-danger" 
                                                data-bs-toggle="tooltip" 
                                                title="Delete"
                                                onclick="confirmDelete('{{ $subscription->id }}', '{{ $subscription->plan_name }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9">
                                    <div class="empty-state">
                                        <div class="empty-state-icon">
                                            <i class="fas fa-credit-card"></i>
                                        </div>
                                        <h5 class="empty-state-title">No subscriptions found</h5>
                                        <p class="empty-state-description">Get started by creating a new subscription.</p>
                                        <a href="{{ route('admin.subscriptions.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-1"></i> Add Subscription
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($subscriptions->hasPages())
            <div class="card-footer bg-transparent">
                {{ $subscriptions->links() }}
            </div>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="fas fa-exclamation-triangle text-danger me-2"></i>Confirm Delete
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the <strong id="deleteSubscriptionName"></strong> subscription?</p>
                    <p class="text-muted mb-0">This action cannot be undone.</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST" class="d-inline">
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

    <!-- Extend Subscription Modal -->
    <div class="modal fade" id="extendModal" tabindex="-1" aria-labelledby="extendModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="extendModalLabel">
                        <i class="fas fa-redo text-primary me-2"></i>Extend Subscription
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="extendForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="extendDays" class="form-label">Extension Period (Days)</label>
                            <input type="number" class="form-control" id="extendDays" name="days" value="30" min="1" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-redo me-1"></i> Extend
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function confirmDelete(subscriptionId, planName) {
            document.getElementById('deleteSubscriptionName').textContent = planName;
            document.getElementById('deleteForm').action = `{{ url('admin/subscriptions') }}/${subscriptionId}`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }
        
        function extendSubscription(subscriptionId) {
            document.getElementById('extendForm').action = `{{ url('admin/subscriptions') }}/${subscriptionId}/extend`;
            new bootstrap.Modal(document.getElementById('extendModal')).show();
        }
    </script>
    @endpush
</x-admin-layout>