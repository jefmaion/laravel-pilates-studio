<div class="row">

    <div class="col-12 form-group">
        <label>Nome da Modalidade</label>
        <x-form.input name="name" value="{{ old('name', $modality->name) }}" />
    </div>

    <div class="col-12 form-group">
        <x-form.switch-button name="enabled" value="{{ old('enabled', $modality->enabled) }}">Ativo</x-form.switch-button>
    </div>

</div>


<x-slot name="footer">

    <a name="" id="" class="btn btn-light text-dark" href="{{ route('modality.index') }}" role="button">
        <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
        Voltar
    </a>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-check-circle    "></i>
        Salvar
    </button>
</x-slot>
