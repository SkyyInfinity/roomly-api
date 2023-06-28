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
            'name' => 'Salle ' . fake()->city(),
            'description' => fake()->text(),
            // Get root url of the app
            'image' => 'https://wonderful-lamarr.139-99-210-151.plesk.page/images/room.jpg',
            'pin' => fake()->numberBetween(0, 50),
            'is_reserved' => fake()->boolean(0),
        ];
    }
}
