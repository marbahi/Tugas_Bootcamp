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
        $categories = ProductCategories::withCount('products')
                        ->withSum('products', 'stock');

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
        $request->validate([
            'name' => 'required|string|min:3|max:50',
        ]);

        if (ProductCategories::where('name', $request->name)->exists()) {
            return back()->withErrors(['name' => 'Nama kategori sudah ada.'])->withInput();
        }

        ProductCategories::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('product-categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, ProductCategories $productCategory)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:50',
        ]);

        if (ProductCategories::where('name', $request->name)
                ->where('id', '!=', $productCategory->id)->exists()) {
            return back()->withErrors(['name' => 'Nama kategori "' . $request->name . '" sudah ada.'])->withInput();
        }

        $productCategory->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('product-categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(ProductCategories $productCategory)
    {
        if ($productCategory->products()->count() > 0) {
            return redirect()->back()->withErrors(['error' => 'Tidak dapat menghapus kategori yang memiliki produk terkait.']);
        }

        $productCategory->delete();
        return redirect()->route('product-categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
