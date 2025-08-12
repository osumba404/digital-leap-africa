@props(['value'])

{{-- We are updating the text color and weight --}}
<label {{ $attributes->merge(['class' => 'block font-semibold text-sm text-gray-300']) }}>
    {{ $value ?? $slot }}
</label>