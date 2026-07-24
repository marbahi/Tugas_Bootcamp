<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'TokoKu') ?></title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #f1f5f9;
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        main { flex: 1; width: 100%; padding: 24px 16px; }
        .container { margin: 0 auto; width: 100%; }

        .navbar {
            background: #0f172a;
            padding: 0 16px;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .navbar .container {
            max-width: 960px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 56px;
        }
        .navbar-brand {
            color: #fff;
            text-decoration: none;
            font-size: 1.2rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .navbar-brand:hover { opacity: .9; }
        .navbar-nav { display: flex; gap: 8px; align-items: center; }
        .nav-link {
            color: #94a3b8;
            text-decoration: none;
            font-size: .875rem;
            font-weight: 500;
            padding: 6px 14px;
            border-radius: 6px;
            transition: background .2s, color .2s;
        }
        .nav-link:hover { color: #fff; background: rgba(255,255,255,.1); }
        .nav-link.active { color: #fff; background: #6366f1; }
        .nav-link.tambah-btn {
            background: #6366f1;
            color: #fff;
            font-weight: 600;
        }
        .nav-link.tambah-btn:hover { background: #4f46e5; }

        .site-footer {
            background: #0f172a;
            color: #94a3b8;
            text-align: center;
            padding: 20px 16px;
            font-size: .85rem;
        }
        .site-footer .container { max-width: 960px; }
        .site-footer p { margin: 4px 0; }
        .site-footer .brand { color: #e2e8f0; font-weight: 600; }

        @media (max-width: 600px) {
            main { padding: 16px 12px; }
            .navbar .container { height: 50px; }
            .navbar-brand { font-size: 1rem; }
            .nav-link { font-size: .8rem; padding: 5px 10px; }
        }

        <?php if (!empty($pageCSS)) echo $pageCSS; ?>
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="index.php" class="navbar-brand">🛒 TokoKu</a>
            <div class="navbar-nav">
                <a href="index.php" class="nav-link <?= $activePage === 'index' ? 'active' : '' ?>">Beranda</a>
                <a href="form.php" class="nav-link tambah-btn <?= $activePage === 'form' ? 'active' : '' ?>">+ Tambah Produk</a>
            </div>
        </div>
    </nav>
    <main>