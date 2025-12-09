<?php

namespace App\Models;

use App\Models\Payment;
use App\Models\OrderItem;
use App\Traits\V1\IFiltrable;
use App\Filters\V1\StatusFilter;
use App\Filters\V1\OrderStatusFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model implements IFiltrable
{
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'email', 'phone', 'address', 'status', 'total_price'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPipelineStages()
    {
        return [
            StatusFilter::class,
        ];
    }
}