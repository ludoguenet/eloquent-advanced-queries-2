<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'label' => $this->faker->randomElement(['Antarctique', 'Groenland']),
            'total_paid_amount' => $this->faker->randomElement([5000, 7500, 10000, 12000]),
        ];
    }
}
