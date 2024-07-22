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
use Exception;
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

    /**
     * A basic feature test for category soft deletes.
     */
    public function test_system_can_delete_category(): void
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
        $URL = 'api/category/delete/';
        $response = $this->delete($URL.$category->id);

        if ($response->status() !== 200) {
            dd($response->exception->getMessage());
        }
        $response->assertStatus(200);
        // Assert the user is not in the 'active' users list
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    /**
     * Basic test to test that categories can be extracted.
     */
    public function test_system_can_get_categories(): void
    {
        $this->seed(CategorySeeder::class);

        $category = Category::inRandomOrder()->first();

         $user = User::factory()->create();

         $URL = 'api/category/get/';
         $response = $this->get($URL.$category->id);

         if ($response->status() !== 200) {
            dd($response->exception->getMessage());
         }

         $response->assertJsonStructure([
            'cod',
            'msg',
            'data'
         ]);
    }
}