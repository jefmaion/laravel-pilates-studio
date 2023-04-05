@props(['isInvalid' => ($errors->has($attributes['name'])) ? 'is-invalid' : null])

<input {{ $attributes->merge(['class' => 'form-control ' . $isInvalid]) }} >

<x-form.invalid-feedback name="{{ $attributes['name'] }}" />

