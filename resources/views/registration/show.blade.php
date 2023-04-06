@extends('template.main')

@section('content')

<x-page-title>
    <x-slot name="title"><small>Matrícula do Aluno</small> </x-slot>
    <x-slot name="breadcrumb">
        <x-breadcrumb-item href="{{ route('registration.index') }}">Professores</x-breadcrumb-item>
        <x-breadcrumb-item active>Dados do Professor</x-breadcrumb-item>
    </x-slot>
</x-page-title>

<div class="row">
    <div class="col-12">
        <div class="card profile-widget">

            <div class="profile-widget-header">
                <img alt="image" src="{{ asset($registration->student->user->image) }}"
                    class="rounded-circle profile-widget-picture">
                <div class="profile-widget-items">
                    <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Total de Aulas</div>
                        <div class="profile-widget-item-value">{{ $registration->classes->count() }}</div>
                    </div>
                    <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Presenças</div>
                        <div class="profile-widget-item-value">9,3K</div>
                    </div>
                    <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Faltas</div>
                        <div class="profile-widget-item-value">3,7K</div>
                    </div>

                </div>
            </div>
            <div class="profile-widget-description pb-0">
                <div class="profile-widget-name">
                    <h4>{{ $registration->student->user->name }}</h4>
                </div>
               


            </div>

            <div class="card-body">

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
                                    <th>Dia</th>
                                    <th>Professor</th>
                                    <th>Tipo</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($registration->classes as $class) 
                                <tr>
                                    <td scope="row">{{ $class->date }}</td>
                                    <td>{{ $class->time }}</td>
                                    <td>{{ $class->weekday }}</td>
                                    <td>{{ $class->instructor->user->name }}</td>
                                    <td>{{ $class->type }}</td>
                                    <td>{{ $class->status }}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane fade" id="installment" role="tabpanel" aria-labelledby="installment-tab">
                       
                    </div>
                </div>

            </div>

            <div class="card-footer">
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
                        <a class="dropdown-item has-icon" href="{{ route('registration.edit', $registration) }}"><i
                                class="fas fa-pencil-alt    "></i> Editar</a>
                        <x-delete-button class="dropdown-item has-icon"
                            route="{{ route('registration.destroy', $registration) }}"><i class="fas fa-trash-alt"></i>
                            Excluir</x-delete-button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


{{-- <div class="row">
    <div class="col-5">
        <x-card class="author-box">

            <div class="author-box-left">
                <img alt="image" src="{{ asset($registration->student->user->image) }}"
                    class="rounded-circle author-box-picture">
                <div class="clearfix"></div>
            </div>

            <div class="author-box-details">

                <div class="author-box-name">
                    <h3>{{ $registration->student->user->name }}</h3>
                </div>

                <div class="author-box-job text-muted">
                    {{ $registration->profession }}


                </div>

                <div class="mt-3 author-box-job text-muted">
                    Cadastrado em {{ $registration->created_at->diffForHumans() }} |
                    Editado em {{ $registration->updated_at->diffForHumans() }}
                </div>

                <div class="author-box-description">
                    <x-badge-status status="{{ $registration->enabled }}" />
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
                        <a class="dropdown-item has-icon" href="{{ route('registration.edit', $registration) }}"><i
                                class="fas fa-pencil-alt    "></i> Editar</a>
                        <x-delete-button class="dropdown-item has-icon"
                            route="{{ route('registration.destroy', $registration) }}"><i class="fas fa-trash-alt"></i>
                            Excluir</x-delete-button>
                    </div>
                </div>
            </x-slot>

        </x-card>
    </div>

    <div class="col">
        <div class="row">
            <div class="col-4">
                <x-card>
                    <div class="text-center">
                        <h3>3</h3>
                        <small>Faltas</small>
                    </div>
                </x-card>
            </div>

            <div class="col-4">
                <x-card>
                    <div class="text-center">
                        <h3>3</h3>
                        <small>Faltas</small>
                    </div>
                </x-card>
            </div>

            <div class="col-4">
                <x-card>
                    <div class="text-center">
                        <h3>3</h3>
                        <small>Faltas</small>
                    </div>
                </x-card>
            </div>

            <div class="col-4">
                <x-card>
                    <div class="text-center">
                        <h3>3</h3>
                        <small>Faltas</small>
                    </div>
                </x-card>
            </div>

            <div class="col-4">
                <x-card>
                    <div class="text-center">
                        <h3>3</h3>
                        <small>Faltas</small>
                    </div>
                </x-card>
            </div>

            <div class="col-4">
                <x-card>
                    <div class="text-center">
                        <h3>3</h3>
                        <small>Faltas</small>
                    </div>
                </x-card>
            </div>

        </div>
    </div>
</div> --}}

@endsection

@section('scripts')
    @include('template.includes.datatable')
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/registration.js') }}"></script>
@endsection

