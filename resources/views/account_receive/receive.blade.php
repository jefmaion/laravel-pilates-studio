@extends('template.main')

@section('content')

<x-page-title>
    <x-slot name="title">Contas a Receber - Receber</x-slot>
    <x-slot name="breadcrumb">
        <x-breadcrumb-item href="{{ route('receive.index') }}">Modalidades</x-breadcrumb-item>
        <x-breadcrumb-item active>Conta a receber</x-breadcrumb-item>
    </x-slot>
</x-page-title>

<div class="row">
    <div class="col-6">
        <form action="{{ route('receive.update', [$account, 'to' => Request::get('to')]) }}" method="post">
            @csrf
            @method('put')
            <input type="hidden" name="status" value="1">
        <x-card style="primary">

           
            <div class="row">

                <div class="col-4 form-group">
                    <label>Vencimento</label>
                    <x-form.input type="date" name="date" value="{{ $account->date }}" disabled />
                </div>
  
                <div class="col-8 form-group">
                    <label>Valor inicial </label>
                    <x-form.input name="value" value="{{ old('value', $account->value) }}" disabled />
                </div>

                <div class="col-12 form-group">
                    <label>Descrição</label>
                    <x-form.input name="description" value="{{ old('description', $account->description) }}" />
                </div>

                <div class="col-4 form-group">
                    <label>Data de Pagamento</label>
                    <x-form.input type="date" name="pay_date" value="{{ date('Y-m-d') }}" />
                </div>

                <div class="col-8 form-group">
                    <label>Valor a Pagar </label>
                    <x-form.input name="amount" value="{{ old('amount', $account->amount) }}" />
                </div>

                <div class="col-4 form-group">
                    <label>Forma de Pagamento</label>
                    <x-form.select name="payment_method_id" :options="$paymentMethods" value="{{ old('payment_method_id', $account->payment_method_id)  }}" />
                </div>

                <div class="col-8 form-group">
                    <label>Categoria</label>
                    <x-form.select name="category_id" :options="$categories" value="{{ old('category_id', $account->category_id) }}" />
                </div>
            
                <div class="col-12 form-group">
                    <label>Observações</label>
                    <x-form.textarea name="comments" value=""></x-form.textarea>  
                </div>
            </div>
        
                <x-slot name="footer">
                
                <a name="" id="" class="btn btn-light text-dark" href="{{ route('receive.index') }}" role="button">
                    <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                    Voltar
                </a>

                <button type="submit" class="btn btn-success">Receber</button>

                </x-slot>
            
        
            
        
        </x-card>
    </form>
    </div>
</div>


@endsection