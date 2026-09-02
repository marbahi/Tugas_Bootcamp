<?php

namespace App\Http\Controllers;

use App\Models\Products;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Home';
        $products = Products::paginate(8);

        return view('home', compact('title', 'products'));
    }
}
