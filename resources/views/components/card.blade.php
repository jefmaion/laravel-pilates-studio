@props(['footer' => isset($footer) ? $footer : null])

<div {{ $attributes->merge(['class' => 'card']) }}>
    
    @if($title)
    <div class="card-header">
        <h4>{{ $title }}</h4>
    </div>
    @endif

    <div class="card-body">
        {{ $slot }}
    </div>

    @if($footer)
    <div class="card-footer text-left">
        {{ $footer }}
    </div>
    @endif
</div>
