<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = ['order_number', 'customer_name', 'customer_phone', 'customer_address', 'total_amount', 'status', 'payment_method', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItems::class, 'order_id');
    }
}
