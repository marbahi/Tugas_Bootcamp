<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="panel-card p-4 p-sm-5">
                <div class="d-flex align-items-start gap-3 mb-4">
                    <div class="avatar-user">AK</div>
                    <div>
                        <h2 class="font-display fw-bold mb-1 fs-4">Halo, {{ Auth::user()->name }}!</h2>
                        <p class="text-muted small mb-0">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <p class="text-muted">{{ __("You're logged in!") }}</p>

                <div class="d-flex flex-wrap gap-2">
                    <a href="/" class="btn btn-primary btn-pill">Lihat Toko</a>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-pill">Kelola Profil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary btn-pill">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>