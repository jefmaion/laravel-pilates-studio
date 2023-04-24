@extends('template.main')

@section('content')

<x-page-title>
    <x-slot name="title">Matrículas</x-slot>
    <x-slot name="breadcrumb">
        <x-breadcrumb-item active>Matrículas</x-breadcrumb-item>
    </x-slot>
</x-page-title>

<x-card style="primary">
    <a class="btn btn-lg btn-success " href="{{ route('registration.create') }}"  role="button">
        <i class="fas fa-plus-circle"></i>
        Nova Matrícula
    </a>
    <div class="float-right">
        <label class="custom-switch mt-2">
            <input type="checkbox" name="check-list-active" value="{{ route('registration.index') }}" {{ $checked }} class="custom-switch-input">
            <span class="custom-switch-indicator"></span>
            <span class="custom-switch-description">Listar Matrículas Ativas</span>
          </label>
    
    </div>
    <hr>
    <div class="table-responsive">
        <table class="table table-striped  " id="table-registrations" style="width:100%">
            <thead>
                <tr>
                    <th>Aluno</th>
                    <th>Modalidade</th>
                    <th>Data Final</th>
                    <th>Status</th>
                </tr>
            </thead>
        </table>
    </div>
</x-card>

@endsection

@section('scripts')
    @include('template.includes.datatable')
    <script src="{{ asset('js/config.js') }}"></script>
    <script src="{{ asset('js/registration.js') }}"></script>
@endsection