<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header p-3">
            <h5 class="modal-title">
                <i class="fas fa-user-check"></i> Reposição de Aula
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span>&times;</span>
            </button>
        </div>

        <form id="form-absense" action="{{ route('class.remark', $class) }}" method="post">
            @csrf
            @method('put')
            <div class="modal-body">

                <div class="row">

                    <input type="hidden" name="date" value="{{ $newDate['day'] }}">
                    <input type="hidden" name="time" value="{{ $newDate['time'] }}">

                    <div class="col-12 mb-2">
                        @include('calendar.header')
                    </div>

                    <div class="col-12">

                        <h5>{{ $newDate['full'] }} às {{ $newDate['time'] }}</h5>

                        <div class="row">

                            <div class="col form-group">
                                <x-form.select class="replacement" name="instructor_id" :options="$instructors" value="" />
                            </div>

                            <div class="col-12">
                                @if(count($classes) > 0)
                                    <h5 class="lead">Outros alunos estarão nesse dia!</h5>
                                    <table class="table table-striped table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th>Aluno</th>
                                                <th>Aula</th>
                                                <th>Modalidade</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($classes as $other)
                                            <tr>
                                                <td scope="row">{{ $other->student->user->name }}</td>
                                                <td scope="row">{{ $other->classType }}</td>
                                                <td>{{ $other->registration->modality->name }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                    Fechar
                </button>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check-circle    "></i>
                    Agendar Reposição
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    $(".select2").select2();

    $('#form-absense').submit(function (e) { 
        e.preventDefault();

        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            success: function (response) {
                $('#modelId').modal('hide')
                refreshCalendar()
                setRemark(false, null)
            },
            error: function(response) {
                $('.is-invalid').removeClass('is-invalid')
                $.each(response.responseJSON.errors, function (name, message) { 
                    $('[name="'+name+'"]').addClass('is-invalid').next().html(message[0])
                });
            
            }
        });
        
    });
</script>

@section('css')
<link rel="stylesheet" href="{{ asset('template/assets/bundles/select2/dist/css/select2.min.css') }}">
@endsection