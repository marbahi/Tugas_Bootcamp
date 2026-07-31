<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('product')->get();
        return response()->json($orders);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
        ]);

        $product = \App\Models\Product::findOrFail($validated['product_id']);

        $validated['total_price'] = $product->price * $validated['quantity'];
        $validated['status'] = 'pending';

        $order = Order::create($validated);

        return response()->json($order->load('product'), 201);
    }

    public function show(Order $order)
    {
        return response()->json($order->load('product'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'sometimes|in:pending,completed,cancelled',
        ]);

        $order->update($validated);

        return response()->json($order->load('product'));
    }
}
