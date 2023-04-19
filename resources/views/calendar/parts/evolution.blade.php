

<div class="media">
    <div class="media-body">
        <div class="media-right">
            <div class="text-dark">
                
            </div>
        </div>
        <div class="media-title mb-1">
            Evolução Recente - {{ date('d/m/Y', strtotime($class->date)) }}
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
</div>