<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Message;
use Illuminate\Database\Eloquent\Model;

final class MessageRepository
{
    public function paginate(int $perPage, string $orderBy = 'DESC')
    {
        return Message::query()
            ->orderBy('created_at', $orderBy)
            ->paginate($perPage);
    }

}
