<?php

namespace Database\Factories;

use App\Models\Ride;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RideFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {

        $destination = $this->faker->randomElement([
            'Thane Station',
            'Kasarvadvali',
            'Andheri Station',
            'Mira Road Station',
            'Viviana',
            'AP SHAH',
            'Majiwada',
            'Manpada'
        ]);

        $ride = Ride::where('destination', $destination)->inRandomOrder()->first();

        $user = User::inRandomOrder()->first();

        if ($ride) {
            return [
                'user_id' => $ride->user_id,
                'destination' => $destination,
                'total_auto_fare' => $this->faker->numberBetween(100, 500),
                'wait_till_time' => $this->faker->dateTimeBetween('now', '+1 week'),
                'status' => 'ACTIVE',
                'current_status' => 'CONNECTING',
            ];
        }

        return [
            'user_id' => $user->id,
            'destination' => $destination,
            'total_auto_fare' => $this->faker->numberBetween(100, 500),
            'wait_till_time' => $this->faker->dateTimeBetween('now', '+1 week'),
            'status' => 'ACTIVE',
            'current_status' => 'CONNECTING',
        ];








        // $factory->afterCreating(Ride::class, function ($ride) {
        //     // Get three random users to be passengers on this ride
        //     $passengers = User::inRandomOrder()->limit(3)->get();

        //     foreach ($passengers as $passenger) {
        //         Passenger::factory()->create([
        //             'ride_id' => $ride->id,
        //             'user_id' => $passenger->id,
        //         ]);
        //     }
        // });
    }

}
