@extends('template.main')

@section('content')

<x-page-title>
    <x-slot name="title">Modalidades</x-slot>
    <x-slot name="breadcrumb">
        <x-breadcrumb-item active>Modalidades</x-breadcrumb-item>
    </x-slot>
</x-page-title>

<x-card style="primary">

    <a class="btn btn-lg btn-success " href="{{ route('modality.create') }}" role="button">
        <i class="fas fa-plus-circle    "></i>
        Nova Modalidade
    </a>

    <hr>

    <div class="table-responsive">
        <table class="table table-striped datatable" id="table-modality" style="width:100%">
            <thead>
                <tr>
                    <th width="5%">#</th>
                    <th>Name</th>
                    <th>Status</th>
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
    <script src="{{ asset('js/modality.js') }}"></script>
@endsection
