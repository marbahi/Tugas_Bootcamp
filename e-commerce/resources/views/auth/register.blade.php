<x-guest-layout>
    <h2 class="font-display fw-bold mb-1">Daftar</h2>
    <p class="text-muted small mb-4">Buat akun untuk mulai berbelanja.</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama lengkap" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="mb-3">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="mb-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="d-flex align-items-center justify-content-end">
            <x-primary-button>
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <hr class="section-hr">

        <p class="small text-muted mb-0">
            Sudah punya akun?
            <a class="fw-semibold text-decoration-none" href="{{ route('login') }}">Masuk</a>
        </p>
    </form>
</x-guest-layout>