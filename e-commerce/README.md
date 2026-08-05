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

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
