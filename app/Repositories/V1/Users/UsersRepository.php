<?php

namespace App\Repositories\V1\Users;

use App\Models\User;
use App\Models\Order;
use App\Repositories\V1\BaseRepository;
use App\Repositories\V1\Users\IUsersRepository;

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