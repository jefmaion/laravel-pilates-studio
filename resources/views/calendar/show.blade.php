<div class="modal-header p-3">
    <h5 class="modal-title">
         {{-- {{ date('d/m/Y', strtotime($class->date)) }} - {!! $class->classStatus !!} --}}
         
         
         <i class="fas fa-info-circle    "></i>
         Informações da Aula
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span>&times;</span>
    </button>
</div>

<div class="modal-body">

    <div class="row">
        <div class="col-12 mb-2">
            @include('calendar.header')
        </div>

        <div class="col-12">
            @if(in_array($class->status, [0,1]))
                @if($class->evolution)
                    @include('calendar.parts.evolution', ['class' => $class])
                @else
                    @if($class->lastClass && $class->status == 0)
                        @include('calendar.parts.evolution', ['class' => $class->lastClass])
                    @endif
                @endif
            @endif
            
            @if(!empty($class->absense_comments))
                <div class="mb-2 text-dark">
                    <b>Motivo da falta: </b>{{ $class->absense_comments }}
                </div>
            @endif

        </div>
    </div>
</div>

<div class="modal-footer bg-whitesmoke br">

    <button type="button" class="btn btn-secondary text-dark" data-dismiss="modal">
        <i class="fa fa-times-circle" aria-hidden="true"></i>
        Fechar
    </button>

    <div class="dropdown dropup d-inline">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cogs    "></i>
            Gerenciar
        </button>
        <div class="dropdown-menu" x-placement="bottom-start">

            <a class="dropdown-item has-icon open-view" href="{{ route('calendar.edit', $class) }}">
                <i class="fas fa-calendar-plus"></i>
                Editar Aula
            </a>


            @if($class->status == 0)
                <a class="dropdown-item has-icon open-view" href="{{ route('calendar.presence', $class) }}">
                    <i class="fas fa-user-check    "></i>
                    Registrar Presença
                </a>

                <a class="dropdown-item has-icon open-view" href="{{ route('calendar.absense', $class) }}" >
                    <i class="fas fa-user-times"></i>
                    Registrar Falta
                </a>


              

            @else

            @if($class->status == 1 && empty($class->evolution))
            <a class="dropdown-item has-icon open-view" href="{{ route('calendar.evolution', $class) }}">
                <i class="fas fa-file-contract    "></i>
                Registrar Evolução
            </a>
            @endif

            
            {{-- verifica se é falta com aviso e se nao existe reposicao --}}
            @if($class->status == 2 &&  is_null($class->hasReplacement()))
            <a class="dropdown-item has-icon" id="btn-remark"  href="{{ route('calendar.select', $class) }}">
                <i class="fas fa-calendar-plus"></i>
                Agendar Reposição
            </a>
            @endif

            

            <a class="dropdown-item has-icon reset-class" href="#" data-id="{{ $class->id }}">
                <i class="fas fa-user-times    "></i>
                Remover Presença/Falta
            </a>

            @endif

        </div>
    </div>

</div>

<script>
    $('.open-view').click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "get",
            url: $(this).attr('href'),
            success: function (response) {
                showModal(response)
            }
        });
    }); 

    $('.reset-class').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            type: "post",
            url: 'class/'+id+'/reset',
            data: {
                _method: 'put',
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                $('#modelId').modal('hide')
                refreshCalendar();
            }
        });
    });

    $('#btn-remark').click(function (e) { 
        e.preventDefault();
        setRemark(true, $(this).attr('href'))
        $('#modelId').modal('hide')
    });

</script>