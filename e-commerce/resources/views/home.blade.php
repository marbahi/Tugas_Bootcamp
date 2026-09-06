@extends('template.body')

@section('content')
    <section class="mb-5 pt-1">
        <div id="promoCarousel" class="carousel slide promo-carousel" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="promo-slide">
                        <span class="promo-ghost promo-ghost--right" aria-hidden="true">1</span>
                        <div class="promo-caption">
                            <h2 class="promo-title">Promo <span class="promo-digit">1</span></h2>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="promo-slide">
                        <span class="promo-ghost promo-ghost--left" aria-hidden="true">2</span>
                        <div class="promo-caption">
                            <h2 class="promo-title">Promo <span class="promo-digit">2</span></h2>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="promo-slide">
                        <span class="promo-ghost promo-ghost--right promo-ghost--bottom" aria-hidden="true">3</span>
                        <div class="promo-caption">
                            <h2 class="promo-title">Promo <span class="promo-digit">3</span></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-5" style="max-width: 1400px;">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h2 class="font-display fw-bold mb-0 fs-2">Rekomendasi</h2>
            <a href="#" class="see-more">Lihat Selengkapnya &gt;</a>
        </div>
        <hr class="section-hr">

        <div class="row row-cols-2 row-cols-lg-4 g-3 g-lg-4">
            @foreach ($products as $product)
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

        <div class="d-flex justify-content-center mt-4">
            {{ $products->links() }}
        </div>
    </section>
@endsection