<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Orders::withCount('items');

        if ($request->filled('search')) {
            $search = $request->search;
            $orders = $orders->where('order_number', 'like', "%{$search}%")
                ->orWhere('customer_name', 'like', "%{$search}%");
        }

        if ($request->filled('status')) {
            $orders = $orders->where('status', $request->status);
        }

        $orders = $orders->latest()->paginate(10)->withQueryString();

        return view('dashboards.orders.index', compact('orders'));
    }

    public function show(Orders $order)
    {
        $order->load('items.product');
        return view('dashboards.orders.show', compact('order'));
    }

    public function update(Request $request, Orders $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,canceled',
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->route('orders.show', $order)->with('success', 'Status order berhasil diperbarui.');
    }

    public function destroy(Orders $order)
    {
        $order->items()->delete();
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order berhasil dihapus.');
    }
}
