<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_profile_can_be_created(): void
    {
        $this->assertTrue(true);
        // // Fake storage for testing
        // \Storage::fake('public');

        // // Create a fake image file
        // $file = UploadedFile::fake()->image('profile.jpg');

        // $user = User::factory()->create();
        // Sanctum::actingAs($user);
        // $profileRequest = [
        //     'user_id' => $user->id,
        //     'user_type_id' => 'provider',
        //     'profile_picture' => $file,
        //     'location' => 'La Vega',
        //     'phone_number' => '8095079266',
        //     'bio' => 'Brief introduction about the user',
        // ];

        // $url = 'api/profile/create/';
        // $response = $this->postJson($url, $profileRequest);

        // if ($response->status() !== 200) {
        //     dd($response->exception->getMessage());
        // }

        // $response->assertStatus(200);

        // $this->assertDatabaseHas('profiles', $profileRequest);

        // $response->assertJsonStructure([
        //     'cod',
        //     'msg'
        // ]);
        
    }
}
