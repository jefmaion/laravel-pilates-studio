
<div class="modal-header bg-whitesmoke p-3">
    <h5 class="modal-title">
        {!! $class->classStatusBadge !!} :: Aula de {{ $class->registration->modality->name }}



    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span>&times;</span>
    </button>
</div>

<div class="modal-body">

    <div class="row">
        <div class="col-12">
            @include('calendar.header')
        </div>


        <div class="col-12">


            @if(in_array($class->status, [0,1]))    

                @if($class->evolution)
                    <div class="mb-2 text-dark"><b>Evolução Aula</b></div>
                    @include('calendar.parts.evolution', ['class' => $class])
                @else

                    @if($class->lastClass)
                        <div class="mb-2 text-dark"><b>Evolução da Última Aula <small>({{ formatData($class->lastClass->date) }})</small></b></div>
                        @include('calendar.parts.evolution', ['class' => $class->lastClass])
                    @endif

                @endif
           
            @endif

            @if($class->comments)
                <div class="mb-2 text-dark"><b>Observações</b></div>
                {{ $class->comments }}
            @endif
            
            {{-- <p><b>Motivo da Falta: </b>{{ $class->comments }}</p>
            @if(isset($class->parent))
            <a href="javascript:showClass({{ $class->parent->id }})">
                Aula de reposição agendada para o dia {{ $class->parent->date }}
            </a>
            @endif --}}

        </div>

    </div>











</div>

<div class="modal-footer bg-whitesmoke br">

    <button type="button" class="btn btn-secondary text-dark" data-dismiss="modal">
        <i class="fa fa-times-circle" aria-hidden="true"></i>
        Fechar
    </button>

    @if(!$class->finished)
        <button type="button" class="btn btn-danger" data-url="{{ route('calendar.absense', $class) }}" id="btn-absense">
            <i class="fas fa-user-times    "></i>
            Registrar Falta
        </button>

        <button type="button" class="btn btn-success" data-url="{{ route('calendar.presence', $class) }}" id="btn-presence">
            <i class="fas fa-user-check    "></i>
            Registrar Presença
        </button>
    @else
    <a name="" id="" class="btn btn-primary" href="{{ route('class.edit', $class) }}" role="button">Editar Aula</a>
    @endif



</div>


<script>
    $('#btn-absense').click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "get",
            url: $(this).data('url'),
            success: function (response) {
                showModal(response)
                // $('#modelId').modal('hide')
                // $('#modelId .modal-content').hide().html(response).fadeIn();
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
                // $('#modelId .modal-content').html(response);
                // $('#modelId').modal('show')
                showModal(response)
            }
        });
    });
</script>