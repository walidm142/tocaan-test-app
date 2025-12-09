<?php

namespace App\Api\V1\Orders\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_name', 'quantity', 'price', 'total_price'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
