<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'body' => fake()->paragraph(3),
            'user_id' => User::factory()->afterCreating(function ($user) {
                $user->roles()->attach(3);  // Asigna el rol 'usuario' (ID: 3)
            })
        ];
    }
}
