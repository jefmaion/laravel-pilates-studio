@extends('template.main')

@section('content')

<x-page-title>
    <x-slot name="title">Contas a Receber - Informações</x-slot>
    <x-slot name="breadcrumb">
        <x-breadcrumb-item href="{{ route('receive.index') }}">Modalidades</x-breadcrumb-item>
        <x-breadcrumb-item active>Conta a receber</x-breadcrumb-item>
    </x-slot>
</x-page-title>

<div class="row">
    <div class="col-4">
        <x-card style="primary">


            <h3>{{ $account->description }} </h3>

            <x-badge>R$ {{ $account->value }}</x-badge>
            {!! $account->statusLabel !!}
        
        
            {{-- <p class="text-muted">
                Cadastrado em {{ $account->created_at->diffForHumans() }} |
                Editado em {{ $account->updated_at->diffForHumans() }}
            </p> --}}

            <ul class="mt-4">
                @if(isset($account->registration->modality))
                <li>
                    <b>Modalidade:</b> {{ $account->registration->modality->name }}
                </li>
                @endif
                <li>
                    <b>Categoria:</b> {{ $account->category->name }}
                </li>
                <li>
                    <b>Forma:</b> {{ $account->paymentMethod->name }}
                </li>
                <li>
                    <b>Vencimento:</b> {{ $account->date }}
                </li>
            </ul>
        
            
        
            <x-slot name="footer">
                <a name="" id="" class="btn btn-light text-dark" href="{{ route('receive.index') }}" role="button">
                    <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                    Voltar
                </a>

                <a name="" id="" class="btn btn-success  " href="{{ route('receive.edit', $account) }}" role="button">
                    <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                    Editar
                </a>

                @if(!isset($account->registration))
                <x-delete-button class="btn btn-danger" route="{{ route('receive.destroy', $account) }}"><i class="fas fa-trash-alt"></i> Excluir
                </x-delete-button>
                @endif
                <a name="" id="" class="btn btn-success  " href="{{ route('receive.receive', $account) }}" role="button">
                    <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                    Receber
                </a>
        
        
        
                
            </x-slot>
        
        </x-card>
    </div>
</div>


@endsection