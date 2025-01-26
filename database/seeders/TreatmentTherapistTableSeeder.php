<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TreatmentTherapistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('treatment_therapist')->insert([
            ['treatment_id' => 1, 'therapist_id' => 1],
            ['treatment_id' => 1, 'therapist_id' => 2],
            ['treatment_id' => 2, 'therapist_id' => 1],
            ['treatment_id' => 2, 'therapist_id' => 2],
        ]);
    }
}
