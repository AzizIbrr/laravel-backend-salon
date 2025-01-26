<?php

namespace Database\Seeders;

use App\Models\Treatment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TreatmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Treatment::create([
            'name' => 'Treatment 1',
            'duration' => 60,
            'location_id' => 1,
            'price' => 100,
            'image' => 'treatment1.jpg',
            'category_id' => 1,
        ]);

        Treatment::create([
            'name' => 'Treatment 2',
            'duration' => 90,
            'location_id' => 2,
            'price' => 150,
            'image' => 'treatment2.jpg',
            'category_id' => 2,
        ]);
    }
}
