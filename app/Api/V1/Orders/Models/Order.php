<?php

namespace App\Api\V1\Orders\Models;

use App\Api\V1\Users\Models\User;
use App\Api\V1\Base\Traits\IFiltrable;
use App\Api\V1\Orders\Models\OrderItem;
use App\Api\V1\Payments\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use App\Api\V1\Base\Filters\StatusFilter;
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