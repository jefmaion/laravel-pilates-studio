<label class="custom-switch p-0">
    <input type="hidden" class="form-control" name="{{ $attributes['name'] }}" value="0">
    <input type="checkbox" name="{{ $attributes['name'] }}" class="custom-switch-input" value="1" {{ ($attributes['value'] == 1) ? 'checked' : '' }}>
    <span class="custom-switch-indicator"></span>
    <span class="custom-switch-description">{{ $slot }}</span>
</label>