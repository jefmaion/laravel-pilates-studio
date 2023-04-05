@extends('template.main')

@section('title')
    <x-page-title>
        <x-slot name="title">Novo Exercício/Aparelho</x-slot>
        <x-slot name="breadcrumb">
            <x-breadcrumb-item href="{{ route('exercice.index') }}">Exercícios/Aparelhos</x-breadcrumb-item>
            <x-breadcrumb-item active>Novo</x-breadcrumb-item>
        </x-slot>
    </x-page-title>
@endsection

@section('content')
<form action="{{ route('exercice.store') }}" method="post">
    @csrf
    <x-card style="primary">
        @include('exercice.form')
    </x-card>
</form>
@endsection