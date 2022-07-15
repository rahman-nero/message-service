<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class UserController
{

    public function data(Request $request)
    {
        return new JsonResponse(['code' => 200, 'message' => $request->user()]);
    }

}
