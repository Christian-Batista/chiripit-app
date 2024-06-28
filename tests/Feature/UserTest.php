<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_system_can_register_users(): void
    {
        //array with user data.
        $userRequest = [
            'name' => 'name',
            'last_name' => 'last_name',
            'email' => 'example@gmail.com',
            'password' => 'password',
            'confirm_password' => 'password'
        ];
        
        //url to store a new user.
        $url = 'api/register';

        $response = $this->postJson($url, $userRequest);

        //if response fail or doesn't have 200 status code.
        if ($response->status() !== 200) {
            //get current message
            dd($response->exception->getMessage());
        }

        $response->assertStatus(200);

        //verify if user exist on database.
        $this->assertDatabaseHas('users', [
            'name' => $userRequest['name'],
            'last_name' => $userRequest['last_name'],
            'email' => $userRequest['email'],
        ]);
        // Recupera el usuario de la base de datos
        $user = User::where('email', $userRequest['email'])->first();

        // Verifica que la contraseña esté encriptada
        $this->assertTrue(Hash::check($userRequest['password'], $user->password));
        $response->assertJsonStructure([
            'cod',
            'msg',
            'token'
        ]);
    }

    /**
     * A basic feature test example.
     */
    public function test_user_can_be_updated(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $url = 'api/user/update/';
        $response = $this->patchJson($url.$user->id, [
            'name' => 'miguel',
            'last_name' => 'batista'
        ]);

        if ($response->status() !== 200) {
            dd($response->exception->getMessage());
        }

        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'name' => 'miguel',
            'last_name' => 'batista',
            'email' => $user->email,
        ]);

        $response->assertJsonStructure([
            'cod',
            'msg',
            'data'
        ]);
    }

    /**
     * A basic feature test example.
     */
    public function test_user_can_be_deleted(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $url = 'api/user/delete/';
        $response = $this->delete($url.$user->id);

        if ($response->status() !== 200) {
            dd($response->exception->getMessage());
        }

        $response->assertStatus(200);

        $deleted = User::find($user->id);
        $this->assertNull($deleted);

        $response->assertJsonStructure([
            'cod',
            'msg',
        ]);
    }

    /**
     * A basic feature test example.
     */
    public function test_users_can_be_extracted(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $users = User::factory(10)->create();
    
        $url = 'api/user/get';
        $response = $this->get($url);

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

    /**
     * A basic feature test example.
     */
    // public function test_user_can_be_extracted_by_id(): void
    // {
    //     $user = User::factory()->create();
    //     Sanctum::actingAs($user);
    
    //     $url = 'api/user/get/';
    //     $response = $this->get($url.$user->id);

    //     if ($response->status() !== 200) {
    //         dd($response->exception->getMessage());
    //     }
    //     $response->assertStatus(200);

    //     $response->assertJsonStructure([
    //         'cod',
    //         'msg',
    //         'data'
    //     ]);
    // }

}
