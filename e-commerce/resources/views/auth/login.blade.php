<x-guest-layout>
    <h2 class="font-display fw-bold mb-1">Masuk</h2>
    <p class="text-muted small mb-4">Selamat datang kembali di toko kami.</p>

    <x-auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="mb-3">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="form-check mb-4">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label for="remember_me" class="form-check-label small text-muted">{{ __('Remember me') }}</label>
        </div>

        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            @if (Route::has('password.request'))
                <a class="small text-muted text-decoration-underline" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <hr class="section-hr">

        <p class="small text-muted mb-0">
            Belum punya akun?
            <a class="fw-semibold text-decoration-none" href="{{ route('register') }}">Daftar sekarang</a>
        </p>
    </form>
</x-guest-layout>