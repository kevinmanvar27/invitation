<div class="table-responsive">
    <table class="table table-hover data-table {{ $attributes->get('class') }}" {{ $attributes->except('class') }}>
        @if(isset($head))
            <thead class="table-light">
                <tr>
                    {{ $head }}
                </tr>
            </thead>
        @endif
        <tbody>
            {{ $slot }}
        </tbody>
        @if(isset($foot))
            <tfoot class="table-light">
                <tr>
                    {{ $foot }}
                </tr>
            </tfoot>
        @endif
    </table>
</div>