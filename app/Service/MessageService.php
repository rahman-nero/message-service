<?php

declare(strict_types=1);

namespace App\Service;

use App\Models\Message;
use Illuminate\Database\Eloquent\Model;

final class MessageService
{
    /**
     * @param int $userId
     * @param string $content
     * @return Model
     */
    public function create(int $userId, string $content): Model
    {
        // Тут можно было бы в отдельное свойство эту модель выносить, т.е композицию или агрегацию в конструкторе
        return Message::query()
                ->create([
                    'user_id' => $userId,
                    'content' => $content
                ]);
    }

    /**
     * @param int $id
     * @param int $userId
     * @return Model
     */
    public function delete(int $id, int $userId): Model
    {
        return Message::query()
            ->where('id', '=', $id)
            ->where('user_id', '=', $userId)
            ->first();
    }
}
