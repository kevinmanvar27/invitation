@extends('layouts.home')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&family=Great+Vibes&family=Playfair+Display:wght@400;500;600;700&family=Montserrat:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&family=Open+Sans:wght@300;400;500;600;700&family=Lato:wght@300;400;700&family=Poppins:wght@300;400;500;600;700&family=Raleway:wght@300;400;500;600;700&family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
@endpush

@section('content')
<div class="design-show-page">
    <!-- Back Navigation -->
    <div class="design-show-nav">
        <div class="design-show-container">
            <a href="{{ route('designs.index') }}" class="back-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Back to Designs
            </a>
        </div>
    </div>
    
    <!-- Design Content -->
    <div class="design-show-content">
        <div class="design-show-container">
            <div class="design-show-grid">
                <!-- Design Preview -->
                <div class="design-preview-section">
                    <div class="design-preview-card">
                        @if($design->thumbnail_path)
                            <img src="{{ asset('storage/' . $design->thumbnail_path) }}" alt="{{ $design->design_name }}" class="design-preview-image">
                        @elseif($design->canvas_data)
                            <!-- Design Preview Container -->
                            <div class="design-preview-container" data-design-id="{{ $design->id }}" data-canvas-data="{{ base64_encode(json_encode($design->canvas_data)) }}"></div>
                        @else
                            <div class="design-preview-placeholder">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                    <polyline points="21 15 16 10 5 21"></polyline>
                                </svg>
                                <p>Preview not available</p>
                            </div>
                        @endif
                    </div>
                    
                    @if($design->canvas_data && isset($design->canvas_data['pages']) && count($design->canvas_data['pages']) > 1)
                        <div class="design-pages-info">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                            </svg>
                            <span>{{ count($design->canvas_data['pages']) }} pages</span>
                        </div>
                    @endif
                </div>
                
                <!-- Design Info -->
                <div class="design-info-section">
                    @if($design->category)
                        <span class="design-category-badge">{{ ucfirst(str_replace('-', ' ', $design->category)) }}</span>
                    @endif
                    
                    <h1 class="design-title">{{ $design->design_name }}</h1>
                    
                    <div class="design-meta">
                        <div class="design-meta-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <span>By {{ $design->user->name ?? 'Unknown' }}</span>
                        </div>
                        
                        <div class="design-meta-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <span>{{ $design->created_at->format('M d, Y') }}</span>
                        </div>
                        
                        @if($design->canvas_data && isset($design->canvas_data['width']) && isset($design->canvas_data['height']))
                            <div class="design-meta-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                </svg>
                                <span>{{ $design->canvas_data['width'] }} × {{ $design->canvas_data['height'] }}px</span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="design-actions">
                        @auth
                            <form action="{{ route('designs.use', $design) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="design-action-btn primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                    Use This Template
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="design-action-btn primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                                    <polyline points="10 17 15 12 10 7"></polyline>
                                    <line x1="15" y1="12" x2="3" y2="12"></line>
                                </svg>
                                Login to Use Template
                            </a>
                        @endauth
                        
                        <button class="design-action-btn secondary" onclick="shareDesign()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="18" cy="5" r="3"></circle>
                                <circle cx="6" cy="12" r="3"></circle>
                                <circle cx="18" cy="19" r="3"></circle>
                                <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                                <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                            </svg>
                            Share
                        </button>
                    </div>
                    
                    <div class="design-features">
                        <h3>What's Included</h3>
                        <ul class="features-list">
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                Fully customizable design
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                Edit text, colors, and images
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                Download in high quality
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                                Share via link or social media
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/design-preview-renderer.js') }}"></script>
<script>
function shareDesign() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $design->design_name }}',
            text: 'Check out this beautiful design!',
            url: window.location.href
        }).catch(console.error);
    } else {
        // Fallback: copy to clipboard
        navigator.clipboard.writeText(window.location.href).then(() => {
            alert('Link copied to clipboard!');
        }).catch(() => {
            alert('Share URL: ' + window.location.href);
        });
    }
}

// Render design preview using DesignPreviewRenderer
@if($design->canvas_data && !$design->thumbnail_path)
document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.design-preview-container');
    if (!container) {
        console.error('❌ Preview container not found');
        return;
    }
    
    try {
        const canvasDataEncoded = container.getAttribute('data-canvas-data');
        if (!canvasDataEncoded) {
            console.warn('⚠️ No canvas data found');
            return;
        }
        
        const canvasData = JSON.parse(atob(canvasDataEncoded));
        console.log('🎨 Rendering design preview:', canvasData);
        
        // Get the preview card container dimensions
        const previewCard = container.closest('.design-preview-card');
        const maxWidth = previewCard ? previewCard.clientWidth : 700;
        const maxHeight = 900;
        
        // Initialize renderer with container-based dimensions
        const renderer = new DesignPreviewRenderer(container, canvasData, {
            maxWidth: maxWidth,
            maxHeight: maxHeight,
            interactive: false
        });
        
        renderer.render();
        console.log('✅ Design preview rendered successfully');
    } catch (error) {
        console.error('❌ Error rendering design preview:', error);
    }
});
@endif
</script>

<style>
/* Design Show Page Styles */
.design-show-page {
    min-height: 100vh;
    background: #fafafa;
}

.design-show-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Navigation */
.design-show-nav {
    background: #fff;
    border-bottom: 1px solid #e5e5e5;
    padding: 16px 0;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #666;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: color 0.2s ease;
}

.back-link:hover {
    color: #c9184a;
}

/* Content Grid */
.design-show-content {
    padding: 40px 0 80px;
}

.design-show-grid {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 48px;
    align-items: start;
}

/* Preview Section */
.design-preview-section {
    position: sticky;
    top: 40px;
}

.design-preview-card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.design-preview-image {
    width: 100%;
    height: auto;
    display: block;
}

.design-preview-container {
    width: 100%;
    min-height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f5f5f5;
}

.design-preview-placeholder {
    aspect-ratio: 4/3;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 16px;
    color: #ccc;
    background: #f5f5f5;
}

.design-preview-placeholder p {
    margin: 0;
    font-size: 14px;
}

.design-pages-info {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 16px;
    background: #fff;
    border-top: 1px solid #e5e5e5;
    font-size: 14px;
    color: #666;
}

/* Info Section */
.design-info-section {
    padding: 8px 0;
}

.design-category-badge {
    display: inline-block;
    padding: 6px 14px;
    background: linear-gradient(135deg, #fff5f7 0%, #ffe4e9 100%);
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    color: #c9184a;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 16px;
}

.design-title {
    font-size: 2rem;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 20px;
    line-height: 1.3;
    font-family: 'Playfair Display', serif;
}

.design-meta {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 32px;
    padding-bottom: 32px;
    border-bottom: 1px solid #e5e5e5;
}

.design-meta-item {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    color: #666;
}

.design-meta-item svg {
    color: #999;
}

/* Actions */
.design-actions {
    display: flex;
    gap: 12px;
    margin-bottom: 32px;
}

.design-action-btn {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding: 14px 24px;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
    font-family: inherit;
}

.design-action-btn.primary {
    background: linear-gradient(135deg, #c9184a 0%, #a01038 100%);
    color: #fff;
}

.design-action-btn.primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(201, 24, 74, 0.3);
}

.design-action-btn.secondary {
    background: #f5f5f5;
    color: #333;
}

.design-action-btn.secondary:hover {
    background: #e5e5e5;
}

/* Features */
.design-features {
    background: #fff;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

.design-features h3 {
    font-size: 16px;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0 0 16px;
}

.features-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.features-list li {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 14px;
    color: #555;
}

.features-list li svg {
    color: #22c55e;
    flex-shrink: 0;
}

/* Responsive */
@media (max-width: 900px) {
    .design-show-grid {
        grid-template-columns: 1fr;
        gap: 32px;
    }
    
    .design-preview-section {
        position: static;
    }
    
    .design-title {
        font-size: 1.5rem;
    }
    
    .design-actions {
        flex-direction: column;
    }
}
</style>
@endsection
