<div class="modal-header bg-danger text-white p-3">
    <h5 class="modal-title">
        Registrar Falta de {{ $class->student->user->firstName }}
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span>&times;</span>
    </button>
</div>

<form id="form-absense" action="{{ route('class.absense', $class) }}" method="post">
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
                    <label>Tipo de Falta</label>
                    <x-form.select name="absense_type" :options="[2 => 'Falta COM aviso', 3 => 'Falta SEM aviso']"  />
                </div>

                <div class="col-12 form-group">
                    <label>Comentários</label>
                    <x-form.textarea name="comments" rows="4" value=""></x-form.textarea>
                </div>
            </div>

            
            
            
            <div class="row">

                <div class="col-12">
                    <x-form.switch-button class="my-4" single name="has_replacement">Agendar Reposição</x-form.switch-button>
                </div>

                <div class="col-3 form-group">
                    <label>Data</label>
                    <x-form.input type="date" class="replacement" disabled name="date"  />
                </div>

                <div class="col-2 form-group">
                    <label>Horario</label>
                    <x-form.select class="replacement" disabled name="time" :options="[
                    '07:00:00' => '07:00',
                    '08:00:00' => '08:00',
                    '09:00:00' => '09:00',
                    '10:00:00' => '10:00',
                    '11:00:00' => '11:00',
                    '12:00:00' => '12:00',
                    '13:00:00' => '13:00',
                    '14:00:00' => '14:00',
                    '15:00:00' => '15:00',
                    '16:00:00' => '16:00',
                    '17:00:00' => '17:00',
                    '18:00:00' => '18:00',
                    '19:00:00' => '19:00',
                    '20:00:00' => '20:00',
                ]"  />
                </div>

                <div class="col form-group">
                    <label>Instrutor</label>
                    <x-form.select class="replacement" disabled name="instructor_id" :options="$instructors" value="" />
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

    <button type="submit" class="btn btn-danger">
        <i class="fa fa-times-circle" aria-hidden="true"></i>
        Registrar Falta
    </button>

</div>


</form>

<script>
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

    $('[name="has_replacement"]').change(function (e) { 
        e.preventDefault();
        $('.replacement').attr('disabled', !$(this).prop('checked'))
    });
</script>