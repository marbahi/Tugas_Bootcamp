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
        } else {
            $products = $products->orderBy('id', 'desc');
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
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:10|max:1000',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'product_category_id' => 'required|exists:product_categories,id',
            'image' => 'required|string',
        ]);

        Products::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'product_category_id' => $request->product_category_id,
            'image' => $this->handleImageUpload($request),
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function update(Request $request, Products $product)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:10|max:1000',
            'price' => 'required|integer|min:0',
            'stock' => 'required|integer|min:0',
            'product_category_id' => 'required|exists:product_categories,id',
            'image' => 'nullable|string',
        ]);

        $newImage = $this->handleImageUpload($request);

        if ($newImage) {
            $oldPath = storage_path('app/public/' . $product->image);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        } else {
            $newImage = $product->image;
        }

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'product_category_id' => $request->product_category_id,
            'image' => $newImage,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Products $product)
    {
        if ($product->orderItems()->count() > 0) {
            return back()->withErrors(['error' => 'Tidak dapat menghapus produk yang memiliki pesanan terkait.']);
        }

        if ($product->cartItems()->count() > 0) {
            $product->cartItems()->delete();
        }

        $path = storage_path('app/public/' . $product->image);
        if (file_exists($path)) {
            unlink($path);
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

    protected function handleImageUpload(Request $request): ?string
    {
        $base64 = $request->input('image');

        if (!$base64) {
            return null;
        }

        $imageData = base64_decode(
            preg_replace('#^data:image/\w+;base64,#i', '', $base64)
        );

        if ($imageData === false) {
            return null;
        }

        $image = @imagecreatefromstring($imageData);

        if (!$image) {
            return null;
        }

        $filename = Str::uuid() . '.avif';
        $directory = storage_path('app/public/products');

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $path = $directory . '/' . $filename;
        imageavif($image, $path, 80);
        imagedestroy($image);

        return 'products/' . $filename;
    }
}
