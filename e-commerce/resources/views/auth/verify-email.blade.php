<x-guest-layout>
    <h2 class="font-display fw-bold mb-3">Verifikasi Email</h2>
    <p class="text-muted small">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success py-2">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mt-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <x-primary-button>
                {{ __('Resend Verification Email') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="btn btn-link p-0 small text-decoration-underline">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>