<?php

namespace Tests;

use App\Service\UserService;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    public function getUserToken(): string
    {
        $name = 'Test';
        $email = 'test@gmail.com';
        $password = '1234567890';

        /**
         * @var UserService $userService
        */
        $userService = app(UserService::class);

        $createdUser = $userService->create(name: $name, email: $email, password: $password);

        $token = $createdUser->createToken('token_authenticate');

        return $token->plainTextToken;
    }


    public function getHeaderWithAuthorization(): array
    {
        $token = $this->getUserToken();

        return ['Authorization' => "Bearer {$token}"];
    }
}
