<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class MainController
{

    public function index(Request $request)
    {
        $perPage = $request->get('per_page');

        $messages = Message::query()
            ->paginate($perPage);

        if ($messages->isEmpty()) {
            return new JsonResponse(['code' => 200, 'message' => 'Нет сообщений']);
        }

        return new JsonResponse(['code' => 200, 'message' => $messages->toArray()]);
    }

}
