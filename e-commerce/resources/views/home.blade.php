@extends('template.body')

@section('content')
    <section class="carousel-section my-4 mx-3">
        <div id="promoCarousel" class="carousel slide rounded-4 overflow-hidden" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://placehold.co/1200x400/0f172a/ffffff?text=Promo+1" class="d-block w-100" alt="Promo 1">
                </div>
                <div class="carousel-item">
                    <img src="https://placehold.co/1200x400/6366f1/ffffff?text=Promo+2" class="d-block w-100" alt="Promo 2">
                </div>
                <div class="carousel-item">
                    <img src="https://placehold.co/1200x400/1e293b/ffffff?text=Promo+3" class="d-block w-100" alt="Promo 3">
                </div>
            </div>
        </div>
    </section>

    <hr>

    <section class="rekomendasi mt-4 mb-4" style="max-width: 1400px;">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h2 class="fw-bold mb-0">Rekomendasi</h2>
            <a href="#" class="text-decoration-none">Lihat Selengkapnya &gt;</a>
        </div>
        <hr class="my-3">

        <div class="row row-cols-2 row-cols-lg-4 g-4">
            @foreach ($products as $product)
                <div class="col">
                    <div class="card h-100 rounded-4" style="width: 18rem">
                        <img src="https://placehold.co/300x200/e2e8f0/0f172a?text=Produk+{{ $product->image }}" class="card-img-top" alt="Produk {{ $product->image }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Produk {{ $product->name }}</h5>
                            <p class="card-text text-primary fw-bold">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                            <button type="button" class="btn btn-primary w-100 mt-auto">Beli</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-3">
            {{ $products->links() }}
        </div>
    </section>
@endsection