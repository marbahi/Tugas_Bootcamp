<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-danger btn-pill']) }}>
    {{ $slot }}
</button>