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
    <div class="col-12 d-flex">
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

            <a name="" id="" class="btn btn-light text-dark" href="{{ route('registration.show', $registration) }}"
                role="button">
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
        <form action="{{ route('registration.class.store', $registration) }}" method="post">
            <input type="hidden" name="class_per_week"
                value="{{ old('class_per_week', $registration->class_per_week ?? '') }}">
            <x-card style="primary">
                <x-slot name="title">
                    Aulas <small>(<a href="#" data-toggle="modal" data-target="#modelId">Agenda</a>)</small>
                </x-slot>

                @csrf
                @include('registration.form-class')

                <x-slot name="footer">
                    <a name="" id="" class="btn btn-light text-dark" href="{{ route('registration.index') }}"
                        role="button">
                        <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                        Voltar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check-circle    "></i>
                        Salvar
                    </button>
                </x-slot>

            </x-card>
        </form>
    </div>

</div>


<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">

            </div>


            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped">
                    <thead class="theasd-dark">
                        <tr>
                            <th></th>
                            @foreach($_week as $i => $week)
                            <th class="text-center">{{ $week }}</th>
                            @endforeach

                        </tr>
                    </thead>
                    <tbody>

                        @foreach($times as $k => $time)
                        <tr>
                            <th class="bg-lisght align-middle">{{ $time }}</th>
                            @foreach($_week as $i => $week)
                            <td width="16%" class="p-0 text-center align-middle {{ ($i % 2) ? 'bg-lsight' : '' }}">

                                @if(isset($classes[$k][$i]))
                                @foreach($classes[$k][$i] as $item)
                                <div>
                                    <x-badge theme="{{ ($item['me'])  ? 'primary' : 'light' }}">{{ $item['name'] }}
                                    </x-badge>
                                </div>
                                @endforeach
                                @endif

                            </td>
                            @endforeach
                        </tr>
                        @endforeach



                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')
@parent
@include('template.includes.datatable')
<script src="{{ asset('js/config.js') }}"></script>
<script src="{{ asset('js/registration.js') }}"></script>

@endsection