
@include('user.form')

<div class="row">
    <div class="col-12 form-group">
        <label>Observações</label>
        <x-form.textarea name="comments" value="">{{ old('comments', $student->comments ?? '') }}</x-form.textarea>
    </div>

    <div class="col-12 form-group">
        <x-form.switch-button name="enabled" value="{{ old('enabled', $student->enabled ?? 1) }}">Ativo</x-form.switch-button>
    </div>
</div>