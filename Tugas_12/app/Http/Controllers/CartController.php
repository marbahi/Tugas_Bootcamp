<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = [
            ['id' => 1, 'name' => 'Produk 1', 'price' => 150000, 'qty' => 1, 'image' => 'https://placehold.co/300x200/e2e8f0/0f172a?text=Produk+1'],
            ['id' => 2, 'name' => 'Produk 2', 'price' => 100000, 'qty' => 2, 'image' => 'https://placehold.co/300x200/e2e8f0/0f172a?text=Produk+2'],
            ['id' => 3, 'name' => 'Produk 3', 'price' => 250000, 'qty' => 1, 'image' => 'https://placehold.co/300x200/e2e8f0/0f172a?text=Produk+3'],
            ['id' => 4, 'name' => 'Produk 4', 'price' => 75000, 'qty' => 3, 'image' => 'https://placehold.co/300x200/e2e8f0/0f172a?text=Produk+4'],
            ['id' => 5, 'name' => 'Produk 5', 'price' => 500000, 'qty' => 1, 'image' => 'https://placehold.co/300x200/e2e8f0/0f172a?text=Produk+5'],
        ];

        return view('cart', ['title' => 'Cart', 'cartItems' => $cartItems]);
    }
}
