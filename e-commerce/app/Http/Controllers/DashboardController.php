<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $items = [
            [
                'title' => 'Number of Products',
                'number' => 80,
                'icon' => 'inventory_2',
            ],
            [
                'title' => 'Number of Categories',
                'number' => 8,
                'icon' => 'category',
            ],
            [
                'title' => 'Number of Product Clicks',
                'number' => 100,
                'icon' => 'left_click',
            ],
        ];
        return view('dashboards.index', compact('items'));
    }
}
