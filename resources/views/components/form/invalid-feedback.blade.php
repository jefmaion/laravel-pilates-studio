@if($errors->has($attributes['name']))
    <div class="invalid-feedback">
        {{ $errors->first($attributes['name']) }}
    </div>
@endif