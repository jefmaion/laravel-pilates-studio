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
        <x-card >

            <div class="row">
                <div class="col-6">
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
                                {{ $registration->modality->name }}  | 
                                {{ $registration->durationName }} ({{ $registration->class_per_week }}x) | 
                                {{ $registration->value }}
                                </h6>
                                <p class="text-muted"><b>Início: </b>{{ formatData($registration->start) }} | <b>Fim: </b>{{ formatData($registration->end) }}</p>
        
                                
                            </div>
        
                            {{-- <div class="mt-1 author-box-job text-muted">
                                Cadastrado em {{ $registration->created_at->diffForHumans() }} |
                                Editado em {{ $registration->updated_at->diffForHumans() }}
                            </div> --}}
        
                            <div class="author-box-description">
                                <x-badge class="badge-shadow">{{ $registration->statusName }}</x-badge>
        
                                
                                {!! $registration->renew; !!}
        
        
                            </div>
        
                        </div>
        
                    </div>
                </div>

                <div class="col">

                    <x-card class="text-center" >
                        <h2 class="font-light">{{ $registration->countClasses() }}</h2>
                        Aulas
                    </x-card>

                </div>
                
                <div class="col">

                    <x-card class="text-center">
                        <h2 class="font-light">{{ $registration->countClasses('presences') }}</h2>
                        Presença
                    </x-card>

                </div>
                <div class="col">

                    <x-card class="text-center">
                        <h2 class="font-light">{{ $registration->countClasses('absenses') }}</h2>
                        Faltas
                    </x-card>

                </div>
                <div class="col">

                    <x-card class="text-center" >
                        <h2 class="font-light">{{ $registration->countClasses('remarks') }}</h2>
                        Reposicoes
                    </x-card>

                </div>
            </div>



            <div>

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="class-tab" data-toggle="tab" href="#class" role="tab"
                            aria-controls="class" aria-selected="true">Grade de Aulas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="evolution-tab" data-toggle="tab" href="#evolution" role="tab"
                            aria-controls="evolution" aria-selected="false">Evolucoes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="installment-tab" data-toggle="tab" href="#installment" role="tab"
                            aria-controls="installment" aria-selected="false">Mensalidades</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="class" role="tabpanel" aria-labelledby="class-tab">
                       
                        <div class="table-responsive">
                            <table class="table datatable table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Hora</th>
                                        <th>Professor</th>
                                        <th>Tipo</th>
                                        <th class="text-center">Status</th>
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
                                    
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="evolution" role="tabpanel" aria-labelledby="evolution-tab">
                       
                        @foreach($registration->evolutions as $class)
                        <div class="card">
                            <div class="card-header">
                                <strong>{{ date('d/m/Y', strtotime($class->date)) }}</strong> <small> - {{ $class->instructor->user->name }}</small>
                            </div>
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <div class="media-right">
                                            <div class="text-dark">
                                                
                                            </div>
                                        </div>
                                       
                                        <div class="text-time">
                                            @foreach($class->exercices as $exercice)
                                            {{ $exercice->name }} | 
                                            @endforeach
                                        </div>
                                        <div class="media-description text-muted">
                                            {!! $class->evolution !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

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

