<div class="modal-header bg-success text-white p-3">
    <h5 class="modal-title">
        Registrar Presença de {{ $class->student->user->firstName }}
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span>&times;</span>
    </button>
</div>

<form id="form-absense" action="{{ route('class.presence', $class) }}" method="post">
    @csrf
    @method('put')
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
                                        {{ $class->registration->modality->name }} <span class="mx-1 text-light">|</span> 
                                        {{ $class->registration->durationName }} ({{ $class->registration->class_per_week }}x)   <span class="mx-1 text-light">|</span> 
                                        {{ $class->student->user->phone_wpp }}
                                    </p>

                                    <p class="mb-1">
                                        <i class="fas fa-clock"></i> 
                                        {{ date('H', strtotime($class->time)) }}h00 <span class="mx-1 text-light">|</span>
                                        {{ $class->classType }} <span class="mx-1 text-light">|</span>
                                        {{ $class->classStatus }}
                                    </p>

                                    <p class="mb-1">
                                        <i class="fa fa-user-circle" aria-hidden="true"></i>
                                        {{ $class->instructor->user->name }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <div class="col">
            <div class="row">


                <div class="col-12 form-group">
                    <label>Exercícios/Aparelhos utilizados</label>
                    <x-form.select name="exercices[]" multiple class="select2" :options="$exercices" value="" />
                </div>


                <div class="col form-group">
                    <label>Evolução da Aula</label>
                    <x-form.textarea  class="summernote" name="evolution" rows="10" value=""></x-form.textarea>
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

    <button type="submit" class="btn btn-success">
        <i class="fas fa-check-circle    "></i>
        Registrar Presenca
    </button>

</div>


</form>




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
                $('#myEvent').fullCalendar( 'refetchEvents' )
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