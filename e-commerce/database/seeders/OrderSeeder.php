<?php

namespace Database\Seeders;

use App\Models\Orders;
use App\Models\OrderItems;
use App\Models\Products;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $products = Products::all();

        if ($users->isEmpty() || $products->isEmpty()) {
            return;
        }

        $statuses = ['pending', 'processing', 'completed', 'canceled'];
        $paymentMethods = ['cash', 'bank_transfer', 'credit_card', 'e_wallet'];
        $customerNames = [
            'Budi Santoso', 'Siti Rahayu', 'Andi Wijaya', 'Dewi Lestari',
            'Rizky Pratama', 'Maya Sari', 'Joko Widodo', 'Rina Wati',
            'Ahmad Fauzi', 'Lina Marlina', 'Dani Kurniawan', 'Sari Dewi',
        ];

        for ($i = 1; $i <= 25; $i++) {
            $user = $users->random();
            $customerName = $customerNames[array_rand($customerNames)];
            $status = $statuses[array_rand($statuses)];
            $paymentMethod = $paymentMethods[array_rand($paymentMethods)];
            $createdAt = now()->subMonths(rand(0, 5))->subDays(rand(0, 30));

            $order = Orders::create([
                'order_number' => 'ORD-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'customer_name' => $customerName,
                'customer_phone' => '08' . rand(10000000, 99999999),
                'customer_address' => 'Jl. ' . Str::random(10) . ' No. ' . rand(1, 100),
                'total_amount' => 0,
                'status' => $status,
                'payment_method' => $paymentMethod,
                'user_id' => $user->id,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ]);

            $itemCount = rand(1, 4);
            $totalAmount = 0;
            $shuffledProducts = $products->shuffle()->take($itemCount);

            foreach ($shuffledProducts as $product) {
                $quantity = rand(1, 3);
                $price = $product->price;
                $totalAmount += $price * $quantity;

                OrderItems::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'user_id' => $user->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]);
            }

            $order->update(['total_amount' => $totalAmount]);
        }
    }
}
