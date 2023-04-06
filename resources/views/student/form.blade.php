
@include('user.form')
<div class="row">
    <div class="col form-group">
        <label>Observações</label>
        <x-form.textarea name="comments" value="">{{ old('comments', $student->comments ?? '') }}</x-form.textarea>

        <div class="mt-4">
            <x-form.switch-button class="mt-4" name="enabled" value="{{ old('enabled', $student->enabled ?? '') }}">Ativo</x-form.switch-button>
        </div>
    </div>
</div>