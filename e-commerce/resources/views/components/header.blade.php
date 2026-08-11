<header class="site-header">
    <nav class="py-2 border-bottom border-light-subtle">
        <div class="container d-flex flex-wrap align-items-center">
            <ul class="nav nav-flat me-auto">
                <li class="nav-item"><a href="#" class="nav-link active" aria-current="page">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Products</a></li>
                <li class="nav-item"><a href="#" class="nav-link">FAQs</a></li>
            </ul>
            <ul class="nav align-items-center gap-2">
                @auth
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link text-muted px-2">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle px-2 fw-medium" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link text-muted px-2">Login</a></li>
                    <li class="nav-item"><a href="{{ route('register') }}" class="btn btn-primary btn-sm rounded-pill px-3">Sign up</a></li>
                @endauth
            </ul>
        </div>
    </nav>
    <div class="py-3">
        <div class="container d-flex flex-wrap align-items-center gap-3">
            <a href="/" class="brand-word d-flex align-items-center me-lg-auto">
                E-Commerce<span class="dot">.</span>
            </a>
            <form class="col-12 col-lg-auto" role="search">
                <input type="search" class="form-control search-input" placeholder="Search..." aria-label="Search">
            </form>
        </div>
    </div>
</header>