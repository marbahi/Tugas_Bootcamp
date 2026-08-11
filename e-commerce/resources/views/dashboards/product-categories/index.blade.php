<x-app-layout>
    <x-slot name="actions">
        <a href="{{ route('product-categories.create') }}" class="btn btn-primary btn-pill btn-sm px-4">+ Add Category</a>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="panel-card p-4">
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
                                        <a href="{{ route('product-categories.edit', $category) }}" class="btn btn-outline-primary btn-sm btn-pill">Edit</a>
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
            </div>
        </div>
    </div>

    @foreach ($categories as $category)
        <div class="modal fade" id="deleteCategory{{ $category->id }}" tabindex="-1" aria-labelledby="deleteCategoryLabel{{ $category->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-display fw-bold" id="deleteCategoryLabel{{ $category->id }}">Hapus Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Yakin ingin menghapus kategori <strong>{{ $category->name }}</strong>?
                        @if ($category->products_count > 0)
                            <br><span class="text-danger small">{{ $category->products_count }} produk akan ikut terhapus.</span>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary btn-pill" data-bs-dismiss="modal">Batal</button>
                        <form method="POST" action="{{ route('product-categories.destroy', $category) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-pill">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>