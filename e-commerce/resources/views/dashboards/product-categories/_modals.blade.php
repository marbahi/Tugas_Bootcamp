{{-- Modal Add Category --}}
<div class="modal fade" id="categoryCreateModal" tabindex="-1" aria-labelledby="categoryCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('product-categories.store') }}">
                @csrf
                <input type="hidden" name="form_context" value="category-create">

                <div class="modal-header">
                    <h5 class="modal-title font-display fw-bold" id="categoryCreateModalLabel">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <x-input-label for="create-name" :value="__('Name')" />
                        <x-text-input id="create-name" name="name" type="text" :value="old('name')" class="slug-source" data-slug-target="create-slug" required placeholder="Nama kategori" />
                        <x-input-error :messages="$errors->get('name')" />
                    </div>

                    <div class="mb-1">
                        <x-input-label for="create-slug" :value="__('Slug')" />
                        <x-text-input id="create-slug" name="slug" type="text" :value="old('slug')" class="slug-target" placeholder="otomatis dari nama" />
                        <x-input-error :messages="$errors->get('slug')" />
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-pill" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-pill">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit Category --}}
@foreach ($categories as $category)
    <div class="modal fade" id="editCategory{{ $category->id }}" tabindex="-1" aria-labelledby="editCategoryLabel{{ $category->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="POST" action="{{ route('product-categories.update', $category) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="form_context" value="category-edit-{{ $category->id }}">

                    <div class="modal-header">
                        <h5 class="modal-title font-display fw-bold" id="editCategoryLabel{{ $category->id }}">Edit Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <x-input-label for="edit-name-{{ $category->id }}" :value="__('Name')" />
                            <x-text-input id="edit-name-{{ $category->id }}" name="name" type="text" :value="old('name', $category->name)" class="slug-source" data-slug-target="edit-slug-{{ $category->id }}" required placeholder="Nama kategori" />
                            <x-input-error :messages="$errors->get('name')" />
                        </div>

                        <div class="mb-1">
                            <x-input-label for="edit-slug-{{ $category->id }}" :value="__('Slug')" />
                            <x-text-input id="edit-slug-{{ $category->id }}" name="slug" type="text" :value="old('slug', $category->slug)" class="slug-target" placeholder="otomatis dari nama" />
                            <x-input-error :messages="$errors->get('slug')" />
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary btn-pill" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary btn-pill">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

{{-- Modal Delete Category --}}
@foreach ($categories as $category)
    <div class="modal fade" id="deleteCategory{{ $category->id }}" tabindex="-1" aria-labelledby="deleteCategoryLabel{{ $category->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-display fw-bold" id="deleteCategoryLabel{{ $category->id }}">Hapus Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($category->products_count > 0)
                        <span class="text-danger">Kategori ini tidak dapat dihapus karena masih memiliki produk yang terhubung.</span>
                        <br><strong>{{ $category->name }}</strong>
                        <br><span class="text-muted small">{{ $category->products_count }} produk terhubung dengan kategori ini.</span>
                    @else
                        Apakah anda yakin menghapus kategori ini?
                        <br><strong>{{ $category->name }}</strong>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary btn-pill" data-bs-dismiss="modal">Batal</button>
                    @if ($category->products_count == 0)
                        <form method="POST" action="{{ route('product-categories.destroy', $category) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-pill">Hapus</button>
                        </form>
                    @else
                        <button type="button" class="btn btn-secondary btn-pill" disabled>Tidak Bisa Dihapus</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach

<script>
    (function () {
        document.querySelectorAll('.slug-source').forEach(function (source) {
            const target = document.getElementById(source.dataset.slugTarget);

            if (!target) return;

            source.addEventListener('input', function () {
                if (document.activeElement === target) return;

                target.value = source.value
                    .toLowerCase()
                    .trim()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
            });
        });

        const context = @json(old('form_context'));

        if (context === 'category-create') {
            new bootstrap.Modal(document.getElementById('categoryCreateModal')).show();
        } else if (typeof context === 'string' && context.startsWith('category-edit-')) {
            const modal = document.getElementById('editCategory' + context.replace('category-edit-', ''));

            if (modal) new bootstrap.Modal(modal).show();
        }
    })();
</script>
