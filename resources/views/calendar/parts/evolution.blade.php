{!! $class->evolution !!}

<div class="mt-3">
@foreach($class->exercices as $exercice)
<x-badge class="mr-1">{{ $exercice->name }} </x-badge>
@endforeach
</div>
