@extends('template.main')

@section('content')

    <x-page-title>
        <x-slot name="title">Contas a Receber</x-slot>
        <x-slot name="breadcrumb">
            <x-breadcrumb-item active>Contas a Receber</x-breadcrumb-item>
        </x-slot>
    </x-page-title>

    <x-card style="primary">

        

        <div class="row align-items-center">
            <div class="col">
                <a class="btn btn-lg btn-success " href="{{ route('receive.create') }}" role="button">
                    <i class="fas fa-plus-circle    "></i>
                    Novo
                </a>
            </div>
            <div class="col">
                
            </div>
        </div>

        <hr>

        <div class="table-responsive">
            <table class="table table-striped datatable table-ssm" id="table-modality" style="width:100%">
                <thead>
                    <tr>
                        
                        
                        <th>Vencimento</th>
                        <th>Descrição</th>
                        <th>Categoria</th>
                        <th>Forma</th>
                        <th>Status</th>
                        <th>Valor a Receber</th>
                        <th>Valor Recebido</th>
                        <th>Data Pagamento</th>
                    </tr>
                </thead>
            </table>
        </div>
    </x-card>

@endsection



@section('body')
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                Body
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    @parent
    @include('template.includes.datatable')
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/account_receive.js') }}"></script>
@endsection
