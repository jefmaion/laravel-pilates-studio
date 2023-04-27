@extends('template.main')

@section('title')
    <x-page-title>
        <x-slot name="title">Editar Conta a Pagar</x-slot>
        <x-slot name="breadcrumb">
            <x-breadcrumb-item href="{{ route('receive.index') }}">Exercício/Aparelhos</x-breadcrumb-item>
            <x-breadcrumb-item href="{{ route('receive.show', $account) }}">{{ $account->name }}</x-breadcrumb-item>
            <x-breadcrumb-item active>Editar</x-breadcrumb-item>
        </x-slot>
    </x-page-title>
@endsection

@section('content')
<form action="{{ route('receive.update', $account) }}" method="post">
    <x-card style="primary">
        
            @csrf
            @method('PUT')
            @include('account_receive.form')
        


    </x-card>
</form>
@endsection