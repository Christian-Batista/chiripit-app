<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\UserType;
use Database\Seeders\UserTypeSeeder;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTypeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_type_usuario_can_be_created(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $userTypeRequest = [
            'type_name' => 'usuario'
        ];
        $URL = 'api/user-type/create';
        $response = $this->postJson($URL, $userTypeRequest);

        if ($response->status() !== 200) {
            dd($response->exception->getMessage());
        }

        $response->assertStatus(200);

        $this->assertDatabaseHas('user_types', $userTypeRequest);
    }

    /**
     * A basic feature test example.
     */
    public function test_user_type_proveedor_can_be_created(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $userTypeRequest = [
            'type_name' => 'proveedor'
        ];
        $URL = 'api/user-type/create';
        $response = $this->postJson($URL, $userTypeRequest);

        if ($response->status() !== 200) {
            dd($response->exception->getMessage());
        }

        $response->assertStatus(200);

        $this->assertDatabaseHas('user_types', $userTypeRequest);
    }
}
