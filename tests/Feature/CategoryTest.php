<?php
namespace Tests\Feature;


use App\Models\Category;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Tests\OauthTrait;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use DatabaseTransactions, OauthTrait;

    const URL = '/api/categories';
    /** @var Category */
    protected $category;

    /** @var User */
    protected $user;

    protected $token;

    protected $headers = [];

    public function setUp()
    {
        parent::setUp();
        $this->token = $this->makeOauthTokenByPassword();
        $this->headers['Accept'] = 'application/goods+json';
        $this->headers['Authorization'] = "Bearer {$this->token->access_token}";

        $this->category = factory(Category::class)->create();
    }

    /**
     * @test
     */
    public function get_categories_is_successfully()
    {
        $response = $this->get(self::URL);
        $response->assertSuccessful()->assertJsonStructure([
            'data'
        ]);
    }

    /**
     * @test
     */
    public function show_category_is_successfully()
    {
        $this->get(self::URL . '/' . $this->category->id)->assertSuccessful()
            ->assertJsonStructure(['data']);
    }

    /**
     * @test
     */
    public function create_category_is_successfully()
    {
        $this->post(self::URL,
            ['name' => $this->app->make(\Faker\Generator::class)->name], $this->headers)->assertSuccessful()
        ->assertJsonStructure([
            'message',
            'data'
        ])->assertJson(['message' => 'Category created.']);

    }

    /**
     * @test
     */
    public function update_category_is_successfully()
    {
        $response =
            $this->put(self::URL . '/' . $this->category->id, ['name' => $this->app->make(\Faker\Generator::class)->name], $this->headers);
        $response->assertSuccessful()->assertJsonStructure([
            'message',
            'data'
        ])->assertJson(['message' => 'Category updated.']);
    }

    /**
     * @test
     */
    public function destroy_category_is_successfully()
    {
        $response = $this->delete(self::URL . '/' . $this->category->id, [], $this->headers)->assertSuccessful();
        $response->assertJson( ["message" => "Category deleted.", "deleted" => true]);
    }
}
