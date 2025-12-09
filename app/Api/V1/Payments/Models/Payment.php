<?php

namespace App\Api\V1\Payments\Models;

use App\Api\V1\Orders\Models\Order;
use App\Api\V1\Base\Traits\IFiltrable;
use Illuminate\Database\Eloquent\Model;
use App\Api\V1\Base\Filters\StatusFilter;
use App\Api\V1\Base\Filters\ByOrderFilter;

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
