
<figure class="avatar mr-2 avatar-{{ $size }}">
    <img src="{{ $src }}" alt="...">

    @if($second)
    <img src="{{ $second }}" class="avatar-icon" alt="...">
    @endif

    @if($status)
    <i class="avatar-presence {{ $status }}"></i>
    @endif

</figure>