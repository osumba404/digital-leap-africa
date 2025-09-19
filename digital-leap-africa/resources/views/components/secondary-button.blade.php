<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-secondary fw-semibold text-uppercase']) }}>
    {{ $slot }}
</button>
