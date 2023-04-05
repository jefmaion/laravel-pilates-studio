
<li class="breadcrumb-item">
    @if($active)
    {{ $slot }}
    @else
    <a href="{{ $href }}">{{ $slot }}</a>
    @endif
</li>