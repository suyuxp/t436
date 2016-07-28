<?php

use \Firebase\JWT\JWT;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    protected function getJwtToken($username)
    {  
        $payload = [
            'uid'   => $username,
            'exp'   => time() + 60*10
        ];

        $token = JWT::encode($payload, env('JWT_KEY'));

        return ['Authorization' => 'Bearer ' . $token];
    }
}
