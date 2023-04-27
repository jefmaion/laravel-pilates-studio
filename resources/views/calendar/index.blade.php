@extends('template.main')

@section('content')

<x-page-title>
    <x-slot name="title">Calendário</x-slot>
    <x-slot name="breadcrumb">
        <x-breadcrumb-item active>Calendario</x-breadcrumb-item>
    </x-slot>
</x-page-title>

<x-card style="primary" id="card-main" class="">

    {{-- <div class="alert bg-orange remark-alert d-none" role="alert">
        <strong>Reagendar Aula</strong> <a href="#" onclick="setRemark(false)">Cancelar</a>

        
    </div> --}}

    <button type="button" class="btn btn-lg bg-orange remark-alert d-none mb-3" onclick="setRemark(false)"><h5 class="m-0">Cancelar Reagendamento</h5></button>

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
            <x-form.select class="item-calendar select2" name="_instructor_id" :options="$instructors" value="" />
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
            <x-form.select class="item-calendar select2" name="_status"  :options="[0 => 'Agendada', 1 => 'Realizada', 2 => 'Falta Com Aviso', 3 => 'Falta']" />
        </div>

    </div>

    <div id="calendar-class" ></div>

    
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
<link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}">


@endsection


@section('scripts')
<script src="{{ asset('template/assets/bundles/fullcalendar/fullcalendar.min.js') }}"></script>
<script src="{{ asset('js/config.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.5/dist/locale/pt-br.js"></script>
<script src="{{ asset('template/assets/bundles/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('template/assets/bundles/summernote/summernote-bs4.js') }}"></script>
<script>

    var calendar = null
    var remark = false
    var remarkUrl = null

    $(document).ready(function () {

        calendar = $('#calendar-class').fullCalendar({...config.fullcalendar,...{
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
                    if(!remark) {
                        showClass(event.id)
                    }
                },
                dateClick: function(info) {
                    alert('clicked ' + info.dateStr + ' on resource ');
                },
                dayClick: function(date, jsEvent, view) {
                    $.ajax({
                        url: remarkUrl,
                        data: {
                            date: date.format()
                        },
                        success: function(doc) {
                            showModal(doc)
                        }
                    });
                }
            }
        });

        $('.item-calendar').change(function (e) { 
            refreshCalendar();
        });

                
    });
        

    function refreshCalendar() {
        calendar.fullCalendar('refetchEvents');
    }
        
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
        $('#modelId .modal-content').html(content)
        $('#modelId').modal('show')
    }


    function setRemark(status, url) {
        remark = status
        remarkUrl = url
        classes = 'border border-warning fc-border-yellow'

        $('#card-main').removeClass(classes);
        $('.remark-alert').addClass('d-none')
        // $('.fc td').removeClass('fc-border-yellow')

        if(status) {
            $('#card-main').addClass(classes);
            $('.remark-alert').removeClass('d-none')
            // $('.fc td').addClass('fc-border-yellow')
        }
        
    }
    


    
        
</script>
@endsection