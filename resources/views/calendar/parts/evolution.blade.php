
{{-- <hr>
<div class="media">
    <div class="media-body">
        <div class="media-right">
            <div class="text-dark">
                
            </div>
        </div>
        <div class="media-title mb-1">
            {{ date('d/m/Y', strtotime($class->date)) }} - {{ $class->instructor->user->name }}
        </div>
        <div class="text-time">
            @foreach($class->exercices as $exercice)
            {{ $exercice->name }} | 
            @endforeach
        </div>
        <div class="media-description text-muted">
            {!! $class->evolution !!}
        </div>
    </div>
</div> --}}


<div class="card">
    <div class="card-header">
        <h4>
            {{ date('d/m/Y', strtotime($class->date)) }} - {{ $class->instructor->user->name }}
        </h4>
    </div>
    <div class="card-body">
        @foreach($class->exercices as $exercice)
        {{ $exercice->name }} | 
        @endforeach

        {!! $class->evolution !!}
    </div>
</div>