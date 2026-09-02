<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
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

        $chartData = [
            'labels' => ['Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            'values' => [12, 19, 8, 15, 22, 14],
        ];

        $recentOrders = [
            [
                'id' => 'ORD-001',
                'customer' => 'Budi Santoso',
                'product' => 'Laptop ASUS ROG',
                'amount' => 12500000,
                'status' => 'completed',
                'date' => '2026-09-01',
            ],
            [
                'id' => 'ORD-002',
                'customer' => 'Siti Rahayu',
                'product' => 'Sepatu Nike Air',
                'amount' => 1250000,
                'status' => 'pending',
                'date' => '2026-09-01',
            ],
            [
                'id' => 'ORD-003',
                'customer' => 'Andi Wijaya',
                'product' => 'Headset Sony WH-1000',
                'amount' => 850000,
                'status' => 'completed',
                'date' => '2026-08-31',
            ],
            [
                'id' => 'ORD-004',
                'customer' => 'Dewi Lestari',
                'product' => 'Buku React Design Patterns',
                'amount' => 125000,
                'status' => 'cancelled',
                'date' => '2026-08-30',
            ],
            [
                'id' => 'ORD-005',
                'customer' => 'Rizky Pratama',
                'product' => 'Keyboard Mechanical Keychron',
                'amount' => 450000,
                'status' => 'pending',
                'date' => '2026-08-30',
            ],
        ];

        return view('dashboards.index', compact('items', 'chartData', 'recentOrders'));
    }
}
