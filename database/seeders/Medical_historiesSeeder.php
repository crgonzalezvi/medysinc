<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Medical_historiesSeeder extends Seeder
{
    public function run()
    {
        $completedAppointments = DB::table('appointments')
            ->where('status', 'Completado')
            ->get();


        foreach ($completedAppointments as $appointment) {
            DB::table('medical_histories')->insert([
                'patient_id' => $appointment->patients_id,
                'doctor_id' => $appointment->doctor_id,
                'diagnosis' => 'Diagnóstico de ejemplo para el paciente ' . $appointment->patients_id,
                'treatment' => 'Tratamiento recomendado para el paciente ' . $appointment->patients_id,
                'date' => $appointment->date_hour,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

