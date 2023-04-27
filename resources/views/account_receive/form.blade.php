<div class="row">

    <div class="col-4 form-group">
        <label>Data de Pagamento</label>
        <x-form.input type="date" name="date" value="{{ date('Y-m-d') }}" />
    </div>

    <div class="col-8 form-group">
        <label>Valor a Receber </label>
        <x-form.input name="value" value="{{ old('value', $account->value) }}" />
    </div>                
            
    <div class="col-12 form-group">
        <label>Descrição</label>
        <x-form.input name="description" value="{{ old('description', $account->description) }}" />
    </div>

    <div class="col-12 form-group">
        <label>Receber de:</label>
        <x-form.select name="student_id" :options="$students" value="{{ old('category_id', $account->category_id) }}" />
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


    <div class="col form-group">
        <x-form.switch-button class="mt-4" name="status" value="{{ old('status', $account->status) }}" >Pago</x-form.switch-button>
    </div>
</div>


<x-slot name="footer">

    <a name="" id="" class="btn btn-light text-dark" href="{{ route('receive.index') }}" role="button">
        <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
        Voltar
    </a>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-check-circle    "></i>
        Salvar
    </button>
</x-slot>
