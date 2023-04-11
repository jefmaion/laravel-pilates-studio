@section('css')
<link rel="stylesheet" href="{{ asset('template/assets/bundles/fullcalendar/fullcalendar.min.css') }}">
<style>

.fc-event {
    /* margin: 2px; */
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

