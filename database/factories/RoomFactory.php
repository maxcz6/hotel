<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition(): array
    {
        $types = ['individual', 'doble', 'suite', 'familiar'];
        $amenities = [
            'wifi', 'tv', 'aire_acondicionado', 'minibar', 
            'caja_fuerte', 'balcon', 'vista_mar', 'jacuzzi'
        ];

        return [
            'number' => $this->faker->unique()->numberBetween(101, 999),
            'type' => $this->faker->randomElement($types),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->numberBetween(50, 500),
            'status' => 'available',
            'capacity' => $this->faker->numberBetween(1, 6),
            'amenities' => $this->faker->randomElements($amenities, $this->faker->numberBetween(3, 6))
        ];
    }

    public function occupied(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'occupied'
            ];
        });
    }

    public function maintenance(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'maintenance'
            ];
        });
    }
}