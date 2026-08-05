# Graph Report - Tugas_Bootcamp  (2026-08-01)

## Corpus Check
- 152 files · ~780,241 words
- Verdict: corpus is large enough that graph structure adds value.

## Summary
- 591 nodes · 606 edges · 121 communities (119 shown, 2 thin omitted)
- Extraction: 100% EXTRACTED · 0% INFERRED · 0% AMBIGUOUS · INFERRED: 3 edges (avg confidence: 0.8)
- Token cost: 0 input · 0 output

## Graph Freshness
- Built from commit: `86e52b61`
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
- Tugas_11/routes/web.php
- Controller
- Closure
- Tugas_12/README.md

## God Nodes (most connected - your core abstractions)
1. `Installer` - 22 edges
2. `process()` - 10 edges
3. `out()` - 10 edges
4. `scripts` - 9 edges
5. `Product` - 9 edges
6. `scripts` - 9 edges
7. `HttpClient` - 9 edges
8. `require-dev` - 8 edges
9. `Order` - 8 edges
10. `require-dev` - 8 edges

## Surprising Connections (you probably didn't know these)
- `setup` --extends--> `composer install`  [EXTRACTED]
  Tugas_11/composer.json → Tugas_12/composer.json
- `setup` --extends--> `@php artisan key:generate`  [EXTRACTED]
  Tugas_11/composer.json → Tugas_12/composer.json
- `setup` --extends--> `@php artisan migrate --force`  [EXTRACTED]
  Tugas_11/composer.json → Tugas_12/composer.json
- `setup` --extends--> `npm install --ignore-scripts`  [EXTRACTED]
  Tugas_11/composer.json → Tugas_12/composer.json
- `setup` --extends--> `npm run build`  [EXTRACTED]
  Tugas_11/composer.json → Tugas_12/composer.json

## Import Cycles
- None detected.

## Communities (121 total, 2 thin omitted)

### Community 7 - "Tugas 9 - TokoKu (E-Commerce)"
Cohesion: 0.20
Nodes (9): Admin (Seller), Akses Admin, Cara Menjalankan, Customer, Database, Fitur, Halaman, Teknologi (+1 more)

### Community 8 - "Fitur"
Cohesion: 0.08
Nodes (21): checkParams(), checkPlatform(), displayHelp(), ErrorHandler, getHomeDir(), getIniMessage(), getOptValue(), getPlatformIssues() (+13 more)

### Community 23 - "Tugas_10/composer.json"
Cohesion: 0.06
Nodes (33): autoload, autoload-dev, psr-4, psr-4, description, extra, laravel, framework (+25 more)

### Community 24 - "Tugas_11/composer.json"
Cohesion: 0.05
Nodes (40): pestphp/pest-plugin, php-http/discovery, autoload, autoload-dev, psr-4, psr-4, config, allow-plugins (+32 more)

### Community 25 - "scripts"
Cohesion: 0.06
Nodes (43): Composer\\Config::disableProcessTimeout, composer install, Illuminate\\Foundation\\ComposerScripts::postAutoloadDump, Illuminate\\Foundation\\ComposerScripts::prePackageUninstall, npm install --ignore-scripts, npm run build, npx concurrently -c \"#93c5fd,#c4b5fd,#fb7185,#fdba74\" \"php artisan serve\" \"php artisan queue:listen --tries=1 --timeout=0\" \"php artisan pail --timeout=0\" \"npm run dev\" --names=server,queue,logs,vite --kill-others, @php artisan config:clear --ansi @no_additional_args (+35 more)

### Community 26 - "Product"
Cohesion: 0.15
Nodes (7): Illuminate\Database\Eloquent\Model, Illuminate\Http\Request, Controller, OrderController, ProductController, Order, Product

### Community 27 - "devDependencies"
Cohesion: 0.10
Nodes (20): autoprefixer, axios, postcss, devDependencies, autoprefixer, axios, concurrently, laravel-vite-plugin (+12 more)

### Community 28 - "devDependencies"
Cohesion: 0.06
Nodes (33): concurrently, laravel-vite-plugin, tailwindcss, @tailwindcss/vite, devDependencies, concurrently, laravel-vite-plugin, tailwindcss (+25 more)

### Community 29 - "User"
Cohesion: 0.16
Nodes (11): Illuminate\Database\Console\Seeds\WithoutModelEvents, Illuminate\Database\Eloquent\Factories\HasFactory, Illuminate\Database\Seeder, Illuminate\Foundation\Auth\User, Illuminate\Notifications\Notifiable, User, DatabaseSeeder, User (+3 more)

### Community 30 - "scripts"
Cohesion: 0.13
Nodes (15): npx concurrently -c \"#93c5fd,#c4b5fd,#fb7185,#fdba74\" \"php artisan serve\" \"php artisan queue:listen --tries=1\" \"php artisan pail --timeout=0\" \"npm run dev\" --names=server,queue,logs,vite, Composer\\Config::disableProcessTimeout, Illuminate\\Foundation\\ComposerScripts::postAutoloadDump, @php artisan key:generate --ansi, @php artisan migrate --graceful --ansi, @php artisan package:discover --ansi, @php artisan vendor:publish --tag=laravel-assets --ansi --force, @php -r \"file_exists('database/database.sqlite') || touch('database/database.sqlite');\ (+7 more)

### Community 31 - "config"
Cohesion: 0.15
Nodes (13): true, block, pestphp/pest-plugin, php-http/discovery, ignore, config, allow-plugins, audit (+5 more)

### Community 32 - "HttpClient"
Cohesion: 0.05
Nodes (40): framework, laravel, pestphp/pest-plugin, php-http/discovery, autoload, autoload-dev, psr-4, psr-4 (+32 more)

### Community 33 - "Illuminate\Database\Eloquent\Factories\Factory"
Cohesion: 0.17
Nodes (7): Illuminate\Database\Eloquent\Factories\Factory, static, static, UserFactory, static, UserFactory, UserFactory

### Community 34 - "TestCase"
Cohesion: 0.16
Nodes (7): Illuminate\Foundation\Testing\TestCase, ExampleTest, TestCase, ExampleTest, TestCase, ExampleTest, TestCase

### Community 35 - "Illuminate\Support\ServiceProvider"
Cohesion: 0.19
Nodes (4): Illuminate\Support\ServiceProvider, AppServiceProvider, AppServiceProvider, AppServiceProvider

### Community 36 - "Tugas_10/README.md"
Cohesion: 0.22
Nodes (8): About Laravel, Code of Conduct, Contributing, Laravel Sponsors, Learning Laravel, License, Premium Partners, Security Vulnerabilities

### Community 37 - "Tugas_11/README.md"
Cohesion: 0.25
Nodes (7): About Laravel, Agentic Development, Code of Conduct, Contributing, Learning Laravel, License, Security Vulnerabilities

### Community 38 - "PHPUnit\Framework\TestCase"
Cohesion: 0.27
Nodes (4): PHPUnit\Framework\TestCase, ExampleTest, ExampleTest, ExampleTest

### Community 86 - "Tugas_11/routes/web.php"
Cohesion: 0.29
Nodes (3): Controller, HomeController, ProductController

### Community 91 - "Controller"
Cohesion: 0.17
Nodes (4): CartController, Controller, HomeController, ProductController

### Community 92 - "Closure"
Cohesion: 0.33
Nodes (5): Closure, Illuminate\Contracts\View\View, Illuminate\View\Component, Footer, Navbar

### Community 93 - "Tugas_12/README.md"
Cohesion: 0.25
Nodes (7): About Laravel, Agentic Development, Code of Conduct, Contributing, Learning Laravel, License, Security Vulnerabilities

## Knowledge Gaps
- **172 isolated node(s):** `About Laravel`, `Learning Laravel`, `Agentic Development`, `Contributing`, `Code of Conduct` (+167 more)
  These have ≤1 connection - possible missing edges or undocumented components.
- **2 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `scripts` connect `scripts` to `Tugas_11/composer.json`?**
  _High betweenness centrality (0.024) - this node is a cross-community bridge._
- **Why does `scripts` connect `scripts` to `HttpClient`?**
  _High betweenness centrality (0.024) - this node is a cross-community bridge._
- **What connects `About Laravel`, `Learning Laravel`, `Agentic Development` to the rest of the system?**
  _172 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `Fitur` be split into smaller, more focused modules?**
  _Cohesion score 0.07597402597402597 - nodes in this community are weakly interconnected._
- **Should `Tugas_10/composer.json` be split into smaller, more focused modules?**
  _Cohesion score 0.058823529411764705 - nodes in this community are weakly interconnected._
- **Should `Tugas_11/composer.json` be split into smaller, more focused modules?**
  _Cohesion score 0.04878048780487805 - nodes in this community are weakly interconnected._
- **Should `scripts` be split into smaller, more focused modules?**
  _Cohesion score 0.05758582502768549 - nodes in this community are weakly interconnected._