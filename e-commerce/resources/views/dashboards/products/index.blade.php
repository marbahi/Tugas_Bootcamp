<x-app-layout headerTitle="Products">
    <x-slot name="actions">
        <a href="{{ route('products.create') }}" class="btn btn-primary btn-pill btn-sm px-4">+ Add Product</a>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="panel-card p-4">
                <form method="GET" action="{{ route('products.index') }}" id="product-filter" class="row g-2 mb-3">
                    <div class="col-12 col-md-4">
                        <input type="search" name="search" value="{{ request('search') }}" class="form-control search-input" placeholder="Cari produk atau kategori...">
                    </div>
                    <div class="col-6 col-md-3">
                        <select name="order_by" class="form-select">
                            <option value="">Urutkan berdasarkan</option>
                            <option value="name" {{ request('order_by') == 'name' ? 'selected' : '' }}>Nama</option>
                            <option value="price" {{ request('order_by') == 'price' ? 'selected' : '' }}>Harga</option>
                            <option value="stock" {{ request('order_by') == 'stock' ? 'selected' : '' }}>Stok</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-3">
                        <select name="order_direction" class="form-select">
                            <option value="">Arah</option>
                            <option value="asc" {{ request('order_direction') == 'asc' ? 'selected' : '' }}>Naik (A-Z)</option>
                            <option value="desc" {{ request('order_direction') == 'desc' ? 'selected' : '' }}>Turun (Z-A)</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-2">
                        @if (request()->hasAny(['search', 'order_by', 'order_direction']))
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-pill w-100">Reset</a>
                        @endif
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover align-middle admin-table mb-0">
                        <thead>
                            <tr>
                                <th class="text-muted small">ID</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Gambar</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td class="text-muted small">{{ $product->id }}</td>
                                    <td class="fw-semibold">{{ $product->name }}</td>
                                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                                    <td class="card-price">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>
                                        @if ($product->stock > 0)
                                            <span class="badge rounded-pill stock-badge stock-badge--in">{{ $product->stock }}</span>
                                        @else
                                            <span class="badge rounded-pill stock-badge stock-badge--out">0</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($product->image)
                                            @if (str_starts_with($product->image, 'data:'))
                                                <img src="{{ $product->image }}" alt="{{ $product->name }}" width="48" height="36" class="rounded border" style="object-fit: cover;">
                                            @else
                                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="48" height="36" class="rounded border" style="object-fit: cover;">
                                            @endif
                                        @else
                                            <span class="text-muted small">N/A</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-outline-primary btn-sm btn-pill" data-bs-toggle="modal" data-bs-target="#editProduct{{ $product->id }}">Edit</button>
                                        <button type="button" class="btn btn-outline-danger btn-sm btn-pill" data-bs-toggle="modal" data-bs-target="#deleteProduct{{ $product->id }}">Hapus</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">Belum ada produk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($products->hasPages())
                    <div class="d-flex justify-content-end mt-3">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('dashboards.products._modals')

    <script>
        (function () {
            const selects = document.querySelectorAll('#product-filter select[name="order_by"], #product-filter select[name="order_direction"]');
            selects.forEach((select) => select.addEventListener('change', () => select.form.submit()));

            const search = document.querySelector('#product-filter input[name="search"]');
            if (search) {
                search.addEventListener('input', () => {
                    clearTimeout(search.delay);
                    search.delay = setTimeout(() => search.form.submit(), 600);
                });
            }
        })();
    </script>
</x-app-layout>