@extends('template.main')

@section('content')

<x-page-title>
    <x-slot name="title">{{ $exercice->name }} - <small>Informação do Exercício </small> </x-slot>
    <x-slot name="breadcrumb">
        <x-breadcrumb-item href="{{ route('exercice.index') }}">Modalidades</x-breadcrumb-item>
        <x-breadcrumb-item active>{{ $exercice->name }}</x-breadcrumb-item>
    </x-slot>
</x-page-title>

<x-card style="primary">


    <h3>{{ $exercice->name }}</h3>


    <p class="text-muted">
        Cadastrado em {{ $exercice->created_at->diffForHumans() }} |
        Editado em {{ $exercice->updated_at->diffForHumans() }}
    </p>

    <x-badge-status status="{{ $exercice->enabled }}" />

    <x-slot name="footer">
        <a name="" id="" class="btn btn-light text-dark" href="{{ route('exercice.index') }}" role="button">
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
                <a class="dropdown-item has-icon" href="{{ route('exercice.edit', $exercice) }}"><i class="fas fa-pencil-alt    "></i> Editar</a>
                <x-delete-button class="dropdown-item has-icon" route="{{ route('exercice.destroy', $exercice) }}"><i class="fas fa-trash-alt"></i> Excluir
                </x-delete-button>
            </div>
        </div>
    </x-slot>

</x-card>


@endsection