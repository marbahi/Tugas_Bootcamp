<x-app-layout>
    <x-slot name="actions">
        <a href="{{ route('product-categories.index') }}" class="btn btn-outline-secondary btn-pill btn-sm px-4">Kembali</a>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-6">
            <div class="panel-card p-4 p-sm-5">
                @include('dashboards.product-categories._form')
            </div>
        </div>
    </div>
</x-app-layout>