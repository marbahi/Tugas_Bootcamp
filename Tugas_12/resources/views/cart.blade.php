@extends('templates.body')

@section('content')
    <section class="cart-section mt-4 mb-4" style="max-width: 1400px;">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
            <h2 class="fw-bold mb-0">Keranjang</h2>
            <span class="text-muted" id="cartCount">{{ count($cartItems) }} barang</span>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="d-flex align-items-center mb-3 ps-1">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="selectAll">
                        <label class="form-check-label" for="selectAll">Pilih Semua</label>
                    </div>
                </div>

                @forelse ($cartItems as $item)
                    <div class="card rounded-4 mb-3 cart-item" data-id="{{ $item['id'] }}" data-price="{{ $item['price'] }}" data-name="{{ $item['name'] }}">
                        <div class="card-body d-flex flex-wrap align-items-center gap-3">
                            <div class="form-check mb-0">
                                <input class="form-check-input item-check" type="checkbox" checked>
                            </div>

                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="rounded-3" width="80" height="80" style="object-fit: cover;">

                            <div class="flex-grow-1">
                                <h6 class="mb-1 fw-semibold">{{ $item['name'] }}</h6>
                                <span class="text-primary fw-bold">Rp{{ number_format($item['price'], 0, ',', '.') }}</span>
                            </div>

                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="btn btn-outline-secondary btn-sm btn-qty-minus">-</button>
                                <input type="number" class="form-control form-control-sm text-center qty-input" style="width: 60px;" value="{{ $item['qty'] }}" min="1">
                                <button type="button" class="btn btn-outline-secondary btn-sm btn-qty-plus">+</button>
                            </div>

                            <div class="text-end" style="min-width: 110px;">
                                <div class="fw-bold line-total">Rp{{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</div>
                                <button type="button" class="btn btn-link text-danger p-0 btn-delete mt-1" style="font-size: .8rem;">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card rounded-4">
                        <div class="card-body text-center text-muted py-5">
                            <i class="bi bi-cart-x fs-1 d-block mb-2"></i>
                            Keranjang kosong
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="col-lg-4">
                <div class="card rounded-4 sticky-lg-top" style="top: 1rem;">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Ringkasan Belanja</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Total barang</span>
                            <span id="summaryCount">0</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="fw-semibold">Subtotal</span>
                            <span class="fw-bold text-primary" id="summarySubtotal">Rp0</span>
                        </div>
                        <button type="button" class="btn btn-primary w-100 rounded-3 fw-semibold" id="btnCheckout" disabled>Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        const items = document.querySelectorAll('.cart-item');
        const selectAll = document.getElementById('selectAll');
        const summaryCount = document.getElementById('summaryCount');
        const summarySubtotal = document.getElementById('summarySubtotal');
        const btnCheckout = document.getElementById('btnCheckout');
        const cartCount = document.getElementById('cartCount');

        const formatRupiah = (num) => 'Rp' + num.toLocaleString('id-ID');

        function lineTotal(item) {
            const price = parseInt(item.dataset.price);
            const qty = parseInt(item.querySelector('.qty-input').value);
            const total = price * qty;
            item.querySelector('.line-total').textContent = formatRupiah(total);
            return total;
        }

        function recalc() {
            let subtotal = 0;
            let count = 0;
            items.forEach((item) => {
                if (item.querySelector('.item-check').checked) {
                    subtotal += lineTotal(item);
                    count++;
                }
            });
            summarySubtotal.textContent = formatRupiah(subtotal);
            summaryCount.textContent = count;
            btnCheckout.disabled = count === 0;
        }

        items.forEach((item) => {
            const check = item.querySelector('.item-check');
            const qtyInput = item.querySelector('.qty-input');
            const minus = item.querySelector('.btn-qty-minus');
            const plus = item.querySelector('.btn-qty-plus');
            const del = item.querySelector('.btn-delete');

            check.addEventListener('change', recalc);
            qtyInput.addEventListener('change', () => {
                qtyInput.value = Math.max(1, parseInt(qtyInput.value) || 1);
                recalc();
            });
            minus.addEventListener('click', () => {
                qtyInput.value = Math.max(1, parseInt(qtyInput.value) - 1);
                recalc();
            });
            plus.addEventListener('click', () => {
                qtyInput.value = parseInt(qtyInput.value) + 1;
                recalc();
            });
            del.addEventListener('click', () => {
                item.remove();
                cartCount.textContent = document.querySelectorAll('.cart-item').length + ' barang';
                recalc();
            });
        });

        selectAll.addEventListener('change', () => {
            items.forEach((item) => {
                item.querySelector('.item-check').checked = selectAll.checked;
            });
            recalc();
        });

        btnCheckout.addEventListener('click', () => {
            const selected = [...items]
                .filter((item) => item.querySelector('.item-check').checked)
                .map((item) => item.dataset.name)
                .join(', ');
            alert('Checkout: ' + (selected || 'tidak ada'));
        });

        recalc();
    </script>
@endsection
