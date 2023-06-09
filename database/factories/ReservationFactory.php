<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user' => fake()->numberBetween(1, 10),
            'room' => fake()->numberBetween(1, 10),
            'start_at' => fake()->dateTimeBetween('-1 week', '+1 week'),
            'end_at' => fake()->dateTimeBetween('-1 week', '+1 week')
        ];
    }
}
