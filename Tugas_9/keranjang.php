<?php
session_start();

$cart = $_SESSION['cart'] ?? [];

if (isset($_GET['hapus'])) {
    $hapusId = (int) $_GET['hapus'];
    unset($cart[$hapusId]);
    $_SESSION['cart'] = $cart;
    header('Location: keranjang.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    foreach ($_POST['qty'] as $id => $qty) {
        $id = (int) $id;
        $qty = (int) $qty;
        if (isset($cart[$id])) {
            if ($qty < 1) $qty = 1;
            if ($qty > $cart[$id]['stok']) $qty = $cart[$id]['stok'];
            $cart[$id]['qty'] = $qty;
        }
    }
    $_SESSION['cart'] = $cart;
    header('Location: keranjang.php');
    exit;
}

$pageTitle = 'Keranjang - TokoKu';
$activePage = 'keranjang';

$pageCSS = <<<'CSS'
.container { max-width: 960px; }

.page-header {
    margin-bottom: 20px;
}
.page-header h1 {
    font-size: 1.35rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0;
}

.card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,.08);
    overflow: hidden;
}

table { width: 100%; border-collapse: collapse; }
th, td {
    padding: 14px 16px;
    text-align: left;
    border-bottom: 1px solid #e2e8f0;
    font-size: .9rem;
    vertical-align: middle;
}
th { background: #f8fafc; font-weight: 600; color: #475569; }
tr:last-child td { border-bottom: none; }
tr:hover td { background: #f8fafc; }

.cart-thumb {
    width: 52px;
    height: 52px;
    object-fit: cover;
    border-radius: 8px;
    background: #e2e8f0;
}
.cart-no-img {
    width: 52px;
    height: 52px;
    border-radius: 8px;
    background: #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #94a3b8;
    font-size: .65rem;
}
.cart-nama {
    font-weight: 600;
    color: #0f172a;
}
.cart-harga {
    font-weight: 600;
    color: #6366f1;
}
.cart-subtotal {
    font-weight: 700;
    color: #0f172a;
}
.cart-qty {
    width: 64px;
    padding: 6px 8px;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    font-size: .9rem;
    font-family: inherit;
    text-align: center;
    outline: none;
    background: #f8fafc;
    transition: border-color .2s;
}
.cart-qty:focus {
    border-color: #6366f1;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(99,102,241,.1);
}
.btn-update {
    padding: 6px 12px;
    background: #6366f1;
    color: #fff;
    border: none;
    border-radius: 6px;
    font-size: .8rem;
    font-weight: 500;
    cursor: pointer;
    transition: background .2s;
}
.btn-update:hover { background: #4f46e5; }
.btn-hapus {
    padding: 6px 12px;
    background: transparent;
    color: #ef4444;
    border: 1px solid #fecaca;
    border-radius: 6px;
    font-size: .8rem;
    font-weight: 500;
    cursor: pointer;
    transition: background .2s;
}
.btn-hapus:hover { background: #fef2f2; }

.cart-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px;
    background: #f8fafc;
    border-top: 1px solid #e2e8f0;
}
.cart-footer .total-label {
    font-size: .9rem;
    font-weight: 600;
    color: #475569;
}
.cart-footer .total-harga {
    font-size: 1.2rem;
    font-weight: 700;
    color: #6366f1;
}

.btn-checkout {
    display: inline-flex;
    padding: 10px 24px;
    background: #6366f1;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: .9rem;
    font-weight: 600;
    text-decoration: none;
    transition: background .2s;
}
.btn-checkout:hover { background: #4f46e5; }

.cart-actions {
    display: flex;
    gap: 12px;
    margin-top: 16px;
}
.cart-actions .btn-belanja {
    display: inline-flex;
    padding: 10px 20px;
    background: transparent;
    color: #6366f1;
    border: 2px solid #6366f1;
    border-radius: 8px;
    font-size: .9rem;
    font-weight: 600;
    text-decoration: none;
    transition: background .2s, color .2s;
}
.cart-actions .btn-belanja:hover { background: #6366f1; color: #fff; }

.empty-state {
    min-height: 50vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 60px 20px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,.08);
}
.empty-state .icon { font-size: 3rem; margin-bottom: 16px; }
.empty-state h1 { font-size: 1.3rem; font-weight: 700; color: #0f172a; margin: 0 0 8px; }
.empty-state p { font-size: .9rem; color: #64748b; margin: 0 0 20px; }
.empty-state .btn-belanja {
    display: inline-block;
    padding: 10px 24px;
    background: #6366f1;
    color: #fff;
    text-decoration: none;
    border-radius: 8px;
    font-size: .9rem;
    font-weight: 600;
    transition: background .2s;
}
.empty-state .btn-belanja:hover { background: #4f46e5; }

@media (max-width: 640px) {
    th, td { padding: 10px 10px; font-size: .8rem; }
    .cart-qty { width: 48px; }
    .cart-footer { flex-direction: column; gap: 8px; text-align: center; }
}
CSS;

include 'header.php';
?>

<div class="container">
    <div class="page-header">
        <h1>Keranjang Belanja</h1>
    </div>

    <?php if (empty($cart)): ?>
        <div class="empty-state">
            <div class="icon">🛒</div>
            <h1>Keranjang Belanja</h1>
            <p>Belum ada produk di keranjang. Yuk, belanja dulu!</p>
            <a href="index.php" class="btn-belanja">Mulai Belanja</a>
        </div>
    <?php else: ?>
        <div class="card">
            <form method="post">
                <table>
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0; ?>
                        <?php foreach ($cart as $item): ?>
                            <?php $subtotal = $item['harga'] * $item['qty']; $total += $subtotal; ?>
                            <tr>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px">
                                        <a href="produk.php?id=<?= $item['id'] ?>">
                                            <?php if ($item['gambar']): ?>
                                                <img src="uploads/<?= htmlspecialchars($item['gambar']) ?>" class="cart-thumb" alt="<?= htmlspecialchars($item['nama']) ?>">
                                            <?php else: ?>
                                                <div class="cart-no-img">No</div>
                                            <?php endif; ?>
                                        </a>
                                        <span class="cart-nama"><?= htmlspecialchars($item['nama']) ?></span>
                                    </div>
                                </td>
                                <td class="cart-harga">Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                                <td>
                                    <input type="number" name="qty[<?= $item['id'] ?>]" value="<?= $item['qty'] ?>" min="1" max="<?= $item['stok'] ?>" class="cart-qty">
                                </td>
                                <td class="cart-subtotal">Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                                <td>
                                    <button type="submit" name="update" class="btn-update">Update</button>
                                    <a href="keranjang.php?hapus=<?= $item['id'] ?>" class="btn-hapus" onclick="return confirm('Hapus produk ini dari keranjang?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="cart-footer">
                    <span class="total-label">Total Belanja:</span>
                    <span class="total-harga">Rp <?= number_format($total, 0, ',', '.') ?></span>
                </div>
            </form>
        </div>

        <div class="cart-actions">
            <a href="index.php" class="btn-belanja">← Lanjut Belanja</a>
            <a href="checkout.php" class="btn-checkout">Checkout →</a>
        </div>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
