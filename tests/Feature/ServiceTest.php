<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_run(): void
    {
        $this->assertTrue(true);
    }
    // public function test_user_can_create_service(): void
    // {
    //     $user = User::factory()->create();
    //     Sanctum::actingAs($user);

    //     $serviceRequest = [
    //         "service_name",
    //         "description",
    //         "category_id",
    //         "price",
    //         "user_id",
    //     ];

    //     $response = $this->postJson();

    //     $response->assertStatus(200);
    // }
}
