<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'user_type_id' => \App\Models\UserType::factory(),
            'profile_picture' => $this->faker->imageUrl(640, 480, 'people', true,'Faker'),
            'location' => $this->faker->address,
            'phone_number' => $this->faker->phoneNumber,
            'bio' => $this->faker->paragraph,
            'availability' => $this->faker->boolean,
        ];
    }
}
