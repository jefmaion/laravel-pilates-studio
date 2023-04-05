@props(['isInvalid' => ($errors->has($attributes['name'])) ? 'is-invalid' : null])

<textarea {{ $attributes->merge(['class' => 'form-control ' . $isInvalid]) }} >{{ $slot }}</textarea>

<x-form.invalid-feedback name="{{ $attributes['name'] }}" />

