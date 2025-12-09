<?php

namespace App\Api\V1\Users\Repositories;

use App\Api\V1\Base\Repositories\IBaseRepository;

interface IUsersRepository extends IBaseRepository
{
    public function login(array $credentials);
    public function me();
}
