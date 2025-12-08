<?php

namespace App\Services\V1\Users;

use App\Services\V1\IBaseService;

interface IUsersService extends IBaseService
{
    public function login(array $credentials);
    public function register(array $data);
    public function me();
}
