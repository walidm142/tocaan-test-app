<?php

namespace App\Repositories\V1\Users;

use App\Repositories\V1\IBaseRepository;

interface IUsersRepository extends IBaseRepository
{
    public function login(array $credentials);
    public function me();
}
