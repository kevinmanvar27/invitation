@props(['type' => 'primary', 'size' => 'md', 'href' => null])

@if($href)
    <a href="{{ $href }}" 
       class="btn btn-{{ $type }} btn-{{ $size }} {{ $attributes->get('class') }}"
       {{ $attributes->except('class') }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $attributes->get('type', 'button') }}" 
            class="btn btn-{{ $type }} btn-{{ $size }} {{ $attributes->get('class') }}"
            {{ $attributes->except('class') }}>
        {{ $slot }}
    </button>
@endif