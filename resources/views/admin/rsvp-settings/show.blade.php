<x-admin-layout>
    <x-slot name="header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.rsvp-settings.index') }}">RSVP Settings</a></li>
                <li class="breadcrumb-item active">Details</li>
            </ol>
        </nav>
    </x-slot>

    <div class="row g-4">
        <!-- Left Column - Profile & Related -->
        <div class="col-lg-4">
            <!-- Profile Card -->
            <div class="card">
                <div class="card-body text-center py-4">
                    <div class="avatar bg-primary text-white d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px; border-radius: 50%;">
                        <i class="fas fa-cog fa-2x"></i>
                    </div>
                    <h4 class="mb-1">RSVP Setting #{{ $rsvpSetting->id }}</h4>
                    <p class="text-muted mb-3">{{ $rsvpSetting->design->name ?? 'No Design Assigned' }}</p>
                    
                    @if($rsvpSetting->rsvp_enabled)
                        <span class="badge bg-success px-3 py-2"><i class="fas fa-check-circle me-1"></i>RSVP Enabled</span>
                    @else
                        <span class="badge bg-secondary px-3 py-2"><i class="fas fa-times-circle me-1"></i>RSVP Disabled</span>
                    @endif

                    <div class="d-flex justify-content-center gap-2 mt-4">
                        <a href="{{ route('admin.rsvp-settings.edit', $rsvpSetting->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                        <button type="button" class="btn btn-outline-danger" onclick="confirmDelete()">
                            <i class="fas fa-trash me-1"></i>Delete
                        </button>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <div class="row text-center">
                        <div class="col-6">
                            <small class="text-muted d-block">Created</small>
                            <span class="fw-medium">{{ $rsvpSetting->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Updated</small>
                            <span class="fw-medium">{{ $rsvpSetting->updated_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Card -->
            @if($rsvpSetting->user)
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-user me-2"></i>Owner</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar bg-info text-white d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; border-radius: 50%;">
                            {{ strtoupper(substr($rsvpSetting->user->name ?? 'U', 0, 1)) }}
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0">{{ $rsvpSetting->user->name }}</h6>
                            <small class="text-muted">{{ $rsvpSetting->user->email }}</small>
                        </div>
                    </div>
                    <a href="{{ route('admin.users.show', $rsvpSetting->user->id) }}" class="btn btn-sm btn-outline-primary w-100 mt-3">
                        <i class="fas fa-external-link-alt me-1"></i> View User Profile
                    </a>
                </div>
            </div>
            @endif

            <!-- Design Card -->
            @if($rsvpSetting->design)
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-palette me-2"></i>Design</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar bg-primary text-white d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; border-radius: 50%;">
                            <i class="fas fa-palette"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0">{{ $rsvpSetting->design->name }}</h6>
                            <small class="text-muted">Design ID: {{ $rsvpSetting->design->id }}</small>
                        </div>
                    </div>
                    <a href="{{ route('admin.designs.show', $rsvpSetting->design->id) }}" class="btn btn-sm btn-outline-primary w-100 mt-3">
                        <i class="fas fa-external-link-alt me-1"></i> View Design
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
                    <a href="{{ route('admin.rsvp-settings.edit', $rsvpSetting->id) }}" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="fas fa-edit text-primary me-3"></i>
                        <span>Edit Settings</span>
                    </a>
                    @if($rsvpSetting->design)
                    <a href="{{ route('admin.designs.show', $rsvpSetting->design->id) }}" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="fas fa-palette text-info me-3"></i>
                        <span>View Design</span>
                    </a>
                    @endif
                    @if($rsvpSetting->user)
                    <a href="{{ route('admin.users.show', $rsvpSetting->user->id) }}" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="fas fa-user text-success me-3"></i>
                        <span>View User</span>
                    </a>
                    @endif
                    <a href="{{ route('admin.rsvp-responses.index') }}" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="fas fa-reply-all text-warning me-3"></i>
                        <span>View All Responses</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Column - Details -->
        <div class="col-lg-8">
            <!-- Stats Cards -->
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="stat-card h-100">
                        <div class="stat-card-content">
                            <div class="stat-card-value">{{ $rsvpSetting->rsvp_enabled ? 'ON' : 'OFF' }}</div>
                            <div class="stat-card-label">RSVP Status</div>
                        </div>
                        <div class="stat-card-icon primary">
                            <i class="fas fa-toggle-on"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card h-100">
                        <div class="stat-card-content">
                            <div class="stat-card-value">{{ $rsvpSetting->max_guests_per_invite ?? 'N/A' }}</div>
                            <div class="stat-card-label">Max Guests</div>
                        </div>
                        <div class="stat-card-icon secondary">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card h-100">
                        <div class="stat-card-content">
                            <div class="stat-card-value">{{ $rsvpSetting->deadline ? $rsvpSetting->deadline->format('M d') : 'None' }}</div>
                            <div class="stat-card-label">Deadline</div>
                        </div>
                        <div class="stat-card-icon info">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card h-100">
                        <div class="stat-card-content">
                            <div class="stat-card-value">{{ $rsvpSetting->collect_meal_preferences ? 'Yes' : 'No' }}</div>
                            <div class="stat-card-label">Meal Prefs</div>
                        </div>
                        <div class="stat-card-icon accent">
                            <i class="fas fa-utensils"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RSVP Configuration -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-sliders-h me-2"></i>RSVP Configuration</h6>
                </div>
                <div class="card-body">
                    <div class="detail-grid">
                        <div class="detail-item">
                            <div class="detail-label">RSVP Enabled</div>
                            <div class="detail-value">
                                @if($rsvpSetting->rsvp_enabled)
                                    <span class="badge bg-success"><i class="fas fa-check me-1"></i>Enabled</span>
                                @else
                                    <span class="badge bg-secondary"><i class="fas fa-times me-1"></i>Disabled</span>
                                @endif
                            </div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Max Guests Per Invite</div>
                            <div class="detail-value">{{ $rsvpSetting->max_guests_per_invite ?? 'Not Set' }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">RSVP Deadline</div>
                            <div class="detail-value">
                                @if($rsvpSetting->deadline)
                                    {{ $rsvpSetting->deadline->format('F d, Y') }}
                                    @if($rsvpSetting->deadline->isPast())
                                        <span class="badge bg-danger ms-2">Expired</span>
                                    @elseif($rsvpSetting->deadline->isToday())
                                        <span class="badge bg-warning ms-2">Today</span>
                                    @else
                                        <span class="badge bg-success ms-2">{{ $rsvpSetting->deadline->diffForHumans() }}</span>
                                    @endif
                                @else
                                    <span class="text-muted">No Deadline Set</span>
                                @endif
                            </div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Collect Meal Preferences</div>
                            <div class="detail-value">
                                @if($rsvpSetting->collect_meal_preferences)
                                    <span class="badge bg-success"><i class="fas fa-check me-1"></i>Yes</span>
                                @else
                                    <span class="badge bg-secondary"><i class="fas fa-times me-1"></i>No</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Custom Questions -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-question-circle me-2"></i>Custom Questions</h6>
                </div>
                <div class="card-body">
                    @if($rsvpSetting->custom_questions && count((array)$rsvpSetting->custom_questions) > 0)
                        @php
                            $questions = is_array($rsvpSetting->custom_questions) ? $rsvpSetting->custom_questions : json_decode($rsvpSetting->custom_questions, true);
                        @endphp
                        @if(is_array($questions) && count($questions) > 0)
                            <ul class="list-group list-group-flush">
                                @foreach($questions as $index => $question)
                                    <li class="list-group-item d-flex align-items-center">
                                        <span class="badge bg-primary me-3">{{ $index + 1 }}</span>
                                        {{ $question }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-muted mb-0"><i class="fas fa-info-circle me-2"></i>No custom questions configured</p>
                        @endif
                    @else
                        <p class="text-muted mb-0"><i class="fas fa-info-circle me-2"></i>No custom questions configured</p>
                    @endif
                </div>
            </div>

            <!-- Raw JSON (for debugging) -->
            @if($rsvpSetting->custom_questions)
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="mb-0"><i class="fas fa-code me-2"></i>Raw JSON Data</h6>
                </div>
                <div class="card-body">
                    <pre class="bg-light p-3 rounded mb-0"><code>{{ json_encode($rsvpSetting->custom_questions, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</code></pre>
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
                            <div class="detail-value">{{ $rsvpSetting->created_at->format('F d, Y \a\t h:i A') }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Last Updated</div>
                            <div class="detail-value">{{ $rsvpSetting->updated_at->format('F d, Y \a\t h:i A') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Button -->
            <a href="{{ route('admin.rsvp-settings.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to RSVP Settings
            </a>
        </div>
    </div>

    <!-- Delete Modal -->
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
                    <p>Are you sure you want to delete this RSVP setting?</p>
                    <div class="bg-light rounded p-3">
                        <strong>RSVP Setting #{{ $rsvpSetting->id }}</strong><br>
                        <strong>Design:</strong> {{ $rsvpSetting->design->name ?? 'N/A' }}<br>
                        <strong>User:</strong> {{ $rsvpSetting->user->name ?? 'N/A' }}
                    </div>
                    <p class="text-danger mt-3 mb-0"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.rsvp-settings.destroy', $rsvpSetting->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i>Delete
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