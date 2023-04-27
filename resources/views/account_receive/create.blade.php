@extends('template.main')

@section('title')
    <x-page-title>
        <x-slot name="title">Novo Exercício/Aparelho</x-slot>
        <x-slot name="breadcrumb">
            <x-breadcrumb-item href="{{ route('receive.index') }}">Exercícios/Aparelhos</x-breadcrumb-item>
            <x-breadcrumb-item active>Novo</x-breadcrumb-item>
        </x-slot>
    </x-page-title>
@endsection

@section('content')
<div class="row">
    <div class="col-6">
        <form action="{{ route('receive.store') }}" method="post">
            @csrf
            <x-card style="primary">
                @include('account_receive.form')
            </x-card>
        </form>
    </div>
</div>
@endsection