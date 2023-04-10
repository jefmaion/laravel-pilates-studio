@section('css')
<link rel="stylesheet" href="{{ asset('template/assets/bundles/fullcalendar/fullcalendar.min.css') }}">
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


<script src="{{ asset('template/assets/bundles/fullcalendar/fullcalendar.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.5/dist/locale/pt-br.js"></script>

<script>


// var today = new Date();
// year = today.getFullYear();
// month = today.getMonth();
// day = today.getDate();
// var calendar = $('#myEvent').fullCalendar({
//   height: 'auto',
//   defaultView: 'month',
//   editable: true,
//   selectable: true,
//   header: {
//     left: 'prev,next today',
//     center: 'title',
//     right: 'month,agendaWeek,agendaDay,listMonth'
//   },
//   events: [{
//     title: "Palak Jani",
//     start: new Date(year, month, day, 11, 30),
//     end: new Date(year, month, day, 12, 00),
//     backgroundColor: "#00bcd4"
//   }, {
//     title: "Priya Sarma",
//     start: new Date(year, month, day, 13, 30),
//     end: new Date(year, month, day, 14, 00),
//     backgroundColor: "#fe9701"
//   }, {
//     title: "John Doe",
//     start: new Date(year, month, day, 17, 30),
//     end: new Date(year, month, day, 18, 00),
//     backgroundColor: "#F3565D"
//   }, {
//     title: "Sarah Smith",
//     start: new Date(year, month, day, 19, 00),
//     end: new Date(year, month, day, 19, 30),
//     backgroundColor: "#1bbc9b"
//   }, {
//     title: "Airi Satou",
//     start: new Date(year, month, day + 1, 19, 00),
//     end: new Date(year, month, day + 1, 19, 30),
//     backgroundColor: "#DC35A9",
//   }, {
//     title: "Angelica Ramos",
//     start: new Date(year, month, day + 1, 21, 00),
//     end: new Date(year, month, day + 1, 21, 30),
//     backgroundColor: "#fe9701",
//   }, {
//     title: "Palak Jani",
//     start: new Date(year, month, day + 3, 11, 30),
//     end: new Date(year, month, day + 3, 12, 00),
//     backgroundColor: "#00bcd4"
//   }, {
//     title: "Priya Sarma",
//     start: new Date(year, month, day + 5, 2, 30),
//     end: new Date(year, month, day + 5, 3, 00),
//     backgroundColor: "#9b59b6"
//   }, {
//     title: "John Doe",
//     start: new Date(year, month, day + 7, 17, 30),
//     end: new Date(year, month, day + 7, 18, 00),
//     backgroundColor: "#F3565D"
//   }, {
//     title: "Mark Hay",
//     start: new Date(year, month, day + 5, 9, 30),
//     end: new Date(year, month, day + 5, 10, 00),
//     backgroundColor: "#F3565D"
//   }]
// });


    // $(document).ready(function () {

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
                        
                        // showClass(event.id)
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

    // function showClass(id) {
    //     $.ajax({
    //             type: "get",
    //             url: "calendar/" + id,
    //             success: function (response) {

    //                 // $('#modelId').modal('hide');
    //                 $('#modelId .modal-content').html(response);
    //                 $('#modelId').modal('show')
    //             }
    //         });
    // }

    </script>