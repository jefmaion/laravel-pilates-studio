@extends('template.main')

@section('content')

<x-page-title>
    <x-slot name="title">Calendário</x-slot>
    <x-slot name="breadcrumb">
        <x-breadcrumb-item active>Calendario</x-breadcrumb-item>
    </x-slot>
</x-page-title>

<x-card style="primary">

    <div class="row">
        {{-- <div class="col-1">
            <div class="dropdown">
                <button class="btn btn-primary btn-block dropdown-toggle" type="button" id="dropdownMenuButton2"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Ações
                </button>
                <div class="dropdown-menu" x-placement="bottom-start">
                    <a class="dropdown-item has-icon" href="#"><i class="far fa-heart"></i> Action</a>
                    <a class="dropdown-item has-icon" href="#"><i class="far fa-file"></i> Another action</a>
                    <a class="dropdown-item has-icon" href="#"><i class="far fa-clock"></i> Something else here</a>
                </div>
            </div>
        </div> --}}

        <div class="col form-group">
            <label>Instrutor</label>
            <x-form.select class="item-calendar select2" name="_instructor_id" :options="$instructors" />
        </div>

        <div class="col form-group">
            <label>Aluno</label>
            <x-form.select class="item-calendar select2" name="_student_id" :options="$students" />
        </div>

        <div class="col form-group">
            <label>Modalidade</label>
            <x-form.select class="item-calendar select2" name="_modality_id" :options="$modalities" />
        </div>

        <div class="col form-group">
            <label>Tipo de Aula</label>
            <x-form.select class="item-calendar select2" name="_type"
                :options="['AN' => 'Aula Normal', 'RP' => 'Reposição', 'AE' => 'Aula Experimental']" />
        </div>

        <div class="col form-group">
            <label>Status Aula</label>
            <x-form.select class="item-calendar select2" name="_status"
                :options="[0 => 'Agendada', 1 => 'Realizada', 2 => 'Falta Com Aviso', 3 => 'Falta']" />
        </div>

    </div>

    <div id="myEvent"></div>
</x-card>

@endsection

@section('body')
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
<style>
    .fc-event {
        margin: 2px;
        box-shadow: none !important;
    }

    .fc-time-grid .fc-slats td {
        height: 4.5em;
        border-bottom: 0;

    }

    .risk {
        text-decoration: line-through
    }
</style>


@endsection


@section('scripts')
<script src="{{ asset('template/assets/bundles/fullcalendar/fullcalendar.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.5/dist/locale/pt-br.js"></script>
<script src="{{ asset('template/assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('template/assets/bundles/summernote/summernote-bs4.js') }}"></script>
<script>
    $(document).ready(function () {
        var calendar = $('#myEvent').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        navLinks:true,
        height: 'auto',
        defaultView: 'agendaWeek',
        // editable: true,
        selectable: true,
        allDaySlot: false,
        displayEventTime : false,
        minTime: "07:00:00",
        maxTime: "21:00:00",
        slotDuration: '00:60:00',
        // eventLimit: true,
        nowIndicator:true,
        timeFormat: 'H(:mm)',
        slotEventOverlap:false,
        hiddenDays: [0],
        slotLabelFormat: [
            'HH:mm', // top level of text
        ],
        // navLinkDayClick: function(date, jsEvent) {
        //     console.log('day', date.format()); // date is a moment
        //     console.log('coords', jsEvent.pageX, jsEvent.pageY);
        // },
        events: {
            url: 'calendar/',
            data: function() {
                obj = {}
                $('.item-calendar').each(function (index, element) {
                    name = $(this).attr('name');
                    obj[name] = $('[name="'+name+'"]').val()
                });
                return obj
            }
        },


        eventRender: function(event, element) {
            element.find(".fc-title").html(event.title);
        },
        eventClick:  function(event, jsEvent, view) {
            showClass(event.id)
        },

        dateClick: function(info) {
            alert('clicked ' + info.dateStr + ' on resource ');
        },

        dayClick: function(date, jsEvent, view) {

            // alert('Clicked on: ' + date.format());

            // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

            // alert('Current view: ' + view.name);
            alert('dia')

        },
        eventAfterRender: function(event, element, view) {
            // alert('sd');
        },
        
    });

    $('.item-calendar').change(function (e) { 
        calendar.fullCalendar('refetchEvents');
    });
                
    });
        
            // });
        
    function showClass(id) {
        $.ajax({
            type: "get",
            url: "calendar/" + id,
            success: function (response) {
                showModal(response)
            }
        });
    }

    function showModal(content) {
        // $('#modelId').modal('hide')
        $('#modelId .modal-content').html(content)
        $('#modelId').modal('show')
    }

    


    
        
</script>
@endsection