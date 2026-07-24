<?php
require_once 'koneksi.php';

$sql = "CREATE TABLE IF NOT EXISTS produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(255) NOT NULL,
    harga DOUBLE NOT NULL,
    deskripsi TEXT,
    stok INT NOT NULL DEFAULT 0,
    kategori VARCHAR(100) NOT NULL,
    gambar VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

$pdo->exec($sql);

$cek = $pdo->query("SELECT COUNT(*) FROM produk")->fetchColumn();
if ($cek == 0) {
    $sample = $pdo->prepare("INSERT INTO produk (nama_produk, harga, deskripsi, stok, kategori, gambar) VALUES (?, ?, ?, ?, ?, ?)");
    $data = [
        ['Laptop ASUS ROG', 15000000, 'Laptop gaming 16GB RAM, RTX 4060', 10, 'Elektronik', null],
        ['Kaos Polos Hitam', 75000, 'Kaos cotton combed 30s, ukuran M-XL', 50, 'Pakaian', null],
        ['Keripik Singkong', 15000, 'Keripik singkong original 250gram', 100, 'Makanan', null],
        ['Mouse Logitech G502', 450000, 'Mouse gaming wireless, 25600 DPI', 25, 'Elektronik', null],
        ['Jaket Denim', 250000, 'Jaket denim oversized, warna biru', 30, 'Pakaian', null],
    ];
    foreach ($data as $row) {
        $sample->execute($row);
    }
    echo "Tabel produk berhasil dibuat dan data sample berhasil diinsert!<br>";
} else {
    echo "Tabel produk sudah ada dengan $cek data.<br>";
}

echo "<a href='index.php'>Lihat Daftar Produk</a>";
