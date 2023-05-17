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
            <div class="col-7">
                <x-card style="primary">
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
    </div>
    </div>
    
</form>
@endsection