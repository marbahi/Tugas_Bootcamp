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

## Sesi 15 - Penambahan Autentikasi (Laravel Breeze)

### Yang sudah dikerjakan:

1. **Install Laravel Breeze (Blade stack)**
   - `composer require laravel/breeze --dev` lalu `php artisan breeze:install blade`
   - Menambahkan sistem login/register, reset password, dan verifikasi email
   - Testing framework: PHPUnit (konsisten dengan project)

2. **Route Autentikasi**
   - Route storefront tetap (home & detail produk publik)
   - `/dashboard` dan `/profile` dilindungi middleware `auth` + `verified`
   - Setelah login/register diarahkan ke dashboard; logout kembali ke `/`

3. **Desain Ulang Auth → Bootstrap**
   - Semua halaman auth Breeze (login, register, lupa/reset password, verifikasi email, konfirmasi password) dikonversi dari Tailwind default ke Bootstrap agar konsisten dengan storefront
   - `layouts/guest.blade.php` & `layouts/app.blade.php` memakai shell Bootstrap (bg-paper, header/footer toko)
   - Dashboard dibuat dengan kartu `.panel-card`, avatar user, dan aksi (Lihat Toko / Kelola Profil / Logout)
   - Halaman profile (update informasi, ganti password, hapus akun) memakai form Bootstrap + modal konfirmasi hapus (Bootstrap native)
   - Komponen Blade dikonversi: `text-input` (→ `form-control`), `input-label`, `input-error`, `auth-session-status` (→ alert), tombol (→ `btn-pill`)
   - Header toko kini `@guest/@auth`: guest melihat Login/Sign up, member melihat Dashboard + dropdown nama (Profile/Logout)
   - CSS baru di `custom.css`: `.auth-card`, `.panel-card`, `.avatar-user`, styling dropdown

4. **Catatan**
   - Tabel `users` sudah ada sejak awal (tidak diubah Breeze)
   - Komponen Tailwind Breeze yang tidak terpakai dibiarkan namun tidak dirender

### Cara menjalankan:

```bash
# Pastikan database & seeder sudah jalan (lihat Sesi 13)
php artisan migrate
npm install
npm run build

# Jalankan server dan buka http://localhost:8000
php artisan serve
```

- Buka `http://localhost:8000`, klik **Sign up** untuk membuat akun
- Login lalu akses Dashboard via menu di header

### Struktur Rute Autentikasi:

| Metode | URL | Controller | Keterangan |
|--------|-----|------------|------------|
| `GET/POST` | `/login` | `Auth\AuthenticatedSessionController` | Login |
| `GET/POST` | `/register` | `Auth\RegisteredUserController` | Registrasi |
| `POST` | `/logout` | `Auth\AuthenticatedSessionController@destroy` | Logout |
| `GET/POST` | `/forgot-password`, `/reset-password/{token}` | `Auth\Password*Controller` | Reset password |
| `GET` | `/dashboard` | closure | Halaman member (auth + verified) |
| `GET/PATCH/DELETE` | `/profile` | `ProfileController` | Kelola profil |
| `GET` | `/verify-email` | `Auth\EmailVerificationPromptController` | Verifikasi email |

### Verifikasi:

```bash
php artisan route:list   # 21 route terdaftar
php artisan test         # 25 tes lolos (termasuk tes auth Breeze)
```

---

## Sesi 16 - Admin Product List & Edit Page

### Yang sudah dikerjakan:

1. **Route Resource Admin** (`routes/web.php`)
   - `Route::resource('products', ProductController::class)->except(['show'])` dan `Route::resource('product-categories', CategoryController::class)` di prefix `/dashboard`, dilindungi middleware `auth` + `verified`

2. **Admin Product List** (`Admin\ProductController@index` + `dashboards/products/index.blade.php`)
   - Tabel full-width berisi: ID, Nama, Kategori, Harga (format `Rp1.234.567`), Stok (badge hijau/merah), Gambar, Aksi (Edit/Hapus)
   - Pencarian `search` (nama produk **atau** nama kategori via `whereHas`) + pengurutan `order_by` (name/price/stock) dengan arah `asc/desc` — auto-submit via JS, `paginate(10)->withQueryString()` agar filter tetap saat pindah halaman
   - Hapus pakai modal konfirmasi Bootstrap

3. **Create & Edit Page** (`create.blade.php` / `edit.blade.php` + partial `_form.blade.php`)
   - Satu partial form untuk create & edit: Name, Slug, Kategori (dropdown), Harga, Stok, URL Gambar, Deskripsi
   - Slug auto-fill dari nama via JS (tetap bisa diedit manual); tombol **Simpan/Update** + **Batal**
   - Validasi server-side: `name` required, `slug` unique (di-ignore id sendiri saat edit), `product_category_id` harus exists, `price`/`stock` integer >= 0, `description` required
   - Slug otomatis via `Str::slug` + suffix `-2`, `-3` jika sudah dipakai (fallback `produk`)

4. **Admin Category CRUD** (`Admin\CategoryController`)
   - Daftar kategori dengan jumlah produk (`withCount('products')`), create/edit dengan slug otomatis, hapus dengan modal + peringatan produk ikut terhapus

5. **Redesign Header Dashboard**
   - Header toko (storefront) hanya tampil di halaman publik; area member mendapat header sendiri: brand di kiri, tab navigasi (Dashboard / Product Categories / Products), tombol aksi halaman (Add/Kembali), dropdown user
   - Slot judul h1 + hr dihapus (redundan dengan tab), diganti slot `actions` berisi tombol aksi
   - Tabel diperlebar penuh seukuran `main` (`col-12`); form create/edit tetap lebar sedang agar nyaman

6. **Perbaikan Bug Penting**
   - Skema DB tidak sinkron dengan migrasi (tabel `products` tak punya kolom `id`, PK = `name`) -> rebuild dengan `migrate:fresh --seed`; memperbaiki relasi `ProductCategories::products()` dengan FK eksplisit `product_category_id`; `DatabaseSeeder` ditambah password ber-hash agar user seeder berhasil dibuat

### Cara menjalankan:

```bash
php artisan migrate:fresh --seed   # reset + seed 8 kategori & 80 produk
npm run build
php artisan serve                 # buka http://127.0.0.1:8000
```

- Login `admintest@example.com` / `password` -> menu **Product Categories** / **Products** di header
- Klik **+ Add Product** untuk membuat, **Edit** untuk mengubah, tombol Hapus (modal) untuk menghapus

### Struktur Rute:

| Metode | URL | Controller | Keterangan |
|--------|-----|------------|------------|
| `GET` | `/dashboard/products` | `Admin\ProductController@index` | Daftar produk + filter/sort |
| `GET` | `/dashboard/products/create` | `Admin\ProductController@create` | Form tambah produk |
| `POST` | `/dashboard/products` | `Admin\ProductController@store` | Simpan produk baru |
| `GET` | `/dashboard/products/{product}/edit` | `Admin\ProductController@edit` | Form edit produk |
| `PUT` | `/dashboard/products/{product}` | `Admin\ProductController@update` | Update produk |
| `DELETE` | `/dashboard/products/{product}` | `Admin\ProductController@destroy` | Hapus produk |
| `GET/POST/PUT/DELETE` | `/dashboard/product-categories...` | `Admin\CategoryController` | CRUD kategori |

### Verifikasi:

```bash
php artisan route:list   # route resource terdaftar
php artisan test         # semua tes tetap lolos
```

---

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
