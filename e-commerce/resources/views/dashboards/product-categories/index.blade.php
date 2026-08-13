<x-app-layout headerTitle="Product Categories">
    <x-slot name="actions">
        <button type="button" class="btn btn-primary btn-pill btn-sm px-4" data-bs-toggle="modal" data-bs-target="#categoryCreateModal">+ Add Category</button>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="panel-card p-4">
                <form method="GET" action="{{ route('product-categories.index') }}" id="category-filter" class="row g-2 mb-3">
                    <div class="col-12 col-md-4">
                        <input type="search" name="search" value="{{ request('search') }}" class="form-control search-input" placeholder="Cari nama atau slug kategori...">
                    </div>
                    <div class="col-12 col-md-2">
                        @if (request()->has('search'))
                            <a href="{{ route('product-categories.index') }}" class="btn btn-outline-secondary btn-pill w-100">Reset</a>
                        @endif
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover align-middle admin-table mb-0">
                        <thead>
                            <tr>
                                <th class="text-muted small">ID</th>
                                <th>Nama</th>
                                <th>Slug</th>
                                <th class="text-center">Jumlah Produk</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td class="text-muted small">{{ $category->id }}</td>
                                    <td class="fw-semibold">{{ $category->name }}</td>
                                    <td><code>{{ $category->slug }}</code></td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill stock-badge stock-badge--in">{{ $category->products_count }}</span>
                                    </td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-outline-primary btn-sm btn-pill" data-bs-toggle="modal" data-bs-target="#editCategory{{ $category->id }}">Edit</button>
                                        <button type="button" class="btn btn-outline-danger btn-sm btn-pill" data-bs-toggle="modal" data-bs-target="#deleteCategory{{ $category->id }}">Hapus</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">Belum ada kategori.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($categories->hasPages())
                    <div class="d-flex justify-content-end mt-3">
                        {{ $categories->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    @include('dashboards.product-categories._modals')

    <script>
        (function () {
            const search = document.querySelector('#category-filter input[name="search"]');
            if (search) {
                search.addEventListener('input', () => {
                    clearTimeout(search.delay);
                    search.delay = setTimeout(() => search.form.submit(), 600);
                });
            }
        })();
    </script>
</x-app-layout>