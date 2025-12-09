<?php

namespace App\Api\V1\Payments\Services;

use App\Api\V1\Base\Services\BaseService;
use App\Api\V1\Payments\Services\IPaymentsService;
use App\Api\V1\Payments\Repositories\PaymentsRepository;


class PaymentsService extends BaseService implements IPaymentsService
{
    protected $repository;
    public function __construct(PaymentsRepository $repository)
    {
        parent::__construct($repository);
    }


}