<?php
session_start();
if (!isset($_SESSION['seller_login']) || !$_SESSION['seller_login']) {
    header('Location: login.php');
    exit;
}

require_once 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $orderId = (int) ($_POST['order_id'] ?? 0);
    $newStatus = $_POST['status'] ?? '';
    $validStatus = ['pending', 'diproses', 'dikirim', 'selesai', 'dibatalkan'];

    if (in_array($newStatus, $validStatus)) {
        $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
        $stmt->execute([$newStatus, $orderId]);
    }
    header('Location: order.php');
    exit;
}

$filter = $_GET['filter'] ?? '';
$query = "SELECT o.*, COUNT(oi.id) as jumlah_item FROM orders o LEFT JOIN order_items oi ON o.id = oi.order_id";
$params = [];

if ($filter !== '' && in_array($filter, ['pending', 'diproses', 'dikirim', 'selesai', 'dibatalkan'])) {
    $query .= " WHERE o.status = ?";
    $params[] = $filter;
}

$query .= " GROUP BY o.id ORDER BY o.created_at DESC";
$orders = $pdo->prepare($query);
$orders->execute($params);
$orders = $orders->fetchAll(PDO::FETCH_ASSOC);

$pageTitle = 'Kelola Order - TokoKu';
$activePage = 'order';

$pageCSS = <<<'CSS'
.container { max-width: 960px; }
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 12px;
}
.page-header h1 { font-size: 1.35rem; font-weight: 700; color: #0f172a; margin: 0; }

.filter-bar {
    display: flex;
    gap: 8px;
    margin-bottom: 16px;
    flex-wrap: wrap;
}
.filter-bar a {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: .8rem;
    font-weight: 500;
    text-decoration: none;
    transition: background .2s, color .2s;
    background: #f1f5f9;
    color: #475569;
}
.filter-bar a:hover { background: #e2e8f0; }
.filter-bar a.active {
    background: #6366f1;
    color: #fff;
}

.card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,.08);
    overflow: hidden;
}
table { width: 100%; border-collapse: collapse; }
th, td {
    padding: 12px 16px;
    text-align: left;
    border-bottom: 1px solid #e2e8f0;
    font-size: .875rem;
    vertical-align: middle;
}
th { background: #f8fafc; font-weight: 600; color: #475569; }
tr:last-child td { border-bottom: none; }
tr:hover td { background: #f8fafc; }
tr { cursor: pointer; }

.badge {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 20px;
    font-size: .75rem;
    font-weight: 600;
}
.badge-pending { background: #fef3c7; color: #92400e; }
.badge-diproses { background: #dbeafe; color: #1e40af; }
.badge-dikirim { background: #ede9fe; color: #5b21b6; }
.badge-selesai { background: #d1fae5; color: #065f46; }
.badge-dibatalkan { background: #fef2f2; color: #991b1b; }

.status-select {
    padding: 5px 10px;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    font-size: .8rem;
    font-family: inherit;
    outline: none;
    background: #fff;
    cursor: pointer;
}
.btn-simpan-status {
    padding: 5px 10px;
    background: #6366f1;
    color: #fff;
    border: none;
    border-radius: 6px;
    font-size: .75rem;
    font-weight: 500;
    cursor: pointer;
    transition: background .2s;
}
.btn-simpan-status:hover { background: #4f46e5; }

.kosong {
    text-align: center;
    padding: 60px 20px;
    color: #94a3b8;
}

/* Modal */
.modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.45);
    z-index: 1000;
    justify-content: center;
    align-items: center;
    padding: 20px;
}
.modal-overlay.active { display: flex; }
.modal {
    background: #fff;
    border-radius: 12px;
    padding: 28px;
    width: 100%;
    max-width: 560px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 20px 60px rgba(0,0,0,.3);
}
.modal h2 { font-size: 1.2rem; font-weight: 700; color: #0f172a; margin: 0 0 16px; }
.modal .info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    margin-bottom: 16px;
    font-size: .85rem;
}
.modal .info-grid .item { display: flex; flex-direction: column; }
.modal .info-grid .label { color: #64748b; font-size: .8rem; }
.modal .info-grid .value { font-weight: 600; color: #0f172a; }
.modal .info-grid .full { grid-column: 1 / -1; }

.modal .detail-table { width: 100%; border-collapse: collapse; font-size: .85rem; margin-bottom: 16px; }
.modal .detail-table th { background: #f8fafc; font-weight: 600; color: #475569; padding: 8px 12px; text-align: left; border-bottom: 1px solid #e2e8f0; }
.modal .detail-table td { padding: 8px 12px; border-bottom: 1px solid #f1f5f9; }
.modal .detail-table tr:last-child td { border-bottom: none; }
.modal .detail-table .total-row td { border-top: 2px solid #e2e8f0; font-weight: 700; color: #0f172a; }

.modal .status-form {
    display: flex;
    gap: 8px;
    align-items: center;
    padding-top: 16px;
    border-top: 1px solid #e2e8f0;
}
.modal .status-form select { flex: 1; }
.modal .btn-tutup {
    display: inline-block;
    margin-top: 12px;
    padding: 8px 20px;
    background: #f1f5f9;
    color: #475569;
    border: none;
    border-radius: 8px;
    font-size: .85rem;
    font-weight: 500;
    cursor: pointer;
    transition: background .2s;
}
.modal .btn-tutup:hover { background: #e2e8f0; }

@media (max-width: 640px) {
    th, td { padding: 10px 8px; font-size: .8rem; }
    .modal .info-grid { grid-template-columns: 1fr; }
    .page-header { flex-direction: column; align-items: flex-start; }
}
CSS;

include 'header.php';
?>

<div class="container">
    <div class="page-header">
        <h1>📋 Kelola Order</h1>
    </div>

    <div class="filter-bar">
        <a href="order.php" class="<?= $filter === '' ? 'active' : '' ?>">Semua</a>
        <a href="order.php?filter=pending" class="<?= $filter === 'pending' ? 'active' : '' ?>">Pending</a>
        <a href="order.php?filter=diproses" class="<?= $filter === 'diproses' ? 'active' : '' ?>">Diproses</a>
        <a href="order.php?filter=dikirim" class="<?= $filter === 'dikirim' ? 'active' : '' ?>">Dikirim</a>
        <a href="order.php?filter=selesai" class="<?= $filter === 'selesai' ? 'active' : '' ?>">Selesai</a>
        <a href="order.php?filter=dibatalkan" class="<?= $filter === 'dibatalkan' ? 'active' : '' ?>">Dibatalkan</a>
    </div>

    <div class="card">
        <?php if (empty($orders)): ?>
            <div class="kosong">Belum ada pesanan.</div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Item</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $o): ?>
                        <?php
                        $badgeClass = 'badge-pending';
                        if ($o['status'] === 'diproses') $badgeClass = 'badge-diproses';
                        elseif ($o['status'] === 'dikirim') $badgeClass = 'badge-dikirim';
                        elseif ($o['status'] === 'selesai') $badgeClass = 'badge-selesai';
                        elseif ($o['status'] === 'dibatalkan') $badgeClass = 'badge-dibatalkan';

                        $tgl = date('d M Y', strtotime($o['created_at']));
                        ?>
                        <tr onclick="openDetail(<?= $o['id'] ?>)">
                            <td><strong>#<?= $o['id'] ?></strong></td>
                            <td><?= htmlspecialchars($o['customer_name']) ?></td>
                            <td style="font-weight:600;color:#6366f1">Rp <?= number_format($o['total_harga'], 0, ',', '.') ?></td>
                            <td><?= $o['jumlah_item'] ?> item</td>
                            <td><span class="badge <?= $badgeClass ?>"><?= ucfirst($o['status']) ?></span></td>
                            <td style="color:#64748b;font-size:.8rem"><?= $tgl ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<!-- Modal Detail -->
<div class="modal-overlay" id="detailModal">
    <div class="modal" id="modalContent">
        <h2 id="modalTitle">Detail Pesanan</h2>
        <div id="modalBody">Memuat...</div>
        <button class="btn-tutup" onclick="closeModal()">Tutup</button>
    </div>
</div>

<script>
    let ordersData = <?= json_encode($orders) ?>;

    function openDetail(orderId) {
        fetch('order_detail.php?id=' + orderId)
            .then(r => r.text())
            .then(html => {
                document.getElementById('modalBody').innerHTML = html;
                document.getElementById('detailModal').classList.add('active');
            });
    }

    function closeModal() {
        document.getElementById('detailModal').classList.remove('active');
    }

    document.getElementById('detailModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });
</script>

<?php include 'footer.php'; ?>
