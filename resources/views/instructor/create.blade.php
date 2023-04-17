@extends('template.main')

@section('title')
    <x-page-title>
        <x-slot name="title">Novo Professor</x-slot>
        <x-slot name="breadcrumb">
            <x-breadcrumb-item href="{{ route('instructor.index') }}">Professores</x-breadcrumb-item>
            <x-breadcrumb-item active>Novo Professor</x-breadcrumb-item>
        </x-slot>
    </x-page-title>
@endsection

@section('content')
<form action="{{ route('instructor.store') }}" method="post" >
    <x-card style="primary">
        @csrf
        @include('instructor.form')
        <x-slot name="footer">  
            <a name="" id="" class="btn btn-light text-dark" href="{{ route('instructor.index') }}" role="button">
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
@endsection