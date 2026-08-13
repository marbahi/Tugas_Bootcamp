@php($product ??= null)

<form method="POST" action="{{ $product ? route('products.update', $product) : route('products.store') }}">
    @csrf
    @if ($product)
        @method('PUT')
    @endif

    <div class="row g-3">
        <div class="col-12">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" :value="old('name', $product->name ?? '')" required placeholder="Nama produk" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div class="col-12 col-md-4">
            <x-input-label for="product_category_id" :value="__('Kategori')" />
            <select id="product_category_id" name="product_category_id" class="form-select" required>
                <option value="" disabled {{ ! old('product_category_id', $product->product_category_id ?? '') ? 'selected' : '' }}>Pilih kategori...</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('product_category_id', $product->product_category_id ?? '') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('product_category_id')" />
        </div>

        <div class="col-6 col-md-4">
            <x-input-label for="price" :value="__('Harga (Rp)')" />
            <x-text-input id="price" name="price" type="number" min="0" :value="old('price', $product->price ?? '')" required placeholder="100000" />
            <x-input-error :messages="$errors->get('price')" />
        </div>

        <div class="col-6 col-md-4">
            <x-input-label for="stock" :value="__('Stok')" />
            <x-text-input id="stock" name="stock" type="number" min="0" :value="old('stock', $product->stock ?? '')" required placeholder="10" />
            <x-input-error :messages="$errors->get('stock')" />
        </div>

        <div class="col-12">
            <x-input-label for="image" :value="__('URL Gambar')" />
            <x-text-input id="image" name="image" type="url" :value="old('image', $product->image ?? '')" placeholder="https://... (opsional)" />
            <x-input-error :messages="$errors->get('image')" />
        </div>

        <div class="col-12">
            <x-input-label for="description" :value="__('Deskripsi')" />
            <textarea id="description" name="description" rows="4" class="form-control" required placeholder="Deskripsi produk">{{ old('description', $product->description ?? '') }}</textarea>
            <x-input-error :messages="$errors->get('description')" />
        </div>
    </div>

    <div class="d-flex align-items-center gap-2 mt-4">
        <x-primary-button>{{ $product ? __('Update') : __('Simpan') }}</x-primary-button>
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-pill">Batal</a>
    </div>
</form>