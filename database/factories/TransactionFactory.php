<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomFloat(2, 2000, 50000), // Generates a random float between 0 and 1000
            'category_id' => $this->faker->numberBetween(1, 3),
            'user_id' => 1,
            'description' => $this->faker->sentence,
            'type' => $this->faker->randomElement(['expense', 'income']),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),

        ];;
    }
}
