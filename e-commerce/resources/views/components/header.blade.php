<header class="site-header">
    <div class="py-3">
        <div class="container header-inner d-flex align-items-center gap-3">
            <a href="/" class="brand-word d-flex align-items-center flex-shrink-0 order-1">
                E-Commerce<span class="dot">.</span>
            </a>
            <form class="header-search flex-grow-1 mx-auto order-3 order-lg-2" role="search">
                <input type="search" class="form-control search-input w-100" placeholder="Search..." aria-label="Search">
            </form>
            <div class="d-none d-md-flex align-items-center gap-2 ms-auto flex-shrink-0 order-2 order-lg-3">
                @auth
                    @php
                        $cartCount = Auth::user()->cartItems()->count();
                    @endphp
                    <a href="{{ route('cart.index') }}" class="nav-link text-muted px-2 fw-medium">Keranjang
                        @if ($cartCount > 0)
                            <span class="badge rounded-pill bg-danger ms-1">{{ $cartCount }}</span>
                        @endif
                    </a>
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('dashboard') }}" class="nav-link text-muted px-2 fw-medium">Dashboard</a>
                    @endif
                    <div class="dropdown">
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
                    </div>
                @else
                    <a href="{{ route('login') }}" class="nav-link text-muted px-2 fw-medium">Keranjang</a>
                    <a href="{{ route('login') }}" class="nav-link text-muted px-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm rounded-pill px-3">Sign up</a>
                @endauth
            </div>
            <button class="btn menu-btn d-md-none ms-auto flex-shrink-0 order-2" type="button" data-bs-toggle="collapse" data-bs-target="#headerMenu" aria-expanded="false" aria-controls="headerMenu" aria-label="Menu">
                <img src="{{ asset('images/icons/menu.png') }}" alt="Menu" class="menu-icon">
            </button>
        </div>
        <div class="container d-md-none">
            <div class="collapse" id="headerMenu">
                <div class="header-menu d-flex flex-column gap-2">
                    @auth
                        <a href="{{ route('cart.index') }}" class="nav-link px-0 fw-medium">Keranjang
                            @if (($cartCount ?? Auth::user()->cartItems()->count()) > 0)
                                <span class="badge rounded-pill bg-danger ms-1">{{ $cartCount ?? Auth::user()->cartItems()->count() }}</span>
                            @endif
                        </a>
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('dashboard') }}" class="nav-link px-0 fw-medium">Dashboard</a>
                        @endif
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle px-0 fw-medium" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu shadow-sm">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="nav-link px-0 fw-medium">Keranjang</a>
                        <a href="{{ route('login') }}" class="nav-link px-0">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm rounded-pill px-3 align-self-start">Sign up</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>
