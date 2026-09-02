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
        $categories = ProductCategories::orderBy('name')->get();

        return view('dashboards.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = ProductCategories::orderBy('name')->get();

        return view('dashboards.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['image'] = $this->handleImageUpload($request);
        $data['slug'] = $this->resolveSlug($this->categorySlug($data['product_category_id']));

        Products::create($data);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function update(Request $request, Products $product)
    {
        $data = $this->validateData($request, $product->id);
        $newImage = $this->handleImageUpload($request);

        if ($newImage) {
            // Delete old image if exists
            if ($product->image && ! str_starts_with($product->image, 'data:')) {
                $oldPath = storage_path('app/public/'.$product->image);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $data['image'] = $newImage;
        } else {
            // Keep old image if no new upload
            $data['image'] = $product->image;
        }

        $data['slug'] = $this->resolveSlug($this->categorySlug($data['product_category_id']), $product->id);

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Products $product)
    {
        // Delete image file if exists
        if ($product->image && ! str_starts_with($product->image, 'data:')) {
            $path = storage_path('app/public/'.$product->image);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

    protected function validateData(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'product_category_id' => ['required', 'exists:product_categories,id'],
            'price' => ['required', 'integer', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'string'],
            'description' => ['required', 'string'],
        ]);
    }

    protected function handleImageUpload(Request $request): ?string
    {
        $base64 = $request->input('image');

        if (! $base64) {
            return null;
        }

        // Remove data URL prefix if present
        $imageData = base64_decode(
            preg_replace('#^data:image/\w+;base64,#i', '', $base64)
        );

        if ($imageData === false) {
            return null;
        }

        // Create GD image from decoded data
        $image = @imagecreatefromstring($imageData);

        if (! $image) {
            return null;
        }

        // Generate unique filename
        $filename = Str::uuid().'.avif';
        $directory = storage_path('app/public/products');

        // Ensure directory exists
        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $path = $directory.'/'.$filename;

        // Save as AVIF
        imageavif($image, $path, 80);
        imagedestroy($image);

        return 'products/'.$filename;
    }

    protected function categorySlug(int $categoryId): string
    {
        return ProductCategories::findOrFail($categoryId)->slug;
    }

    protected function resolveSlug(string $slug, ?int $ignoreId = null): string
    {
        $base = Str::slug($slug) ?: Str::slug('produk');
        $candidate = $base;
        $i = 2;

        while (Products::where('slug', $candidate)->where('id', '!=', $ignoreId)->exists()) {
            $candidate = $base.'-'.$i++;
        }

        return $candidate;
    }
}
