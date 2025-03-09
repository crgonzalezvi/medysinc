<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialties = [
            ['name' => 'Cardiology'],
            ['name' => 'Dermatology'],
            ['name' => 'Endocrinology'],
            ['name' => 'Gastroenterology'],
            ['name' => 'Neurology'],
            ['name' => 'Oncology'],
            ['name' => 'Ophthalmology'],
            ['name' => 'Orthopedics'],
            ['name' => 'Pediatrics'],
            ['name' => 'Psychiatry'],
        ];

        DB::table('specialties')->insert($specialties);
    }
}
