<div class="row">

    <div class="col-3 form-group">
        <label>Tipo</label>
        <x-form.select name="type" :options="['AP' => 'Aparelho', 'EX' => 'Exercício']"  value="{{ $exercice->type }}" />
    </div>

    <div class="col-12 form-group">
        <label>Nome</label>
        <x-form.input name="name" value="{{ old('name', $exercice->name) }}" />
    </div>

    

    <div class="col-12 form-group">
        <label>Descrição</label>
        <x-form.text-area name="description" >{{ old('description', $exercice->description) }}</x-form.text-area>
    </div>

    <div class="col-12 form-group">
        <x-form.switch-button name="enabled" value="{{ old('enabled', $exercice->enabled) }}">Ativo</x-form.switch-button>
    </div>

</div>


<x-slot name="footer">

    <a name="" id="" class="btn btn-light text-dark" href="{{ route('exercice.index') }}" role="button">
        <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
        Voltar
    </a>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-check-circle    "></i>
        Salvar
    </button>
</x-slot>
