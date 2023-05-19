@extends('template.main')

@section('title')
    <x-page-title>
        <x-slot name="title">Editar Matrícula</x-slot>
        <x-slot name="breadcrumb">
            <x-breadcrumb-item href="{{ route('registration.index') }}">Matrículas</x-breadcrumb-item>
            <x-breadcrumb-item href="{{ route('registration.show', $registration) }}">{{ $registration->student->user->name }}</x-breadcrumb-item>
            <x-breadcrumb-item active>Editar</x-breadcrumb-item>
        </x-slot>
    </x-page-title>
@endsection

@section('content')
<form action="{{ route('registration.update', $registration) }}" method="post">

        @csrf
        @method('PUT')
        @include('registration.form')
        

</form>
@endsection