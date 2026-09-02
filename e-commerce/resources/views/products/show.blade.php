@extends('template.body')

@section('content')
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

            <button type="button" class="btn btn-primary btn-pill w-100" {{ $product->stock < 1 ? 'disabled' : '' }}>Beli</button>
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
                                <p class="card-price mt-1 mb-3">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                <button type="button" class="btn btn-primary btn-pill w-100 mt-auto">Beli</button>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>
@endsection