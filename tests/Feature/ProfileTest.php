<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Profile;
use App\Models\UserType;
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
    public function test_a_profile_with_user_profile_can_be_created(): void
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
}
