@props([
    '_theme' => $attributes['theme'] ?? 'light'
])

<span {{ $attributes->merge(['class' => 'badge badge-pill badge-'.$_theme]) }}>
    {{ $slot  }}
</span>