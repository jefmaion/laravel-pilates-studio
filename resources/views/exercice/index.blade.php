@extends('template.main')

@section('content')

<x-page-title>
    <x-slot name="title">Exercícios/Aparelhos</x-slot>
    <x-slot name="breadcrumb">
        <x-breadcrumb-item active>Exercícios/Aparelhos</x-breadcrumb-item>
    </x-slot>
</x-page-title>

<x-card style="primary">

    <div class="row align-items-center">
        <div class="col">
            <a class="btn btn-lg btn-success " href="{{ route('exercice.create') }}" role="button">
                <i class="fas fa-plus-circle    "></i>
                Novo Exercicio/Aparelho
            </a>
        </div>
        <div class="col">
            <h5 class="text-right text-muted font-weight-light my-auto">{{ $count }} Exercícios(s) Cadastrado(s)</h5>
        </div>
    </div>

    <hr>

    <div class="table-responsive">
        <table class="table table-striped datatable" id="table-exercice" style="width:100%">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Data de Cadastro</th>
                </tr>
            </thead>
        </table>
    </div>
</x-card>

@endsection

@section('scripts')
    @include('template.includes.datatable')
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/exercice.js') }}"></script>
@endsection
