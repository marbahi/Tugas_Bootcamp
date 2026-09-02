{{-- Modal Edit Product --}}
@foreach ($products as $product)
    <div class="modal fade" id="editProduct{{ $product->id }}" tabindex="-1" aria-labelledby="editProductLabel{{ $product->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
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
                                <x-input-label for="edit-product-image-{{ $product->id }}" :value="__('Gambar Produk')" />
                                <input type="file" id="image-input-{{ $product->id }}" name="image_file" accept="image/*" class="form-control">
                                <input type="hidden" name="image" id="image-base64-{{ $product->id }}" value="{{ old('image', $product->image) }}">
                                <x-input-error :messages="$errors->get('image')" />

                                <div id="croppie-wrapper-{{ $product->id }}" class="mt-3" style="display:none;">
                                    <div id="croppie-container-{{ $product->id }}"></div>
                                    <button type="button" class="btn btn-primary btn-sm btn-pill mt-2" data-action="crop">Crop</button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm btn-pill mt-2" data-action="cancel">Batal</button>
                                </div>

                                <div id="image-preview-{{ $product->id }}" class="mt-3" style="display:{{ $product->image ? 'block' : 'none' }};">
                                    @if ($product->image)
                                        @if (str_starts_with($product->image, 'data:'))
                                            <img id="preview-img-{{ $product->id }}" src="{{ $product->image }}" style="max-width:200px; border-radius:8px; border:1px solid #ddd;">
                                        @else
                                            <img id="preview-img-{{ $product->id }}" src="{{ asset('storage/' . $product->image) }}" style="max-width:200px; border-radius:8px; border:1px solid #ddd;">
                                        @endif
                                    @else
                                        <img id="preview-img-{{ $product->id }}" style="max-width:200px; border-radius:8px; border:1px solid #ddd;">
                                    @endif
                                    <button type="button" class="btn btn-sm btn-outline-danger ms-2" data-action="remove">Hapus</button>
                                </div>
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

@push('scripts')
<script>
(function () {
    const context = @json(old('form_context'));

    if (typeof context === 'string' && context.startsWith('product-edit-')) {
        const modal = document.getElementById('editProduct' + context.replace('product-edit-', ''));
        if (modal) new bootstrap.Modal(modal).show();
    }

    // Initialize Croppie for each product modal
    @foreach ($products as $product)
    (function () {
        const id = '{{ $product->id }}';
        let croppieInstance = null;

        const fileInput = document.getElementById('image-input-' + id);
        const base64Input = document.getElementById('image-base64-' + id);
        const croppieWrapper = document.getElementById('croppie-wrapper-' + id);
        const croppieContainer = document.getElementById('croppie-container-' + id);
        const imagePreview = document.getElementById('image-preview-' + id);
        const previewImg = document.getElementById('preview-img-' + id);

        const cropBtn = croppieWrapper.querySelector('[data-action="crop"]');
        const cancelBtn = croppieWrapper.querySelector('[data-action="cancel"]');
        const removeBtn = imagePreview.querySelector('[data-action="remove"]');

        function showPreview(base64) {
            previewImg.src = base64;
            imagePreview.style.display = 'block';
            croppieWrapper.style.display = 'none';
            fileInput.style.display = 'none';
        }

        function resetAll() {
            base64Input.value = '';
            fileInput.value = '';
            fileInput.style.display = '';
            imagePreview.style.display = 'none';
            croppieWrapper.style.display = 'none';
            previewImg.src = '';
            if (croppieInstance) {
                croppieInstance.destroy();
                croppieInstance = null;
            }
        }

        fileInput.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (event) {
                croppieWrapper.style.display = 'block';
                imagePreview.style.display = 'none';

                if (croppieInstance) {
                    croppieInstance.destroy();
                }

                croppieInstance = new Croppie(croppieContainer, {
                    viewport: { width: 250, height: 250, type: 'square' },
                    boundary: { width: 350, height: 350 },
                    enableOrientation: true
                });

                croppieInstance.bind({ url: event.target.result });
            };
            reader.readAsDataURL(file);
        });

        cropBtn.addEventListener('click', function () {
            if (!croppieInstance) return;

            croppieInstance.result({
                type: 'base64',
                size: 'viewport',
                format: 'jpeg',
                quality: 0.9
            }).then(function (base64) {
                base64Input.value = base64;
                showPreview(base64);
                croppieInstance.destroy();
                croppieInstance = null;
            });
        });

        cancelBtn.addEventListener('click', function () {
            if (croppieInstance) {
                croppieInstance.destroy();
                croppieInstance = null;
            }
            croppieWrapper.style.display = 'none';
            fileInput.value = '';
            fileInput.style.display = '';
        });

        removeBtn.addEventListener('click', resetAll);
    })();
    @endforeach
})();
</script>
@endpush
