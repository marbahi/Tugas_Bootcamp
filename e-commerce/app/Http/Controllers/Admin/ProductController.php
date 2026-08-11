<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Products::with('category');

        if ($request->filled('search')) {
            $search = $request->search;

            $products = $products->where('name', 'like', "%{$search}%")
                ->orWhereHas('category', fn ($query) => $query->where('name', 'like', "%{$search}%"));
        }

        if ($request->filled('order_by') && in_array($request->order_by, ['name', 'price', 'stock'])) {
            $direction = in_array($request->order_direction, ['asc', 'desc']) ? $request->order_direction : 'asc';

            $products = $products->orderBy($request->order_by, $direction);
        }

        $products = $products->paginate(10)->withQueryString();

        return view('dashboards.products.index', compact('products'));
    }

    public function create()
    {
        $categories = ProductCategories::orderBy('name')->get();

        return view('dashboards.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['slug'] = $this->resolveSlug($data['slug'] ?: $data['name']);

        Products::create($data);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Products $product)
    {
        $categories = ProductCategories::orderBy('name')->get();

        return view('dashboards.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Products $product)
    {
        $data = $this->validateData($request, $product->id);
        $data['slug'] = $this->resolveSlug($data['slug'] ?: $data['name'], $product->id);

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Products $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

    protected function validateData(Request $request, ?int $ignoreId = null): array
    {
        $slugRule = 'unique:products,slug';

        if ($ignoreId !== null) {
            $slugRule = 'unique:products,slug,' . $ignoreId;
        }

        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', $slugRule],
            'product_category_id' => ['required', 'exists:product_categories,id'],
            'price' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);
    }

    protected function resolveSlug(string $slug, ?int $ignoreId = null): string
    {
        $base = Str::slug($slug) ?: Str::slug('produk');
        $candidate = $base;
        $i = 2;

        while (Products::where('slug', $candidate)->where('id', '!=', $ignoreId)->exists()) {
            $candidate = $base . '-' . $i++;
        }

        return $candidate;
    }
}
