<div class="modal-header bg-whitesmoke p-3">
    <h5 class="modal-title">
        Aula de {{ $class->registration->modality->name }} - {{ $class->classStatus }}

       

    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span>&times;</span>
    </button>
</div>

<div class="modal-body">

    <div class="row">
        <div class="col-12">
            <ul class="list-unstyled list-unstyled-border list-unstyled-noborder">
                <li class="media">
                    <figure class="avatar mr-2 avatar-xl mr-4">
                        {!! image(asset($class->student->user->image)) !!}
                    </figure>
                    <div class="media-body">
                        <div class="media-title smb-1">
                            <a href="{{ route('registration.show', $class->registration) }}">
                                <h4>
                                    {{ $class->student->user->name }}
                                </h4>
                            </a>
                        </div>
                        <div class="h6">
                            <div class="mb-2">
                                <div class="mb-1">

                                    <p class="mb-1">
                                        <i class="fas fa-boxes"></i>
                                        {{ $class->registration->modality->name }} <span
                                            class="mx-1 text-light">|</span>
                                        {{ $class->registration->durationName }} ({{
                                        $class->registration->class_per_week }}x) <span class="mx-1 text-light">|</span>
                                        {{ $class->student->user->phone_wpp }}
                                    </p>

                                    <p class="mb-1">
                                        <i class="fas fa-clock"></i>
                                        {{ date('H', strtotime($class->time)) }}h00 <span class="mx-1 text-light">|</span>
                                        {{ $class->classType }}

                                        @if($class->parent)
                                        ( <a href="javascript:showClass({{$class->parent->id}})">{{ date('d/m/Y', strtotime($class->parent->date)) }}</a> )
                                        @endif

                                        
                                    </p>

                                    <p class="mb-1">
                                        <i class="fa fa-user-circle" aria-hidden="true"></i>
                                        {{ $class->instructor->user->name }}
                                    </p>


                                    {{-- <p>

                                        <x-badge theme="info">
                                            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                            OOpa
                                        </x-badge>
                                        <x-badge theme="warning">Mensalidade em Atraso</x-badge>
                                        <x-badge theme="danger">Mensalidade em Atraso</x-badge>

                                    </p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        
        <div class="col">

            @if($class->lastClass)
            
            <h6>Informações da Última Aula</h6>
            <hr>
            
                <p>
                    <b>Data:</b> {{ $class->lastClass->date }} {{ $class->lastClass->time }}
                </p>
                <p>
                    <b>Professor:</b> {{ $class->lastClass->instructor->user->name }}
                </p>

                
                <p>
                    <b>Evolução: </b><em>{{ $class->lastClass->evolution }}</em>
                </p>

                <b>Exercícios Utilizados: </b>
                @foreach($class->lastClass->exercices as $exercice)
                {{ $exercice->name }}
                @endforeach
            @endif  

            @if($class->status == 2)
            
         

            <p><b>Motivo da Falta: </b>{{ $class->comments }}</p>

            <a href="javascript:showClass({{ $class->parent->id }})">Aula de reposição agendada para o dia {{ $class->parent->date }}</a>
            @endif
            
        </div>
        
    </div>











</div>

<div class="modal-footer bg-whitesmoke br">

    <button type="button" class="btn btn-secondary" data-dismiss="modal">
        <i class="fa fa-times-circle" aria-hidden="true"></i>
        Fechar
    </button>

    <button type="button" class="btn btn-danger" data-url="{{ route('calendar.absense', $class) }}" id="btn-absense">
        <i class="fa fa-times-circle" aria-hidden="true"></i>
        Registrar Falta
    </button>

    <button type="button" class="btn btn-success" data-url="{{ route('calendar.presence', $class) }}" id="btn-presence">
        <i class="fa fa-times-circle" aria-hidden="true"></i>
        Registrar Presença
    </button>



</div>


<script>
    $('#btn-absense').click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "get",
            url: $(this).data('url'),
            success: function (response) {
                // $('#modelId').modal('hide')
                $('#modelId .modal-content').hide().html(response).fadeIn();
                // $('#modelId').modal('show')
            }
        });
    });

    $('#btn-presence').click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "get",
            url: $(this).data('url'),
            success: function (response) {
                $('#modelId .modal-content').html(response);
                $('#modelId').modal('show')
            }
        });
    });
</script>