<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Sensor;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create a test user
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Create some test sensors
        Sensor::create([
            'name' => 'Colombo Central',
            'sensor_id' => 'COL001',
            'latitude' => 6.9270796,
            'longitude' => 79.8612430,
            'is_active' => true,
            'location_description' => 'Central Colombo monitoring station',
            'installed_by' => $user->id,
        ]);

        Sensor::create([
            'name' => 'Kandy Station',
            'sensor_id' => 'KAN001',
            'latitude' => 7.2906,
            'longitude' => 80.6337,
            'is_active' => true,
            'location_description' => 'Kandy city monitoring station',
            'installed_by' => $user->id,
        ]);
    }
}
