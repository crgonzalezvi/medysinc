<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Specialty;
use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = User::where('role_id', 3)->pluck('id')->toArray();

        // Obtener todas las especialidades
        $specialties = Specialty::pluck('id')->toArray();


        foreach ($doctors as $doctor) {
            DB::table('doctors')->insert([
                'users_id' => $doctor,
                'specialties_id' => $specialties[array_rand($specialties)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
