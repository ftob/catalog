<?php
namespace Tests\Feature;

use App\Models\Category;
use App\Models\Item;
use App\User;
use Tests\DatabaseSetup;
use Tests\OauthTrait;
use Tests\TestCase;

/**
 * Class ItemTest
 * @package Tests\Feature
 */
class ItemTest extends TestCase
{
    use DatabaseSetup, OauthTrait;

    const URL = '/api/items';

    /** @var Category */
    protected $category;

    /** @var Item */
    protected $item;

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
        $this->item = factory(Item::class)->create();
    }

    /**
     * @test
     */
    public function get_items_is_successfully()
    {
        $response = $this->get(self::URL);
        $response->assertSuccessful()->assertJsonStructure([
            'data'
        ]);
    }

    /**
     * @test
     */
    public function show_item_is_successfully()
    {
        $this->get(self::URL . '/' . $this->item->id)->assertSuccessful()
            ->assertJsonStructure(['data']);
    }

    /**
     * @test
     */
    public function create_item_is_successfully()
    {
        $this->post(self::URL,
            ['name' => $this->app->make(\Faker\Generator::class)->name], $this->headers)->assertSuccessful()
            ->assertJsonStructure([
                'message',
                'data'
            ])->assertJson(['message' => 'Item created.']);

    }

    /**
     * @test
     */
    public function update_item_is_successfully()
    {
        $response =
            $this->put(self::URL . '/' . $this->item->id, ['name' => $this->app->make(\Faker\Generator::class)->name], $this->headers);
        $response->assertSuccessful()->assertJsonStructure([
            'message',
            'data'
        ])->assertJson(['message' => 'Item updated.']);
    }

    /**
     * @test
     */
    public function destroy_item_is_successfully()
    {
        $response = $this->delete(self::URL . '/' . $this->item->id, [], $this->headers)->assertSuccessful();
        $response->assertJson( ["message" => "Item deleted.", "deleted" => true]);
    }

}
