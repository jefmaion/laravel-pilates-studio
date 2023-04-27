@extends('template.main')

@section('content')

    <x-page-title>
        <x-slot name="title">Mensalidades</x-slot>
        <x-slot name="breadcrumb">
            <x-breadcrumb-item active>Contas a Receber</x-breadcrumb-item>
        </x-slot>
    </x-page-title>

    <x-card style="primary">

        

        <div class="row align-items-center">
            <div class="col">
                <a class="btn btn-lg btn-success " href="{{ route('modality.create') }}" role="button">
                    <i class="fas fa-plus-circle    "></i>
                    Novo
                </a>
            </div>
            <div class="col">
                
            </div>
        </div>

        <hr>

        <div class="table-responsive">
            <table class="table table-striped datatable" id="table-modality" style="width:100%">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Vencimento</th>
                        <th>Valor</th>
                        <th>Aluno</th>
                        <th>Valor</th>
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
    <script src="{{ asset('js/installment.js') }}"></script>
@endsection
