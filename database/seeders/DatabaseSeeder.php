<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Passenger;
use App\Models\Ride;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
    //     // ]);
    //    $users = factory(User::class, 5)->create();

        $users = User::factory()->count(10)->create();
        // // Create 20 rides with random user as host
        Ride::factory()->count(10)->create([
            'user_id' => function () use ($users) {
                return $users->unique()->random()->id;
            }
        ]);
        // Ride::factory()->count(10)->create([
        //     'user_id' => function () use ($users) {
        //         return $users->unique()->random()->id;
        //     }
        // ]);


        // // Create 50 passengers for each ride with random user
        // foreach ($rides as $ride) {
        //     Passenger::factory()->count(50)->create([
        //         'ride_id' => $ride->id,
        //         'user_id' => function () use ($users) {
        //             return $users->random()->id;
        //         }
        //     ]);
        // }
    }
}
