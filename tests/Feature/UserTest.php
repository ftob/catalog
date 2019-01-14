<?php
namespace Tests\Feature;


use App\User;
use Faker\Generator;
use Laravel\Passport\Client;
use Tests\DatabaseSetup;
use Tests\OauthTrait;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseSetup, OauthTrait;

    protected $token;

    protected $headers = [];

    public function setUp()
    {
        parent::setUp();

    }

    /**
     * @test
     */
    public function check_user_auth()
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
        $this->token =  json_decode($tokenResponse->content());
        $this->headers['Accept'] = 'application/goods+json';
        $this->headers['Authorization'] = "Bearer {$this->token->access_token}";


        $this->get('/api/user', $this->headers)->assertSuccessful()->assertJsonStructure(['data' => ['id']]);
    }
}
