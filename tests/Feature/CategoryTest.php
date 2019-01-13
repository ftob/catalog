<?php
namespace Tests\Feature;


use App\Models\Category;
use App\Models\Item;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    const URL = '/api/categories';

    /** @var Category */
    protected $category;

    public function setUp()
    {
        parent::setUp();

        $this->category = factory(Category::class)->create()->each(function (Category $category) {
            $category->items()->save(factory(Item::class)->create());
            $category->children()->save(factory(Category::class)->create());
        });

    }

    public function testIndex()
    {
        $this->get(self::URL)->assertSuccessful();
    }

    public function testShow()
    {
        $this->get(self::URL . '/' . $this->category->id)->assertSuccessful();
    }

    public function testStore()
    {
        $this->post(self::URL)->assertSuccessful();
    }

    public function testUpdate()
    {
        $this->put(self::URL . '/' . $this->category->id)->assertSuccessful();
    }

    public function testDestroy()
    {
        $this->delete(self::URL . '/' . $this->category->id)->assertSuccessful();
    }
}