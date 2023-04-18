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
    <div class="col-12">
        <x-card class="author-box">

            <div class="author-box-left">
                <img alt="image" src="{{ asset($registration->student->user->image) }}"
                    class="rounded-circle author-box-picture">
                <div class="clearfix"></div>
            </div>

            <div class="author-box-details">

                <div class="author-box-name">
                    <h3><a href="{{ route('student.show', $registration->student) }}">{{ $registration->student->user->name }}</a></h3>
                </div>

                <div class="author-box-job text-muted">
                    {{ $registration->modality->name }} | 
                    {{ $registration->durationName }} | 
                    {{ $registration->class_per_week }}x | 
                    {{ $registration->value }}
                </div>

                <div class="mt-1 author-box-job text-muted">
                    Cadastrado em {{ $registration->created_at->diffForHumans() }} |
                    Editado em {{ $registration->updated_at->diffForHumans() }}
                </div>

                <div class="author-box-description">
                    <x-badge>{{ $registration->statusName }}</x-badge>
                </div>

            </div>

            <hr>

            <div>

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="class-tab" data-toggle="tab" href="#class" role="tab"
                            aria-controls="class" aria-selected="true">Grade de Aulas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="installment-tab" data-toggle="tab" href="#installment" role="tab"
                            aria-controls="installment" aria-selected="false">Mensalidades</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="class" role="tabpanel" aria-labelledby="class-tab">
                       
                        <table class="table datatable table-striped">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Hora</th>
                                    <th>Professor</th>
                                    <th>Tipo</th>
                                    <th class="text-center">Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($registration->classes as $class) 
                                <tr>
                                    <td scope="row">{{ date('d/m/Y', strtotime($class->date)) }} {{ $class->weekname }}</td>
                                    <td>{{ $class->time }}</td>
                                    <td>{{ $class->instructor->user->name }}</td>
                                    <td>{{ $class->classType }}</td>
                                    <td class="text-center">{!! $class->classStatusBadge !!}</td>
                                    <td>
                                        @if(empty($class->evolution))
                                        <a name="" id="" class="btn btn-warning" href="{{ route('class.edit', $class) }}" role="button">Editar Aula</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane fade" id="installment" role="tabpanel" aria-labelledby="installment-tab">
                       
                    </div>
                </div>


            </div>

            <x-slot name="footer">

                <a name="" id="" class="btn btn-light text-dark" href="{{ route('registration.index') }}" role="button">
                    <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                    Voltar
                </a>

                <div class="dropdown d-inline">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-cogs    "></i>
                        Gerenciar
                    </button>
                    <div class="dropdown-menu" x-placement="bottom-start">
                        @if($registration->status > 0)
                        <a class="dropdown-item has-icon" href="{{ route('registration.renew', $registration) }}"><i class="fas fa-pencil-alt    "></i> Renovar Matrícula</a>
                        <a class="dropdown-item has-icon" href="{{ route('registration.cancel', $registration) }}"><i class="fas fa-pencil-alt    "></i> Cancelar Matrícula</a>
                        <a class="dropdown-item has-icon" href="{{ route('registration.edit', $registration) }}"><i class="fas fa-pencil-alt    "></i> Editar</a>
                        @endif
                        <x-delete-button class="dropdown-item has-icon" route="{{ route('registration.destroy', $registration) }}"><i class="fas fa-trash-alt"></i>Excluir</x-delete-button>
                    </div>
                </div>
            </x-slot>

            

        </x-card>
    </div>

    <div class="col-12">
        
    </div>
</div>

@endsection

@section('scripts')
    @include('template.includes.datatable')
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/registration.js') }}"></script>
@endsection

