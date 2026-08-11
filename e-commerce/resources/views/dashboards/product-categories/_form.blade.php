@php($productCategory ??= null)

<form method="POST" action="{{ $productCategory ? route('product-categories.update', $productCategory) : route('product-categories.store') }}">
    @csrf
    @if ($productCategory)
        @method('PUT')
    @endif

    <div class="row g-3">
        <div class="col-12 col-md-7">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" :value="old('name', $productCategory->name ?? '')" required placeholder="Nama kategori" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div class="col-12 col-md-5">
            <x-input-label for="slug" :value="__('Slug')" />
            <x-text-input id="slug" name="slug" type="text" :value="old('slug', $productCategory->slug ?? '')" placeholder="otomatis dari nama" />
            <x-input-error :messages="$errors->get('slug')" />
        </div>
    </div>

    <div class="d-flex align-items-center gap-2 mt-4">
        <x-primary-button>{{ $productCategory ? __('Update') : __('Simpan') }}</x-primary-button>
        <a href="{{ route('product-categories.index') }}" class="btn btn-outline-secondary btn-pill">Batal</a>
    </div>
</form>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const nameInput = document.getElementById('name');
            const slugInput = document.getElementById('slug');

            if (nameInput && slugInput) {
                nameInput.addEventListener('input', function () {
                    if (document.activeElement === slugInput) return;

                    slugInput.value = nameInput.value
                        .toLowerCase()
                        .trim()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-');
                });
            }
        });
    </script>
@endpush