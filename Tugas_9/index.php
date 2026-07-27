<?php
session_start();
require_once 'koneksi.php';

$produk = $pdo->query("SELECT * FROM produk ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
$kategoriList = ['Elektronik', 'Pakaian', 'Makanan', 'Lainnya'];

$pageTitle = 'Beranda - TokoKu';
$activePage = 'index';

$pageCSS = <<<'CSS'
.container { max-width: 960px; }

.page-header {
    margin-bottom: 24px;
}
.page-header h1 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #0f172a;
    margin: 0;
}

.filter-bar {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 24px;
    align-items: center;
    background: #fff;
    padding: 16px;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,.08);
}
.filter-bar input,
.filter-bar select {
    padding: 10px 14px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: .9rem;
    font-family: inherit;
    outline: none;
    background: #f8fafc;
    transition: border-color .2s, background .2s;
}
.filter-bar input:focus,
.filter-bar select:focus {
    border-color: #6366f1;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(99,102,241,.1);
}
.filter-bar .search-input {
    flex: 1;
    min-width: 180px;
}
.filter-bar .price-input { width: 110px; }
.filter-bar .reset-btn {
    padding: 10px 18px;
    background: transparent;
    color: #64748b;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: .9rem;
    cursor: pointer;
    transition: background .2s, color .2s;
}
.filter-bar .reset-btn:hover { background: #f1f5f9; color: #0f172a; }

.produk-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

.produk-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0,0,0,.08);
    transition: transform .2s, box-shadow .2s;
    cursor: pointer;
}
.produk-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 24px rgba(0,0,0,.12);
}

.produk-card .img-wrapper {
    position: relative;
    width: 100%;
    padding-top: 100%;
    background: #f1f5f9;
    overflow: hidden;
}
.produk-card .img-wrapper img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.produk-card .no-img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #94a3b8;
    font-size: .9rem;
}
.produk-card .badge-kategori {
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: .75rem;
    font-weight: 600;
}
.kat-elektronik { background: #dbeafe; color: #1e40af; }
.kat-pakaian { background: #fce7f3; color: #9d174d; }
.kat-makanan { background: #d1fae5; color: #065f46; }
.kat-lainnya { background: #f1f5f9; color: #475569; }

.produk-card .card-body {
    padding: 14px 16px 16px;
}
.produk-card .nama-produk {
    font-size: 1rem;
    font-weight: 600;
    color: #0f172a;
    margin-bottom: 6px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.produk-card .harga {
    font-size: 1.1rem;
    font-weight: 700;
    color: #6366f1;
    margin-bottom: 8px;
}
.produk-card .info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.produk-card .stok {
    font-size: .8rem;
    font-weight: 500;
}
.stok-low { color: #ef4444; }
.stok-ok { color: #22c55e; }

.produk-card .btn-detail {
    display: inline-block;
    padding: 6px 14px;
    background: #6366f1;
    color: #fff;
    text-decoration: none;
    border-radius: 6px;
    font-size: .8rem;
    font-weight: 600;
    transition: background .2s;
}
.produk-card .btn-detail:hover { background: #4f46e5; }

.filter-hide { display: none !important; }

.kosong {
    grid-column: 1 / -1;
    text-align: center;
    padding: 60px 20px;
    color: #94a3b8;
    background: #fff;
    border-radius: 12px;
}
.kosong a { color: #6366f1; text-decoration: none; font-weight: 600; }
.kosong a:hover { text-decoration: underline; }

@media (max-width: 768px) {
    .produk-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; }
    .filter-bar .search-input { min-width: 140px; }
    .filter-bar .price-input { width: 90px; }
}
@media (max-width: 480px) {
    .produk-grid { grid-template-columns: 1fr; }
    .filter-bar { flex-direction: column; }
    .filter-bar .search-input,
    .filter-bar .price-input { width: 100%; min-width: 0; }
}
CSS;

include 'header.php';
?>

<div class="container">
    <div class="page-header">
        <h1>Belanja Produk</h1>
    </div>

    <div class="filter-bar">
        <input type="text" class="search-input" id="searchInput" placeholder="Cari nama produk..." onkeyup="filterProduk()">
        <input type="number" class="price-input" id="priceMin" placeholder="Harga min" min="0" oninput="filterProduk()">
        <input type="number" class="price-input" id="priceMax" placeholder="Harga max" min="0" oninput="filterProduk()">
        <select id="filterKategori" onchange="filterProduk()">
            <option value="">Semua Kategori</option>
            <?php foreach ($kategoriList as $kat): ?>
                <option value="<?= $kat ?>"><?= $kat ?></option>
            <?php endforeach; ?>
        </select>
        <button class="reset-btn" onclick="resetFilter()">Reset</button>
    </div>

    <div class="produk-grid" id="produkGrid">
        <?php if (empty($produk)): ?>
            <div class="kosong">Belum ada produk tersedia.</div>
        <?php else: ?>
            <?php foreach ($produk as $p): ?>
                <div class="produk-card"
                     data-nama="<?= htmlspecialchars($p['nama_produk']) ?>"
                     data-harga="<?= (int) $p['harga'] ?>"
                     data-kategori="<?= htmlspecialchars($p['kategori']) ?>">
                    <div class="img-wrapper">
                        <?php if ($p['gambar']): ?>
                            <img src="uploads/<?= htmlspecialchars($p['gambar']) ?>" alt="<?= htmlspecialchars($p['nama_produk']) ?>">
                        <?php else: ?>
                            <div class="no-img">Tidak ada gambar</div>
                        <?php endif; ?>
                        <?php
                        $katClass = 'kat-lainnya';
                        if ($p['kategori'] === 'Elektronik') $katClass = 'kat-elektronik';
                        elseif ($p['kategori'] === 'Pakaian') $katClass = 'kat-pakaian';
                        elseif ($p['kategori'] === 'Makanan') $katClass = 'kat-makanan';
                        ?>
                        <span class="badge-kategori <?= $katClass ?>"><?= htmlspecialchars($p['kategori']) ?></span>
                    </div>
                    <div class="card-body">
                        <div class="nama-produk" title="<?= htmlspecialchars($p['nama_produk']) ?>"><?= htmlspecialchars($p['nama_produk']) ?></div>
                        <div class="harga">Rp <?= number_format($p['harga'], 0, ',', '.') ?></div>
                        <div class="info-row">
                            <span class="stok <?= $p['stok'] <= 5 ? 'stok-low' : 'stok-ok' ?>">
                                Stok: <?= $p['stok'] ?>
                            </span>
                            <a href="produk.php?id=<?= $p['id'] ?>" class="btn-detail">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script>
    function filterProduk() {
        const search = document.getElementById('searchInput').value.toLowerCase().trim();
        const priceMin = parseFloat(document.getElementById('priceMin').value) || 0;
        const priceMax = parseFloat(document.getElementById('priceMax').value) || Infinity;
        const kategori = document.getElementById('filterKategori').value;
        const cards = document.querySelectorAll('.produk-card');

        cards.forEach(card => {
            const nama = card.dataset.nama.toLowerCase();
            const harga = parseFloat(card.dataset.harga);
            const kat = card.dataset.kategori;
            const matchSearch = !search || nama.includes(search);
            const matchPrice = harga >= priceMin && harga <= priceMax;
            const matchKategori = !kategori || kat === kategori;

            card.classList.toggle('filter-hide', !(matchSearch && matchPrice && matchKategori));
        });
    }

    function resetFilter() {
        document.getElementById('searchInput').value = '';
        document.getElementById('priceMin').value = '';
        document.getElementById('priceMax').value = '';
        document.getElementById('filterKategori').value = '';
        filterProduk();
    }
</script>

<?php include 'footer.php'; ?>
