@extends('template.main')

@section('title')
    <x-page-title>
        <x-slot name="title">Nova Modalidade</x-slot>
        <x-slot name="breadcrumb">
            <x-breadcrumb-item href="{{ route('student.index') }}">Modalidades</x-breadcrumb-item>
            <x-breadcrumb-item active>Novo</x-breadcrumb-item>
        </x-slot>
    </x-page-title>
@endsection

@section('content')
<form action="{{ route('modality.store') }}" method="post">
    @csrf
    <x-card style="primary">
        @include('modality.form')
    </x-card>
</form>
@endsection