<?php
require_once 'koneksi.php';

if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    $stmt = $pdo->prepare("SELECT gambar FROM produk WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    if ($row && $row['gambar'] && file_exists('uploads/' . $row['gambar'])) {
        unlink('uploads/' . $row['gambar']);
    }
    $stmt = $pdo->prepare("DELETE FROM produk WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $id = (int) $_POST['edit_id'];
    $nama = trim($_POST['nama'] ?? '');
    $harga = trim($_POST['harga'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');
    $stok = trim($_POST['stok'] ?? '');
    $kategori = $_POST['kategori'] ?? '';

    $stmt = $pdo->prepare("SELECT gambar FROM produk WHERE id = ?");
    $stmt->execute([$id]);
    $produkLama = $stmt->fetch();

    $gambar = $produkLama['gambar'];
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['gambar'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (in_array($ext, $allowed) && $file['size'] <= 5 * 1024 * 1024) {
            if ($gambar && file_exists('uploads/' . $gambar)) {
                unlink('uploads/' . $gambar);
            }
            $gambar = uniqid('prod_') . '.' . $ext;
            move_uploaded_file($file['tmp_name'], 'uploads/' . $gambar);
        }
    }

    $stmt = $pdo->prepare("UPDATE produk SET nama_produk=?, harga=?, deskripsi=?, stok=?, kategori=?, gambar=? WHERE id=?");
    $stmt->execute([$nama, $harga, $deskripsi, $stok, $kategori, $gambar, $id]);
    header('Location: index.php');
    exit;
}

$produk = $pdo->query("SELECT * FROM produk ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
$kategoriList = ['Elektronik', 'Pakaian', 'Makanan', 'Lainnya'];

$pageTitle = 'Daftar Produk - TokoKu';
$activePage = 'index';

$pageCSS = <<<'CSS'
.container { max-width: 960px; }
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}
h1 { font-size: 1.35rem; margin: 0; color: #0f172a; }
.btn-tambah {
    display: inline-block;
    padding: 10px 20px;
    background: #6366f1;
    color: #fff;
    text-decoration: none;
    border-radius: 8px;
    font-size: .9rem;
    font-weight: 600;
    transition: background .2s;
}
.btn-tambah:hover { background: #4f46e5; }

.filter-bar {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 16px;
    align-items: center;
}
.filter-bar input,
.filter-bar select {
    padding: 8px 12px;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    font-size: .85rem;
    font-family: inherit;
    outline: none;
    background: #fff;
    transition: border-color .2s;
}
.filter-bar input:focus,
.filter-bar select:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99,102,241,.15);
}
.filter-bar .search-input { flex: 1; min-width: 160px; }
.filter-bar .price-input { width: 100px; }
.filter-bar .reset-btn {
    padding: 8px 16px;
    background: transparent;
    color: #64748b;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    font-size: .85rem;
    cursor: pointer;
    transition: background .2s, color .2s;
}
.filter-bar .reset-btn:hover { background: #f1f5f9; color: #0f172a; }

.card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,.08), 0 1px 2px rgba(0,0,0,.06);
    overflow: hidden;
}
table { width: 100%; border-collapse: collapse; }
th, td {
    padding: 12px 16px;
    text-align: left;
    border-bottom: 1px solid #e2e8f0;
    font-size: .9rem;
}
th { background: #f8fafc; font-weight: 600; color: #475569; }
tr:last-child td { border-bottom: none; }
tr:hover td { background: #f8fafc; }

.filter-hide { display: none !important; }

.thumb {
    width: 48px;
    height: 48px;
    object-fit: cover;
    border-radius: 6px;
    background: #e2e8f0;
}
.no-img {
    width: 48px;
    height: 48px;
    border-radius: 6px;
    background: #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #94a3b8;
    font-size: .7rem;
}
.kategori {
    display: inline-block;
    padding: 2px 10px;
    border-radius: 20px;
    font-size: .8rem;
    font-weight: 500;
}
.kat-elektronik { background: #dbeafe; color: #1e40af; }
.kat-pakaian { background: #fce7f3; color: #9d174d; }
.kat-makanan { background: #d1fae5; color: #065f46; }
.kat-lainnya { background: #f1f5f9; color: #475569; }

.btn-hapus {
    display: inline-block;
    padding: 5px 12px;
    background: #ef4444;
    color: #fff;
    text-decoration: none;
    border-radius: 6px;
    font-size: .8rem;
    transition: background .2s;
}
.btn-hapus:hover { background: #dc2626; }
.btn-edit {
    display: inline-block;
    padding: 5px 12px;
    background: #6366f1;
    color: #fff;
    text-decoration: none;
    border-radius: 6px;
    font-size: .8rem;
    transition: background .2s;
    cursor: pointer;
    border: none;
    margin-right: 4px;
}
.btn-edit:hover { background: #4f46e5; }

.harga { font-weight: 600; color: #0f172a; }
.stok { font-weight: 500; }
.stok-low { color: #ef4444; }
.stok-ok { color: #22c55e; }
.kosong { text-align: center; padding: 40px; color: #94a3b8; }

.success {
    background: #d1fae5;
    border: 1px solid #6ee7b7;
    border-radius: 8px;
    padding: 12px 16px;
    margin-bottom: 16px;
    color: #065f46;
    font-size: .9rem;
}

.modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.45);
    z-index: 1000;
    justify-content: center;
    align-items: center;
    padding: 16px;
}
.modal-overlay.active { display: flex; }
.modal {
    background: #fff;
    border-radius: 12px;
    padding: 28px 24px;
    width: 100%;
    max-width: 520px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 20px 60px rgba(0,0,0,.3);
}
.modal h2 { font-size: 1.2rem; margin: 0 0 20px; color: #0f172a; }
.modal label {
    display: block;
    font-size: .85rem;
    font-weight: 600;
    margin-top: 14px;
    color: #1e293b;
}
.modal label:first-of-type { margin-top: 0; }
.modal input,
.modal textarea,
.modal select {
    width: 100%;
    padding: 9px 12px;
    margin-top: 5px;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    font-size: .9rem;
    font-family: inherit;
    outline: none;
    transition: border-color .2s;
}
.modal input:focus,
.modal textarea:focus,
.modal select:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99,102,241,.15);
}
.modal textarea { height: 80px; resize: vertical; }
.modal-row { display: flex; gap: 12px; }
.modal-row > div { flex: 1; }
.modal .current-img {
    max-width: 120px;
    max-height: 80px;
    object-fit: cover;
    border-radius: 6px;
    border: 1px solid #e2e8f0;
    margin-top: 5px;
}
.modal-actions {
    display: flex;
    gap: 10px;
    margin-top: 20px;
}
.modal-actions button {
    flex: 1;
    padding: 10px 0;
    border-radius: 8px;
    font-size: .9rem;
    font-weight: 600;
    cursor: pointer;
    transition: background .2s;
    border: none;
}
.modal-actions .btn-save { background: #6366f1; color: #fff; }
.modal-actions .btn-save:hover { background: #4f46e5; }
.modal-actions .btn-cancel { background: #f1f5f9; color: #475569; }
.modal-actions .btn-cancel:hover { background: #e2e8f0; }
.modal .file-info { font-size: .8rem; color: #94a3b8; margin-top: 4px; }

@media (max-width: 640px) {
    .header { flex-direction: column; gap: 12px; align-items: flex-start; }
    th, td { padding: 8px 10px; font-size: .8rem; }
    .filter-bar .price-input { width: 80px; }
}
CSS;

include 'header.php';
?>

<div class="container">
    <?php if (isset($_GET['sukses'])): ?>
        <div class="success">Produk berhasil ditambahkan!</div>
    <?php endif; ?>

    <div class="header">
        <h1>Daftar Produk</h1>
        <a href="form.php" class="btn-tambah">+ Tambah Barang</a>
    </div>

    <div class="filter-bar">
        <input type="text" class="search-input" id="searchInput" placeholder="Cari nama produk..." onkeyup="filterTable()">
        <input type="number" class="price-input" id="priceMin" placeholder="Harga min" min="0" oninput="filterTable()">
        <input type="number" class="price-input" id="priceMax" placeholder="Harga max" min="0" oninput="filterTable()">
        <select id="filterKategori" onchange="filterTable()">
            <option value="">Semua Kategori</option>
            <?php foreach ($kategoriList as $kat): ?>
                <option value="<?= $kat ?>"><?= $kat ?></option>
            <?php endforeach; ?>
        </select>
        <button class="reset-btn" onclick="resetFilter()">Reset</button>
    </div>

    <div class="card">
        <?php if (empty($produk)): ?>
            <div class="kosong">Belum ada produk. <a href="form.php">Tambah sekarang</a></div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="produkTableBody">
                    <?php foreach ($produk as $p): ?>
                        <tr data-nama="<?= htmlspecialchars($p['nama_produk']) ?>"
                            data-harga="<?= (int) $p['harga'] ?>"
                            data-kategori="<?= htmlspecialchars($p['kategori']) ?>">
                            <td>
                                <?php if ($p['gambar']): ?>
                                    <img src="uploads/<?= htmlspecialchars($p['gambar']) ?>" class="thumb" alt="<?= htmlspecialchars($p['nama_produk']) ?>">
                                <?php else: ?>
                                    <div class="no-img">No Img</div>
                                <?php endif; ?>
                            </td>
                            <td class="nama-produk"><?= htmlspecialchars($p['nama_produk']) ?></td>
                            <td class="harga">Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
                            <td>
                                <span class="stok <?= $p['stok'] <= 5 ? 'stok-low' : 'stok-ok' ?>">
                                    <?= $p['stok'] ?>
                                </span>
                            </td>
                            <td>
                                <?php
                                $katClass = 'kat-lainnya';
                                if ($p['kategori'] === 'Elektronik') $katClass = 'kat-elektronik';
                                elseif ($p['kategori'] === 'Pakaian') $katClass = 'kat-pakaian';
                                elseif ($p['kategori'] === 'Makanan') $katClass = 'kat-makanan';
                                ?>
                                <span class="kategori <?= $katClass ?>"><?= htmlspecialchars($p['kategori']) ?></span>
                            </td>
                            <td>
                                <button class="btn-edit"
                                    data-id="<?= $p['id'] ?>"
                                    data-nama="<?= htmlspecialchars($p['nama_produk']) ?>"
                                    data-harga="<?= $p['harga'] ?>"
                                    data-stok="<?= $p['stok'] ?>"
                                    data-kategori="<?= htmlspecialchars($p['kategori']) ?>"
                                    data-deskripsi="<?= htmlspecialchars($p['deskripsi']) ?>"
                                    data-gambar="<?= htmlspecialchars($p['gambar']) ?>"
                                    onclick="openEditModal(this)">Edit</button>
                                <a href="index.php?hapus=<?= $p['id'] ?>" class="btn-hapus" onclick="return confirm('Yakin hapus produk ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<div class="modal-overlay" id="editModal">
    <div class="modal">
        <h2>Edit Produk</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="edit_id" id="edit_id">
            <label for="edit_nama">Nama Produk</label>
            <input type="text" id="edit_nama" name="nama" required>

            <div class="modal-row">
                <div>
                    <label for="edit_harga">Harga (Rp)</label>
                    <input type="text" id="edit_harga" name="harga" required>
                </div>
                <div>
                    <label for="edit_stok">Stok</label>
                    <input type="number" id="edit_stok" name="stok" min="0" required>
                </div>
            </div>

            <label for="edit_kategori">Kategori</label>
            <select id="edit_kategori" name="kategori" required>
                <option value="">-- Pilih Kategori --</option>
                <?php foreach ($kategoriList as $kat): ?>
                    <option value="<?= $kat ?>"><?= $kat ?></option>
                <?php endforeach; ?>
            </select>

            <label for="edit_deskripsi">Deskripsi</label>
            <textarea id="edit_deskripsi" name="deskripsi"></textarea>

            <label for="edit_gambar">Gambar Produk</label>
            <input type="file" id="edit_gambar" name="gambar" accept="image/*">
            <div class="file-info">Kosongkan jika tidak ingin mengganti gambar</div>
            <img id="editPreview" class="current-img" style="display:none" alt="Preview">

            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeEditModal()">Batal</button>
                <button type="submit" class="btn-save">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function filterTable() {
        const search = document.getElementById('searchInput').value.toLowerCase().trim();
        const priceMin = parseFloat(document.getElementById('priceMin').value) || 0;
        const priceMax = parseFloat(document.getElementById('priceMax').value) || Infinity;
        const kategori = document.getElementById('filterKategori').value;
        const rows = document.querySelectorAll('#produkTableBody tr');

        rows.forEach(row => {
            const nama = row.dataset.nama.toLowerCase();
            const harga = parseFloat(row.dataset.harga);
            const kat = row.dataset.kategori;
            const matchSearch = !search || nama.includes(search);
            const matchPrice = harga >= priceMin && harga <= priceMax;
            const matchKategori = !kategori || kat === kategori;

            row.classList.toggle('filter-hide', !(matchSearch && matchPrice && matchKategori));
        });
    }

    function resetFilter() {
        document.getElementById('searchInput').value = '';
        document.getElementById('priceMin').value = '';
        document.getElementById('priceMax').value = '';
        document.getElementById('filterKategori').value = '';
        filterTable();
    }

    function openEditModal(btn) {
        document.getElementById('edit_id').value = btn.dataset.id;
        document.getElementById('edit_nama').value = btn.dataset.nama;
        document.getElementById('edit_harga').value = btn.dataset.harga;
        document.getElementById('edit_stok').value = btn.dataset.stok;
        document.getElementById('edit_kategori').value = btn.dataset.kategori;
        document.getElementById('edit_deskripsi').value = btn.dataset.deskripsi;

        const preview = document.getElementById('editPreview');
        if (btn.dataset.gambar) {
            preview.src = 'uploads/' + btn.dataset.gambar;
            preview.style.display = 'block';
        } else {
            preview.style.display = 'none';
        }

        document.getElementById('edit_gambar').value = '';
        document.getElementById('editModal').classList.add('active');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.remove('active');
    }

    document.getElementById('editModal').addEventListener('click', function(e) {
        if (e.target === this) closeEditModal();
    });

    document.getElementById('edit_gambar').addEventListener('change', function(e) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById('editPreview');
            preview.src = reader.result;
            preview.style.display = 'block';
        };
        if (e.target.files[0]) reader.readAsDataURL(e.target.files[0]);
    });
</script>

<?php include 'footer.php'; ?>