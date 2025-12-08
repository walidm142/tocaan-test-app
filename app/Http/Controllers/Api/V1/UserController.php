<?php

namespace App\Http\Controllers\Api\V1;

use App\V1\ErrorTypeEnum;
use Illuminate\Http\Request;
use App\Traits\V1\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Services\V1\Users\IUserService;
use App\Services\V1\Users\IUsersService;
use App\Http\Requests\V1\Users\LoginRequest;
use App\Http\Requests\V1\Users\RegisterRequest;

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
}
