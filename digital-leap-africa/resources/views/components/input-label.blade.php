@props(['value'])

{{-- We are updating the text color and weight --}}
<label {{ $attributes->merge(['class' => 'form-label fw-semibold text-gray-300']) }}>
    {{ $value ?? $slot }}
</label>