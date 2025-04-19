<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(2, asText: true),
            'description' => fake()->paragraph,
            'price' => fake()->randomFloat(nbMaxDecimals: 2, min: 50, max: 120),
            'image' => fake()->imageUrl
        ];
    }
}
