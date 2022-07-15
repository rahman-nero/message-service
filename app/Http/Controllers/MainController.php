<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repository\MessageRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class MainController extends Controller
{
    private MessageRepository $repository;

    /**
     * @param MessageRepository $repository
     */
    public function __construct(MessageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 20);

        $messages = $this->repository->paginate($perPage);

        if ($messages->isEmpty()) {
            return new JsonResponse(['code' => 200, 'message' => 'Нет сообщений']);
        }

        return new JsonResponse(['code' => 200, 'message' => $messages->toArray()]);
    }

}
