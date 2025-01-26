<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LocationTableSeeder::class,
            CategoriesTableSeeder::class,
            TreatmentsTableSeeder::class,
            TherapistTableSeeder::class,
            TreatmentTherapistTableSeeder::class,
        ]);
    }
}
