@extends('template.main')

@section('content')

<x-page-title>
    <x-slot name="title">Cadastro de Alunos</x-slot>
    <x-slot name="breadcrumb">
        <x-breadcrumb-item active>Alunos</x-breadcrumb-item>
    </x-slot>
</x-page-title>

<x-card style="primary">

    <a class="btn btn-lg btn-success " href="{{ route('student.create') }}" role="button">
        <i class="fas fa-plus-circle    "></i>
        Novo Aluno
    </a>

    <hr>

    <div class="table-responsive">
        <table class="table table-striped datatable" style="width:100%">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Name</th>
                    <th>Telefone</th>
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
    <script src="{{ asset('js/student.js') }}"></script>
@endsection

