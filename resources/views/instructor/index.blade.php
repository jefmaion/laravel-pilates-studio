@extends('template.main')

@section('content')

<x-page-title>
    <x-slot name="title">Cadastro de Professores</x-slot>
    <x-slot name="breadcrumb">
        <x-breadcrumb-item active>Professores</x-breadcrumb-item>
    </x-slot>
</x-page-title>

<x-card style="primary">

    <div class="row align-items-center">
        <div class="col">
            <a class="btn btn-lg btn-success " href="{{ route('instructor.create') }}" role="button">
                <i class="fas fa-plus-circle    "></i>
                Novo Professor
            </a>
        </div>
        <div class="col">
            <h5 class="text-right text-muted font-weight-light my-auto">{{ $count }} Professor(es) Cadastrado(s)</h5>
        </div>
    </div>

    <hr>

    <div class="table-responsive">
        <table class="table table-striped datatable" id="table-instructor" style="width:100%">
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
    <script src="{{ asset('js/instructor.js') }}"></script>
@endsection

