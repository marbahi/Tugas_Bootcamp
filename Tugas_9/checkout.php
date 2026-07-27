<?php
session_start();
require_once 'koneksi.php';

$errors = [];
$orderId = null;
$orderSuccess = false;
$orderData = null;

if (isset($_GET['sukses']) && isset($_SESSION['order_data'])) {
    $orderSuccess = true;
    $orderData = $_SESSION['order_data'];
    $orderId = $orderData['id'];
    unset($_SESSION['order_data']);
}

$cart = $_SESSION['cart'] ?? [];
$total = 0;
foreach ($cart as $item) $total += $item['harga'] * $item['qty'];

if (!$orderSuccess && empty($cart)) {
    header('Location: keranjang.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bayar'])) {
    $customer_name = trim($_POST['customer_name'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');
    $pengiriman = $_POST['pengiriman'] ?? '';
    $pembayaran = $_POST['pembayaran'] ?? '';

    if ($customer_name === '') $errors[] = 'Nama customer harus diisi.';
    if ($alamat === '') $errors[] = 'Alamat harus diisi.';
    if ($pengiriman === '') $errors[] = 'Pilih metode pengiriman.';
    if ($pembayaran === '') $errors[] = 'Pilih metode pembayaran.';

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO orders (customer_name, alamat, metode_pengiriman, metode_pembayaran, total_harga, status) VALUES (?, ?, ?, ?, ?, 'pending')");
        $stmt->execute([$customer_name, $alamat, $pengiriman, $pembayaran, $total]);
        $orderId = $pdo->lastInsertId();

        $stmt = $pdo->prepare("INSERT INTO order_items (order_id, produk_id, nama_produk, harga, qty, subtotal) VALUES (?, ?, ?, ?, ?, ?)");
        foreach ($cart as $item) {
            $subtotal = $item['harga'] * $item['qty'];
            $stmt->execute([$orderId, $item['id'], $item['nama'], $item['harga'], $item['qty'], $subtotal]);
        }

        $_SESSION['cart'] = [];
        $_SESSION['order_data'] = [
            'id' => $orderId,
            'customer_name' => $customer_name,
            'alamat' => $alamat,
            'pengiriman' => $pengiriman,
            'pembayaran' => $pembayaran,
            'total' => $total,
        ];

        header('Location: checkout.php?sukses=1');
        exit;
    }
}

$pageTitle = 'Checkout - TokoKu';
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

.checkout-layout {
    display: flex;
    gap: 24px;
    align-items: flex-start;
}

.checkout-form {
    flex: 1;
    background: #fff;
    border-radius: 12px;
    padding: 28px;
    box-shadow: 0 1px 3px rgba(0,0,0,.08);
}
.checkout-form h2 {
    font-size: 1.1rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 20px;
}
.checkout-form label {
    display: block;
    font-size: .85rem;
    font-weight: 600;
    margin-top: 14px;
    color: #1e293b;
}
.checkout-form label:first-of-type { margin-top: 0; }
.checkout-form input,
.checkout-form textarea,
.checkout-form select {
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
.checkout-form input:focus,
.checkout-form textarea:focus,
.checkout-form select:focus {
    border-color: #6366f1;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(99,102,241,.1);
}
.checkout-form textarea { height: 80px; resize: vertical; }

.cart-summary {
    width: 320px;
    background: #fff;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 1px 3px rgba(0,0,0,.08);
    position: sticky;
    top: 80px;
}
.cart-summary h2 {
    font-size: 1.1rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 16px;
}
.cart-summary .item-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px solid #f1f5f9;
    font-size: .85rem;
}
.cart-summary .item-row:last-child { border-bottom: none; }
.cart-summary .item-nama {
    flex: 1;
    color: #1e293b;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.cart-summary .item-subtotal {
    font-weight: 600;
    color: #0f172a;
    white-space: nowrap;
    margin-left: 12px;
}
.cart-summary .total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0 0;
    margin-top: 8px;
    border-top: 2px solid #e2e8f0;
    font-size: 1rem;
}
.cart-summary .total-row .label {
    font-weight: 600;
    color: #1e293b;
}
.cart-summary .total-row .harga {
    font-weight: 700;
    color: #6366f1;
    font-size: 1.15rem;
}

.btn-bayar {
    width: 100%;
    padding: 14px 0;
    margin-top: 20px;
    background: #22c55e;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    transition: background .2s;
}
.btn-bayar:hover { background: #16a34a; }

.alert {
    background: #fef2f2;
    border: 1px solid #fecaca;
    border-radius: 8px;
    padding: 12px 16px;
    margin-bottom: 16px;
}
.alert p { margin: 4px 0; font-size: .85rem; color: #b91c1c; }

/* Modal WA */
.modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.5);
    z-index: 1000;
    justify-content: center;
    align-items: center;
    padding: 20px;
}
.modal-overlay.active { display: flex; }
.modal-wa {
    background: #fff;
    border-radius: 14px;
    padding: 32px 28px;
    width: 100%;
    max-width: 420px;
    text-align: center;
    box-shadow: 0 20px 60px rgba(0,0,0,.3);
    animation: pop .3s ease;
}
@keyframes pop {
    from { transform: scale(.9); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}
.modal-wa .icon { font-size: 3rem; margin-bottom: 12px; }
.modal-wa h2 { font-size: 1.2rem; font-weight: 700; color: #0f172a; margin: 0 0 8px; }
.modal-wa p { font-size: .9rem; color: #64748b; margin: 0 0 6px; line-height: 1.5; }
.modal-wa .order-info {
    background: #f8fafc;
    border-radius: 8px;
    padding: 12px 16px;
    margin: 16px 0;
    font-size: .85rem;
    text-align: left;
}
.modal-wa .order-info div { margin: 4px 0; }
.modal-wa .order-info .label { color: #64748b; }
.modal-wa .order-info .value { font-weight: 600; color: #0f172a; }
.modal-wa .btn-wa {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 12px 0;
    background: #25D366;
    color: #fff;
    text-decoration: none;
    border-radius: 8px;
    font-size: .95rem;
    font-weight: 600;
    transition: background .2s;
    margin-top: 8px;
}
.modal-wa .btn-wa:hover { background: #1ebe5d; }
.modal-wa .btn-wa {
    background: #6366f1;
}
.modal-wa .btn-wa:hover { background: #4f46e5; }

@media (max-width: 768px) {
    .checkout-layout { flex-direction: column-reverse; }
    .cart-summary { width: 100%; position: static; }
}
CSS;

include 'header.php';
?>

<div class="container">
    <div class="page-header">
        <h1>Checkout</h1>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="alert">
            <?php foreach ($errors as $e): ?>
                <p><?= htmlspecialchars($e) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

        <?php if (!$orderSuccess): ?>
    <div class="checkout-layout">
        <div class="checkout-form">
            <h2>Informasi Pengiriman</h2>
            <form method="post" id="formCheckout">
                <label for="customer_name">Nama Customer</label>
                <input type="text" id="customer_name" name="customer_name" value="<?= htmlspecialchars($_POST['customer_name'] ?? '') ?>" required>

                <label for="alamat">Alamat Lengkap</label>
                <textarea id="alamat" name="alamat" required><?= htmlspecialchars($_POST['alamat'] ?? '') ?></textarea>

                <label for="pengiriman">Metode Pengiriman</label>
                <select id="pengiriman" name="pengiriman" required>
                    <option value="">-- Pilih --</option>
                    <?php
                    $kurir = ['JNE', 'J&T', 'SiCepat', 'Ninja Express'];
                    $selected = $_POST['pengiriman'] ?? '';
                    foreach ($kurir as $k):
                    ?>
                        <option value="<?= $k ?>" <?= $selected === $k ? 'selected' : '' ?>><?= $k ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="pembayaran">Metode Pembayaran</label>
                <select id="pembayaran" name="pembayaran" required>
                    <option value="">-- Pilih --</option>
                    <?php
                    $payment = ['Transfer Bank', 'COD', 'QRIS', 'E-Wallet'];
                    $selectedPayment = $_POST['pembayaran'] ?? '';
                    foreach ($payment as $p):
                    ?>
                        <option value="<?= $p ?>" <?= $selectedPayment === $p ? 'selected' : '' ?>><?= $p ?></option>
                    <?php endforeach; ?>
                </select>

                <button type="submit" name="bayar" class="btn-bayar">Bayar Sekarang</button>
            </form>
        </div>

        <div class="cart-summary">
            <h2>Ringkasan Pesanan</h2>
            <?php foreach ($cart as $item): ?>
                <?php $subtotal = $item['harga'] * $item['qty']; ?>
                <div class="item-row">
                    <span class="item-nama"><?= htmlspecialchars($item['nama']) ?> × <?= $item['qty'] ?></span>
                    <span class="item-subtotal">Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
                </div>
            <?php endforeach; ?>
            <div class="total-row">
                <span class="label">Total</span>
                <span class="harga">Rp <?= number_format($total, 0, ',', '.') ?></span>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php if ($orderSuccess && isset($orderData)): ?>
<div class="modal-overlay active" id="modalWA">
    <div class="modal-wa">
        <div class="icon">📱</div>
        <h2>Pesanan Berhasil Dibuat</h2>
        <p>Pembayaran akan diproses oleh admin. Silakan tunggu konfirmasi.</p>

        <div class="order-info">
            <div><span class="label">No. Pesanan:</span> <span class="value">#<?= $orderData['id'] ?></span></div>
            <div><span class="label">Nama:</span> <span class="value"><?= htmlspecialchars($orderData['customer_name']) ?></span></div>
            <div><span class="label">Total:</span> <span class="value">Rp <?= number_format($orderData['total'], 0, ',', '.') ?></span></div>
        </div>

        <a href="index.php" class="btn-wa">✓ Selesai</a>
    </div>
</div>
<?php endif; ?>

<?php include 'footer.php'; ?>
