<?php
session_start();
if (!isset($_SESSION['seller_login']) || !$_SESSION['seller_login']) {
    exit;
}

require_once 'koneksi.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
if ($id <= 0) { echo '<p style="color:#94a3b8">Pesanan tidak ditemukan.</p>'; exit; }

$stmt = $pdo->prepare("SELECT * FROM orders WHERE id = ?");
$stmt->execute([$id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) { echo '<p style="color:#94a3b8">Pesanan tidak ditemukan.</p>'; exit; }

$stmt = $pdo->prepare("SELECT * FROM order_items WHERE order_id = ?");
$stmt->execute([$id]);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$badgeClass = 'badge-pending';
if ($order['status'] === 'diproses') $badgeClass = 'badge-diproses';
elseif ($order['status'] === 'dikirim') $badgeClass = 'badge-dikirim';
elseif ($order['status'] === 'selesai') $badgeClass = 'badge-selesai';
elseif ($order['status'] === 'dibatalkan') $badgeClass = 'badge-dibatalkan';

$tgl = date('d M Y H:i', strtotime($order['created_at']));
?>

<div class="info-grid">
    <div class="item">
        <span class="label">No. Pesanan</span>
        <span class="value">#<?= $order['id'] ?></span>
    </div>
    <div class="item">
        <span class="label">Tanggal</span>
        <span class="value"><?= $tgl ?></span>
    </div>
    <div class="item">
        <span class="label">Customer</span>
        <span class="value"><?= htmlspecialchars($order['customer_name']) ?></span>
    </div>
    <div class="item">
        <span class="label">Status</span>
        <span class="value"><span class="badge <?= $badgeClass ?>"><?= ucfirst($order['status']) ?></span></span>
    </div>
    <div class="item full">
        <span class="label">Alamat</span>
        <span class="value"><?= htmlspecialchars($order['alamat']) ?></span>
    </div>
    <div class="item">
        <span class="label">Pengiriman</span>
        <span class="value"><?= htmlspecialchars($order['metode_pengiriman']) ?></span>
    </div>
    <div class="item">
        <span class="label">Pembayaran</span>
        <span class="value"><?= htmlspecialchars($order['metode_pembayaran']) ?></span>
    </div>
</div>

<?php if (!empty($items)): ?>
    <table class="detail-table">
        <thead>
            <tr>
                <th>Produk</th>
                <th style="text-align:right">Harga</th>
                <th style="text-align:center">Qty</th>
                <th style="text-align:right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0; ?>
            <?php foreach ($items as $item): ?>
                <?php $subtotal = $item['harga'] * $item['qty']; $total += $subtotal; ?>
                <tr>
                    <td><?= htmlspecialchars($item['nama_produk']) ?></td>
                    <td style="text-align:right">Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                    <td style="text-align:center"><?= $item['qty'] ?></td>
                    <td style="text-align:right;font-weight:600">Rp <?= number_format($subtotal, 0, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
            <tr class="total-row">
                <td colspan="3" style="text-align:right">Total</td>
                <td style="text-align:right">Rp <?= number_format($order['total_harga'], 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>
<?php endif; ?>

<form method="post" action="order.php" style="margin-top:0">
    <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
    <div class="status-form">
        <label style="font-size:.85rem;font-weight:600;white-space:nowrap">Ubah Status:</label>
        <select name="status" class="status-select">
            <option value="pending" <?= $order['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
            <option value="diproses" <?= $order['status'] === 'diproses' ? 'selected' : '' ?>>Diproses</option>
            <option value="dikirim" <?= $order['status'] === 'dikirim' ? 'selected' : '' ?>>Dikirim</option>
            <option value="selesai" <?= $order['status'] === 'selesai' ? 'selected' : '' ?>>Selesai</option>
            <option value="dibatalkan" <?= $order['status'] === 'dibatalkan' ? 'selected' : '' ?>>Dibatalkan</option>
        </select>
        <button type="submit" name="update_status" class="btn-simpan-status">Simpan</button>
    </div>
</form>
