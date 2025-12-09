<?php

namespace App\Api\V1\Users\Repositories;

use App\Api\V1\Users\Models\User;
use App\Api\V1\Base\Repositories\BaseRepository;
use App\Api\V1\Users\Repositories\IUsersRepository;

class UsersRepository extends BaseRepository implements IUsersRepository
{

    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function login(array $credentials)
    {
        // Implementation for user login
    }

    public function me()
    {
        // Implementation for getting authenticated user's information
    }
}