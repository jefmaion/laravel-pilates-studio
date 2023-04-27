

<h5 class="mb-3">Dados Pessoais</h5>
<hr>
@include('user.form')

<h5 class="my-3">Dados Complementares</h5>
<hr>
<div class="row">

    <div class="col form-group">
        <label>Profissão</label>
        <x-form.input name="profession" value="{{ old('profession', $instructor->profession ?? '') }}" />
    </div>

    <div class="col form-group">
        <label>Doc. Conselho Regional (CREF/CREFITO)</label>
        <x-form.input name="profession_register" value="{{ old('profession_register', $instructor->profession_register ?? '') }}" />
    </div>


    <div class="col-12 form-group">
        <label>Observações</label>
        <x-form.textarea name="comments" value="">{{ old('comments', $instructor->comments ?? '') }}</x-form.textarea>

        <div class="mt-4">
            <x-form.switch-button class="mt-4" name="enabled" value="{{ old('enabled', $instructor->enabled ?? '') }}">Ativo</x-form.switch-button>
        </div>
    </div>
</div>