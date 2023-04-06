@extends('template.main')

@section('title')
    <x-page-title>
        <x-slot name="title">Editar Professor</x-slot>
        <x-slot name="breadcrumb">
            <x-breadcrumb-item href="{{ route('registration.index') }}">Professores</x-breadcrumb-item>
            <x-breadcrumb-item href="{{ route('registration.show', $registration) }}">{{ $registration->student->user->name }}</x-breadcrumb-item>
            <x-breadcrumb-item active>Editar</x-breadcrumb-item>
        </x-slot>
    </x-page-title>
@endsection

@section('content')
<form action="{{ route('registration.update', $registration) }}" method="post">
    <x-card style="primary">
        @csrf
        @method('PUT')
        @include('registration.form')
        <x-slot name="footer">
            <a name="" id="" class="btn btn-light text-dark" href="{{ route('registration.index') }}" role="button">
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