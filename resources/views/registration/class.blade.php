@extends('template.main')

@section('content')

<x-page-title>
    <x-slot name="title"><small>Matrícula do Aluno</small> </x-slot>
    <x-slot name="breadcrumb">
        <x-breadcrumb-item href="{{ route('registration.index') }}">Matrículas</x-breadcrumb-item>
        <x-breadcrumb-item active>Matrícula Atual</x-breadcrumb-item>
    </x-slot>
</x-page-title>

<div class="row">
    <div class="col-6 d-flex">
        <x-card class="flex-fill">
            <div class="row">
                <div class="col-8">
                    <div class="author-box">
                        <div class="author-box-left">
                            <img alt="image" src="{{ asset($registration->student->user->image) }}"
                                class="rounded-circle author-box-picture">
                            <div class="clearfix"></div>
                        </div>
                        <div class="author-box-details mb-4">
                            <div class="author-box-name">
                                <h3>
                                    <a href="{{ route('student.show', $registration->student) }}">
                                        {{ $registration->student->user->name }}
                                    </a>
                                </h3>
                            </div>
                            <div class="author-box-job text-muted">
                                <h6 class="font-weight-light">
                                    {{ $registration->modality->name }} |
                                    {{ $registration->durationName }} ({{ $registration->class_per_week }}x) |
                                    R$ {{ currency($registration->value) }}
                                </h6>
                                <h6 class="text-muted"><b>Início: </b>{{ formatData($registration->start) }} | <b>Fim:
                                    </b>{{ formatData($registration->end) }}
                                </h6>
                            </div>
                            <div class="author-box-description"></div>
                        </div>
                    </div>
                </div>
                <div class="col text-right">
                    <h4>{!! $registration->statusName !!}</h4>
                </div>
            </div>

            <a name="" id="" class="btn btn-light text-dark" href="{{ route('registration.show', $registration) }}" role="button">
                <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                Voltar
            </a>

        </x-card>
    </div>


    <div class="col-12">
        <?php
            $times = [
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
        ];
        $_week = [
                1 => 'Segunda-Feira',
                2 => 'Terça-Feira',
                3 => 'Quarta-Feira',
                4 => 'Quinta-Feira',
                5 => 'Sexta-Feira',
                6 => 'Sábado'
            ]    
        ?>
        <x-card>
            <div>

                <table class="table table-stripesd table-bordered" id="table-class-calendar">
                    <thead class="thead-inverse">
                        <tr>
                            <th></th>
                            @foreach($_week as $k => $w)
                            <th>{{ $w }}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                                @foreach($times as $x => $time)
                                <tr>
                                <th scope="row">{{ $time }}</th>

                                    @foreach($_week as $k => $w)
                                    <td data-weekday="{{ $k }}" data-time="{{  $x }}">
                                        @if(isset($classes[$x][$k]))
                                            @foreach($classes[$x][$k] as $reg)
                                                <div class="{{ ($reg->id == $registration->id) ? 'text-danger' : 'text-muted' }}">{{ $reg->student->user->name }}</div>
                                            @endforeach
                                        @endif
                                    </td>
                                    @endforeach
                                </tr>
                                @endforeach
                        </tbody>
                </table>

            </div>
        </x-card>
    </div>
</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
  Launch
</button>

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('registration.class.store', $registration) }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <x-form.select name="weekday" :options="$_week" />
                    <x-form.select name="time" :options="$times" />
                    <x-form.select name="instructor_id" :options="$instructors" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection

@section('scripts')
@parent
@include('template.includes.datatable')
<script src="{{ asset('js/config.js') }}"></script>
<script src="{{ asset('js/registration.js') }}"></script>
<script>
    $('#table-class-calendar td').click(function (e) { 
        e.preventDefault();
        data = $(this).data();
        $('[name="time"]').val(data.time).change();
        $('[name="weekday"]').val(data.weekday).change();
        $('#modelId').modal('show')
    });
</script>
@endsection