@extends('template.main')

@section('content')

<x-page-title>
    <x-slot name="title">Calendário</x-slot>
    <x-slot name="breadcrumb">
        <x-breadcrumb-item active>Calendario</x-breadcrumb-item>
    </x-slot>
</x-page-title>

<x-card style="primary">
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
<link rel="stylesheet" href="{{ asset('template/assets/bundles/fullcalendar/fullcalendar.min.css') }}">
<link rel="stylesheet" href="{{ asset('template/assets/bundles/select2/dist/css/select2.min.css') }}">
<style>

.fc-event {
    margin: 2px;
    box-shadow: none !important;
}

.fc-time-grid .fc-slats td {
  height: 3em; // Change This to your required height
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

<script>

        
var calendar = $('#myEvent').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        height: 'auto',
        defaultView: 'agendaWeek',
        editable: false,
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
        events: {
            url: 'calendar/',
            data: function() {
                obj = {}
                $('.calendar-comp').each(function (index, element) {
                    name = $(this).attr('name');
                    obj[name] = $(element).val()
                });

                return obj
            }
        },

        eventRender: function(event, element) {
            element.find(".fc-title").html(event.title);
        },
        eventClick:  function(event, jsEvent, view) {

            // alert(event.id)
            
            showClass(event.id)
        },
        dayClick: function(date, jsEvent, view) {

            // alert('Clicked on: ' + date.format());

            // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

            // alert('Current view: ' + view.name);

            // change the day's background color just for fun
            // $(this).css('background-color', 'red');

        },
        eventAfterRender: function(event, element, view) {
            // alert('sd');
        }
        
    });
        
        
                        
        
        
            //             function getEvents() {
            //                 return  {
            //                      url: '{{ route('calendar.index') }}',
            //                     data: {
            //                         instructor: $('[name=instructor]').val()
            //                     }
            //                 }
            //             }
        
                
            //             $('.calendar-comp').change(function (e) { 
            //                 calendar.fullCalendar('refetchEvents');
            //             });
        
            // });
        
    function showClass(id) {
        $.ajax({
            type: "get",
            url: "calendar/" + id,
            success: function (response) {

                // $('#modelId').modal('hide');
                $('#modelId .modal-content').html(response);
                $('#modelId').modal('show')
            }
        });
    }


        
</script>
@endsection