<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignUpRequest;
use App\Service\UserService;
use Illuminate\Http\JsonResponse;

final class SignUpController extends Controller
{
    private UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function signup(SignUpRequest $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        $user = $this->service->create(name: $name, email: $email, password: $password);

        if (!$user) {
            // FIXME: тут нужно было вернуть 500, но почему-то в ТЗ сказано не возвращать 500
            return new JsonResponse(['code' => 400, 'message' => 'Произошла ошибка во время выполнения регистраций, пожалуйста, попробуйте позднее'], 400);
        }

        $token = $user->createToken('token_authenticate');

        return new JsonResponse(['code' => 200, 'message' =>
            [
                'token' => $token->plainTextToken
            ]
        ]);
    }


}
