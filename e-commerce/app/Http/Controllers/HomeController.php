<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $title = "Home";
        $products = Products::paginate(5);
        return view('home', compact('title', 'products'));
    }
}
