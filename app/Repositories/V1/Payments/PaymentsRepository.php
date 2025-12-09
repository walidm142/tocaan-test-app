<?php

namespace App\Repositories\V1\Payments;

use App\Models\Payment;
use App\Repositories\V1\BaseRepository;

use App\Repositories\V1\Payments\IPaymentsRepository;

class PaymentsRepository extends BaseRepository implements IPaymentsRepository
{


    public function __construct(Payment $payment)
    {
        parent::__construct($payment);
    }
}