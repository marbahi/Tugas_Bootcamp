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

## Sesi 17 - Modal untuk CRUD Kategori & Edit Produk

### Yang sudah dikerjakan:

1. **Modal Add/Edit/Hapus Kategori** (`dashboards/product-categories/_modals.blade.php`)
   - Tombol **+ Add Category** di header dan **Edit** per baris kini membuka modal Bootstrap (bukan halaman terpisah)
   - Modal berisi form `store`/`update` (Name + Slug), tombol **Simpan/Update** di footer
   - Hapus tetap pakai modal konfirmasi (dipindahkan dari index ke partial yang sama)

2. **Modal Edit/Hapus Produk** (`dashboards/products/_modals.blade.php`)
   - Tombol **Edit** membuka modal `modal-lg` scrollable berisi semua field form (Nama, Kategori, Harga, Stok, URL Gambar, Deskripsi)
   - **+ Add Product tetap halaman terpisah** (`products/create`) — bukan modal
   - Modal delete dipindahkan ke partial yang sama

3. **Auto-reopen Modal Saat Validasi Gagal**
   - Tiap form modal menyimpan hidden field `form_context` (mis. `category-create`, `category-edit-5`, `product-edit-3`)
   - Jika validasi gagal, Laravel redirect balik ke index dan JS membaca `old('form_context')` lalu membuka ulang modal yang sama beserta isian (`old()`) dan pesan error — data tidak hilang

4. **Slug Produk Otomatis dari Kategori**
   - Field slug dihapus dari halaman add product dan modal edit product
   - Slug produk = slug kategori yang dipilih (produk kedua di kategori sama otomatis `-2`, `-3` via `resolveSlug`)
   - Modal kategori tetap punya field slug dengan auto-fill JS (`data-slug-source`/`data-slug-target`)

5. **Penyesuaian Route & Bersih-bersih**
   - `product-categories` dibatasi `only(['index','store','update','destroy'])`; `products` tanpa `edit`
   - View lama dihapus: `product-categories/create|edit|_form`, `products/edit`
   - Migration baru `make_image_nullable_on_products_table` — kolom `products.image` dijadikan `nullable` (sebelumnya NOT NULL tapi form menganggap opsional, menyebabkan error 500 saat disimpan kosong)

6. **Search & Pagination Kategori**
   - Halaman Product Categories kini punya pencarian (nama/slug) dengan auto-submit debounce dan `paginate(10)->withQueryString()` — konsisten dengan halaman Products

7. **Title per Halaman**
   - Title tab disesuaikan per halaman (Dashboard / Product Categories / Products / Add Product / Profile) via property `headerTitle` pada komponen `AppLayout`
   - `APP_NAME` diubah menjadi `E-Commerce` → title tampil sebagai `Dashboard | E-Commerce`, dst.

### Cara menjalankan:

```bash
php artisan migrate --force          # jalankan migration baru (products.image nullable)
php artisan serve                    # buka http://127.0.0.1:8000
```

- Login, buka **Product Categories** → klik **+ Add Category** untuk menambah via modal, **Edit** untuk mengubah, **Hapus** untuk menghapus
- Buka **Products** → **Edit** membuka modal edit, **Hapus** untuk menghapus, **+ Add Product** tetap halaman form
- Coba submit form modal dengan field kosong → modal terbuka kembali dengan pesan error

### Struktur Rute:

| Metode | URL | Controller | Keterangan |
|--------|-----|------------|------------|
| `GET` | `/dashboard/product-categories` | `Admin\CategoryController@index` | Daftar kategori + search + pagination |
| `POST` | `/dashboard/product-categories` | `Admin\CategoryController@store` | Simpan kategori (modal) |
| `PUT` | `/dashboard/product-categories/{product_category}` | `Admin\CategoryController@update` | Update kategori (modal) |
| `DELETE` | `/dashboard/product-categories/{product_category}` | `Admin\CategoryController@destroy` | Hapus kategori (modal) |
| `GET` | `/dashboard/products/create` | `Admin\ProductController@create` | Form tambah produk (halaman) |
| `PUT` | `/dashboard/products/{product}` | `Admin\ProductController@update` | Update produk (modal) |
| `DELETE` | `/dashboard/products/{product}` | `Admin\ProductController@destroy` | Hapus produk (modal) |

### Verifikasi:

```bash
php artisan route:list   # route resource terdaftar (tanpa create/edit kategori, tanpa edit produk)
php artisan test         # semua tes tetap lolos
```

---

## Sesi 18 - Overview Dashboard

### Yang sudah dikerjakan:

1. **DashboardController** (`app/Http/Controllers/DashboardController.php`)
   - File baru hasil rename dari `DashboardConrtoller` (typo nama kelas diperbaiki)
   - Method `index()` menyiapkan `$items` — list array berisi data kartu statistik (title, number, icon) lalu dikirim ke view via `compact('items')`
   - Nilai statistik masih **hardcoded** (80 produk, 8 kategori, 100 klik produk) sebagai placeholder sementara

2. **Route Dashboard → Controller**
   - Route `/dashboard` yang tadinya closure langsung `return view('dashboards.index')` kini diarahkan ke `DashboardController@index` agar data dari controller sampai ke view

3. **View Overview** (`dashboards/index.blade.php`)
   - Menampilkan grid 3 kartu statistik dengan loop `@foreach ($items as $item)` menggunakan class `panel-card`
   - Tiap kartu berisi ikon Material Symbols, angka besar, dan judul statistik

4. **Ikon Material Symbols**
   - Font Material Symbols ditambahkan di `<head>` `layouts/app.blade.php`
   - Ikon disimpan sebagai nama string (mis. `inventory_2`, `category`, `left_click`) dan dirender `<span class="material-symbols-outlined">`
   - Style baru `.dashboard-stat-icon` di `public/css/custom.css`

5. **User Test**
   - Ditambahkan user `test@test.com` / `test123` (email sudah diverifikasi) untuk login dan melihat dashboard

6. **Dashboard Chart & Order Terbaru** (`DashboardController` + `dashboards/index.blade.php`)
   - Chart.js v4.4.4 via CDN untuk line chart penjualan bulanan
   - Data dummy: 6 bulan terakhir (Jul-Des)
   - Card ringkasan: Total Order, Revenue, Pending, Completed, Cancelled
   - Tabel order terbaru (5 data dummy) dengan status badge (Selesai/Pending/Dibatalkan)
   - Style `.order-status-badge` di `custom.css`

### Cara menjalankan:

```bash
php artisan serve   # buka http://127.0.0.1:8000
```

- Login dengan `test@test.com` / `test123` → buka menu **Dashboard**
- Lihat 3 kartu statistik (Number of Products, Number of Categories, Number of Product Clicks)

### Verifikasi:

```bash
php artisan route:list   # GET /dashboard → DashboardController@index
```

---

## Sesi 19 - Role Admin & Dashboard Access Control

### Yang sudah dikerjakan:

1. **Migration - Add Role Column** (`database/migrations/2026_08_31_161829_add_role_to_users_table.php`)
   - Menambah kolom `role` (string, default: `'user'`) ke tabel `users`
   - Kolom `role` menyimpan nilai `'admin'` atau `'user'`

2. **AdminMiddleware** (`app/Http/Middleware/AdminMiddleware.php`)
   - Middleware baru untuk membatasi akses hanya untuk admin
   - Cek `Auth::check()` && `Auth::user()->role == 'admin'`
   - Jika bukan admin → redirect ke `/home` dengan pesan error `"You Do Not Have Admin Access"`

3. **Register Middleware Alias** (`bootstrap/app.php`)
   - Alias `'admin' => AdminMiddleware::class` didaftarkan di `withMiddleware`
   - Memungkinkan penggunaan `middleware('admin')` di route

4. **Route Protection** (`routes/web.php`)
   - Seluruh route dashboard dibungkus `Route::middleware(['admin'])->prefix('dashboard')`
   - Hanya user dengan `role = 'admin'` yang bisa mengakses:
     - `/dashboard` (Overview Dashboard)
     - `/dashboard/products` (CRUD Produk)
     - `/dashboard/product-categories` (CRUD Kategori)
   - User biasa (`role = 'user'`) tidak bisa mengakses halaman dashboard

5. **Admin User Seeder** (`database/seeders/DatabaseSeeder.php`)
   - Ditambahkan user admin: `admintest@example.com` / `password` dengan `role = 'admin'`
   - User biasa tetap: `test@example.com` / `password` dengan `role = 'user'`

6. **Header Navigation Conditional** (`resources/views/layouts/app.blade.php`)
   - Menu navigasi Dashboard, Product Categories, Products hanya tampil jika user adalah admin
   - User biasa hanya melihat header toko (storefront) tanpa akses admin

### Cara menjalankan:

```bash
# Jalankan migration untuk menambah kolom role
php artisan migrate

# Jalankan seeder untuk membuat user admin
php artisan db:seed

# Jalankan server
php artisan serve
```

### Test Akses:

| User | Email | Password | Role | Akses Dashboard |
|------|-------|----------|------|-----------------|
| Admin | `admintest@example.com` | `password` | `admin` | ✅ Bisa |
| User | `test@example.com` | `password` | `user` | ❌ Redirect ke `/home` |

### Struktur Rute:

| Metode | URL | Middleware | Keterangan |
|--------|-----|------------|------------|
| `GET` | `/dashboard` | `auth`, `admin`, `verified` | Overview dashboard (admin only) |
| `GET/POST/...` | `/dashboard/products/*` | `auth`, `admin`, `verified` | CRUD produk (admin only) |
| `GET/POST/...` | `/dashboard/product-categories/*` | `auth`, `admin`, `verified` | CRUD kategori (admin only) |

### Verifikasi:

```bash
php artisan migrate   # tambah kolom role ke tabel users
php artisan db:seed   # buat user admin
php artisan route:list   # cek route dengan middleware admin
```

---

## Sesi 20 - Add Product Form & Store ke Database

### Yang sudah dikerjakan:

1. **Form Add Product** (`resources/views/dashboards/products/_form.blade.php`)
   - Form hanya untuk **create** product (bukan edit)
   - Field: Name, Kategori (dropdown), Harga, Stok, URL Gambar (opsional), Deskripsi
   - Menggunakan komponen Blade: `x-input-label`, `x-text-input`, `x-input-error`, `x-primary-button`
   - Form action: `route('products.store')` dengan method POST + `enctype="multipart/form-data"`
   - `old()` input tetap terjaga saat validasi gagal

2. **Controller Store** (`Admin\ProductController@store`)
   - Validasi server-side: `name` required, `product_category_id` harus exists di tabel `product_categories`, `price`/`stock` integer ≥ 0, `image` nullable, `description` required
   - Slug produk = slug kategori yang dipilih (otomatis suffix `-2`, `-3` jika sudah dipakai via `resolveSlug`)
   - Simpan ke database via `Products::create($data)`
   - Redirect ke `products.index` dengan flash message `"Produk berhasil ditambahkan."`

3. **Route** (`routes/web.php`)
   - `GET /dashboard/products/create` → form tambah produk (`ProductController@create`)
   - `POST /dashboard/products` → simpan produk baru (`ProductController@store`)

4. **View Create** (`resources/views/dashboards/products/create.blade.php`)
   - Include `_form.blade.php` sebagai partial form
   - Title tab: "Add Product"

5. **Pembersihan Code**
   - Hapus dead code `$product` dari `_form.blade.php` (form hanya untuk create)
   - Hapus `@method('PUT')` conditional yang tidak terpakai
   - Button text fixed: "Simpan" (tidak ada kondisi Update)

### Cara menjalankan:

```bash
php artisan serve   # buka http://127.0.0.1:8000
```

- Login sebagai admin → buka **Products** → klik **+ Add Product**
- Isi form → klik **Simpan** → produk baru tersimpan di database

### Struktur Rute:

| Metode | URL | Controller | Keterangan |
|--------|-----|------------|------------|
| `GET` | `/dashboard/products/create` | `Admin\ProductController@create` | Form tambah produk |
| `POST` | `/dashboard/products` | `Admin\ProductController@store` | Simpan produk baru |

### Verifikasi:

```bash
php artisan route:list   # cek route create & store terdaftar
```

---

## Sesi 21 - Croppie Image Crop & AVIF Conversion

### Yang sudah dikerjakan:

1. **Croppie.js Integration**
   - Load Croppie.js v2.6.5 via CDN (CSS + JS) di `layouts/app.blade.php`
   - Viewport square 250x250 untuk crop gambar produk

2. **Form Input Gambar** (`_form.blade.php` + `_modals.blade.php`)
   - Input file `accept="image/*"` menggantikan input URL
   - Preview gambar sebelum upload
   - Tombol Crop & Hapus

3. **AVIF Conversion** (`Admin\ProductController`)
   - Base64 dari Croppie di-decode via GD
   - Konversi ke AVIF via `imageavif()` (quality 80)
   - Simpan ke `storage/app/public/products/{uuid}.avif`
   - Storage symlink dibuat via `php artisan storage:link`

4. **Update Image Display**
   - Semua tampilan gambar diubah ke `asset('storage/' . $product->image)`

### Cara menjalankan:

```bash
php artisan storage:link   # buat symlink public/storage
php artisan serve          # buka http://127.0.0.1:8000
```

- Login sebagai admin → **Products** → **+ Add Product**
- Pilih file gambar → Croppie muncul → Crop → Simpan
- Gambar otomatis dikonversi ke AVIF dan disimpan di `storage/app/public/products/`

### Struktur Storage:

| Path | Keterangan |
|------|------------|
| `storage/app/public/products/` | Folder penyimpanan file gambar AVIF |
| `public/storage/` | Symlink ke `storage/app/public` |

---

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
