<form method="{{ $method ?? 'POST' }}" 
      action="{{ $action }}" 
      class="{{ $attributes->get('class') }}"
      {{ $attributes->except('class') }}>
    @csrf
    @if(isset($method) && in_array(strtoupper($method), ['PUT', 'PATCH', 'DELETE']))
        @method(strtoupper($method))
    @endif
    
    {{ $slot }}
</form>