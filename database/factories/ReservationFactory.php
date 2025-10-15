<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition(): array
    {
        $checkIn = $this->faker->dateTimeBetween('-1 month', '+2 months');
        $checkOut = clone $checkIn;
        $checkOut->modify('+' . $this->faker->numberBetween(1, 7) . ' days');

        return [
            'room_id' => Room::factory(),
            'guest_name' => $this->faker->name(),
            'guest_email' => $this->faker->safeEmail(),
            'guest_phone' => $this->faker->phoneNumber(),
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'status' => $this->faker->randomElement(['confirmed', 'pending', 'cancelled', 'completed']),
            'notes' => $this->faker->optional()->sentence(),
            'total_price' => $this->faker->numberBetween(100, 1000)
        ];
    }

    public function confirmed(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'confirmed'
            ];
        });
    }

    public function active(): self
    {
        return $this->state(function (array $attributes) {
            $checkIn = now()->subDays($this->faker->numberBetween(0, 3));
            $checkOut = now()->addDays($this->faker->numberBetween(1, 4));

            return [
                'status' => 'active',
                'check_in' => $checkIn,
                'check_out' => $checkOut
            ];
        });
    }
}