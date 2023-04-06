@extends('template.main')

@section('title')
    <x-page-title>
        <x-slot name="title">Editar Aluno</x-slot>
        <x-slot name="breadcrumb">
            <x-breadcrumb-item href="{{ route('student.index') }}">Alunos</x-breadcrumb-item>
            <x-breadcrumb-item href="{{ route('student.show', $student) }}">{{ $student->user->name }}</x-breadcrumb-item>
            <x-breadcrumb-item active>Editar</x-breadcrumb-item>
        </x-slot>
    </x-page-title>
@endsection

@section('content')
<form action="{{ route('student.update', $student) }}" method="post">
    <x-card style="primary">
        @csrf
        @method('PUT')
        @include('student.form', ['user' => $student->user])
        <x-slot name="footer">
            <a name="" id="" class="btn btn-light text-dark" href="{{ route('student.index') }}" role="button">
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