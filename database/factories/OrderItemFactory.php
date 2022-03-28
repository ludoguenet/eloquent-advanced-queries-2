<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'quantity' => $this->faker->randomElement([1, 2, 3, 5, 10, 15, 20]),
            'price' => $this->faker->randomElement([1000, 1500, 2000, 3000, 4000, 4500, 7500]),
        ];
    }
}
