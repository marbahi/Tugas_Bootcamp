<?php

namespace App\Http\Controllers;

use App\Models\ProductCategories;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
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
        $categories = ProductCategories::all();

        return view('dashboards.products.tambah', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $product)
    {
        $sessionKey = 'product_clicks_' . $product->id;
        if (!session()->has($sessionKey)) {
            $product->increment('click');
            session()->put($sessionKey, true);
        }

        $title = $product->name;

        $productImages = [
            $product->image ? asset('storage/'.$product->image) : 'https://placehold.co/900x675/EAF1EC/1B2A27?text='.rawurlencode($product->name),
        ];

        $recommendations = Products::where('product_category_id', $product->product_category_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(8)
            ->get();

        return view('products.show', compact('title', 'product', 'productImages', 'recommendations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        //
    }
}
