<?php
require_once 'koneksi.php';

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $harga = trim($_POST['harga'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');
    $stok = trim($_POST['stok'] ?? '');
    $kategori = $_POST['kategori'] ?? '';

    if ($nama === '') $errors[] = 'Nama produk harus diisi.';
    if ($harga === '') $errors[] = 'Harga produk harus diisi.';
    if (!is_numeric($harga) && $harga !== '') $errors[] = 'Harga harus berupa angka.';
    if ($deskripsi === '') $errors[] = 'Deskripsi produk harus diisi.';
    if ($stok === '') $errors[] = 'Stok harus diisi.';
    if (!ctype_digit($stok) && $stok !== '') $errors[] = 'Stok harus berupa angka positif.';
    if ($kategori === '') $errors[] = 'Kategori harus dipilih.';
    if (!in_array($kategori, ['Elektronik', 'Pakaian', 'Makanan', 'Lainnya']) && $kategori !== '') {
        $errors[] = 'Kategori tidak valid.';
    }

    $gambar = null;
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['gambar'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($ext, $allowed)) {
            $errors[] = 'Format gambar harus JPG, PNG, GIF, atau WEBP.';
        } elseif ($file['size'] > 5 * 1024 * 1024) {
            $errors[] = 'Ukuran gambar maksimal 5MB.';
        } else {
            $gambar = uniqid('prod_') . '.' . $ext;
        }
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO produk (nama_produk, harga, deskripsi, stok, kategori, gambar) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nama, $harga, $deskripsi, $stok, $kategori, $gambar]);

        if ($gambar) {
            move_uploaded_file($file['tmp_name'], __DIR__ . '/uploads/' . $gambar);
        }

        header('Location: index.php?sukses=1');
        exit;
    }
}

$pageTitle = 'Tambah Produk Baru - TokoKu';
$activePage = 'form';

$pageCSS = <<<'CSS'
.container { max-width: 540px; }
.card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,.08), 0 1px 2px rgba(0,0,0,.06);
    padding: 24px 20px;
    margin-bottom: 20px;
}
h1 { font-size: 1.35rem; margin: 0 0 20px; color: #0f172a; }
h2 { font-size: 1.1rem; margin: 0 0 12px; color: #0f172a; }
label {
    display: block;
    font-size: .875rem;
    font-weight: 600;
    margin-top: 16px;
    color: #1e293b;
}
label:first-of-type { margin-top: 0; }
input, textarea, select {
    width: 100%;
    padding: 10px 12px;
    margin-top: 6px;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    font-size: .925rem;
    font-family: inherit;
    outline: none;
    transition: border-color .2s, box-shadow .2s;
}
input:focus, textarea:focus, select:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99,102,241,.15);
}
textarea { height: 100px; resize: vertical; }
.file-upload {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-top: 6px;
}
.file-upload input[type="file"] {
    flex: 1;
    padding: 8px 12px;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    font-size: .9rem;
    cursor: pointer;
}
.file-upload input[type="file"]:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 3px rgba(99,102,241,.15);
}
.preview-img {
    width: 64px;
    height: 64px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
    display: none;
}
button {
    width: 100%;
    margin-top: 20px;
    padding: 11px 0;
    background: #6366f1;
    color: #fff;
    font-size: .95rem;
    font-weight: 600;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background .2s;
}
button:hover { background: #4f46e5; }
.btn-secondary {
    display: block;
    width: 100%;
    margin-top: 12px;
    padding: 11px 0;
    background: #fff;
    color: #6366f1;
    border: 2px solid #6366f1;
    font-size: .95rem;
    font-weight: 600;
    border-radius: 8px;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    transition: background .2s, color .2s;
}
.btn-secondary:hover { background: #6366f1; color: #fff; }
.alert {
    background: #fef2f2;
    border: 1px solid #fecaca;
    border-radius: 8px;
    padding: 12px 16px;
    margin-bottom: 20px;
}
.alert p { margin: 4px 0; font-size: .875rem; color: #b91c1c; }
.row { display: flex; gap: 12px; }
.row > div { flex: 1; }
@media (min-width: 600px) {
    .card { padding: 32px; }
}
CSS;

include 'header.php';
?>

<div class="container">
    <div class="card">
        <h1>Tambah Produk Baru</h1>

        <?php if (!empty($errors)): ?>
            <div class="alert">
                <?php foreach ($errors as $e): ?>
                    <p><?= htmlspecialchars($e) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data">
            <label for="nama">Nama Produk</label>
            <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>" placeholder="Masukkan nama produk">

            <div class="row">
                <div>
                    <label for="harga">Harga (Rp)</label>
                    <input type="text" id="harga" name="harga" value="<?= htmlspecialchars($_POST['harga'] ?? '') ?>" placeholder="Contoh: 75000">
                </div>
                <div>
                    <label for="stok">Stok</label>
                    <input type="number" id="stok" name="stok" value="<?= htmlspecialchars($_POST['stok'] ?? '') ?>" min="0" placeholder="Jumlah stok">
                </div>
            </div>

            <label for="kategori">Kategori</label>
            <select id="kategori" name="kategori">
                <option value="">-- Pilih Kategori --</option>
                <?php
                $kategoriList = ['Elektronik', 'Pakaian', 'Makanan', 'Lainnya'];
                $selected = $_POST['kategori'] ?? '';
                foreach ($kategoriList as $kat):
                ?>
                    <option value="<?= $kat ?>" <?= $selected === $kat ? 'selected' : '' ?>><?= $kat ?></option>
                <?php endforeach; ?>
            </select>

            <label for="gambar">Gambar Produk</label>
            <div class="file-upload">
                <input type="file" id="gambar" name="gambar" accept="image/*" onchange="previewGambar(event)">
                <img id="preview" class="preview-img" alt="Preview">
            </div>

            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi" placeholder="Deskripsi singkat produk..."><?= htmlspecialchars($_POST['deskripsi'] ?? '') ?></textarea>

            <button type="submit">Simpan Produk</button>
        </form>

        <a href="index.php" class="btn-secondary">Lihat Daftar Produk</a>
    </div>
</div>

<script>
    function previewGambar(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const img = document.getElementById('preview');
            img.src = reader.result;
            img.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<?php include 'footer.php'; ?>