@extends('template.main')

@section('content')

<x-page-title>
    <x-slot name="title">Calendário</x-slot>
    <x-slot name="breadcrumb">
        <x-breadcrumb-item active>Calendario</x-breadcrumb-item>
    </x-slot>
</x-page-title>

<x-card style="primary">
    <div id="myEvent"></div>
</x-card>

@endsection

@section('scripts')
    @include('template.includes.calendar')
@endsection

