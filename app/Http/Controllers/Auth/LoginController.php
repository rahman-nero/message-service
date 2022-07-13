<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

final class LoginController extends Controller
{

    public function login(LoginRequest $request)
    {

        $token = $request->user()->createToken($request->token_name);

        return ['token' => $token->plainTextToken];


    }
}
