<?php

namespace App\Services\V1\Payments;

use App\Services\V1\BaseService;
use App\Services\V1\Payments\IPaymentsService;
use App\Repositories\V1\Payments\PaymentsRepository;


class PaymentsService extends BaseService implements IPaymentsService
{
    protected $repository;
    public function __construct(PaymentsRepository $repository)
    {
        parent::__construct($repository);
    }


}