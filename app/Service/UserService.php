<?php

declare(strict_types=1);

namespace App\Service;

use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher;

final class UserService
{
    private Hasher $hasher;

    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;
    }

    public function create(string $name, string $email, string $password)
    {
        return User::query()
            ->create([
                'name' => $name,
                'email' => $email,
                'password' => $this->hasher->make($password)
            ]);
    }

}
