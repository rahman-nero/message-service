<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

final class MessageTest extends TestCase
{
    use DatabaseTransactions;
    use DatabaseMigrations;

    protected $defaultHeaders = [
        'Accept' => 'application/json',
    ];

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_send_message_success()
    {
        $headers = $this->getHeaderWithAuthorization();
        $data = [
            'content' => 'Hello, it is my first message'
        ];

        $response = $this->post('/api/messages', $data, $headers);

        $response->assertStatus(200);
    }


    public function test_send_message_return_error_about_validation()
    {
        $headers = $this->getHeaderWithAuthorization();

        $data = [
            'content' => 'l'
        ];

        $response = $this->post('/api/messages', $data, $headers);

        $response->assertUnprocessable();
    }
}
