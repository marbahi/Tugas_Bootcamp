<?php

namespace App\Http\Controllers;

use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public const SELLER_WHATSAPP = '1234567890';

    public const PAYMENT_METHODS = [
        'transfer_bank' => 'Transfer Bank',
        'cod' => 'COD',
        'e_wallet' => 'E-Wallet',
    ];

    public function create(Request $request)
    {
        if ($request->filled('product_id')) {
            $product = Products::findOrFail($request->product_id);

            if ($product->stock < 1) {
                return redirect()->route('products.show', $product)
                    ->withErrors(['error' => 'Stok produk habis.']);
            }

            $quantity = max(1, min((int) $request->input('quantity', 1), $product->stock));

            $items = collect([
                (object) [
                    'product' => $product,
                    'quantity' => $quantity,
                    'price' => $product->price,
                ],
            ]);
            $mode = 'buy-now';
        } else {
            $cartItems = Auth::user()->cartItems()->with('product')->get();

            if ($cartItems->isEmpty()) {
                return redirect()->route('cart.index')
                    ->withErrors(['error' => 'Keranjang masih kosong.']);
            }

            $items = $cartItems;
            $mode = 'cart';
        }

        $total = $items->sum(fn ($item) => ($item->price ?? $item->product->price ?? 0) * $item->quantity);
        $paymentMethods = self::PAYMENT_METHODS;

        return view('checkout.index', compact('items', 'total', 'mode', 'paymentMethods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20|regex:/^[0-9+\-\s]+$/',
            'customer_address' => 'required|string|max:500',
            'payment_method' => 'required|in:transfer_bank,cod,e_wallet',
            'mode' => 'required|in:cart,buy-now',
            'product_id' => 'required_if:mode,buy-now|exists:products,id',
            'quantity' => 'required_if:mode,buy-now|integer|min:1',
        ]);

        if ($request->mode === 'buy-now') {
            $product = Products::findOrFail($request->product_id);

            if ($product->stock < 1) {
                return back()->withErrors(['error' => 'Stok produk habis.'])->withInput();
            }

            $lines = [[
                'product_id' => $product->id,
                'quantity' => max(1, min((int) $request->quantity, $product->stock)),
                'price' => $product->price,
            ]];
        } else {
            $cartItems = Auth::user()->cartItems()->with('product')->get();

            if ($cartItems->isEmpty()) {
                return redirect()->route('cart.index')
                    ->withErrors(['error' => 'Keranjang masih kosong.']);
            }

            $lines = [];
            foreach ($cartItems as $item) {
                if (! $item->product || $item->product->stock < 1) {
                    return back()->withErrors(['error' => 'Stok produk "' . ($item->product->name ?? '') . '" habis.'])->withInput();
                }

                $lines[] = [
                    'product_id' => $item->product_id,
                    'quantity' => min($item->quantity, $item->product->stock),
                    'price' => $item->product->price,
                ];
            }
        }

        $order = DB::transaction(function () use ($request, $lines) {
            $total = collect($lines)->sum(fn ($line) => $line['price'] * $line['quantity']);

            do {
                $orderNumber = 'ORD-' . now()->format('YmdHis') . strtoupper(Str::random(3));
            } while (Orders::where('order_number', $orderNumber)->exists());

            $order = Orders::create([
                'order_number' => $orderNumber,
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'total_amount' => $total,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'user_id' => Auth::id(),
            ]);

            foreach ($lines as $line) {
                OrderItems::create([
                    'order_id' => $order->id,
                    'product_id' => $line['product_id'],
                    'user_id' => Auth::id(),
                    'quantity' => $line['quantity'],
                    'price' => $line['price'],
                ]);

                Products::where('id', $line['product_id'])->decrement('stock', $line['quantity']);
            }

            if ($request->mode === 'cart') {
                Auth::user()->cartItems()->delete();
            }

            return $order;
        });

        $order->load('items.product');

        return redirect()->away($this->whatsappUrl($order));
    }

    protected function whatsappUrl(Orders $order): string
    {
        $lines = [
            'Halo, saya ' . $order->customer_name . ' baru saja memesan:',
            '',
            'No. Order: ' . $order->order_number,
        ];

        foreach ($order->items as $item) {
            $lines[] = '- ' . ($item->product->name ?? 'Produk')
                . ' x' . $item->quantity
                . ' = Rp' . number_format($item->price * $item->quantity, 0, ',', '.');
        }

        $lines[] = '';
        $lines[] = 'Total: Rp' . number_format($order->total_amount, 0, ',', '.');
        $lines[] = 'Metode: ' . (self::PAYMENT_METHODS[$order->payment_method] ?? $order->payment_method);
        $lines[] = 'Alamat: ' . $order->customer_address;
        $lines[] = '';
        $lines[] = 'Mohon konfirmasi pesanan saya. Terima kasih.';

        return 'https://wa.me/' . self::SELLER_WHATSAPP . '?text=' . urlencode(implode("\n", $lines));
    }
}
