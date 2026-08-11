<x-guest-layout>
    <h2 class="font-display fw-bold mb-1">Lupa Password</h2>
    <p class="text-muted small mb-4">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </p>

    <x-auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <a class="small text-muted text-decoration-underline" href="{{ route('login') }}">
                {{ __('Back to login') }}
            </a>

            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>