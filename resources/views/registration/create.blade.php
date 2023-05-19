@extends('template.main')

@section('title')
    <x-page-title>
        <x-slot name="title">Nova Matrícula</x-slot>
        <x-slot name="breadcrumb">
            <x-breadcrumb-item href="{{ route('registration.index') }}">Matrículas</x-breadcrumb-item>
            <x-breadcrumb-item active>Novo</x-breadcrumb-item>
        </x-slot>
    </x-page-title>
@endsection

@section('content')
    <form action="{{ route('registration.store') }}" method="post" >
        @csrf
        <div class="row">
            <div class="col-12">
                @include('registration.form')
            </div>
        </div>
    </form>
@endsection