@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <!-- Welcome Section -->
    <div class="dashboard-welcome">
        <div class="welcome-content">
            <h1 class="welcome-title">Welcome back, <span class="highlight">{{ Auth::user()->name }}</span>!</h1>
            <p class="welcome-subtitle">Here's what's happening with your wedding invitations today.</p>
        </div>
    </div>
    
    <!-- Stats Cards -->
    <div class="stats-grid mt-8">
        <div class="stat-card">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
            </div>
            <div class="stat-number">{{ $recentDesigns->count() }}</div>
            <div class="stat-label">Total Designs</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
            </div>
            <div class="stat-number">{{ $recentDesigns->where('is_completed', true)->count() }}</div>
            <div class="stat-label">Completed</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
            <div class="stat-number">{{ $recentDesigns->where('is_completed', false)->count() }}</div>
            <div class="stat-label">Drafts</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                </svg>
            </div>
            <div class="stat-number">{{ $rsvpCount }}</div>
            <div class="stat-label">RSVP Responses</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                </svg>
            </div>
            <div class="stat-number">{{ $printOrderCount }}</div>
            <div class="stat-label">Print Orders</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
            </div>
            <div class="stat-number">0</div>
            <div class="stat-label">Favorites</div>
        </div>
    </div>
    
    <div class="dashboard-grid mt-10">
        <!-- Recent Templates -->
        <div class="card dashboard-card">
            <div class="card-header">
                <h2 class="card-title">Recent Templates</h2>
                <a href="{{ route('templates.index') }}" class="btn btn-outline btn-sm">View All</a>
            </div>
            
            <div class="card-body">
                <div class="template-list">
                    @forelse ($recentTemplates as $template)
                        <div class="template-item">
                            <div class="template-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                            </div>
                            <div class="template-info">
                                <h3 class="template-name">{{ $template->name }}</h3>
                                <p class="template-meta">{{ $template->theme }} - {{ $template->style }}</p>
                            </div>
                            <div class="template-status">
                                @if ($template->is_premium)
                                    <span class="badge badge-premium">Premium</span>
                                @else
                                    <span class="badge badge-free">Free</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <div class="empty-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                    <polyline points="14 2 14 8 20 8"></polyline>
                                    <line x1="16" y1="13" x2="8" y2="13"></line>
                                    <line x1="16" y1="17" x2="8" y2="17"></line>
                                    <polyline points="10 9 9 9 8 9"></polyline>
                                </svg>
                            </div>
                            <h3 class="empty-title">No templates available</h3>
                            <p class="empty-description">Check back later for new templates.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        
        <!-- Recent Designs -->
        <div class="card dashboard-card">
            <div class="card-header">
                <h2 class="card-title">Your Recent Designs</h2>
                <a href="#" class="btn btn-outline btn-sm">View All</a>
            </div>
            
            <div class="card-body">
                @if ($recentDesigns->count() > 0)
                    <div class="design-list">
                        @foreach ($recentDesigns as $design)
                            <div class="design-item">
                                <div class="design-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                        <polyline points="10 9 9 9 8 9"></polyline>
                                    </svg>
                                </div>
                                <div class="design-info">
                                    <h3 class="design-name">{{ $design->design_name }}</h3>
                                    <p class="design-meta">Last updated: {{ $design->updated_at->diffForHumans() }}</p>
                                </div>
                                <div class="design-status">
                                    @if ($design->is_completed)
                                        <span class="badge badge-completed">Completed</span>
                                    @else
                                        <span class="badge badge-draft">Draft</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                        </div>
                        <h3 class="empty-title">No designs yet</h3>
                        <p class="empty-description">Get started by creating your first wedding invitation design.</p>
                        <div class="empty-actions">
                            <a href="{{ route('templates.index') }}" class="btn btn-primary btn-md">
                                Create Your First Design
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- RSVP Management Section -->
    <div class="dashboard-grid mt-10">
        <div class="card dashboard-card">
            <div class="card-header">
                <h2 class="card-title">RSVP Management</h2>
                <a href="#" class="btn btn-outline btn-sm">Manage RSVPs</a>
            </div>
            
            <div class="card-body">
                <div class="rsvp-summary">
                    <div class="rsvp-stats">
                        <div class="rsvp-stat-item">
                            <div class="stat-value">{{ $rsvpCount }}</div>
                            <div class="stat-label">Total Responses</div>
                        </div>
                        <div class="rsvp-stat-item">
                            <div class="stat-value">{{ $rsvpCount > 0 ? round(($rsvpCount * 100) / 100) : 0 }}%</div>
                            <div class="stat-label">Response Rate</div>
                        </div>
                        <div class="rsvp-stat-item">
                            <div class="stat-value">0</div>
                            <div class="stat-label">Pending</div>
                        </div>
                    </div>
                    
                    <div class="rsvp-actions mt-6">
                        <a href="#" class="btn btn-primary btn-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                            </svg>
                            View Responses
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Print Orders Section -->
        <div class="card dashboard-card">
            <div class="card-header">
                <h2 class="card-title">Print Orders</h2>
                <a href="#" class="btn btn-outline btn-sm">View Orders</a>
            </div>
            
            <div class="card-body">
                <div class="print-summary">
                    <div class="print-stats">
                        <div class="print-stat-item">
                            <div class="stat-value">{{ $printOrderCount }}</div>
                            <div class="stat-label">Total Orders</div>
                        </div>
                        <div class="print-stat-item">
                            <div class="stat-value">${{ $printOrderCount * 25 }}</div>
                            <div class="stat-label">Spent</div>
                        </div>
                        <div class="print-stat-item">
                            <div class="stat-value">0</div>
                            <div class="stat-label">In Progress</div>
                        </div>
                    </div>
                    
                    <div class="print-actions mt-6">
                        <a href="#" class="btn btn-primary btn-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                                <rect x="6" y="14" width="12" height="8"></rect>
                            </svg>
                            Order Prints
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="quick-actions mt-12 pt-12">
        <h2 class="section-title">Quick Actions</h2>
        <div class="actions-grid mt-8">
            <a href="{{ route('templates.index') }}" class="action-card">
                <div class="action-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                        <polyline points="2 17 12 22 22 17"></polyline>
                        <polyline points="2 12 12 17 22 12"></polyline>
                    </svg>
                </div>
                <h3 class="action-title">Browse Templates</h3>
                <p class="action-description">Find the perfect template for your wedding</p>
            </a>
            
            <a href="#" class="action-card">
                <div class="action-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <h3 class="action-title">Manage Guests</h3>
                <p class="action-description">Track RSVPs and guest information</p>
            </a>
            
            <a href="#" class="action-card">
                <div class="action-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51v.17a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1h-.17a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2h1a2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2v1a2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                    </svg>
                </div>
                <h3 class="action-title">Customize Design</h3>
                <p class="action-description">Personalize your invitation with photos</p>
            </a>
            
            <a href="#" class="action-card">
                <div class="action-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </div>
                <h3 class="action-title">Send Invitations</h3>
                <p class="action-description">Share digital invitations with your guests</p>
            </a>
        </div>
    </div>
</div>
@endsection