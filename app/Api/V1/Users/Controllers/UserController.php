<?php

namespace App\Api\V1\Users\Controllers;

use App\Http\Controllers\Controller;
use App\Api\V1\Base\Enums\ErrorTypeEnum;
use App\Api\V1\Users\Requests\LoginRequest;
use App\Api\V1\Base\Traits\ApiResponseTrait;
use App\Api\V1\Users\Resources\UserResource;
use App\Api\V1\Users\Services\IUsersService;
use App\Api\V1\Users\Requests\RegisterRequest;

class UserController extends Controller
{
    use ApiResponseTrait;

    public function __construct(private IUsersService $usersService)
    {
    }

    public function login(LoginRequest $request)
    {
        $login = $this->usersService->login($request->only('email', 'password'));

        if ($login === ErrorTypeEnum::INVALID_CREDENTIALS) {
            return $this->errorResponse('Invalid credentials', [], 401);
        }
        if ($login === ErrorTypeEnum::JWT_EXCEPTION) {
            return $this->errorResponse('Could not create token', [], 500);
        }
        return $this->successResponse($login);
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->usersService->register($request->all());
        if (!$user) {
            return $this->errorResponse('Could not register user', [], 500);
        }

        return $this->successResponse(new UserResource($user), 'User registered successfully', 201);
    }

    public function me()
    {
        $user = $this->usersService->me();

        if (!$user) {
            return $this->errorResponse('Could not get user', [], 404);
        }
        return $this->successResponse(new UserResource($user));
    }
    public function logout()
    {
        $logout = $this->usersService->logout();

        if ($logout === ErrorTypeEnum::FAILED_TO_LOGOUT) {
            return $this->errorResponse('Could not logout user', [], 500);
        }

        return $this->successResponse([], 'Successfully logged out');
    }
}
