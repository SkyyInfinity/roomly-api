<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Salle N°' . fake()->numberBetween(100, 200),
            'description' => fake()->text(),
            'image' => fake()->imageUrl(),
            'pin' => fake()->numberBetween(0, 50),
            'is_reserved' => fake()->boolean(0),
        ];
    }
}
