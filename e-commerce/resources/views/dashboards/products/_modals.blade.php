{{-- Modal Edit Product --}}
@foreach ($products as $product)
    <div class="modal fade" id="editProduct{{ $product->id }}" tabindex="-1" aria-labelledby="editProductLabel{{ $product->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <form method="POST" action="{{ route('products.update', $product) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="form_context" value="product-edit-{{ $product->id }}">

                    <div class="modal-header">
                        <h5 class="modal-title font-display fw-bold" id="editProductLabel{{ $product->id }}">Edit Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <x-input-label for="edit-product-name-{{ $product->id }}" :value="__('Name')" />
                                <x-text-input id="edit-product-name-{{ $product->id }}" name="name" type="text" :value="old('name', $product->name)" required placeholder="Nama produk" />
                                <x-input-error :messages="$errors->get('name')" />
                            </div>

                            <div class="col-12 col-md-4">
                                <x-input-label for="edit-product-category-{{ $product->id }}" :value="__('Kategori')" />
                                <select id="edit-product-category-{{ $product->id }}" name="product_category_id" class="form-select" required>
                                    <option value="" disabled {{ ! old('product_category_id', $product->product_category_id) ? 'selected' : '' }}>Pilih kategori...</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('product_category_id', $product->product_category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('product_category_id')" />
                            </div>

                            <div class="col-6 col-md-4">
                                <x-input-label for="edit-product-price-{{ $product->id }}" :value="__('Harga (Rp)')" />
                                <x-text-input id="edit-product-price-{{ $product->id }}" name="price" type="number" min="0" :value="old('price', $product->price)" required placeholder="100000" />
                                <x-input-error :messages="$errors->get('price')" />
                            </div>

                            <div class="col-6 col-md-4">
                                <x-input-label for="edit-product-stock-{{ $product->id }}" :value="__('Stok')" />
                                <x-text-input id="edit-product-stock-{{ $product->id }}" name="stock" type="number" min="0" :value="old('stock', $product->stock)" required placeholder="10" />
                                <x-input-error :messages="$errors->get('stock')" />
                            </div>

                            <div class="col-12">
                                <x-input-label for="edit-product-image-{{ $product->id }}" :value="__('URL Gambar')" />
                                <x-text-input id="edit-product-image-{{ $product->id }}" name="image" type="url" :value="old('image', $product->image)" placeholder="https://... (opsional)" />
                                <x-input-error :messages="$errors->get('image')" />
                            </div>

                            <div class="col-12">
                                <x-input-label for="edit-product-description-{{ $product->id }}" :value="__('Deskripsi')" />
                                <textarea id="edit-product-description-{{ $product->id }}" name="description" rows="4" class="form-control" required placeholder="Deskripsi produk">{{ old('description', $product->description) }}</textarea>
                                <x-input-error :messages="$errors->get('description')" />
                            </div>
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

{{-- Modal Delete Product --}}
@foreach ($products as $product)
    <div class="modal fade" id="deleteProduct{{ $product->id }}" tabindex="-1" aria-labelledby="deleteProductLabel{{ $product->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-display fw-bold" id="deleteProductLabel{{ $product->id }}">Hapus Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Yakin ingin menghapus <strong>{{ $product->name }}</strong>? Tindakan ini tidak dapat dibatalkan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary btn-pill" data-bs-dismiss="modal">Batal</button>
                    <form method="POST" action="{{ route('products.destroy', $product) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-pill">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

<script>
    (function () {
        const context = @json(old('form_context'));

        if (typeof context === 'string' && context.startsWith('product-edit-')) {
            const modal = document.getElementById('editProduct' + context.replace('product-edit-', ''));

            if (modal) new bootstrap.Modal(modal).show();
        }
    })();
</script>
