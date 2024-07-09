<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Profile;
use App\Models\Category;
use App\Models\UserType;
use Laravel\Sanctum\Sanctum;
use Database\Seeders\CategorySeeder;
use Database\Seeders\UserTypeSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test for category creation.
     */
    public function test_system_can_create_category(): void
    {
        $this->seed(UserTypeSeeder::class);
        $userType = UserType::where('type_name', 'proveedor')->first();

        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $profile = Profile::factory()->create([
            'user_id' => $user->id,
            'user_type_id' => $userType->id
        ]);

        $categoryRequest = [
            'category_name' => 'Lavado de vehiculos'
        ];
        $URL = 'api/category/create';
        $response = $this->postJson($URL, $categoryRequest);

        if ($response->status() !== 200) {
            dd($response->exception->getMessage());
        }
        $response->assertStatus(200);
        $this->assertDatabaseHas('categories', $categoryRequest);
        $response->assertJsonStructure([
            'cod',
            'msg'
        ]);
    }

    /**
     * A basic feature test for category update.
     */
    public function test_system_can_update_category(): void
    {
        $this->seed(UserTypeSeeder::class);
        $this->seed(CategorySeeder::class);
        $userType = UserType::where('type_name', 'proveedor')->first();

        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $profile = Profile::factory()->create([
            'user_id' => $user->id,
            'user_type_id' => $userType->id
        ]);
        $category = Category::where('category_name', 'Lavado de Vehiculos')->first();

        $categoryRequest = [
            'category_name' => 'Plomería'
        ];
        $URL = 'api/category/update/';
        $response = $this->putJson($URL.$category->id, $categoryRequest);

        if ($response->status() !== 200) {
            dd($response->exception->getMessage());
        }
        $response->assertStatus(200);
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'category_name' => $categoryRequest['category_name']
        ]);
        $response->assertJsonStructure([
            'cod',
            'msg'
        ]);
    }
}