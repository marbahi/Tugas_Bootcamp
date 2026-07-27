# Tugas 9 - TokoKu (E-Commerce)

Projek e-commerce sederhana menggunakan PHP & MySQL dengan fitur:
- Halaman belanja untuk customer (grid produk, pencarian, filter)
- Keranjang belanja (session-based)
- Checkout & simulasi pembayaran
- Halaman admin untuk kelola produk & pesanan

## Halaman

| URL | Fungsi | Akses |
|-----|--------|-------|
| `index.php` | Grid produk (belanja) | Public |
| `produk.php?id=X` | Detail produk + add to cart | Public |
| `keranjang.php` | Keranjang belanja | Public |
| `checkout.php` | Checkout & pembayaran | Public |
| `login.php` | Login admin | Public |
| `seller.php` | CRUD produk | Admin |
| `order.php` | Kelola pesanan | Admin |
| `logout.php` | Logout | Admin |

## Akses Admin

- **Username:** `admin`
- **Password:** `admin123`

## Database

Tabel otomatis dibuat saat pertama kali koneksi:
- `produk` (dari Tugas 8)
- `orders` (data pesanan)
- `order_items` (detail item pesanan)

## Fitur

### Customer
- Browse produk (grid card, gambar, harga, stok)
- Filter berdasarkan nama, kategori, harga
- Detail produk dengan jumlah beli
- Keranjang belanja (session)
- Checkout dengan form nama, alamat, pengiriman, pembayaran
- Konfirmasi via WhatsApp (simulasi)

### Admin (Seller)
- Login / Logout
- Kelola produk (Tambah, Edit, Hapus)
- Kelola pesanan (lihat semua order, ubah status: pending → diproses → dikirim → selesai)
- Filter pesanan berdasarkan status
- Detail pesanan via modal

## Cara Menjalankan

1. Pastikan XAMPP/PHP & MySQL sudah berjalan
2. Buka `Tugas_9/` di browser (misal: `http://localhost/Tugas_Bootcamp/Tugas_9/`)

## Teknologi

- PHP (vanilla)
- MySQL / MariaDB
- HTML, CSS, JavaScript (tanpa framework)
