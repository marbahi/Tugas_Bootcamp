<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'stock', 'image', 'price', 'product_category_id'];

    public function category()
    {
        return $this->belongsTo(ProductCategories::class, 'product_category_id');
    }
}
