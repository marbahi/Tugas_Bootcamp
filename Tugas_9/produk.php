<?php
session_start();
require_once 'koneksi.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM produk WHERE id = ?");
$stmt->execute([$id]);
$produk = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produk) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah_cart'])) {
    $qty = (int) ($_POST['qty'] ?? 1);

    if ($qty < 1) {
        $error = 'Jumlah minimal 1.';
    } elseif ($qty > $produk['stok']) {
        $error = 'Stok tidak mencukupi. Tersedia ' . $produk['stok'] . ' item.';
    } else {
        $cart = $_SESSION['cart'] ?? [];
        if (isset($cart[$id])) {
            $newQty = $cart[$id]['qty'] + $qty;
            $cart[$id]['qty'] = min($newQty, $produk['stok']);
        } else {
            $cart[$id] = [
                'id' => $produk['id'],
                'nama' => $produk['nama_produk'],
                'harga' => $produk['harga'],
                'gambar' => $produk['gambar'],
                'qty' => min($qty, $produk['stok']),
                'stok' => $produk['stok'],
            ];
        }
        $_SESSION['cart'] = $cart;
        $_SESSION['toast'] = ['Produk berhasil ditambahkan ke keranjang!'];
        header('Location: produk.php?id=' . $id);
        exit;
    }
}

$toast = $_SESSION['toast'] ?? null;
unset($_SESSION['toast']);

$pageTitle = htmlspecialchars($produk['nama_produk']) . ' - TokoKu';
$activePage = 'index';

$katClass = 'kat-lainnya';
if ($produk['kategori'] === 'Elektronik') $katClass = 'kat-elektronik';
elseif ($produk['kategori'] === 'Pakaian') $katClass = 'kat-pakaian';
elseif ($produk['kategori'] === 'Makanan') $katClass = 'kat-makanan';

$pageCSS = <<<'CSS'
.container { max-width: 960px; }

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #64748b;
    text-decoration: none;
    font-size: .875rem;
    font-weight: 500;
    margin-bottom: 20px;
    transition: color .2s;
}
.back-link:hover { color: #0f172a; }

.detail-wrapper {
    display: flex;
    gap: 32px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,.08);
    overflow: hidden;
}

.detail-gambar {
    flex: 1;
    min-width: 0;
    background: #f8fafc;
    display: flex;
    align-items: center;
    justify-content: center;
}
.detail-gambar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
.detail-gambar .no-img {
    width: 100%;
    padding: 80px 20px;
    text-align: center;
    color: #94a3b8;
    font-size: .9rem;
}

.detail-info {
    flex: 1;
    padding: 32px 32px 32px 0;
    display: flex;
    flex-direction: column;
}
.detail-info .nama {
    font-size: 1.4rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 10px;
}
.detail-info .kategori {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: .8rem;
    font-weight: 600;
    margin-bottom: 16px;
}
.kat-elektronik { background: #dbeafe; color: #1e40af; }
.kat-pakaian { background: #fce7f3; color: #9d174d; }
.kat-makanan { background: #d1fae5; color: #065f46; }
.kat-lainnya { background: #f1f5f9; color: #475569; }

.detail-info .harga {
    font-size: 1.6rem;
    font-weight: 700;
    color: #6366f1;
    margin-bottom: 8px;
}
.detail-info .stok {
    font-size: .9rem;
    font-weight: 500;
    margin-bottom: 16px;
}
.stok-low { color: #ef4444; }
.stok-ok { color: #22c55e; }

.detail-info .deskripsi {
    font-size: .9rem;
    color: #475569;
    line-height: 1.7;
    margin-bottom: 24px;
}

.cart-form {
    margin-top: auto;
    border-top: 1px solid #e2e8f0;
    padding-top: 20px;
}
.cart-form .qty-row {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 14px;
}
.cart-form .qty-row label {
    font-size: .9rem;
    font-weight: 600;
    color: #1e293b;
    white-space: nowrap;
}
.cart-form .qty-row input {
    width: 80px;
    padding: 10px 12px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: 1rem;
    font-family: inherit;
    text-align: center;
    outline: none;
    background: #f8fafc;
    transition: border-color .2s;
}
.cart-form .qty-row input:focus {
    border-color: #6366f1;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(99,102,241,.1);
}

.btn-cart {
    width: 100%;
    padding: 14px 0;
    background: #6366f1;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background .2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}
.btn-cart:hover { background: #4f46e5; }
.btn-cart:disabled {
    background: #94a3b8;
    cursor: not-allowed;
}

.error-msg {
    background: #fef2f2;
    border: 1px solid #fecaca;
    border-radius: 8px;
    padding: 10px 14px;
    color: #dc2626;
    font-size: .85rem;
    margin-bottom: 14px;
}

.toast {
    position: fixed;
    bottom: 24px;
    right: 24px;
    background: #065f46;
    color: #fff;
    padding: 14px 24px;
    border-radius: 10px;
    font-size: .9rem;
    font-weight: 500;
    box-shadow: 0 8px 24px rgba(0,0,0,.2);
    z-index: 9999;
    animation: slideIn .3s ease, fadeOut .3s ease 2.7s forwards;
    display: flex;
    align-items: center;
    gap: 8px;
}
@keyframes slideIn {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}
@keyframes fadeOut {
    to { opacity: 0; transform: translateY(10px); }
}

@media (max-width: 768px) {
    .detail-wrapper { flex-direction: column; }
    .detail-info { padding: 20px; }
    .detail-gambar img { max-height: 300px; }
}
CSS;

include 'header.php';
?>

<div class="container">
    <a href="index.php" class="back-link">← Kembali ke Belanja</a>

    <?php if ($toast): ?>
        <div class="toast" onclick="this.remove()">✓ <?= htmlspecialchars($toast[0]) ?></div>
    <?php endif; ?>

    <div class="detail-wrapper">
        <div class="detail-gambar">
            <?php if ($produk['gambar']): ?>
                <img src="uploads/<?= htmlspecialchars($produk['gambar']) ?>" alt="<?= htmlspecialchars($produk['nama_produk']) ?>">
            <?php else: ?>
                <div class="no-img">Tidak ada gambar</div>
            <?php endif; ?>
        </div>

        <div class="detail-info">
            <h1 class="nama"><?= htmlspecialchars($produk['nama_produk']) ?></h1>
            <span class="kategori <?= $katClass ?>"><?= htmlspecialchars($produk['kategori']) ?></span>

            <div class="harga">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></div>

            <div class="stok <?= $produk['stok'] <= 5 ? 'stok-low' : 'stok-ok' ?>">
                Stok: <?= $produk['stok'] ?>
            </div>

            <?php if ($produk['deskripsi']): ?>
                <div class="deskripsi"><?= nl2br(htmlspecialchars($produk['deskripsi'])) ?></div>
            <?php endif; ?>

            <div class="cart-form">
                <?php if ($error): ?>
                    <div class="error-msg"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form method="post" onsubmit="return validasiQty()">
                    <div class="qty-row">
                        <label for="qty">Jumlah:</label>
                        <input type="number" id="qty" name="qty" value="1" min="1" max="<?= $produk['stok'] ?>" required>
                        <span style="font-size:.85rem;color:#64748b">Max: <?= $produk['stok'] ?></span>
                    </div>

                    <?php if ($produk['stok'] > 0): ?>
                        <button type="submit" name="tambah_cart" class="btn-cart">🛒 Masukkan ke Keranjang</button>
                    <?php else: ?>
                        <button type="button" class="btn-cart" disabled>Stok Habis</button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function validasiQty() {
        const input = document.getElementById('qty');
        const val = parseInt(input.value);
        const max = parseInt(input.max);
        if (val < 1) { input.value = 1; return false; }
        if (val > max) { input.value = max; return false; }
        return true;
    }

    document.getElementById('qty').addEventListener('input', function() {
        const max = parseInt(this.max);
        if (parseInt(this.value) > max) this.value = max;
        if (parseInt(this.value) < 1) this.value = 1;
    });
</script>

<?php include 'footer.php'; ?>
