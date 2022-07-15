<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Service\UserService;
use Illuminate\Http\JsonResponse;

final class LoginController extends Controller
{
    private UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function login(LoginRequest $request)
    {
        $email = $request->input('login');
        $password = $request->input('password');

        $user = $this->service->loginCheck(email: $email, password: $password);

        if (!$user) {
            return new JsonResponse(['code' => 403, 'message' => 'Логин или пароль введены неправильно'], 403);
        }

        $token = $user->createToken('token_authenticate');

        return new JsonResponse(['code' => 200, 'message' => [
                'token' => $token->plainTextToken
            ]
        ]);
    }
}
