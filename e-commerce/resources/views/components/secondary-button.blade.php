<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-outline-primary btn-pill']) }}>
    {{ $slot }}
</button>