<?php

namespace Database\Seeders;

use App\Models\Therapist;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TherapistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Therapist::create([
            'name' => 'Therapist 1',
            'price' => 100,
            'image' => 'therapist1.jpg',
            'rating' => 4.5,
            'total_treatment' => 50,
        ]);

        Therapist::create([
            'name' => 'Therapist 2',
            'price' => 120,
            'image' => 'therapist2.jpg',
            'rating' => 4.7,
            'total_treatment' => 60,
        ]);

        Therapist::create([
            'name' => 'Therapist 3',
            'price' => 90,
            'image' => 'therapist3.jpg',
            'rating' => 4.3,
            'total_treatment' => 40,
        ]);
    }
}
