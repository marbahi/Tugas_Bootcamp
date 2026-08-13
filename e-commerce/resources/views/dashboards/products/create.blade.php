<x-app-layout headerTitle="Add Product">
    <x-slot name="actions">
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-pill btn-sm px-4">Kembali</a>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="panel-card p-4 p-sm-5">
                @include('dashboards.products._form')
            </div>
        </div>
    </div>
</x-app-layout>