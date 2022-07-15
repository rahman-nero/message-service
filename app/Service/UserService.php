<?php

declare(strict_types=1);

namespace App\Service;

use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Database\Eloquent\Model;

final class UserService
{
    private Hasher $hasher;

    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;
    }

    public function create(string $name, string $email, string $password): Model
    {
        return User::query()
            ->create([
                'name' => $name,
                'email' => $email,
                'password' => $this->hasher->make($password)
            ]);
    }

    public function loginCheck(string $email, string $password): Model|false
    {
        $user = User::query()
            ->where('email', '=', $email)
            ->first();

        if (!$user || !$this->hasher->check($password, $user->password)) {
            return false;
        }

        return $user;
    }

}
