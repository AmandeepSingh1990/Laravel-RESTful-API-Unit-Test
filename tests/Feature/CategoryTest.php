<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    private static $id = null;

    public function testIndex() {
        $response = $this->get('/api/categories');

        $response->assertStatus(200);
    }

    public function testStore() {
        $response = $this->json('POST', '/api/categories/store',
            ["name" => "Default"]
        );
        self::$id = $response->original['data']['id'];
        $response->assertStatus(200);
    }

    public function testShow() {
        $response = $this->get('/api/categories/' . self::$id);

        $response->assertStatus(200);
    }

    public function testUpdate() {

        $response = $this->json('PATCH', '/api/categories/' . self::$id,
            ["name" => "New Default"]
        );
        $response->assertStatus(200);
    }

    public function testDestroy() {
        $response = $this->delete('/api/categories/' . self::$id);

        $response->assertStatus(200);
    }
}
