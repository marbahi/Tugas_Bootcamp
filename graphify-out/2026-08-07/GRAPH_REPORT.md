# Graph Report - Tugas_Bootcamp  (2026-08-07)

## Corpus Check
- 210 files · ~793,540 words
- Verdict: corpus is large enough that graph structure adds value.

## Summary
- 843 nodes · 895 edges · 166 communities (157 shown, 9 thin omitted)
- Extraction: 100% EXTRACTED · 0% INFERRED · 0% AMBIGUOUS · INFERRED: 4 edges (avg confidence: 0.8)
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `243db7e7`
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
- OrderItemsController
- CartItemsController
- OrdersController
- Product
- Sesi 13 - Database Migration & Dummy Data
- Illuminate\Database\Eloquent\Model
- scripts
- scripts
- devDependencies
- script.js
- e-commerce/app/Http/Controllers/Controller.php

## God Nodes (most connected - your core abstractions)
1. `Installer` - 22 edges
2. `Controller` - 14 edges
3. `TestCase` - 13 edges
4. `process()` - 10 edges
5. `out()` - 10 edges
6. `ProductCategories` - 10 edges
7. `Products` - 10 edges
8. `Product` - 9 edges
9. `scripts` - 9 edges
10. `scripts` - 9 edges

## Surprising Connections (you probably didn't know these)
- `CartItemsController` --inherits--> `Controller`  [EXTRACTED]
  e-commerce/app/Http/Controllers/CartItemsController.php → Tugas_10/app/Http/Controllers/Controller.php
- `OrderItemsController` --inherits--> `Controller`  [EXTRACTED]
  e-commerce/app/Http/Controllers/OrderItemsController.php → Tugas_10/app/Http/Controllers/Controller.php
- `OrdersController` --inherits--> `Controller`  [EXTRACTED]
  e-commerce/app/Http/Controllers/OrdersController.php → Tugas_10/app/Http/Controllers/Controller.php
- `ProductCategoriesController` --inherits--> `Controller`  [EXTRACTED]
  e-commerce/app/Http/Controllers/ProductCategoriesController.php → Tugas_10/app/Http/Controllers/Controller.php
- `ProductController` --inherits--> `Controller`  [EXTRACTED]
  Tugas_11/app/Http/Controllers/ProductController.php → Tugas_10/app/Http/Controllers/Controller.php

## Import Cycles
- None detected.

## Communities (166 total, 9 thin omitted)

### Community 7 - "Tugas 9 - TokoKu (E-Commerce)"
Cohesion: 0.33
Nodes (5): Cara menjalankan:, Project - E-Commerce, Sesi 13 - E-Commerce Laravel (Database Migration & Dummy Data), Struktur Database:, Yang sudah dikerjakan:

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

### Community 27 - "devDependencies"
Cohesion: 0.10
Nodes (20): autoprefixer, axios, postcss, devDependencies, autoprefixer, axios, concurrently, laravel-vite-plugin (+12 more)

### Community 28 - "devDependencies"
Cohesion: 0.11
Nodes (17): devDependencies, concurrently, laravel-vite-plugin, tailwindcss, @tailwindcss/vite, vite, concurrently, laravel-vite-plugin (+9 more)

### Community 29 - "User"
Cohesion: 0.12
Nodes (14): User, DatabaseSeeder, ProductSeeder, Illuminate\Database\Console\Seeds\WithoutModelEvents, Illuminate\Database\Eloquent\Factories\HasFactory, Illuminate\Database\Seeder, Illuminate\Foundation\Auth\User, Illuminate\Notifications\Notifiable (+6 more)

### Community 30 - "scripts"
Cohesion: 0.13
Nodes (15): npx concurrently -c \"#93c5fd,#c4b5fd,#fb7185,#fdba74\" \"php artisan serve\" \"php artisan queue:listen --tries=1\" \"php artisan pail --timeout=0\" \"npm run dev\" --names=server,queue,logs,vite, Composer\\Config::disableProcessTimeout, Illuminate\\Foundation\\ComposerScripts::postAutoloadDump, @php artisan key:generate --ansi, @php artisan migrate --graceful --ansi, @php artisan package:discover --ansi, @php artisan vendor:publish --tag=laravel-assets --ansi --force, @php -r \"file_exists('database/database.sqlite') || touch('database/database.sqlite');\ (+7 more)

### Community 31 - "config"
Cohesion: 0.05
Nodes (40): pestphp/pest-plugin, php-http/discovery, autoload, autoload-dev, psr-4, psr-4, config, allow-plugins (+32 more)

### Community 32 - "HttpClient"
Cohesion: 0.05
Nodes (40): pestphp/pest-plugin, php-http/discovery, autoload, autoload-dev, psr-4, psr-4, config, allow-plugins (+32 more)

### Community 33 - "Illuminate\Database\Eloquent\Factories\Factory"
Cohesion: 0.13
Nodes (9): static, UserFactory, Illuminate\Database\Eloquent\Factories\Factory, static, UserFactory, static, UserFactory, static (+1 more)

### Community 34 - "TestCase"
Cohesion: 0.13
Nodes (9): ExampleTest, TestCase, Illuminate\Foundation\Testing\TestCase, ExampleTest, TestCase, ExampleTest, TestCase, ExampleTest (+1 more)

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
Cohesion: 0.18
Nodes (8): Closure, footer, header, template, Illuminate\Contracts\View\View, Illuminate\View\Component, Footer, Navbar

### Community 93 - "Tugas_12/README.md"
Cohesion: 0.25
Nodes (7): About Laravel, Agentic Development, Code of Conduct, Contributing, Learning Laravel, License, Security Vulnerabilities

### Community 121 - "devDependencies"
Cohesion: 0.11
Nodes (17): devDependencies, concurrently, laravel-vite-plugin, tailwindcss, @tailwindcss/vite, vite, concurrently, laravel-vite-plugin (+9 more)

### Community 122 - "ProductCategories"
Cohesion: 0.18
Nodes (3): ProductCategoriesController, ProductCategories, CategorySeeder

### Community 123 - "Illuminate\Http\Request"
Cohesion: 0.07
Nodes (9): HomeController, ProductsController, Products, Controller, HomeController, ProductController, CartController, HomeController (+1 more)

### Community 125 - "CartItemsController"
Cohesion: 0.26
Nodes (3): CartItemsController, CartItems, Illuminate\Http\Request

### Community 128 - "Sesi 13 - Database Migration & Dummy Data"
Cohesion: 0.29
Nodes (6): Cara menjalankan:, E-Commerce - Tugas Bootcamp, License, Sesi 13 - Database Migration & Dummy Data, Struktur Database:, Yang sudah dikerjakan:

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

## Knowledge Gaps
- **250 isolated node(s):** `$schema`, `name`, `type`, `description`, `laravel` (+245 more)
  These have ≤1 connection - possible missing edges or undocumented components.
- **9 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `ProductCategories` connect `ProductCategories` to `Illuminate\Database\Eloquent\Model`?**
  _High betweenness centrality (0.011) - this node is a cross-community bridge._
- **Why does `Controller` connect `Illuminate\Http\Request` to `Product`, `ProductCategories`, `OrderItemsController`, `CartItemsController`, `OrdersController`, `Product`?**
  _High betweenness centrality (0.008) - this node is a cross-community bridge._
- **Why does `ProductCategoriesController` connect `ProductCategories` to `Illuminate\Http\Request`?**
  _High betweenness centrality (0.004) - this node is a cross-community bridge._
- **What connects `$schema`, `name`, `type` to the rest of the system?**
  _250 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `Fitur` be split into smaller, more focused modules?**
  _Cohesion score 0.07597402597402597 - nodes in this community are weakly interconnected._
- **Should `Tugas_10/composer.json` be split into smaller, more focused modules?**
  _Cohesion score 0.0425531914893617 - nodes in this community are weakly interconnected._
- **Should `Tugas_11/composer.json` be split into smaller, more focused modules?**
  _Cohesion score 0.04878048780487805 - nodes in this community are weakly interconnected._