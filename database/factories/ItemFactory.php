<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      return [
        'name' => $this->faker->name,
        'description' => $this->faker->sentence, // Assuming you have a description field
        'ticked' => false, // Set ticked to false by default
        'quantity' => $this->faker->numberBetween(1, 10), // Random quantity between 1 and 10
        'price' => $this->faker->randomFloat(2, 0, 100), // Random price with 2 decimal places
      ];
    }
}
