<div class="modal-dialog modal-dialog-centered modal-{{ (count($class->student->lastEvolutions) > 0) ? 'lg' : 'lg' }}"
    role="document">
    <div class="modal-content">

        <div class="modal-header bg-whitesmoke  p-3">
            <h5 class="modal-title">
                {{-- {{ date('d/m/Y', strtotime($class->date)) }} - {!! $class->classStatus !!} --}}
                <i class="fas fa-info-circle    "></i>
                Informações da Aula - {!! $class->classStatusBadge !!}
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

                    @if(!empty($class->absense_comments))

                    <div class="mb-2 card card-{{ $class->classStatusColor }}">
                        <div class="card-header">
                            <h4 class="text-{{ $class->classStatusColor }}">
                                <i class="fas fa-exclamation-circle    "></i>
                                {{ $class->classStatus }}
                            </h4>
                        </div>
                        <div class="card-body">
                            {{ $class->absense_comments }}
                        </div>
                    </div>

                    @endif

                    @if($class->student->lastEvolutions->count())
                    <div id="accordion">
                        <div class="accordion">
                            <div class="accordion-header collapsed" role="button" data-toggle="collapse"
                                data-target="#panel-body-1" aria-expanded="false">
                                <h4>Evoluções ({{ $class->student->lastEvolutions->count() }})</h4>
                            </div>
                            <div class="accordion-body collapse" id="panel-body-1" data-parent="#accordion" style="">
                                <ul class="list-unstyled list-unstyled-border user-list" id="message-list">
                                    @foreach($class->student->lastEvolutions as $evol)
                                    <li class="media">
                                        <img alt="image" src="{{ asset($evol->instructor->user->image) }}" class="mr-3 user-img-radious-style user-list-img">
                                        <div class="media-body">
                                            <div class="mt-0 font-weight-bold">{{ $evol->instructor->user->name }} em {{
                                                date('d/m/Y', strtotime($evol->date)) }}:</div>
                                            <div class="text-small">{!! $evol->evolution !!}</div>
                                            <div class="text-small font-weight-bold">
                                                @foreach($evol->exercices as $exercice)
                                                {{ $exercice->name }} <div class="bullet"></div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="modal-footer br">
            <hr>

            <button type="button" class="btn btn-secondary text-dark" data-dismiss="modal">
                <i class="fa fa-times-circle" aria-hidden="true"></i>
                Fechar
            </button>

            @if($class->status == 0)

                {{-- <a class="dropdown-item has-icon open-view" href="{{ route('calendar.edit', $class) }}">
                    <i class="fas fa-calendar-plus"></i>
                    Editar Aula
                </a> --}}

                <a class="btn btn-danger text-white open-view" href="{{ route('calendar.absense', $class) }}">
                    <i class="fas fa-user-times"></i>
                    Registrar Falta
                </a>

                <a class="btn  btn-success open-view" href="{{ route('calendar.presence', $class) }}">
                    <i class="fas fa-user-check    "></i>
                    Registrar Presença
                </a>

            @else

                <a class="btn bg-danger text-white reset-class" href="#" data-id="{{ $class->id }}">
                    <i class="fas fa-user-times    "></i>
                    Remover Presença/Falta
                </a>

                @if(!$class->hasRegistration)
                <a class="btn btn-success text-white open-view" href="{{ route('calendar.evolution', $class) }}">
                    <i class="fas fa-file-contract    "></i>
                    Registrar Evolução
                </a>
                @endif


                {{-- verifica se é falta com aviso e se nao existe reposicao --}}
                @if($class->status == 2 && is_null($class->hasReplacement()))
                <a class="btn btn-success " id="btn-remark" href="{{ route('calendar.select', $class) }}">
                    <i class="fas fa-calendar-plus"></i>
                    Agendar Reposição ({{ $class->student->countReplacement(date('n', strtotime($class->date))) }})
                </a>
                @endif

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