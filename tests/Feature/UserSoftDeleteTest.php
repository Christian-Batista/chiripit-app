<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserSoftDeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_be_soft_deleted()
    {
        // Create a user
        $user = User::factory()->create();

        // Assert the user exists in the database
        $this->assertDatabaseHas('users', ['id' => $user->id]);

        // Soft delete the user
        $user->delete();

        // Assert the user is not in the 'active' users list
        $this->assertDatabaseMissing('users', ['id' => $user->id, 'deleted_at' => null]);

        // Assert the user is in the database with a deleted_at timestamp
        $this->assertNotNull($user->fresh()->deleted_at);
    }

    /** @test */
    public function a_soft_deleted_user_can_be_restored()
    {
        // Create a user
        $user = User::factory()->create();

        // Soft delete the user
        $user->delete();

        // Assert the user is soft deleted
        $this->assertNotNull($user->fresh()->deleted_at);

        // Restore the user
        $user->restore();

        // Assert the user is restored and no longer soft deleted
        $this->assertNull($user->fresh()->deleted_at);

        // Assert the user exists in the 'active' users list
        $this->assertDatabaseHas('users', ['id' => $user->id, 'deleted_at' => null]);
    }

    /** @test */
    public function only_soft_deleted_users_can_be_queried()
    {
        // Create a user
        $user = User::factory()->create();

        // Soft delete the user
        $user->delete();

        // Assert the user is in the trashed list
        $trashedUser = User::onlyTrashed()->first();
        $this->assertNotNull($trashedUser);
        $this->assertEquals($user->id, $trashedUser->id);
    }
}
