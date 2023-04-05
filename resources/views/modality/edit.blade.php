@extends('template.main')

@section('title')
    <x-page-title>
        <x-slot name="title">Editar Modalidade</x-slot>
        <x-slot name="breadcrumb">
            <x-breadcrumb-item href="{{ route('modality.index') }}">Modalidades</x-breadcrumb-item>
            <x-breadcrumb-item href="{{ route('modality.show', $modality) }}">{{ $modality->name }}</x-breadcrumb-item>
            <x-breadcrumb-item active>Editar</x-breadcrumb-item>
        </x-slot>
    </x-page-title>
@endsection

@section('content')
<form action="{{ route('modality.update', $modality) }}" method="post">
    <x-card style="primary">
        
            @csrf
            @method('PUT')
            @include('modality.form')
        


    </x-card>
</form>
@endsection