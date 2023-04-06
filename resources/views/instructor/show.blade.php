@extends('template.main')

@section('content')

<x-page-title>
    <x-slot name="title"><small>Informação do Professor </small> </x-slot>
    <x-slot name="breadcrumb">
        <x-breadcrumb-item href="{{ route('instructor.index') }}">Professores</x-breadcrumb-item>
        <x-breadcrumb-item active>Dados do Professor</x-breadcrumb-item>
    </x-slot>
</x-page-title>

<x-card  src="{{ asset($instructor->user->image) }}" class="author-box">

    <div class="author-box-left">
        <img alt="image" src="{{ asset($instructor->user->image) }}" class="rounded-circle author-box-picture">
        <div class="clearfix"></div>
    </div>

    <div class="author-box-details">
        
        <div class="author-box-name">
            <h2>{{ $instructor->user->name }}</h2>
        </div>

        <div class="author-box-job text-muted">
            {{ $instructor->profession }} 

            @foreach($instructor->modalities as $modality) 
            |  {{ $modality->name }}
            @endforeach
        </div>

        <div class="mt-3 author-box-job text-muted">
            Cadastrado em {{ $instructor->created_at->diffForHumans() }} |
            Editado em {{ $instructor->updated_at->diffForHumans() }}
        </div>

        <div class="author-box-description">
            <x-badge-status status="{{ $instructor->enabled }}" />
        </div>

    </div>

    <x-slot name="footer">

        <a name="" id="" class="btn btn-light text-dark" href="{{ route('instructor.index') }}" role="button">
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
                <a class="dropdown-item has-icon" href="{{ route('avatar.index', $instructor->user) }}"><i class="fas fa-image    "></i> Trocar Foto</a>
                <a class="dropdown-item has-icon" href="{{ route('instructor.edit', $instructor) }}"><i class="fas fa-pencil-alt    "></i> Editar</a>
                <x-delete-button class="dropdown-item has-icon" route="{{ route('instructor.destroy', $instructor) }}"><i class="fas fa-trash-alt"></i> Excluir</x-delete-button>
                <a class="dropdown-item has-icon" href="{{ route('instructor.modality.index', $instructor) }}"><i class="fas fa-pencil-alt    "></i> Modalidades</a>
            </div>
        </div>
    </x-slot>

</x-card>

@endsection