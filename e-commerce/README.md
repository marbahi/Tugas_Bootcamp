<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# E-Commerce - Tugas Bootcamp

Proyek e-commerce yang dibangun menggunakan **Laravel 11** sebagai bagian dari tugas bootcamp.

---

## Sesi 13 - Database Migration & Dummy Data

### Yang sudah dikerjakan:

1. **Database Migration**
   - Membuat tabel `product_categories` untuk kategori produk
   - Membuat tabel `products` untuk data produk dengan foreign key ke kategori
   - Membuat tabel `orders` untuk data pesanan
   - Membuat tabel `order_items` untuk detail item pesanan
   - Membuat tabel `cart_items` untuk keranjang belanja
   - Memperbaiki urutan migrasi agar foreign key tidak error (errno 150)

2. **Seeder & Dummy Data**
   - `CategorySeeder` - 8 kategori produk (Elektronik, Fashion, Makanan & Minuman, Kesehatan, Olahraga, Rumah Tangga, Aksesoris, Buku)
   - `ProductSeeder` - 80 produk dummy (10 produk per kategori)
   - Semua seeder menggunakan `firstOrCreate` agar aman dijalankan berulang kali

### Cara menjalankan:

```bash
# Reset database dan jalankan semua seeder
php artisan migrate:fresh --seed

# Atau jalankan seeder saja (tanpa reset)
php artisan db:seed
```

### Struktur Database:

| Tabel | Keterangan |
|-------|------------|
| `users` | Data pengguna (bawaan Laravel) |
| `product_categories` | Kategori produk |
| `products` | Data produk |
| `orders` | Data pesanan |
| `order_items` | Detail item pesanan |
| `cart_items` | Keranjang belanja |

---

## Sesi 14 - Display Product (Home Page) & Detail Product

### Yang sudah dikerjakan:

1. **Home Page (Display Product)**
   - `HomeController@index` mengambil produk dari database dengan `paginate(8)` (8 produk per halaman) lalu dikirim ke view `home`
   - `home.blade.php` menampilkan produk sebagai kartu (`product-card`) yang berisi gambar, nama, dan harga (format `Rp1.234.567`)
   - Setiap kartu produk dibungkus link ke halaman detail, jadi klik kard bisa membuka detail produk
   - Menambahkan pagination di bagian bawah grid produk

2. **Halaman Detail Product**
   - Route baru `GET /product/{product}` dengan nama `products.show` yang mengarah ke `ProductsController@show`
   - `ProductsController@show` mengirim data: objek produk, 3 gambar dummy (placehold.co), dan 8 produk rekomendasi dari kategori yang sama (acak, selain produk yang sedang dibuka)
   - View baru `resources/views/products/show.blade.php` berisi:
     - Galeri produk (carousel Bootstrap) dengan thumbnail yang bisa diklik untuk ganti slide
     - Badge stok (`Stok: N` jika tersedia, `Stok Habis` jika kosong) + nama kategori
     - Harga produk tampil besar dengan font monospace
     - Deskripsi produk
     - Tombol **Beli** (auto-disable jika stok habis)
     - Section **Rekomendasi Produk** berisi 8 produk sejenis yang juga bisa diklik ke detail masing-masing

3. **Styling**
   - Menambahkan style galeri (`.product-gallery`, `.gallery-thumb`), badge stok (`.stock-badge--in` / `--out`), harga detail (`.detail-price`), dan deskripsi (`.detail-description`) di `public/css/custom.css`

### Cara menjalankan:

```bash
# Pastikan database & seeder sudah jalan (lihat Sesi 13)
php artisan migrate --seed

# Jalankan server dan buka http://localhost:8000
php artisan serve
```

- Buka `http://localhost:8000` → home page menampilkan grid produk
- Klik salah satu kartu produk → halaman detail produk

### Struktur Rute:

| Metode | URL | Controller | Keterangan |
|--------|-----|------------|------------|
| `GET` | `/` | `HomeController@index` | Home page dengan grid produk |
| `GET` | `/product/{product}` | `ProductsController@show` | Detail produk + rekomendasi |

---

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
