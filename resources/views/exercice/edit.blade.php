@extends('template.main')

@section('title')
    <x-page-title>
        <x-slot name="title">Editar Exercício/Aparelho</x-slot>
        <x-slot name="breadcrumb">
            <x-breadcrumb-item href="{{ route('exercice.index') }}">Exercício/Aparelhos</x-breadcrumb-item>
            <x-breadcrumb-item href="{{ route('exercice.show', $exercice) }}">{{ $exercice->name }}</x-breadcrumb-item>
            <x-breadcrumb-item active>Editar</x-breadcrumb-item>
        </x-slot>
    </x-page-title>
@endsection

@section('content')
<form action="{{ route('exercice.update', $exercice) }}" method="post">
    <x-card style="primary">
        
            @csrf
            @method('PUT')
            @include('exercice.form')
        


    </x-card>
</form>
@endsection