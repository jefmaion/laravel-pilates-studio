@props(['isInvalid' => ($errors->has($attributes['name'])) ? 'is-invalid' : null])

<select {{ $attributes->merge(['class' => 'form-control ' . $isInvalid]) }}>
    <option value="">{{ $placeholder ?? '' }}</option>
    @foreach($options as $option)
    <option value="{{ $option['value'] }}" {{ $option['selected'] }}>{{ $option['label'] }}</option>
    @endforeach

  </select>

  <x-form.invalid-feedback name="{{ $attributes['name'] }}" />