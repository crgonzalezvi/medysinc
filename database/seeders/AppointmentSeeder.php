<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AppointmentSeeder extends Seeder
{
    public function run()
    {
        $patients = range(1, 37);
        $doctors = [1,2,3,4,5,6,7];
        $statuses = ['Pendiente', 'Confirmado', 'Cancelado', 'Completado'];

        foreach (range(1, 37) as $i) {
            DB::table('appointments')->insert([
                'patients_id' => $patients[array_rand($patients)],
                'doctor_id' => $doctors[array_rand($doctors)],
                'date_hour' => Carbon::now()->addDays(rand(1, 30))->addHours(rand(8, 18))->format('Y-m-d H:i:s'),
                'status' => $statuses[array_rand($statuses)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

