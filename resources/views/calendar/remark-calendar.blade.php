@extends('template.main')

@section('content')




<x-page-title>
    <x-slot name="title">Reagendar Aula de {{ $class->student->user->firstName }}</x-slot>
    <x-slot name="breadcrumb">
        <x-breadcrumb-item active>Calendario</x-breadcrumb-item>
    </x-slot>
</x-page-title>

<x-card style="primary">


<form id="form-absense" action="{{ route('class.remark', $class) }}" method="post">
    @csrf
    @method('put')
    <div class="modal-body">

        <div class="row">
            <div class="col-12">
                @include('calendar.header')
            </div>

            <div class="col">

                <div id="calendar-remark"></div>


                
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

</x-card>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal-remark">
  Launch
</button>


@endsection

@section('body')
<!-- Modal -->
<div class="modal fade" id="modal-remark" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            
        </div>
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('template/assets/bundles/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('template/assets/bundles/fullcalendar/fullcalendar.min.css') }}">
<link rel="stylesheet" href="{{ asset('template/assets/bundles/summernote/summernote-bs4.css') }}">
<link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}">


@endsection

@section('scripts')
<script src="{{ asset('template/assets/bundles/fullcalendar/fullcalendar.min.js') }}"></script>
<script src="{{ asset('js/config.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.5/dist/locale/pt-br.js"></script>
<script src="{{ asset('template/assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('template/assets/bundles/summernote/summernote-bs4.js') }}"></script>

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


$(document).ready(function () {

    console.log(config.fullcalendar)

    var calendar2 = $('#calendar-remark').fullCalendar({...config.fullcalendar,...{
            events: function(start, end, timezone, callback) {
                $.ajax({
                    url: "{{ route('calendar.index') }}",
                    dataType: 'json',
                    data: {
                        // our hypothetical feed requires UNIX timestamps
                        start: start.format(),
                        end: end.format()
                    },
                    success: function(doc) {
                        var events = [];
                        $.each(doc, function (i, item) { 
                            events.push(item.raw)
                        });
                        callback(events);
                    }
                });
            },

            dayClick: function(date, jsEvent, view) {

                $.ajax({
                    url: "{{ route('calendar.select', $class) }}",
                    data: {
                       date: date.format()
                    },
                    success: function(doc) {

                        $('#modal-remark .modal-content').html(doc)
                        $('#modal-remark').modal('show')
                    }
                });

                
                // alert('Clicked on: ' + date.format());

                // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

                // alert('Current view: ' + view.name);
              

            },
            
        }
    });

});
    
</script>
@endsection


