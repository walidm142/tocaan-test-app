<?php

namespace App\Services\V1\Users;

use App\V1\ErrorTypeEnum;
use App\Services\V1\BaseService;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\V1\UserResource;
use App\Services\V1\Users\IUsersService;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Repositories\V1\Users\UsersRepository;

class UsersService extends BaseService implements IUsersService
{
    protected $repository;

    public function __construct(UsersRepository $repository)
    {
        parent::__construct($repository);
    }

    public function login(array $credentials)
    {
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return ErrorTypeEnum::INVALID_CREDENTIALS;
            }
        } catch (JWTException $e) {
            return ErrorTypeEnum::JWT_EXCEPTION;
        }

        return [
            'token' => $token,
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ];
    }

    public function register(array $data)
    {
        $user = $this->repository->create($data);
        try {
            $token = JWTAuth::fromUser($user);
        } catch (JWTException $e) {
            return null;
        }

        return new UserResource($user);
    }

    public function me()
    {
        return auth('api')->user();
    }
}