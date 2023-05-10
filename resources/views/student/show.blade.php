@extends('template.main')



@section('content')

<x-page-title>
    <x-slot name="title"><small>Informação do Aluno </small> </x-slot>
    <x-slot name="breadcrumb">
        <x-breadcrumb-item href="{{ route('student.index') }}">Alunos</x-breadcrumb-item>
        <x-breadcrumb-item active>Dados do Aluno</x-breadcrumb-item>
    </x-slot>
</x-page-title>

<x-card src="{{ asset($student->user->image) }}" class="author-box">

    <div class="author-box-left">
        <img alt="image" src="{{ asset($student->user->image) }}" class="rounded-circle author-box-picture">
        <div class="clearfix"></div>
    </div>

    <div class="author-box-details">

        <div class="author-box-name">
            <h2>{{ $student->user->name }}</h2>
        </div>

        <div class="author-box-job text-muted">
            Cadastrado em {{ $student->created_at->diffForHumans() }} |
            Editado em {{ $student->updated_at->diffForHumans() }}
        </div>

        <div class="author-box-description">
            <x-badge-status status="{{ $student->enabled }}" />
        </div>

    </div>



  

    <x-slot name="footer">

        <a name="" id="" class="btn btn-light text-dark" href="{{ route('student.index') }}" role="button">
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
                <a class="dropdown-item has-icon"
                    href="{{ route('avatar.index', [$student->user, 'to' => Request::path()]) }}"><i
                        class="fas fa-image    "></i> Trocar Foto</a>
                <a class="dropdown-item has-icon" href="{{ route('student.edit', $student) }}"><i
                        class="fas fa-pencil-alt    "></i> Editar</a>

                        <a class="dropdown-item has-icon" href="{{ route('registration.show', $student) }}"><i
                            class="fas fa-pencil-alt    "></i> Editar</a>                        
                <x-delete-button class="dropdown-item has-icon" route="{{ route('student.destroy', $student) }}"><i
                        class="fas fa-trash-alt"></i> Excluir
                </x-delete-button>
            </div>
        </div>
    </x-slot>

</x-card>

<x-card>
    <ul class="mt-4 nav nav-tabs" id="myTab2" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#home2" role="tab" aria-controls="home"
                aria-selected="true">Evoluções</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile"
                aria-selected="false">Aulas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab2" data-toggle="tab" href="#contact2" role="tab" aria-controls="contact"
                aria-selected="false">Mensalidades</a>
        </li>
    </ul>
    <div class="tab-content tab-bordered" id="myTab3Content">
        <div class="tab-pane fade active show" id="home2" role="tabpanel" aria-labelledby="home-tab2">
            <div class="table-responsive">
                <div class="table-responsive">
                    <table class="table table-striped datatable" id="table-evolutions" style="width:100%">
                        <thead>
                            <tr>
                                <th>Aula</th>
                                <th>Professor</th>
                                <th>Resumo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($student->evolutions as $evol)
                           <tr>
                                <td>{{ $evol->date }}</td>
                                <td>{{ $evol->instructor->user->name }}</td>
                                <td>{{ Str::words(strip_tags($evol->evolution),15) }}</td>
                           </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="profile-tab2">
            <div class="table-responsive">
                <table class="table table-striped datatable" id="table-evolutions" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Aula</th>
                            <th>Modalidade</th>
                            <th>Professor</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($student->classes as $class)
                        <tr>
                            <td></td>
                            <td>{{ $class->date }} {{ $class->time }}</td>
                            <td>{{ $class->registration->modality->name }}</td>
                            <td>{{ $class->instructor->user->name }}</td>
                            <td>{{ $class->classStatus }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="contact2" role="tabpanel" aria-labelledby="contact-tab2">
            <div class="table-responsive">
                <table class="table table-striped datatable" id="table-installments" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Vencimento</th>
                            <th>Pagamento</th>
                            <th>Valor</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($student->installments as $installment)
                        <tr>
                            <td>{{ $installment->registration->modality->name }}</td>
                            <td>{{ $installment->date }}</td>
                            <td>{{ $installment->payDate }}</td>
                            <td>{{ $installment->value }} </td>
                            <td>{!! $installment->statusLabel !!}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-card>


@endsection

@section('scripts')
@include('template.includes.datatable')
<script src="{{ asset('js/config.js') }}"></script>
<script>
    dataTable('.datatable')
</script>
@endsection