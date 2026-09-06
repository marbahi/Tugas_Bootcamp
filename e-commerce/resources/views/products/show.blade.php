@extends('template.body')

@section('content')
    <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-pill btn-sm px-4 mb-4">← Kembali</a>
    <div class="row g-4 g-lg-5">
        <div class="col-12 col-lg-7">
            <div class="product-gallery">
                <div id="productGallery" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                    <div class="carousel-inner">
                        @foreach ($productImages as $index => $image)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ $image }}" class="d-block w-100 gallery-main" alt="Foto {{ $index + 1 }} {{ $product->name }}">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="gallery-thumbs mt-3">
                    @foreach ($productImages as $index => $image)
                        <button type="button" class="gallery-thumb {{ $index === 0 ? 'active' : '' }}" data-bs-target="#productGallery" data-bs-slide-to="{{ $index }}" aria-label="Foto {{ $index + 1 }}">
                            <img src="{{ $image }}" alt="Foto {{ $index + 1 }} {{ $product->name }}">
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-5">
            <h1 class="font-display fw-bold mb-2">{{ $product->name }}</h1>

            <div class="d-flex align-items-center gap-2 mb-3">
                @if ($product->stock > 0)
                    <span class="badge rounded-pill stock-badge stock-badge--in">Stok: {{ $product->stock }}</span>
                @else
                    <span class="badge rounded-pill stock-badge stock-badge--out">Stok Habis</span>
                @endif
                <span class="text-muted small">{{ optional($product->category)->name }}</span>
            </div>

            <p class="detail-price mb-4">Rp{{ number_format($product->price, 0, ',', '.') }}</p>

            <p class="text-muted detail-description">{{ $product->description }}</p>

            <div class="d-flex align-items-center gap-2 mb-3">
                <span class="text-muted small">Jumlah</span>
                <div class="input-group" style="max-width: 160px;">
                    <button type="button" class="btn btn-outline-secondary" id="qty-minus" aria-label="Kurangi">−</button>
                    <input type="number" id="qty-input" class="form-control text-center" value="1" min="1" max="{{ $product->stock }}">
                    <button type="button" class="btn btn-outline-secondary" id="qty-plus" aria-label="Tambah">+</button>
                </div>
            </div>
            <div class="d-flex gap-2">
                <form method="GET" action="{{ route('checkout.index') }}" class="flex-grow-1 d-flex" id="buynow-form">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" id="buynow-qty" value="1">
                    <button type="submit" class="btn btn-primary btn-pill w-100" {{ $product->stock < 1 ? 'disabled' : '' }}>Beli</button>
                </form>
                <form method="POST" action="{{ route('cart.store') }}" class="flex-grow-1 d-flex">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" id="cart-qty" value="1">
                    <button type="submit" class="btn btn-outline-primary btn-pill w-100" {{ $product->stock < 1 ? 'disabled' : '' }}>+ Keranjang</button>
                </form>
            </div>
            <script>
                (function () {
                    const input = document.getElementById('qty-input');
                    const minus = document.getElementById('qty-minus');
                    const plus = document.getElementById('qty-plus');
                    const buynowQty = document.getElementById('buynow-qty');
                    const cartQty = document.getElementById('cart-qty');
                    if (!input || !minus || !plus) return;
                    const min = parseInt(input.min || '1', 10);
                    const max = parseInt(input.max || '99', 10);
                    const clamp = () => {
                        let v = parseInt(input.value || '1', 10);
                        if (isNaN(v)) v = min;
                        v = Math.min(Math.max(v, min), max);
                        input.value = v;
                        if (buynowQty) buynowQty.value = v;
                        if (cartQty) cartQty.value = v;
                    };
                    minus.addEventListener('click', () => {
                        input.value = parseInt(input.value || '1', 10) - 1;
                        clamp();
                    });
                    plus.addEventListener('click', () => {
                        input.value = parseInt(input.value || '1', 10) + 1;
                        clamp();
                    });
                    input.addEventListener('change', clamp);
                })();
            </script>
        </div>
    </div>

    <section class="mt-5" style="max-width: 1400px;">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h2 class="font-display fw-bold mb-0 fs-2">Rekomendasi Produk</h2>
            <span class="see-more">Lihat Selengkapnya &gt;</span>
        </div>
        <hr class="section-hr">

        <div class="row row-cols-2 row-cols-lg-4 g-3 g-lg-4">
            @foreach ($recommendations as $product)
                <div class="col">
                    <a href="{{ route('products.show', $product) }}" class="text-decoration-none">
                        <div class="card product-card h-100">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/600x450/EAF1EC/1B2A27?text=Produk+' . urlencode($product->name) }}" class="card-img-top" alt="Produk {{ $product->name }}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fs-6 fw-semibold text-body">Produk {{ $product->name }}</h5>
                                <p class="card-price mt-1 mb-0">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
@endsection