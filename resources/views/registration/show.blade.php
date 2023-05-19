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

    <div class="col-8 d-flex">
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
                                <h6 class="font-weight-light">
                                    Período: {{ formatData($registration->start) }} até {{ formatData($registration->end) }}
                                </h6>

                                {!! $registration->statusName !!}

                                @if(!empty($registration->comments))
                                <h6 class="font-weight-light">
                                    Comentários: {{ $registration->comments }}
                                </h6>
                                @endif

                                @if($registration->status == 0 && !empty($registration->cancel_comments))
                                <h6 class="font-weight-light"> Cancelado em: {{ formatData($registration->cancel_date) }} - Motivo: {{ $registration->cancel_comments }}</h6>
                                @endif

                                
                                
                            </div>
                            <div class="author-box-description"></div>
                        </div>
                        
                    </div>
                </div>
                <div class="col text-right">
                    
                    <h6 class="font-weight-light text-muted">
                    Aulas:
                    @foreach($registration->weekClass as $wk)
                    <div class="mt-2">{{ $wk->weekName }} às {{ $wk->time }}</div>
                    @endforeach
                    </h6>

                    
                    
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
                        <i class="fas fa-cogs"></i>
                        Gerenciar
                    </button>
                    <div class="dropdown-menu" x-placement="bottom-start">
                        @if($registration->status > 0)

                            <a class="dropdown-item has-icon" href="{{ route('registration.renew', $registration) }}">
                                <i class="fas fa-sync    "></i> Renovar Matrícula
                            </a>
        
                            @if($registration->daysToRenew > 0)
                            <a class="dropdown-item has-icon" href="#" data-toggle="modal" data-target="#modelId">
                                <i class="fas fa-stop-circle    "></i> Cancelar Matrícula
                            </a>

                            <a class="dropdown-item has-icon" href="{{ route('registration.edit', $registration) }}">
                                <i class="fas fa-pencil-alt"></i> Editar
                            </a>
                            @endif

                            @if($registration->daysToRenew <= 0)
                            <a class="dropdown-item has-icon" href="#" data-toggle="modal" data-target="#modal-finalize">
                                <i class="fas fa-stop-circle    "></i> Finalizar Matrícula
                            </a>
                            @endif
        
                           
                        @endif
                        {{-- <x-delete-button class="dropdown-item has-icon"
                            route="{{ route('registration.destroy', $registration) }}">
                            <i class="fas fa-trash-alt"></i>Excluir
                        </x-delete-button> --}}
                    </div>
                </div>
            </x-slot>
        </x-card>
    </div>

    <div class="col d-flex">
        <div class="row flex-fill">
            <div class="col-xl-6 col-lg-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-body card-type-3">
                        <div class="row">
                            <div class="col">

                                <span class="font-weight-bold mb-0 h4">{{ $registration->countClasses() }}</span>
                                <h6 class="text-muted mb-0">Aulas</h6>
                            </div>
                            <div class="col-auto">
                                <div class="card-circle bg-primary text-white">
                                    <i class="fas fa-calendar"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-body card-type-3">
                        <div class="row">
                            <div class="col">
                                <span class="font-weight-bold mb-0 h4">{{ $registration->countClasses('presences')
                                    }}</span>
                                <h6 class="text-muted mb-0">Presenças</h6>
                            </div>
                            <div class="col-auto">
                                <div class="card-circle bg-success text-white">
                                    <i class="fas fa-calendar-check    "></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-body card-type-3">
                        <div class="row">
                            <div class="col">
                                <span class="font-weight-bold mb-0 h4">{{ $registration->countClasses('absenses')
                                    }}</span>
                                <h6 class="text-muted mb-0">Faltas</h6>
                            </div>
                            <div class="col-auto">
                                <div class="card-circle bg-danger text-white">
                                    <i class="fas fa-calendar-times    "></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-body card-type-3">
                        <div class="row">
                            <div class="col">
                                <span class="font-weight-bold mb-0 h4">{{ $registration->countClasses('remarks')
                                    }}</span>
                                <h6 class="text-muted mb-0">Reposições</h6>
                            </div>
                            <div class="col-auto">
                                <div class="card-circle bg-info text-white">
                                    <i class="fas fa-sync    "></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <div class="col-12">
        <x-card>
            <x-slot name="title">
                Mensalidades
            </x-slot>
            <div class="table-responsive">
                <x-table class="table-font">
                    <thead>
                        <tr>
                            <th width="10%" class="text-center">Status</th>
                            <th width="8%">Data de Vencto</th>
                            <th width="9%">Valor</th>
                            <th width="9%">Forma</th>
                            <th>Descrição</th>
                            
                            <th width="9%">Data de Pagto</th>
                            <th>Recebido Por</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registration->installments as $installment)
                        <tr>
                            <td class="text-center">{!! $installment->statusLabel !!}</td>
                            <td>
                                @if($installment->status == 0)
                                <a href="{{ route('receive.receive', [$installment, 'to' => Request::path()]) }}">
                                    {{ formatData($installment->date) }}
                                </a>
                                @else
                                {{ formatData($installment->date) }}
                                @endif
                            </td>
                            <td><b>R$ {{ currency($installment->amount) }}</b></td>
                            <td>{{ $installment->paymentMethod->name }}</td>
                            <td>{{ $installment->description }}</td>
                            
                            <td>{{ formatData($installment->pay_date) ?? '-' }}</td>
                            <td>
                                @if($installment->user)
                                <img alt="image" src="{{ asset($installment->user->image) }}" class="rounded-circle" width="35" data-toggle="tooltip" title="" data-original-title="{{ $installment->user->name }}">
                                {{ $installment->user->name }}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </x-table>
            </div>
        </x-card>


        <x-card>
            <div>
                <x-slot name="title">
                    Aulas 
                </x-slot>
                <div class="table-responsive">

                    {{-- <a name="" id="" class="btn btn-primary" href="{{ route('registration.class', $registration) }}" role="button">Plano de Aula</a> --}}

                    <x-table class="table-font">
                        <thead>
                            <tr>
                                <th width="10%" class="text-center">Status</th>
                                <th wwidth="8%">Data</th>
                                <th wwidth="8%">Hora</th>
                                <th wwidth="8%">Tipo</th>
                                
                                <th wwidth="15%">Professor</th>
                                <th width="30%">Evolução</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($registration->classes as $class)
                            <tr>
                                <td class="text-center">{!! $class->classStatusBadge !!}</td>
                                <td>{{ formatData($class->date) }} {{ $class->weekname}} </td>
                                <td>{{ $class->time }}</td>
                                <td>{{ $class->classType }}</td>
                                
                                <td>
                                    <img alt="image" src="{{ asset($class->instructor->user->image) }}"
                                        class="rounded-circle" width="35" data-toggle="tooltip" title=""
                                        data-original-title="{{ $class->instructor->user->name }}">
                                    {{ $class->instructor->user->name }}
                                </td>
                                <td>{{ Str::words($class->evolution, 20) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </x-table>
                </div>
            </div>
        </x-card>

        
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('registration.abort', $registration) }}" method="post" >
                @csrf
                <div class="modal-header bg-whitesmoke  p-3">
                    <h5 class="modal-title">
                        Cancelar Matrícula
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Deseja realmente cancelar essa matrícula?</p>
        
                    <x-form.textarea name="comments" rows="5" placeholder="Motivo do cancelamento" value=""></x-form.textarea>

                    <x-form.switch-button class="mt-2" name="remove_class">Excluir aulas não realizadas</x-form.switch-button>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Fechar</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check-circle    "></i>
                        Confirmar Cancelamento
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-finalize" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('registration.finish', $registration) }}" method="post" >
                @csrf
                <div class="modal-header bg-whitesmoke  p-3">
                    <h5 class="modal-title">
                        Finalizar Matrícula
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Deseja realmente finalizar a matrícula?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Fechar</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check-circle    "></i>
                        Finalizar Matrícula
                    </button>
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
@endsection