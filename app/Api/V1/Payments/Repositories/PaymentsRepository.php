<?php

namespace App\Api\V1\Payments\Repositories;

use App\Api\V1\Payments\Models\Payment;
use App\Api\V1\Base\Repositories\BaseRepository;

use App\Api\V1\Payments\Repositories\IPaymentsRepository;

class PaymentsRepository extends BaseRepository implements IPaymentsRepository
{


    public function __construct(Payment $payment)
    {
        parent::__construct($payment);
    }
}