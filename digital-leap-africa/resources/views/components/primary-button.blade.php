<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary fw-semibold text-uppercase']) }}>
    {{ $slot }}
</button>
