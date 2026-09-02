<form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="row g-3">
        <div class="col-12">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" :value="old('name')" required placeholder="Nama produk" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div class="col-12 col-md-4">
            <x-input-label for="product_category_id" :value="__('Kategori')" />
            <select id="product_category_id" name="product_category_id" class="form-select" required>
                <option value="" disabled {{ ! old('product_category_id') ? 'selected' : '' }}>Pilih kategori...</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('product_category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('product_category_id')" />
        </div>

        <div class="col-6 col-md-4">
            <x-input-label for="price" :value="__('Harga (Rp)')" />
            <x-text-input id="price" name="price" type="number" min="0" :value="old('price')" required placeholder="100000" />
            <x-input-error :messages="$errors->get('price')" />
        </div>

        <div class="col-6 col-md-4">
            <x-input-label for="stock" :value="__('Stok')" />
            <x-text-input id="stock" name="stock" type="number" min="0" :value="old('stock')" required placeholder="10" />
            <x-input-error :messages="$errors->get('stock')" />
        </div>

        <div class="col-12">
            <x-input-label for="image" :value="__('Gambar Produk')" />
            <input type="file" id="image-input" name="image_file" accept="image/*" class="form-control">
            <input type="hidden" name="image" id="image-base64" value="{{ old('image') }}">
            <x-input-error :messages="$errors->get('image')" />

            <div id="croppie-wrapper" class="mt-3" style="display:none;">
                <div id="croppie-container"></div>
                <button type="button" class="btn btn-primary btn-sm btn-pill mt-2" id="crop-btn">Crop</button>
                <button type="button" class="btn btn-outline-secondary btn-sm btn-pill mt-2" id="cancel-crop-btn">Batal</button>
            </div>

            <div id="image-preview" class="mt-3" style="display:none;">
                <img id="preview-img" style="max-width:200px; border-radius:8px; border:1px solid #ddd;">
                <button type="button" class="btn btn-sm btn-outline-danger ms-2" id="remove-image">Hapus</button>
            </div>
        </div>

        <div class="col-12">
            <x-input-label for="description" :value="__('Deskripsi')" />
            <textarea id="description" name="description" rows="4" class="form-control" required placeholder="Deskripsi produk">{{ old('description') }}</textarea>
            <x-input-error :messages="$errors->get('description')" />
        </div>
    </div>

    <div class="d-flex align-items-center gap-2 mt-4">
        <x-primary-button>Simpan</x-primary-button>
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-pill">Batal</a>
    </div>
</form>

@push('scripts')
<script>
(function () {
    let croppieInstance = null;

    const fileInput = document.getElementById('image-input');
    const base64Input = document.getElementById('image-base64');
    const croppieWrapper = document.getElementById('croppie-wrapper');
    const croppieContainer = document.getElementById('croppie-container');
    const cropBtn = document.getElementById('crop-btn');
    const cancelCropBtn = document.getElementById('cancel-crop-btn');
    const imagePreview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');
    const removeBtn = document.getElementById('remove-image');

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

    cancelCropBtn.addEventListener('click', function () {
        if (croppieInstance) {
            croppieInstance.destroy();
            croppieInstance = null;
        }
        croppieWrapper.style.display = 'none';
        fileInput.value = '';
        fileInput.style.display = '';
    });

    removeBtn.addEventListener('click', resetAll);

    // Show preview if old value exists
    if (base64Input.value) {
        showPreview(base64Input.value);
    }
})();
</script>
@endpush
