<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->Name,
            'description' => $this->faker->sentence,
            'price' => $this->faker->numberBetween(0, 1000),
            'star_avg' => $this->faker->numberBetween(3, 5),
            'categories_id' => $this->faker->numberBetween(1, 8),
            'status_id' => $this->faker->numberBetween(1, 2),
        ];
    }
}
