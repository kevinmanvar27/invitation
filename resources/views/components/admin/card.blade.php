<div class="admin-card card mb-4">
    @if(isset($title) || isset($header))
        <div class="card-header">
            @if(isset($title))
                <h5 class="card-title mb-0">{{ $title }}</h5>
            @endif
            {{ $header ?? '' }}
        </div>
    @endif
    <div class="card-body">
        {{ $slot }}
    </div>
    @if(isset($footer))
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endif
</div>