<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\ProductCategories;
use App\Models\Products;

class DashboardController extends Controller
{
    public function index()
    {
        $items = [
            [
                'title' => 'Number of Products',
                'number' => Products::count(),
                'icon' => 'inventory_2',
            ],
            [
                'title' => 'Number of Categories',
                'number' => ProductCategories::count(),
                'icon' => 'category',
            ],
            [
                'title' => 'Number of Product Clicks',
                'number' => Products::sum('click'),
                'icon' => 'left_click',
            ],
        ];

        $monthlyOrders = Orders::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $monthLabels = [];
        $monthValues = [];
        for ($i = 6; $i >= 1; $i--) {
            $month = now()->subMonths($i);
            $monthLabels[] = $month->format('M');
            $monthValues[] = $monthlyOrders[$month->format('m')] ?? 0;
        }

        $chartData = [
            'labels' => $monthLabels,
            'values' => $monthValues,
        ];

        $recentOrders = Orders::latest()->take(5)->get();

        $summary = [
            'total_order' => Orders::count(),
            'revenue' => Orders::where('status', 'completed')->sum('total_amount'),
            'pending' => Orders::where('status', 'pending')->count(),
            'completed' => Orders::where('status', 'completed')->count(),
            'cancelled' => Orders::where('status', 'canceled')->count(),
        ];

        return view('dashboards.index', compact('items', 'chartData', 'recentOrders', 'summary'));
    }
}
