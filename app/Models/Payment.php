<?php

namespace App\Models;

use App\Models\Order;
use App\Traits\V1\IFiltrable;
use App\Filters\V1\StatusFilter;
use App\Filters\V1\ByOrderFilter;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model implements IFiltrable
{
    protected $fillable = ['order_id', 'payment_method', 'status', 'amount'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getPipelineStages()
    {
        return [
           StatusFilter::class,
           ByOrderFilter::class,
        ];
    }
}
