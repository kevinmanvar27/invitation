@extends('layouts.home')

@section('content')
<!-- Hero Section -->
<div class="designs-hero">
    <div class="designs-hero-container">
        <h1 class="designs-hero-title">Browse Our Design Collection</h1>
        <p class="designs-hero-subtitle">
            Discover beautiful invitation designs for every occasion. Filter by category to find your perfect match.
        </p>
    </div>
</div>

<!-- Filters Section -->
<div class="designs-filters-section">
    <div class="designs-container">
        <form action="{{ route('designs.index') }}" method="GET" class="designs-filter-form">
            <div class="filter-group">
                <label for="category" class="filter-label">Category</label>
                <select name="category" id="category" class="filter-select" onchange="this.form.submit()">
                    <option value="all" {{ request('category') == 'all' || !request('category') ? 'selected' : '' }}>All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('-', ' ', $cat)) }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="filter-group search-group">
                <label for="search" class="filter-label">Search</label>
                <div class="search-input-wrapper">
                    <input type="text" name="search" id="search" class="filter-input" 
                           placeholder="Search designs..." value="{{ request('search') }}">
                    <button type="submit" class="search-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </button>
                </div>
            </div>
            
            @if(request('category') && request('category') !== 'all' || request('search'))
                <a href="{{ route('designs.index') }}" class="clear-filters-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                    Clear Filters
                </a>
            @endif
        </form>
        
        <div class="designs-count">
            <span>{{ $designs->total() }} design{{ $designs->total() != 1 ? 's' : '' }} found</span>
        </div>
    </div>
</div>

<!-- Designs Grid -->
<div class="designs-grid-section">
    <div class="designs-container">
        @if($designs->count() > 0)
            <div class="designs-grid">
                @foreach($designs as $design)
                    <div class="design-card">
                        <a href="{{ route('designs.show', $design) }}" class="design-card-link">
                            <div class="design-card-image">
                                @if($design->thumbnail_path)
                                    <img src="{{ asset('storage/' . $design->thumbnail_path) }}" alt="{{ $design->design_name }}">
                                @else
                                    @php
                                        $canvasData = $design->canvas_data;
                                        $bgColor = '#f8f4f0';
                                        $bgImage = null;
                                        
                                        if (is_array($canvasData)) {
                                            if (isset($canvasData['background'])) {
                                                if (isset($canvasData['background']['color'])) {
                                                    $bgColor = $canvasData['background']['color'];
                                                }
                                                if (isset($canvasData['background']['image'])) {
                                                    $bgImage = $canvasData['background']['image'];
                                                }
                                            }
                                            if (isset($canvasData['pages'][0]['background'])) {
                                                if (isset($canvasData['pages'][0]['background']['color'])) {
                                                    $bgColor = $canvasData['pages'][0]['background']['color'];
                                                }
                                                if (isset($canvasData['pages'][0]['background']['image'])) {
                                                    $bgImage = $canvasData['pages'][0]['background']['image'];
                                                }
                                            }
                                        }
                                    @endphp
                                    <div class="design-card-preview" style="background-color: {{ $bgColor }}; {{ $bgImage ? 'background-image: url(' . $bgImage . '); background-size: cover; background-position: center;' : '' }}">
                                        <div class="preview-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                                <polyline points="21 15 16 10 5 21"></polyline>
                                            </svg>
                                            <span>{{ $design->design_name }}</span>
                                        </div>
                                    </div>
                                @endif
                                
                                @if($design->category)
                                    <span class="design-card-category">{{ ucfirst(str_replace('-', ' ', $design->category)) }}</span>
                                @endif
                            </div>
                            
                            <div class="design-card-content">
                                <h3 class="design-card-title">{{ $design->design_name }}</h3>
                                <p class="design-card-meta">
                                    <span class="meta-author">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="12" cy="7" r="4"></circle>
                                        </svg>
                                        {{ $design->user->name ?? 'Admin' }}
                                    </span>
                                    <span class="meta-date">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                        {{ $design->created_at->format('M d, Y') }}
                                    </span>
                                </p>
                            </div>
                        </a>
                        
                        <div class="design-card-actions">
                            <a href="{{ route('designs.show', $design) }}" class="design-card-btn primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                View
                            </a>
                            @auth
                                <form action="{{ route('designs.use', $design) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="design-card-btn secondary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                        Use
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="design-card-btn secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                    Use
                                </a>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($designs->hasPages())
                <div class="designs-pagination">
                    {{ $designs->withQueryString()->links() }}
                </div>
            @endif
        @else
            <div class="designs-empty">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                </svg>
                <h3>No designs found</h3>
                <p>
                    @if(request('category') || request('search'))
                        Try adjusting your filters or search terms to find what you're looking for.
                    @else
                        No designs have been published yet. Check back soon!
                    @endif
                </p>
                @if(request('category') || request('search'))
                    <a href="{{ route('designs.index') }}" class="empty-btn">View All Designs</a>
                @endif
            </div>
        @endif
    </div>
</div>

<style>
/* Designs Page Styles */
.designs-hero {
    background: linear-gradient(135deg, #f8f4f0 0%, #fff5f5 100%);
    padding: 60px 20px;
    text-align: center;
}

.designs-hero-container {
    max-width: 800px;
    margin: 0 auto;
}

.designs-hero-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 16px;
    font-family: 'Playfair Display', serif;
}

.designs-hero-subtitle {
    font-size: 1.125rem;
    color: #666;
    line-height: 1.6;
}

.designs-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Filters Section */
.designs-filters-section {
    background: #fff;
    border-bottom: 1px solid #e5e5e5;
    padding: 24px 0;
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.designs-filter-form {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    align-items: flex-end;
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.filter-label {
    font-size: 12px;
    font-weight: 600;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.filter-select,
.filter-input {
    height: 44px;
    padding: 0 16px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    font-size: 14px;
    background: #fff;
    min-width: 180px;
    transition: all 0.2s ease;
}

.filter-select:focus,
.filter-input:focus {
    outline: none;
    border-color: #c9184a;
    box-shadow: 0 0 0 3px rgba(201, 24, 74, 0.1);
}

.search-group {
    flex: 1;
    min-width: 250px;
}

.search-input-wrapper {
    position: relative;
    display: flex;
}

.search-input-wrapper .filter-input {
    flex: 1;
    padding-right: 50px;
}

.search-btn {
    position: absolute;
    right: 4px;
    top: 4px;
    bottom: 4px;
    width: 36px;
    background: #c9184a;
    border: none;
    border-radius: 6px;
    color: #fff;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s ease;
}

.search-btn:hover {
    background: #a01038;
}

.clear-filters-btn {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 12px 16px;
    background: #f5f5f5;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    color: #666;
    text-decoration: none;
    transition: all 0.2s ease;
    height: 44px;
}

.clear-filters-btn:hover {
    background: #e5e5e5;
    color: #333;
}

.designs-count {
    margin-top: 16px;
    font-size: 14px;
    color: #888;
}

/* Designs Grid */
.designs-grid-section {
    padding: 40px 0 80px;
    background: #fafafa;
    min-height: 500px;
}

.designs-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 28px;
}

.design-card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}

.design-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 32px rgba(0, 0, 0, 0.12);
}

.design-card-link {
    text-decoration: none;
    color: inherit;
    display: block;
}

.design-card-image {
    position: relative;
    aspect-ratio: 4/3;
    background: #f5f5f5;
    overflow: hidden;
}

.design-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.design-card:hover .design-card-image img {
    transform: scale(1.05);
}

.design-card-preview {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.3s ease;
}

.design-card:hover .design-card-preview {
    transform: scale(1.02);
}

.preview-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    color: rgba(0,0,0,0.3);
    text-align: center;
    padding: 20px;
}

.preview-content span {
    font-size: 14px;
    font-weight: 500;
    max-width: 150px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.design-card-category {
    position: absolute;
    top: 12px;
    left: 12px;
    padding: 6px 14px;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    color: #c9184a;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.design-card-content {
    padding: 20px;
}

.design-card-title {
    font-size: 17px;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0 0 12px;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.design-card-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    font-size: 13px;
    color: #888;
    margin: 0;
}

.meta-author,
.meta-date {
    display: flex;
    align-items: center;
    gap: 6px;
}

.meta-author svg,
.meta-date svg {
    opacity: 0.6;
}

.design-card-actions {
    padding: 0 20px 20px;
    display: flex;
    gap: 10px;
}

.design-card-btn {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 16px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
    border: none;
    cursor: pointer;
    font-family: inherit;
}

.design-card-btn.primary {
    background: #c9184a;
    color: #fff;
}

.design-card-btn.primary:hover {
    background: #a01038;
}

.design-card-btn.secondary {
    background: #f5f5f5;
    color: #333;
}

.design-card-btn.secondary:hover {
    background: #e5e5e5;
}

/* Pagination */
.designs-pagination {
    margin-top: 48px;
    display: flex;
    justify-content: center;
}

.designs-pagination nav {
    display: flex;
    gap: 4px;
}

.designs-pagination .page-link {
    padding: 10px 16px;
    border-radius: 8px;
    font-size: 14px;
    color: #666;
    text-decoration: none;
    background: #fff;
    border: 1px solid #e0e0e0;
    transition: all 0.2s ease;
}

.designs-pagination .page-link:hover {
    background: #f5f5f5;
    border-color: #ccc;
}

.designs-pagination .page-item.active .page-link {
    background: #c9184a;
    border-color: #c9184a;
    color: #fff;
}

.designs-pagination .page-item.disabled .page-link {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Empty State */
.designs-empty {
    text-align: center;
    padding: 100px 20px;
    color: #888;
}

.designs-empty svg {
    margin-bottom: 24px;
    color: #ddd;
}

.designs-empty h3 {
    font-size: 22px;
    font-weight: 600;
    color: #333;
    margin: 0 0 12px;
}

.designs-empty p {
    font-size: 15px;
    margin: 0 0 28px;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
}

.empty-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 28px;
    background: #c9184a;
    color: #fff;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}

.empty-btn:hover {
    background: #a01038;
}

/* Responsive */
@media (max-width: 768px) {
    .designs-hero {
        padding: 40px 20px;
    }
    
    .designs-hero-title {
        font-size: 1.75rem;
    }
    
    .designs-hero-subtitle {
        font-size: 1rem;
    }
    
    .designs-filter-form {
        flex-direction: column;
    }
    
    .filter-group,
    .search-group {
        width: 100%;
        min-width: auto;
    }
    
    .filter-select,
    .filter-input {
        width: 100%;
    }
    
    .clear-filters-btn {
        width: 100%;
        justify-content: center;
    }
    
    .designs-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .design-card-actions {
        flex-direction: row;
    }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .designs-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>
@endsection
