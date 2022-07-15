<?php

declare(strict_types=1);

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Message\StoreMessageRequest;
use App\Service\MessageService;
use Carbon\Carbon;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\JsonResponse;

final class ManageController extends Controller
{
    const LIMIT_ON_DELETE = 86_400;

    private MessageService $service;
    private AuthManager $userManager;
    private Carbon $carbon;

    public function __construct(
        AuthManager $userManager,
        Carbon $carbon,
        MessageService $service
    )
    {
        $this->userManager = $userManager;
        $this->carbon = $carbon;
        $this->service = $service;
    }

    public function store(StoreMessageRequest $request)
    {
        $content = $request->input('content');
        $userId = $this->userManager->id();

        $message = $this->service->create(userId: $userId, content: $content);

//        Не совсем понял смысл "Система не должна выдавать ошибок сервера (ошибок типа 500 Internal Server Error)."
//        if (!$message) {
//            return new JsonResponse(['code' => 50])
//        }

        return new JsonResponse(['code' => 200, 'message' => 'Сообщение успешно добавлено']);
    }


    public function delete(int $id)
    {
        $userId = $this->userManager->id();

        $message = $this->service->delete(id: $id, userId: $userId);

        // Если пользователь пытается удалить чужое сообщение
        if (!$message) {
            return new JsonResponse(['code' => 404, 'message' => 'Нельзя удалить не существующее сообщение']);
        }

        /**
         * @var Carbon $expires_at
         * */
        $expires_at = $message->created_at->addSeconds(self::LIMIT_ON_DELETE);
        $now = $this->carbon->now();

        // Если прошло больше 24 часов после добавления сообшения
        if ($now->greaterThan($expires_at)) {
            // Не придумал текст лучше :)
            return new JsonResponse(['code' => 403, 'message' => 'Вы не можете удалить сообщение, которое было добавлено 24 часа назад']);
        }

        return new JsonResponse([], 204);
    }
}
