<?php
session_start();

if (isset($_SESSION['seller_login']) && $_SESSION['seller_login']) {
    header('Location: seller.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['seller_login'] = true;
        header('Location: seller.php');
        exit;
    } else {
        $error = 'Username atau password salah!';
    }
}

$pageTitle = 'Login - TokoKu';
$activePage = 'login';

$pageCSS = <<<'CSS'
.login-wrapper {
    min-height: 70vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}
.login-card {
    background: #fff;
    border-radius: 12px;
    padding: 32px 28px;
    width: 100%;
    max-width: 380px;
    box-shadow: 0 4px 12px rgba(0,0,0,.08);
}
.login-card h1 {
    font-size: 1.3rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 6px;
    text-align: center;
}
.login-card .subtitle {
    font-size: .85rem;
    color: #64748b;
    text-align: center;
    margin-bottom: 24px;
}
.login-card label {
    display: block;
    font-size: .85rem;
    font-weight: 600;
    margin-top: 14px;
    color: #1e293b;
}
.login-card label:first-of-type { margin-top: 0; }
.login-card input {
    width: 100%;
    padding: 10px 14px;
    margin-top: 5px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: .9rem;
    font-family: inherit;
    outline: none;
    background: #f8fafc;
    transition: border-color .2s, background .2s;
}
.login-card input:focus {
    border-color: #6366f1;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(99,102,241,.1);
}
.login-card .btn-masuk {
    width: 100%;
    padding: 12px 0;
    margin-top: 22px;
    background: #6366f1;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: .95rem;
    font-weight: 600;
    cursor: pointer;
    transition: background .2s;
}
.login-card .btn-masuk:hover { background: #4f46e5; }
.login-card .error {
    background: #fef2f2;
    border: 1px solid #fecaca;
    border-radius: 8px;
    padding: 10px 14px;
    margin-bottom: 16px;
    color: #dc2626;
    font-size: .85rem;
    text-align: center;
}
.login-card .back-link {
    display: block;
    text-align: center;
    margin-top: 14px;
    font-size: .85rem;
}
.login-card .back-link a {
    color: #6366f1;
    text-decoration: none;
    font-weight: 500;
}
.login-card .back-link a:hover { text-decoration: underline; }
CSS;

include 'header.php';
?>

<div class="container">
    <div class="login-wrapper">
        <div class="login-card">
            <h1>🔐 Masuk Seller</h1>
            <p class="subtitle">Kelola produk TokoKu</p>

            <?php if ($error): ?>
                <div class="error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="post">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required autofocus>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" class="btn-masuk">Masuk</button>
            </form>

            <div class="back-link">
                <a href="index.php">← Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
