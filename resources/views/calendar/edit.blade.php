<div class="modal-header p-3">
    <h5 class="modal-title">
        <i class="fas fa-user-check"></i> Editar Aula de {{ $class->student->user->firstName }}
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span>&times;</span>
    </button>
</div>

<form id="form-absense" action="{{ route('class.update', $class) }}" method="post">
    @csrf
    @method('put')
<div class="modal-body">

    <div class="row">
        <div class="col-12">
            @include('calendar.header')
        </div>

        <div class="col">
            <div class="row">

                

                @if($class->date == date('Y-m-d'))
                <div class="col-12 form-group">
                    <label>Hora da Aula</label>
                    <x-form.select name="time" :options="[
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
                    ]" value="{{ $class->time }}" />
                </div>
            @endif


                @if($exercices)
                    @include('class.evolution')
                @else

                

                <div class="col-12 form-group">
                    <label>Comentários</label>
                    <x-form.textarea name="absense_comments" rows="4">{{ $class->absense_comments }}</x-form.textarea>
                </div>
                @endif
                
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
        Salvar
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
            refreshCalendar()
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