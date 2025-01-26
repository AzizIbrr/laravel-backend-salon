<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Location::create([
            'name' => 'Location 1',
            'address' => '123 Main St',
            'city' => 'City 1',
            'state' => 'State 1',
            'phone' => '123-456-7890',
            'link' => 'http://example.com',
            'image' => 'location1.jpg',
            'start_hour' => '08:00:00',
            'close_hour' => '18:00:00',
        ]);

        Location::create([
            'name' => 'Location 2',
            'address' => '456 Elm St',
            'city' => 'City 2',
            'state' => 'State 2',
            'phone' => '987-654-3210',
            'link' => 'http://example.com',
            'image' => 'location2.jpg',
            'start_hour' => '09:00:00',
            'close_hour' => '19:00:00',
        ]);
    }
}
