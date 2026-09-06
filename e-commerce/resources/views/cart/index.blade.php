<x-app-layout headerTitle="Keranjang">
    <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-pill btn-sm px-4 mb-4">← Kembali</a>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="panel-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="font-display fw-bold mb-0">Keranjang Belanja</h5>
                    <span class="text-muted small">{{ $cartItems->count() }} item</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle admin-table mb-0">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end">Harga</th>
                                <th class="text-end">Subtotal</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cartItems as $item)
                                <tr>
                                    <td class="fw-semibold">{{ $item->product->name ?? 'N/A' }}</td>
                                    <td class="text-center">
                                        <form method="POST" action="{{ route('cart.update', $item) }}" class="d-inline-flex align-items-center gap-1 justify-content-center">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" class="form-control form-control-sm text-center" style="max-width: 70px;" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock ?? 99 }}">
                                            <button type="submit" class="btn btn-outline-primary btn-sm btn-pill">Ubah</button>
                                        </form>
                                    </td>
                                    <td class="text-end card-price">Rp{{ number_format($item->product->price ?? 0, 0, ',', '.') }}</td>
                                    <td class="text-end card-price">Rp{{ number_format(($item->product->price ?? 0) * $item->quantity, 0, ',', '.') }}</td>
                                    <td class="text-end">
                                        <form method="POST" action="{{ route('cart.destroy', $item) }}" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm btn-pill">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">Keranjang masih kosong.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        @if ($cartItems->count())
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-end fw-bold">Total</td>
                                    <td class="text-end fw-bold card-price">Rp{{ number_format($total, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>
                @if ($cartItems->count())
                    <div class="d-flex justify-content-end mt-3">
                        <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-pill px-5">Beli</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
