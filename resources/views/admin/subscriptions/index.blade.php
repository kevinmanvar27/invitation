<x-admin-layout>
    <x-slot name="header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Manage Subscriptions</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Subscriptions</li>
                </ol>
            </div>
        </div>
        <p class="text-muted">View and manage all user subscriptions</p>
    </x-slot>

    <div class="container-fluid">
        <!-- Unified Toolbar -->
        <div class="toolbar">
            <div class="d-flex flex-column flex-sm-row gap-2 flex-grow-1">
                <input type="text" id="searchInput" class="toolbar-search" placeholder="Search subscriptions...">
                
                <div class="toolbar-filters">
                    <select id="planFilter" class="toolbar-select">
                        <option value="">All Plans</option>
                        <option value="basic">Basic</option>
                        <option value="premium">Premium</option>
                        <option value="enterprise">Enterprise</option>
                    </select>
                    
                    <select id="statusFilter" class="toolbar-select">
                        <option value="">All Statuses</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                    
                    <button type="button" class="btn btn-secondary" id="filterButton">
                        <i class="fas fa-filter"></i>
                        Filter
                    </button>
                    
                    <a href="#" class="btn btn-ghost" id="clearFilters">
                        Clear
                    </a>
                </div>
            </div>
            
            <div class="d-flex gap-2 ms-auto">
                <a href="{{ route('admin.subscriptions.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Add Subscription
                </a>
            </div>
        </div>
        
        <!-- KPI Cards -->
        <div class="row mb-4">
            <div class="col-lg-3 col-6 mb-4">
                <div class="card card-stat">
                    <div class="inner">
                        <h3>₹{{ number_format($mrr ?? 0, 2) }}</h3>
                        <p>MRR</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-rupee-sign"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-6 mb-4">
                <div class="card card-stat">
                    <div class="inner">
                        <h3>{{ $activeSubscriptions ?? 0 }}</h3>
                        <p>Active Subscriptions</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-6 mb-4">
                <div class="card card-stat">
                    <div class="inner">
                        <h3>{{ $churnRate ?? 0 }}%</h3>
                        <p>Churn Rate</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-6 mb-4">
                <div class="card card-stat">
                    <div class="inner">
                        <h3>₹{{ number_format($avgRevenue ?? 0, 2) }}</h3>
                        <p>Avg. Revenue/User</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <!-- Data Table -->
                <div class="table-container">
                    <table id="subscriptionsTable" class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>Plan Name</th>
                                <th class="text-right">Price</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Auto-renewal</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subscriptions as $subscription)
                            <tr>
                                <td>{{ $subscription->id }}</td>
                                <td>{{ $subscription->user->name ?? 'N/A' }}</td>
                                <td>{{ $subscription->plan_name }}</td>
                                <td class="text-right">₹{{ number_format($subscription->price, 2) }}</td>
                                <td>{{ $subscription->start_date ? $subscription->start_date->format('M d, Y') : 'N/A' }}</td>
                                <td>{{ $subscription->end_date ? $subscription->end_date->format('M d, Y') : 'N/A' }}</td>
                                <td>
                                    @if($subscription->status === 'active')
                                        <span class="badge badge-success">Active</span>
                                    @elseif($subscription->status === 'cancelled')
                                        <span class="badge badge-danger">Cancelled</span>
                                    @else
                                        <span class="badge badge-warning">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @if($subscription->auto_renewal)
                                        <span class="badge badge-info">Yes</span>
                                    @else
                                        <span class="badge badge-secondary">No</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button data-subscription-id="{{ $subscription->id }}" class="extend-subscription-btn btn btn-secondary btn-sm">
                                            <i class="fas fa-redo"></i>
                                            Extend
                                        </button>
                                        <a href="{{ route('admin.subscriptions.edit', $subscription->id) }}" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-pencil-alt"></i>
                                            Edit
                                        </a>
                                        <button class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $subscription->id }}')">
                                            <i class="fas fa-trash"></i>
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination mt-4">
                    {{ $subscriptions->links() }}
                </div>

                <!-- Export Buttons -->
                <div class="mt-4 d-flex justify-content-end gap-2">
                    <button id="exportCsv" class="btn btn-ghost">
                        <i class="fas fa-file-csv"></i>
                        Export CSV
                    </button>
                    <button id="exportExcel" class="btn btn-ghost">
                        <i class="fas fa-file-excel"></i>
                        Export Excel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(subscriptionId) {
            if (confirm('Are you sure you want to delete this subscription? This action cannot be undone.')) {
                // Create a form dynamically and submit it
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ url("admin/subscriptions") }}/' + subscriptionId;
                
                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);
                
                const method = document.createElement('input');
                method.type = 'hidden';
                method.name = '_method';
                method.value = 'DELETE';
                form.appendChild(method);
                
                document.body.appendChild(form);
                form.submit();
            }
        }
        
        $(document).ready(function() {
            // Initialize DataTables
            $("#subscriptionsTable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            });
            
            // Search functionality
            $('#searchInput').on('keyup', function() {
                const value = $(this).val().toLowerCase();
                $('tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            
            // Filter functionality
            $('#planFilter, #statusFilter').on('change', function() {
                // In a real application, this would filter the table
                alert('Filtering functionality would be implemented here');
            });
            
            // Extend subscription functionality
            $('.extend-subscription-btn').on('click', function() {
                const subscriptionId = $(this).data('subscription-id');
                alert(`Extending subscription with ID: ${subscriptionId}`);
                // In a real application, this would open a modal or form to extend the subscription
            });
        });
    </script>
</x-admin-layout>