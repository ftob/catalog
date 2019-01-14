<?php
namespace Tests;


use App\User;
use Faker\Generator;
use Laravel\Passport\Client;

trait OauthTrait
{

    public function makeOauthTokenByPassword()
    {
        $user = User::create([
            "name" => $this->app->make(Generator::class)->name,
            "email" => $this->app->make(Generator::class)->email,
            "password" => bcrypt("test1337")
        ]);
        $client = Client::where("password_client", true)->first();
        // Password Grant Type
        $payload = [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $user->email,
            'password' => 'test1337',
            'scope' => ''
        ];

        $tokenResponse = $this->json('post', '/oauth/token', $payload);
        return json_decode($tokenResponse->content());
    }
}
