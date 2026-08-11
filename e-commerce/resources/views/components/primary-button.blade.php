<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary btn-pill']) }}>
    {{ $slot }}
</button>