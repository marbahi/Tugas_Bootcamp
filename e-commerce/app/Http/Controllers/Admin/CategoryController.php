<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = ProductCategories::withCount('products');

        if ($request->filled('search')) {
            $search = $request->search;

            $categories = $categories->where('name', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%");
        }

        $categories = $categories->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('dashboards.product-categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['slug'] = $this->resolveSlug($data['slug'] ?: $data['name']);

        ProductCategories::create($data);

        return redirect()->route('product-categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, ProductCategories $productCategory)
    {
        $data = $this->validateData($request, $productCategory->id);
        $data['slug'] = $this->resolveSlug($data['slug'] ?: $data['name'], $productCategory->id);

        $productCategory->update($data);

        return redirect()->route('product-categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(ProductCategories $productCategory)
    {
        $productCategory->delete();

        return redirect()->route('product-categories.index')->with('success', 'Kategori berhasil dihapus.');
    }

    protected function validateData(Request $request, ?int $ignoreId = null): array
    {
        $slugRule = 'unique:product_categories,slug';

        if ($ignoreId !== null) {
            $slugRule = 'unique:product_categories,slug,'.$ignoreId;
        }

        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', $slugRule],
        ]);
    }

    protected function resolveSlug(string $slug, ?int $ignoreId = null): string
    {
        $base = Str::slug($slug) ?: Str::slug('kategori');
        $candidate = $base;
        $i = 2;

        while (ProductCategories::where('slug', $candidate)->where('id', '!=', $ignoreId)->exists()) {
            $candidate = $base.'-'.$i++;
        }

        return $candidate;
    }
}
