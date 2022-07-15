<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class UserController extends Controller
{
    public function data(Request $request)
    {
        return new JsonResponse(['code' => 200, 'message' => $request->user()]);
    }

}
