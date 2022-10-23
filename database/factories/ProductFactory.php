<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sku' => 'UM-' . $this->faker->unique()->numberBetween(1, 1000),
            'type_id' => rand(1, 12),
            'name' => 'item_' . $this->faker->word(),
            'price' => $this->faker->randomFloat(1, 2, 20),
        ];
    }
}
