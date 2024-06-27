<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

class ProfileTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_profile_can_be_created(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $profileInformation = [
            
        ];
        
    }
}
