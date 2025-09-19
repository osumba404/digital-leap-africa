@props(['disabled' => false])

{{-- We are replacing the default classes with our custom theme classes --}}
<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'form-control bg-primary-light text-gray-200 border-0']) !!}>