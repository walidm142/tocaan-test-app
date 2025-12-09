<?php

namespace App\Api\V1\Users\Services;

use Tymon\JWTAuth\Facades\JWTAuth;
use App\Api\V1\Base\Enums\ErrorTypeEnum;
use App\Api\V1\Base\Services\BaseService;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Api\V1\Users\Resources\UserResource;
use App\Api\V1\Users\Services\IUsersService;
use App\Api\V1\Users\Repositories\UsersRepository;

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
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
        ];
    }

    public function register(array $data)
    {
        $user = $this->repository->create($data);
        try {
            JWTAuth::fromUser($user);
        } catch (JWTException $e) {
            return null;
        }

        return new UserResource($user);
    }

    public function me()
    {
        return auth('api')->user();
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
        } catch (JWTException $e) {
            return ErrorTypeEnum::FAILED_TO_LOGOUT;
        }

        return true;
    }
}