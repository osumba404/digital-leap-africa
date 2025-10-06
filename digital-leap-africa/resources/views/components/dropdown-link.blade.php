@props(['active' => false])

@php
    $classes = ($active ?? false)
                ? 'dropdown-item active'
                : 'dropdown-item';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>