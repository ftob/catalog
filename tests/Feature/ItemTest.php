<?php
namespace Tests\Feature;

use Tests\PassportTestCase;

class ItemTest extends PassportTestCase
{

    const URL = '/api/categories';

    public function testIndex()
    {
        $this->get(self::URL)->assertSuccessful();
    }

    public function testShow()
    {
        $this->get(self::URL . '/' . $this->user->id)->assertSuccessful();
    }

    public function testStore()
    {
        $this->post(self::URL)->assertSuccessful();
    }

    public function testUpdate()
    {
        $this->put(self::URL . '/' . $this->user->id)->assertSuccessful();
    }

    public function testDestroy()
    {
        $this->delete(self::URL . '/' . $this->user->id)->assertSuccessful();
    }
}