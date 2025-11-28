@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-text-light">Welcome back, {{ Auth::user()->name }}!</h1>
            <p class="mt-2 text-text-secondary-light">Here's what's happening with your wedding invitations today.</p>
        </div>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="card">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-secondary-light rounded-lg p-3">
                            <svg class="w-6 h-6 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-text-secondary-light">Total Designs</p>
                            <p class="text-2xl font-semibold text-text-light">{{ $recentDesigns->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-secondary-light rounded-lg p-3">
                            <svg class="w-6 h-6 text-success-light" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-text-secondary-light">Completed</p>
                            <p class="text-2xl font-semibold text-text-light">{{ $recentDesigns->where('is_completed', true)->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-secondary-light rounded-lg p-3">
                            <svg class="w-6 h-6 text-warning-light" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-text-secondary-light">Drafts</p>
                            <p class="text-2xl font-semibold text-text-light">{{ $recentDesigns->where('is_completed', false)->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-secondary-light rounded-lg p-3">
                            <svg class="w-6 h-6 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-text-secondary-light">Favorites</p>
                            <p class="text-2xl font-semibold text-text-light">0</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Templates -->
            <div class="card">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-text-light">Recent Templates</h2>
                        <a href="{{ route('templates.index') }}" class="text-primary-light hover:text-opacity-80 text-sm font-medium">
                            View All
                        </a>
                    </div>
                    
                    <div class="space-y-4">
                        @foreach ($recentTemplates as $template)
                            <div class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-150 ease-in-out">
                                <div class="flex-shrink-0 w-12 h-12 bg-secondary-light rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                                    </svg>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h3 class="font-medium text-text-light">{{ $template->name }}</h3>
                                    <p class="text-sm text-text-secondary-light">{{ $template->theme }} - {{ $template->style }}</p>
                                </div>
                                <div>
                                    @if ($template->is_premium)
                                        <span class="bg-warning-light text-text-dark text-xs font-medium px-2 py-0.5 rounded">Premium</span>
                                    @else
                                        <span class="bg-success-light text-text-dark text-xs font-medium px-2 py-0.5 rounded">Free</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Recent Designs -->
            <div class="card">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-text-light">Your Recent Designs</h2>
                        <a href="#" class="text-primary-light hover:text-opacity-80 text-sm font-medium">
                            View All
                        </a>
                    </div>
                    
                    @if ($recentDesigns->count() > 0)
                        <div class="space-y-4">
                            @foreach ($recentDesigns as $design)
                                <div class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-150 ease-in-out">
                                    <div class="flex-shrink-0 w-12 h-12 bg-secondary-light rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-primary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <h3 class="font-medium text-text-light">{{ $design->design_name }}</h3>
                                        <p class="text-sm text-text-secondary-light">Last updated: {{ $design->updated_at->diffForHumans() }}</p>
                                    </div>
                                    <div>
                                        @if ($design->is_completed)
                                            <span class="bg-success-light text-text-dark text-xs font-medium px-2 py-0.5 rounded">Completed</span>
                                        @else
                                            <span class="bg-warning-light text-text-dark text-xs font-medium px-2 py-0.5 rounded">Draft</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-text-secondary-light" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-text-light">No designs yet</h3>
                            <p class="mt-1 text-sm text-text-secondary-light">Get started by creating your first wedding invitation design.</p>
                            <div class="mt-6">
                                <a href="{{ route('templates.index') }}" class="btn btn-primary btn-md">
                                    Create Your First Design
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection