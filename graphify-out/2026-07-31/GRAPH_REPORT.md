# Graph Report - Tugas_Bootcamp  (2026-07-31)

## Corpus Check
- 102 files · ~768,217 words
- Verdict: corpus is large enough that graph structure adds value.

## Summary
- 417 nodes · 436 edges · 88 communities (87 shown, 1 thin omitted)
- Extraction: 100% EXTRACTED · 0% INFERRED · 0% AMBIGUOUS · INFERRED: 2 edges (avg confidence: 0.8)
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `c5800fbe`
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

## God Nodes (most connected - your core abstractions)
1. `Installer` - 22 edges
2. `process()` - 10 edges
3. `out()` - 10 edges
4. `Product` - 9 edges
5. `scripts` - 9 edges
6. `HttpClient` - 9 edges
7. `Order` - 8 edges
8. `require-dev` - 8 edges
9. `require-dev` - 8 edges
10. `ProductController` - 7 edges

## Surprising Connections (you probably didn't know these)
- `ExampleTest` --inherits--> `TestCase`  [EXTRACTED]
  Tugas_11/tests/Feature/ExampleTest.php → Tugas_10/tests/TestCase.php
- `OrderController` --inherits--> `Controller`  [EXTRACTED]
  Tugas_10/app/Http/Controllers/OrderController.php → Tugas_10/app/Http/Controllers/Controller.php
- `ProductController` --inherits--> `Controller`  [EXTRACTED]
  Tugas_10/app/Http/Controllers/ProductController.php → Tugas_10/app/Http/Controllers/Controller.php
- `ExampleTest` --inherits--> `TestCase`  [EXTRACTED]
  Tugas_10/tests/Feature/ExampleTest.php → Tugas_10/tests/TestCase.php

## Import Cycles
- None detected.

## Communities (88 total, 1 thin omitted)

### Community 7 - "Tugas 9 - TokoKu (E-Commerce)"
Cohesion: 0.20
Nodes (9): Admin (Seller), Akses Admin, Cara Menjalankan, Customer, Database, Fitur, Halaman, Teknologi (+1 more)

### Community 8 - "Fitur"
Cohesion: 0.10
Nodes (18): checkParams(), checkPlatform(), displayHelp(), ErrorHandler, getHomeDir(), getIniMessage(), getOptValue(), getPlatformIssues() (+10 more)

### Community 23 - "Tugas_10/composer.json"
Cohesion: 0.06
Nodes (33): autoload, autoload-dev, psr-4, psr-4, description, extra, laravel, framework (+25 more)

### Community 24 - "Tugas_11/composer.json"
Cohesion: 0.06
Nodes (33): autoload, autoload-dev, psr-4, psr-4, description, extra, laravel, framework (+25 more)

### Community 25 - "scripts"
Cohesion: 0.08
Nodes (26): composer install, Illuminate\\Foundation\\ComposerScripts::prePackageUninstall, npm install --ignore-scripts, npm run build, npx concurrently -c \"#93c5fd,#c4b5fd,#fb7185,#fdba74\" \"php artisan serve\" \"php artisan queue:listen --tries=1 --timeout=0\" \"php artisan pail --timeout=0\" \"npm run dev\" --names=server,queue,logs,vite --kill-others, @php artisan config:clear --ansi @no_additional_args, @php artisan key:generate, @php artisan migrate --force (+18 more)

### Community 26 - "Product"
Cohesion: 0.15
Nodes (7): Illuminate\Database\Eloquent\Model, Illuminate\Http\Request, Controller, OrderController, ProductController, Order, Product

### Community 27 - "devDependencies"
Cohesion: 0.10
Nodes (20): autoprefixer, axios, postcss, devDependencies, autoprefixer, axios, concurrently, laravel-vite-plugin (+12 more)

### Community 28 - "devDependencies"
Cohesion: 0.11
Nodes (17): @tailwindcss/vite, devDependencies, concurrently, laravel-vite-plugin, tailwindcss, @tailwindcss/vite, vite, concurrently (+9 more)

### Community 29 - "User"
Cohesion: 0.19
Nodes (9): Illuminate\Database\Console\Seeds\WithoutModelEvents, Illuminate\Database\Eloquent\Factories\HasFactory, Illuminate\Database\Seeder, Illuminate\Foundation\Auth\User, Illuminate\Notifications\Notifiable, User, DatabaseSeeder, User (+1 more)

### Community 30 - "scripts"
Cohesion: 0.13
Nodes (15): npx concurrently -c \"#93c5fd,#c4b5fd,#fb7185,#fdba74\" \"php artisan serve\" \"php artisan queue:listen --tries=1\" \"php artisan pail --timeout=0\" \"npm run dev\" --names=server,queue,logs,vite, Composer\\Config::disableProcessTimeout, Illuminate\\Foundation\\ComposerScripts::postAutoloadDump, @php artisan key:generate --ansi, @php artisan migrate --graceful --ansi, @php artisan package:discover --ansi, @php artisan vendor:publish --tag=laravel-assets --ansi --force, @php -r \"file_exists('database/database.sqlite') || touch('database/database.sqlite');\ (+7 more)

### Community 31 - "config"
Cohesion: 0.15
Nodes (13): true, block, pestphp/pest-plugin, php-http/discovery, ignore, config, allow-plugins, audit (+5 more)

### Community 32 - "HttpClient"
Cohesion: 0.24
Nodes (3): HttpClient, NoProxyPattern, validateCaFile()

### Community 33 - "Illuminate\Database\Eloquent\Factories\Factory"
Cohesion: 0.25
Nodes (5): Illuminate\Database\Eloquent\Factories\Factory, static, UserFactory, static, UserFactory

### Community 34 - "TestCase"
Cohesion: 0.24
Nodes (5): Illuminate\Foundation\Testing\TestCase, ExampleTest, TestCase, ExampleTest, TestCase

### Community 35 - "Illuminate\Support\ServiceProvider"
Cohesion: 0.28
Nodes (3): Illuminate\Support\ServiceProvider, AppServiceProvider, AppServiceProvider

### Community 36 - "Tugas_10/README.md"
Cohesion: 0.22
Nodes (8): About Laravel, Code of Conduct, Contributing, Laravel Sponsors, Learning Laravel, License, Premium Partners, Security Vulnerabilities

### Community 37 - "Tugas_11/README.md"
Cohesion: 0.25
Nodes (7): About Laravel, Agentic Development, Code of Conduct, Contributing, Learning Laravel, License, Security Vulnerabilities

### Community 38 - "PHPUnit\Framework\TestCase"
Cohesion: 0.38
Nodes (3): PHPUnit\Framework\TestCase, ExampleTest, ExampleTest

### Community 39 - "config"
Cohesion: 0.29
Nodes (7): pestphp/pest-plugin, php-http/discovery, config, allow-plugins, optimize-autoloader, preferred-install, sort-packages

## Knowledge Gaps
- **128 isolated node(s):** `About Laravel`, `Learning Laravel`, `Premium Partners`, `Contributing`, `Code of Conduct` (+123 more)
  These have ≤1 connection - possible missing edges or undocumented components.
- **1 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `scripts` connect `scripts` to `Tugas_11/composer.json`?**
  _High betweenness centrality (0.015) - this node is a cross-community bridge._
- **Why does `scripts` connect `scripts` to `Tugas_10/composer.json`?**
  _High betweenness centrality (0.009) - this node is a cross-community bridge._
- **What connects `About Laravel`, `Learning Laravel`, `Premium Partners` to the rest of the system?**
  _128 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `Fitur` be split into smaller, more focused modules?**
  _Cohesion score 0.09898989898989899 - nodes in this community are weakly interconnected._
- **Should `Tugas_10/composer.json` be split into smaller, more focused modules?**
  _Cohesion score 0.058823529411764705 - nodes in this community are weakly interconnected._
- **Should `Tugas_11/composer.json` be split into smaller, more focused modules?**
  _Cohesion score 0.058823529411764705 - nodes in this community are weakly interconnected._
- **Should `scripts` be split into smaller, more focused modules?**
  _Cohesion score 0.08 - nodes in this community are weakly interconnected._