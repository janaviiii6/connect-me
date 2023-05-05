<?php

namespace Database\Factories;

use App\Models\Ride;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PassengerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ride_id' => Ride::factory(),
            'user_id' => function () {
                // Get 3 random users
                $users = User::inRandomOrder()->limit(3)->get();

                // Return an array of their IDs
                return $users->pluck('id')->toArray();
            },
            'passenger_status' => $this->faker->randomElement(['REQUESTED', 'ACCEPTED', 'REJECTED']),
        ];
    }
}
