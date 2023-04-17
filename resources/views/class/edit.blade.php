@extends('template.main')

@section('title')
    <x-page-title>
        <x-slot name="title">Editar Aula</x-slot>
        <x-slot name="breadcrumb">
            <x-breadcrumb-item href="{{ route('class.index') }}">Exercício/Aparelhos</x-breadcrumb-item>
            <x-breadcrumb-item href="{{ route('class.show', $class) }}">{{ $class->name }}</x-breadcrumb-item>
            <x-breadcrumb-item active>Editar</x-breadcrumb-item>
        </x-slot>
    </x-page-title>
@endsection

@section('content')
<form action="{{ route('class.update', $class) }}" method="post">
    <x-card style="primary">
        @csrf
        @method('PUT')
        @include('class.form')
    </x-card>
</form>
@endsection