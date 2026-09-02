<?php

namespace Database\Seeders;

use App\Models\ProductCategories;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Elektronik', 'slug' => 'elektronik'],
            ['name' => 'Fashion', 'slug' => 'fashion'],
            ['name' => 'Makanan & Minuman', 'slug' => 'makanan-minuman'],
            ['name' => 'Kesehatan', 'slug' => 'kesehatan'],
            ['name' => 'Olahraga', 'slug' => 'olahraga'],
            ['name' => 'Rumah Tangga', 'slug' => 'rumah-tangga'],
            ['name' => 'Aksesoris', 'slug' => 'aksesoris'],
            ['name' => 'Buku', 'slug' => 'buku'],
        ];

        foreach ($categories as $category) {
            ProductCategories::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
