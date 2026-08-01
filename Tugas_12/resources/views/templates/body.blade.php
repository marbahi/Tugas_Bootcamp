<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title  }} | My E-Commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        .site-navbar { background: #0f172a; padding: .75rem 1.25rem; }
        .site-navbar .navbar-row { display: grid; grid-template-columns: 1fr minmax(240px, 640px) 1fr; align-items: center; gap: .5rem 1rem; width: 100%; }
        .site-navbar .navbar-brand { color: #fff; font-weight: 700; justify-self: start; }
        .site-navbar .nav-link { color: #94a3b8; font-size: .875rem; font-weight: 500; padding: 6px 14px; border-radius: 6px; transition: background .2s, color .2s; }
        .site-navbar .nav-link:hover { color: #fff; background: rgba(255,255,255,.1); }
        .site-navbar .cart-link { justify-self: end; font-size: 1.25rem; }
        .site-navbar .search-form { display: flex; gap: .5rem; width: 100%; }
        .site-navbar .search-form .form-control { flex: 1 1 auto; background: #1e293b; border-color: #334155; color: #f1f5f9; }
        .site-navbar .search-form .form-control::placeholder { color: #64748b; }
        .site-navbar .search-form .form-control:focus { border-color: #6366f1; box-shadow: none; }
        .site-navbar .btn-icon { background: transparent; border: none; color: #94a3b8; font-size: 1rem; padding: 6px 8px; border-radius: 6px; transition: background .2s, color .2s; }
        .site-navbar .btn-icon:hover { color: #fff; background: rgba(255,255,255,.1); }
        .site-footer { background: #0f172a; color: #94a3b8; }
        .site-footer .nav-link { color: #94a3b8; }
        .site-footer .nav-link:hover { color: #fff; }
        .site-footer .copyright { color: #94a3b8; }
        .rekomendasi, .cart-section { margin-left: .75rem; margin-right: .75rem; }
        @media (min-width: 768px) {
            .rekomendasi, .cart-section { margin-left: 1.5rem; margin-right: 1.5rem; }
        }
        @media (min-width: 992px) {
            .rekomendasi, .cart-section { margin-left: auto; margin-right: auto; padding-left: 1.5rem; padding-right: 1.5rem; }
        }
        @media (max-width: 767.98px) {
            .site-navbar .navbar-row { grid-template-columns: 1fr auto; grid-template-areas: "brand cart" "search search"; }
            .site-navbar .navbar-brand { grid-area: brand; }
            .site-navbar .cart-link { grid-area: cart; }
            .site-navbar .search-form { grid-area: search; }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <x-navbar></x-navbar>
    <main class="flex-grow-1">
        @yield('content')
    </main>
    <x-footer></x-footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>