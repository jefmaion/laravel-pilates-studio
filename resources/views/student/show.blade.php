@extends('template.main')

@section('content')

<x-page-title>
    <x-slot name="title"><small>Informação do Aluno </small> </x-slot>
    <x-slot name="breadcrumb">
        <x-breadcrumb-item href="{{ route('student.index') }}">Alunos</x-breadcrumb-item>
        <x-breadcrumb-item active>Dados do Aluno</x-breadcrumb-item>
    </x-slot>
</x-page-title>

<x-card>


    <h3>{{ $student->user->name }}</h3>


    <p class="text-muted">
        Cadastrado em {{ $student->created_at->diffForHumans() }} |
        Editado em {{ $student->updated_at->diffForHumans() }}
    </p>

    <x-badge-status status="{{ $student->enabled }}" />

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
                <a class="dropdown-item has-icon" href="{{ route('student.edit', $student) }}"><i class="fas fa-pencil-alt    "></i> Editar</a>
                <x-delete-button class="dropdown-item has-icon" route="{{ route('student.destroy', $student) }}"><i class="fas fa-trash-alt"></i> Excluir
                </x-delete-button>
            </div>
        </div>
    </x-slot>

</x-card>

<x-card>
    
</x-card>


@endsection