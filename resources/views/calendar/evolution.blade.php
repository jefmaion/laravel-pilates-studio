
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">

<div class="modal-header p-3">
    <h5 class="modal-title">
        <i class="fas fa-user-check"></i> Registrar Evolução de {{ $class->student->user->firstName }}
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
            @include('calendar.header')
        </div>

        <div class="col-12">
            @include('class.evolution')
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
        Registrar Evolução
    </button>

</div>


</form>


</div></div>

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