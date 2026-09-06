# Graph Report - Tugas_Bootcamp  (2026-09-01)

## Corpus Check
- 276 files · ~805,809 words
- Verdict: corpus is large enough that graph structure adds value.

## Summary
- 1101 nodes · 1288 edges · 208 communities (194 shown, 14 thin omitted)
- Extraction: 98% EXTRACTED · 2% INFERRED · 0% AMBIGUOUS · INFERRED: 28 edges (avg confidence: 0.8)
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `13c78c49`
- Run `git rev-parse HEAD` and compare to check if the graph is stale.
- Run `graphify update .` after code changes (no API cost).

## Community Hubs (Navigation)
- Tugas 9 - TokoKu (E-Commerce)
- Fitur
- Tugas_10/composer.json
- Tugas_11/composer.json
- scripts
- Product
- devDependencies
- devDependencies
- User
- scripts
- config
- HttpClient
- Illuminate\Database\Eloquent\Factories\Factory
- TestCase
- Illuminate\Support\ServiceProvider
- Tugas_10/README.md
- Tugas_11/README.md
- PHPUnit\Framework\TestCase
- config
- Tugas_11/app/Http/Controllers/Controller.php
- Controller
- Closure
- Tugas_12/README.md
- devDependencies
- ProductCategories
- Illuminate\Http\Request
- CartItemsController
- Sesi 13 - Database Migration & Dummy Data
- ProductController
- scripts
- scripts
- devDependencies
- script.js
- e-commerce/app/Http/Controllers/Controller.php
- OrdersController
- App\Models\ProductCategories
- CategoryController
- CartController
- HomeController
- Order
- products/create.blade.php
- VerifyEmailController.php
- ProductController
- product-categories/index.blade.php
- products/index.blade.php
- ProductController

## God Nodes (most connected - your core abstractions)
1. `Controller` - 31 edges
2. `TestCase` - 27 edges
3. `User` - 26 edges
4. `Installer` - 22 edges
5. `E-Commerce - Tugas Bootcamp` - 10 edges
6. `E-Commerce - Tugas Bootcamp` - 10 edges
7. `ProductController` - 10 edges
8. `process()` - 10 edges
9. `out()` - 10 edges
10. `ProductCategoriesController` - 9 edges

## Surprising Connections (you probably didn't know these)
- `ProductController` --inherits--> `Controller`  [EXTRACTED]
  Tugas_11/app/Http/Controllers/ProductController.php → Tugas_10/app/Http/Controllers/Controller.php
- `NewPasswordController` --inherits--> `Controller`  [EXTRACTED]
  e-commerce/app/Http/Controllers/Auth/NewPasswordController.php → Tugas_10/app/Http/Controllers/Controller.php
- `CartItemsController` --inherits--> `Controller`  [EXTRACTED]
  e-commerce/app/Http/Controllers/CartItemsController.php → Tugas_10/app/Http/Controllers/Controller.php
- `HomeController` --inherits--> `Controller`  [EXTRACTED]
  e-commerce/app/Http/Controllers/HomeController.php → Tugas_10/app/Http/Controllers/Controller.php
- `OrderItemsController` --inherits--> `Controller`  [EXTRACTED]
  e-commerce/app/Http/Controllers/OrderItemsController.php → Tugas_10/app/Http/Controllers/Controller.php

## Import Cycles
- None detected.

## Communities (208 total, 14 thin omitted)

### Community 7 - "Tugas 9 - TokoKu (E-Commerce)"
Cohesion: 0.05
Nodes (40): Cara menjalankan:, Cara menjalankan:, Cara menjalankan:, Cara menjalankan:, Cara menjalankan:, Cara menjalankan:, Cara menjalankan:, Cara menjalankan: (+32 more)

### Community 8 - "Fitur"
Cohesion: 0.08
Nodes (21): checkParams(), checkPlatform(), displayHelp(), ErrorHandler, getHomeDir(), getIniMessage(), getOptValue(), getPlatformIssues() (+13 more)

### Community 23 - "Tugas_10/composer.json"
Cohesion: 0.04
Nodes (46): true, block, pestphp/pest-plugin, php-http/discovery, ignore, autoload, autoload-dev, psr-4 (+38 more)

### Community 24 - "Tugas_11/composer.json"
Cohesion: 0.05
Nodes (40): pestphp/pest-plugin, php-http/discovery, autoload, autoload-dev, psr-4, psr-4, config, allow-plugins (+32 more)

### Community 25 - "scripts"
Cohesion: 0.08
Nodes (26): Composer\\Config::disableProcessTimeout, composer install, Illuminate\\Foundation\\ComposerScripts::postAutoloadDump, Illuminate\\Foundation\\ComposerScripts::prePackageUninstall, npm install --ignore-scripts, npm run build, npx concurrently -c \"#93c5fd,#c4b5fd,#fb7185,#fdba74\" \"php artisan serve\" \"php artisan queue:listen --tries=1 --timeout=0\" \"php artisan pail --timeout=0\" \"npm run dev\" --names=server,queue,logs,vite --kill-others, @php artisan config:clear --ansi @no_additional_args (+18 more)

### Community 26 - "Product"
Cohesion: 0.24
Nodes (3): LoginRequest, ProfileUpdateRequest, Illuminate\Foundation\Http\FormRequest

### Community 27 - "devDependencies"
Cohesion: 0.10
Nodes (20): axios, devDependencies, autoprefixer, axios, concurrently, laravel-vite-plugin, postcss, tailwindcss (+12 more)

### Community 28 - "devDependencies"
Cohesion: 0.08
Nodes (25): alpinejs, devDependencies, alpinejs, autoprefixer, concurrently, laravel-vite-plugin, postcss, tailwindcss (+17 more)

### Community 29 - "User"
Cohesion: 0.10
Nodes (15): CategorySeeder, DatabaseSeeder, ProductSeeder, UserSeeder, Illuminate\Database\Console\Seeds\WithoutModelEvents, Illuminate\Database\Eloquent\Factories\HasFactory, Illuminate\Database\Seeder, Illuminate\Foundation\Auth\User (+7 more)

### Community 30 - "scripts"
Cohesion: 0.13
Nodes (15): npx concurrently -c \"#93c5fd,#c4b5fd,#fb7185,#fdba74\" \"php artisan serve\" \"php artisan queue:listen --tries=1\" \"php artisan pail --timeout=0\" \"npm run dev\" --names=server,queue,logs,vite, Composer\\Config::disableProcessTimeout, Illuminate\\Foundation\\ComposerScripts::postAutoloadDump, @php artisan key:generate --ansi, @php artisan migrate --graceful --ansi, @php artisan package:discover --ansi, @php artisan vendor:publish --tag=laravel-assets --ansi --force, @php -r \"file_exists('database/database.sqlite') || touch('database/database.sqlite');\ (+7 more)

### Community 31 - "config"
Cohesion: 0.05
Nodes (41): pestphp/pest-plugin, php-http/discovery, autoload, autoload-dev, psr-4, psr-4, config, allow-plugins (+33 more)

### Community 32 - "HttpClient"
Cohesion: 0.05
Nodes (40): pestphp/pest-plugin, php-http/discovery, autoload, autoload-dev, psr-4, psr-4, config, allow-plugins (+32 more)

### Community 33 - "Illuminate\Database\Eloquent\Factories\Factory"
Cohesion: 0.13
Nodes (9): static, UserFactory, Illuminate\Database\Eloquent\Factories\Factory, static, UserFactory, static, UserFactory, static (+1 more)

### Community 34 - "TestCase"
Cohesion: 0.06
Nodes (18): User, AuthenticationTest, EmailVerificationTest, PasswordConfirmationTest, PasswordResetTest, PasswordUpdateTest, RegistrationTest, ExampleTest (+10 more)

### Community 35 - "Illuminate\Support\ServiceProvider"
Cohesion: 0.15
Nodes (5): AppServiceProvider, Illuminate\Support\ServiceProvider, AppServiceProvider, AppServiceProvider, AppServiceProvider

### Community 36 - "Tugas_10/README.md"
Cohesion: 0.22
Nodes (8): About Laravel, Code of Conduct, Contributing, Laravel Sponsors, Learning Laravel, License, Premium Partners, Security Vulnerabilities

### Community 37 - "Tugas_11/README.md"
Cohesion: 0.25
Nodes (7): About Laravel, Agentic Development, Code of Conduct, Contributing, Learning Laravel, License, Security Vulnerabilities

### Community 38 - "PHPUnit\Framework\TestCase"
Cohesion: 0.21
Nodes (5): ExampleTest, PHPUnit\Framework\TestCase, ExampleTest, ExampleTest, ExampleTest

### Community 92 - "Closure"
Cohesion: 0.12
Nodes (10): Closure, AppLayout, footer, GuestLayout, header, template, Illuminate\Contracts\View\View, Illuminate\View\Component (+2 more)

### Community 93 - "Tugas_12/README.md"
Cohesion: 0.25
Nodes (7): About Laravel, Agentic Development, Code of Conduct, Contributing, Learning Laravel, License, Security Vulnerabilities

### Community 121 - "devDependencies"
Cohesion: 0.11
Nodes (17): devDependencies, concurrently, laravel-vite-plugin, tailwindcss, @tailwindcss/vite, vite, concurrently, laravel-vite-plugin (+9 more)

### Community 122 - "ProductCategories"
Cohesion: 0.21
Nodes (4): NewPasswordController, ProfileController, AdminMiddleware, Illuminate\Http\Request

### Community 123 - "Illuminate\Http\Request"
Cohesion: 0.16
Nodes (4): App\Models\Products, Controller, DashboardController, ProductsController

### Community 125 - "CartItemsController"
Cohesion: 0.50
Nodes (3): profile.partials.delete-user-form, profile.partials.update-password-form, profile.partials.update-profile-information-form

### Community 128 - "Sesi 13 - Database Migration & Dummy Data"
Cohesion: 0.05
Nodes (40): Cara menjalankan:, Cara menjalankan:, Cara menjalankan:, Cara menjalankan:, Cara menjalankan:, Cara menjalankan:, Cara menjalankan:, Cara menjalankan: (+32 more)

### Community 139 - "ProductController"
Cohesion: 0.35
Nodes (3): App\Http\Controllers\Controller, ProductController, Products

### Community 157 - "scripts"
Cohesion: 0.08
Nodes (26): Composer\\Config::disableProcessTimeout, composer install, Illuminate\\Foundation\\ComposerScripts::postAutoloadDump, Illuminate\\Foundation\\ComposerScripts::prePackageUninstall, npm install --ignore-scripts, npm run build, npx concurrently -c \"#93c5fd,#c4b5fd,#fb7185,#fdba74\" \"php artisan serve\" \"php artisan queue:listen --tries=1 --timeout=0\" \"php artisan pail --timeout=0\" \"npm run dev\" --names=server,queue,logs,vite --kill-others, @php artisan config:clear --ansi @no_additional_args (+18 more)

### Community 158 - "scripts"
Cohesion: 0.08
Nodes (26): Composer\\Config::disableProcessTimeout, composer install, Illuminate\\Foundation\\ComposerScripts::postAutoloadDump, Illuminate\\Foundation\\ComposerScripts::prePackageUninstall, npm install --ignore-scripts, npm run build, npx concurrently -c \"#93c5fd,#c4b5fd,#fb7185,#fdba74\" \"php artisan serve\" \"php artisan queue:listen --tries=1 --timeout=0\" \"php artisan pail --timeout=0\" \"npm run dev\" --names=server,queue,logs,vite --kill-others, @php artisan config:clear --ansi @no_additional_args (+18 more)

### Community 159 - "devDependencies"
Cohesion: 0.11
Nodes (17): devDependencies, concurrently, laravel-vite-plugin, tailwindcss, @tailwindcss/vite, vite, concurrently, laravel-vite-plugin (+9 more)

### Community 160 - "script.js"
Cohesion: 0.60
Nodes (4): formatRupiah(), products, renderFiltered(), renderProducts()

### Community 198 - "Order"
Cohesion: 0.06
Nodes (12): CartItemsController, HomeController, OrderItemsController, CartItems, OrderItems, ProductCategories, Products, Illuminate\Database\Eloquent\Model (+4 more)

### Community 200 - "VerifyEmailController.php"
Cohesion: 0.11
Nodes (13): AuthenticatedSessionController, ConfirmablePasswordController, EmailVerificationNotificationController, EmailVerificationPromptController, PasswordController, PasswordResetLinkController, RegisteredUserController, VerifyEmailController (+5 more)

## Knowledge Gaps
- **316 isolated node(s):** `Yang sudah dikerjakan:`, `Cara menjalankan:`, `Struktur Database:`, `Yang sudah dikerjakan:`, `Cara menjalankan:` (+311 more)
  These have ≤1 connection - possible missing edges or undocumented components.
- **14 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `User` connect `TestCase` to `VerifyEmailController.php`, `User`?**
  _High betweenness centrality (0.038) - this node is a cross-community bridge._
- **Why does `Controller` connect `VerifyEmailController.php` to `CartController`, `HomeController`, `OrdersController`, `Order`, `ProductController`, `ProductController`, `ProductCategories`?**
  _High betweenness centrality (0.023) - this node is a cross-community bridge._
- **Are the 21 inferred relationships involving `User` (e.g. with `.store()` and `.run()`) actually correct?**
  _`User` has 21 INFERRED edges - model-reasoned connections that need verification._
- **What connects `Yang sudah dikerjakan:`, `Cara menjalankan:`, `Struktur Database:` to the rest of the system?**
  _316 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `Tugas 9 - TokoKu (E-Commerce)` be split into smaller, more focused modules?**
  _Cohesion score 0.04878048780487805 - nodes in this community are weakly interconnected._
- **Should `Fitur` be split into smaller, more focused modules?**
  _Cohesion score 0.07597402597402597 - nodes in this community are weakly interconnected._
- **Should `Tugas_10/composer.json` be split into smaller, more focused modules?**
  _Cohesion score 0.0425531914893617 - nodes in this community are weakly interconnected._