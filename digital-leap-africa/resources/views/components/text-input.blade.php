@props(['disabled' => false])

{{-- We are replacing the default classes with our custom theme classes --}}
<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full border-gray-600 bg-primary-light text-gray-200 focus:border-accent focus:ring-accent rounded-md shadow-sm']) !!}>