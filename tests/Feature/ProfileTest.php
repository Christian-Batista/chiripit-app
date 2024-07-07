<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Profile;
use App\Models\UserType;
use Database\Factories\ProfileFactory;
use Laravel\Sanctum\Sanctum;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Database\Seeders\UserTypeSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_a_user_profile_can_be_created(): void
    {
        $this->seed(UserTypeSeeder::class);
        $userType = UserType::where('type_name', 'usuario')->first();

        // Fake storage for testing
        \Storage::fake('public');

        // Create a fake image file
        $file = UploadedFile::fake()->image('profile.jpg');

        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $profileRequest = [
            'user_id' => $user->id,
            'user_type_id' => $userType->id,
            'profile_picture' => $file,
            'location' => 'La Vega',
            'phone_number' => '8095079266',
            'bio' => 'Brief introduction about the user',
            'availability' => 0
        ];

        $url = 'api/profile/create/';
        $response = $this->postJson($url, $profileRequest);

        if ($response->status() !== 200) {
            dd($response->exception->getMessage());
        }

        $response->assertStatus(200);

        // Assert the profile is created in the database
        $this->assertDatabaseHas('profiles', [
            'user_id' => $user->id,
            'user_type_id' => $userType->id,
            'location' => $profileRequest['location'],
            'phone_number' => $profileRequest['phone_number'],
            'bio' => $profileRequest['bio'],
            'availability' => $profileRequest['availability'],
        ]);

        $image = Profile::where('user_id', $user->id)->value('profile_picture');

        // Assert the profile picture is stored
        $storedFilename = $file->hashName('profile_images');
        \Storage::disk('public')->assertExists($image);

        $response->assertJsonStructure([
            'cod',
            'msg'
        ]);
        
    }

    /**
     * A basic feature test example.
     */
    public function test_a_provider_profile_can_be_created(): void
    {
        $this->seed(UserTypeSeeder::class);
        $userType = UserType::where('type_name', 'proveedor')->first();

        // Fake storage for testing
        \Storage::fake('public');

        // Create a fake image file
        $file = UploadedFile::fake()->image('profile.jpg');

        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $profileRequest = [
            'user_id' => $user->id,
            'user_type_id' => $userType->id,
            'profile_picture' => $file,
            'location' => 'La Vega',
            'phone_number' => '8095079266',
            'bio' => 'Brief introduction about the user',
            'availability' => 0
        ];

        $url = 'api/profile/create/';
        $response = $this->postJson($url, $profileRequest);

        if ($response->status() !== 200) {
            dd($response->exception->getMessage());
        }

        $response->assertStatus(200);

        // Assert the profile is created in the database
        $this->assertDatabaseHas('profiles', [
            'user_id' => $user->id,
            'user_type_id' => $userType->id - 1,
            'location' => $profileRequest['location'],
            'phone_number' => $profileRequest['phone_number'],
            'bio' => $profileRequest['bio'],
            'availability' => $profileRequest['availability'],
        ]);

        $image = Profile::where('user_id', $user->id)->value('profile_picture');

        // Assert the profile picture is stored
        $storedFilename = $file->hashName('profile_images');
        \Storage::disk('public')->assertExists($image);

        $response->assertJsonStructure([
            'cod',
            'msg'
        ]);
    }

    /**
     * A basic feature test example.
     */
    public function test_a_user_profile_can_be_updated(): void
    {
        // Fake storage for testing
        \Storage::fake('public');

        // Create a fake image file
        $file = UploadedFile::fake()->image('profile.jpg');
        $this->seed(UserTypeSeeder::class);
        $userType = UserType::where('type_name', 'usuario')->first();
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $profile = Profile::factory()->create([
            'user_id' => $user->id,
            'user_type_id' => $userType->id,
            'availability' => 0
        ]);

        $URL = 'api/profile/update';

        $response = $this->patchJson($URL, [
            'profile_picture' => $file,
            'phone_number' => '8298149266',
        ]);

        if ($response->status() !== 200) {
            dd($response->exception->getMessage());
        }

        $profileUpdated = Profile::where('user_id', $user->id)->first();
        $image = $profileUpdated->profile_picture;
        $this->assertNotEquals($profile, $profileUpdated);

        $this->assertDatabaseHas('profiles', [
            'profile_picture' => $image,
            'phone_number' => '8298149266'
        ]);

        $storedFilename = $file->hashName('profile_images');
        \Storage::disk('public')->assertExists($image);
        
    }

    /**
     * test profile doft delete
     */
    public function test_system_can_soft_deletes_a_user_and_their_profile()
    {
        $this->seed(UserTypeSeeder::class);
        $userType = UserType::where('type_name', 'usuario')->first();

        // Create a user and profile
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $profile = Profile::factory()->create([
            'user_id' => $user->id,
            'user_type_id' => $userType->id,
        ]);

        // Soft delete the user
        $user->delete();

        // Assert soft deletion
        $this->assertSoftDeleted('users', ['id' => $user->id]);
        $this->assertSoftDeleted('profiles', ['id' => $profile->id]);
    }

    /**
     * Test to extract profile information
     */
    public function test_system_can_extract_profile_information(): void
    {
        $this->seed(UserTypeSeeder::class);
        $userType = UserType::where('type_name', 'proveedor')->first();

        // Create a user and profile
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $profile = Profile::factory()->create([
            'user_id' => $user->id,
            'user_type_id' => $userType->id,
        ]);
        
        $URL = 'api/profile/get';
        $response = $this->get($URL);

        if ($response->status() !== 200) {
            dd($response->exception->getMessage());
        }

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'cod',
            'msg',
            'data'
        ]);
    }
}
