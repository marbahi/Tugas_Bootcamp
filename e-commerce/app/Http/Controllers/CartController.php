<?php

namespace App\Http\Controllers;

use App\Models\CartItems;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Auth::user()->cartItems()->with('product')->latest()->get();
        $total = $cartItems->sum(fn ($item) => ($item->product->price ?? 0) * $item->quantity);

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Products::findOrFail($request->product_id);

        if ($product->stock < 1) {
            return back()->withErrors(['error' => 'Stok produk habis.']);
        }

        $quantity = min($request->quantity, $product->stock);

        $item = CartItems::firstOrNew([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
        ]);

        $item->quantity = min(($item->quantity ?? 0) + $quantity, $product->stock);
        $item->save();

        return back()->with('success', 'Produk masuk keranjang.');
    }

    public function update(Request $request, CartItems $cartItem)
    {
        $this->authorizeItem($cartItem);

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $stock = $cartItem->product->stock ?? 0;

        if ($stock < 1) {
            return back()->withErrors(['error' => 'Stok produk habis.']);
        }

        $cartItem->update(['quantity' => min($request->quantity, $stock)]);

        return back()->with('success', 'Jumlah produk diperbarui.');
    }

    public function destroy(CartItems $cartItem)
    {
        $this->authorizeItem($cartItem);

        $cartItem->delete();

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }

    protected function authorizeItem(CartItems $cartItem): void
    {
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
