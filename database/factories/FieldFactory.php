<?php

namespace Database\Factories;

use App\Models\FieldType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fields>
 */
class FieldFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->unique()->company(),
            'image' => fake()->unique()->imageUrl(),
            'desc' => fake()->sentence(20),
            'disc' => fake()->numberBetween(0.1, 1),
            'min_time' => fake()->numberBetween(1, 4),
            'status' => fake()->numberBetween(0, 1),
            'price' => fake()->numberBetween(100000, 1500000),
            'map_link' => fake()->url(),
            'type_id' => FieldType::factory(),
        ];
    }
}
