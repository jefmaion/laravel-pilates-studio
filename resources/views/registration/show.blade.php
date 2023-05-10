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
        <x-card>



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
                                <p class="text-muted"><b>Início: </b>{{ formatData($registration->start) }} | <b>Fim:
                                    </b>{{ formatData($registration->end) }}</p>


                            </div>

                            {{-- <div class="mt-1 author-box-job text-muted">
                                Cadastrado em {{ $registration->created_at->diffForHumans() }} |
                                Editado em {{ $registration->updated_at->diffForHumans() }}
                            </div> --}}

                            <div class="author-box-description">
                                {!! $registration->statusName !!}


                            </div>

                        </div>

                    </div>
                </div>

                <div class="col">

                    <div class="row">
                        <div class="col ">
                            <div class="media float-right">


                                <div class="media-items">
                                    <div class="media-item border-right">
                                        <div class="media-label text-muted"><div><i class="fas fa-calendar    "></i></div> Aulas</div>
                                        <div class="media-value">  {{ $registration->countClasses() }}</div>
                                    </div>
                                    <div class="media-item border-right">
                                        <div class="media-label text-muted"> <div><i class="fas fa-calendar-check    "></i></div> Presenças</div>
                                        <div class="media-value">{{ $registration->countClasses('presences') }}</div>
                                    </div>
                                    <div class="media-item border-right">
                                        <div class="media-label text-muted"> <div><i class="fas fa-calendar-times    "></i></div> Faltas</div>
                                        <div class="media-value">{{ $registration->countClasses('absenses') }}</div>
                                    </div>
                                    <div class="media-item">
                                        <div class="media-label text-muted"> <div><i class="fas fa-sync    "></i></div> Reposições</div>
                                        <div class="media-value">{{ $registration->countClasses('remarks') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>  

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
                            <x-table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Dia da Semana</th>
                                        <th>Data</th>
                                        <th>Hora</th>
                                        <th>Professor</th>
                                        <th>Evolução</th>
                                        <th>Tipo</th>
                                        <th class="text-center">Status</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($registration->classes as $class)
                                    <tr>
                                        <td class="text-center">

                                            
                                            <div class="dropdown d-inline">
                                                <a class="" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <i class="fas fa-bars    "></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                  <a class="dropdown-item has-icon" href="#"><i class="far fa-heart"></i>
                                                    Remover Presença/Falta
                                                    </a>
                                                  <a class="dropdown-item has-icon" href="#"><i class="far fa-file"></i> Another action</a>
                                                  <a class="dropdown-item has-icon" href="#"><i class="far fa-clock"></i> Something else here</a>
                                                </div>
                                              </div>

                                        </td>
                                        <td scope="row">{{ $class->weekname}}</td>
                                        <td>{{ date('d/m/Y', strtotime($class->date)) }} </td>
                                        <td>{{ $class->time }}</td>
                                        <td>
                                            <img alt="image" src="{{ asset($class->instructor->user->image) }}" class="rounded-circle" width="35" data-toggle="tooltip" title="" data-original-title="{{ $class->instructor->user->name }}">
                                            {{ $class->instructor->user->name }}
                                            
                                        </td>
                                        <td>{{ Str::words($class->evolution, 15) }}</td>
                                        <td>{{ $class->classType }}</td>
                                        <td class="text-center">{!! $class->classStatusBadge !!}</td>
                                        

                                    </tr>
                                    @endforeach

                                </tbody>
                            </x-table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="evolution" role="tabpanel" aria-labelledby="evolution-tab">


                        <div class="table-responsive">
                            <table class="table datatable table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>Evoluções</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($registration->evolutions as $evol)
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <img alt="image" class="mr-3 rounded-circle" width="40" src="{{ asset($evol->instructor->user->image) }}">
                                                <div class="media-body">
                                                    <div class="media-right">
                                                        <div class="text-primary">Approved</div>
                                                    </div>
                                                    <div class="media-title mb-1">
                                                        <b>Aula: </b>{{ date('d/m/Y', strtotime($evol->date)) }} <div class="bullet"></div> 
                                                        <b>Professor: </b> {{ $evol->instructor->user->name }}
                                                    </div>
                                                    <div class="text-time">
                                                        @foreach($evol->exercices as $exercice)
                                                        {{ $exercice->name }} <div class="bullet"></div> 
                                                        @endforeach
                                                    </div>
                                                    <div class="media-description text-muted">{!! $evol->evolution !!}</div>                                        
                                                </div>
                                            </div>
                                               

                                        </td>
                                        <td>
                                            
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>



                        

                    </div>
                    <div class="tab-pane fade" id="installment" role="tabpanel" aria-labelledby="installment-tab">
                        <div class="table-responsive">
                            <table class="table datatable table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>Data de Vencimento</th>
                                        <th>Data de Pagamento</th>
                                        <th>Forma</th>
                                        <th>Valor</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($registration->installments as $installment)
                                    <tr>
                                      <td>
                                        <a href="{{ route('receive.receive', $installment) }}">{{ date('d/m/Y', strtotime($installment->date)) }}</a>
                                      </td>
                                      <td>{{ formatData($installment->due_date) }}</td>
                                      <td>R$ {{ currency($installment->value) }}</td>
                                      <td>{{ $installment->paymentMethod->name }}</td>
                                      <td>{!! $installment->statusLabel  !!}</td>

                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
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

                        <a class="dropdown-item has-icon" href="{{ route('registration.renew', $registration) }}">
                            <i class="fas fa-pencil-alt    "></i> Renovar Matrícula
                        </a>

                        <a class="dropdown-item has-icon" href="{{ route('registration.cancel', $registration) }}">
                            <i class="fas fa-pencil-alt    "></i> Cancelar Matrícula
                        </a>

                        <a class="dropdown-item has-icon" href="{{ route('registration.edit', $registration) }}">
                            <i class="fas fa-pencil-alt    "></i> Editar
                        </a>

                        @endif
                        <x-delete-button class="dropdown-item has-icon"
                            route="{{ route('registration.destroy', $registration) }}"><i
                                class="fas fa-trash-alt"></i>Excluir</x-delete-button>
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
@parent
@include('template.includes.datatable')
<script src="{{ asset('js/config.js') }}"></script>
<script src="{{ asset('js/registration.js') }}"></script>
@endsection