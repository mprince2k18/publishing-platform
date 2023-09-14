<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'body' => fake()->text(200),
            'user_id' => 1,
            'published_at' => null,
            'is_published' => true,
            'is_draft' => false,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
