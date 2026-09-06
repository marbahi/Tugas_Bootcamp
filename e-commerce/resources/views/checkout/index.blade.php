<x-app-layout headerTitle="Checkout">
    <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary btn-pill btn-sm px-4 mb-4">← Kembali</a>
    <div class="row g-3 justify-content-center">
        <div class="col-12 col-lg-7">
            <div class="panel-card p-4 p-sm-5">
                <h5 class="font-display fw-bold mb-4">Data Pembeli</h5>
                <form method="POST" action="{{ route('checkout.store') }}">
                    @csrf
                    <input type="hidden" name="mode" value="{{ $mode }}">
                    @if ($mode === 'buy-now')
                        <input type="hidden" name="product_id" value="{{ $items->first()->product->id }}">
                        <input type="hidden" name="quantity" value="{{ $items->first()->quantity }}">
                    @endif

                    <div class="mb-3">
                        <x-input-label for="customer_name" :value="__('Nama Lengkap')" />
                        <x-text-input id="customer_name" name="customer_name" type="text" :value="old('customer_name', Auth::user()->name)" required placeholder="Nama penerima" />
                        <x-input-error :messages="$errors->get('customer_name')" />
                    </div>

                    <div class="mb-3">
                        <x-input-label for="customer_phone" :value="__('No. HP')" />
                        <x-text-input id="customer_phone" name="customer_phone" type="text" :value="old('customer_phone')" required placeholder="08xxxxxxxxxx" />
                        <x-input-error :messages="$errors->get('customer_phone')" />
                    </div>

                    <div class="mb-3">
                        <x-input-label for="customer_address" :value="__('Alamat Lengkap')" />
                        <textarea id="customer_address" name="customer_address" rows="3" class="form-control" required placeholder="Jalan, nomor rumah, kota">{{ old('customer_address') }}</textarea>
                        <x-input-error :messages="$errors->get('customer_address')" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="payment_method" :value="__('Metode Pembayaran')" />
                        <select id="payment_method" name="payment_method" class="form-select" required>
                            <option value="" disabled {{ old('payment_method') ? '' : 'selected' }}>Pilih metode...</option>
                            @foreach ($paymentMethods as $value => $label)
                                <option value="{{ $value }}" {{ old('payment_method') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('payment_method')" />
                    </div>

                    <button type="submit" class="btn btn-primary btn-pill w-100">Buat Pesanan & Konfirmasi WA</button>
                    <p class="text-muted small mt-2 mb-0">Setelah pesanan dibuat, Anda diarahkan ke WhatsApp penjual dengan rincian pesanan otomatis.</p>
                </form>
            </div>
        </div>
        <div class="col-12 col-lg-5">
            <div class="panel-card p-4 p-sm-5">
                <h5 class="font-display fw-bold mb-4">Ringkasan</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle admin-table mb-0">
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td class="fw-semibold">{{ $item->product->name ?? 'N/A' }} <span class="text-muted">x{{ $item->quantity }}</span></td>
                                    <td class="text-end card-price">Rp{{ number_format(($item->price ?? $item->product->price ?? 0) * $item->quantity, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="fw-bold">Total</td>
                                <td class="text-end fw-bold card-price">Rp{{ number_format($total, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
