<?php

namespace App\Http\Controllers;

use App\Models\ProductCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboards.product-categories.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:50',
        ]);

        if (ProductCategories::where('name', $request->name)->exists()) {
            return redirect()->back()->withErrors(['Nama kategori sudah ada']);
        }

        $slug = Str::slug($request->name);

        ProductCategories::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategories $productCategories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategories $productCategories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductCategories $productCategories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategories $productCategories)
    {
        //
    }
}
