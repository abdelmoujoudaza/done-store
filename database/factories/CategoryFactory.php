<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_id' => null,
            'name' => fake()->words(2, asText: true),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function subCategory(): static
    {
        return $this->state(fn () => [
            'parent_id' => Category::factory(),
        ]);
    }
}
