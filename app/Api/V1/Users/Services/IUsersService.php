<?php

namespace App\Api\V1\Users\Services;

use App\Api\V1\Base\Services\IBaseService;

interface IUsersService extends IBaseService
{
    public function login(array $credentials);
    public function register(array $data);
    public function me();
    public function logout();
}
