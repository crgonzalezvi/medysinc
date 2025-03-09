<?php

namespace App\Exports;

use App\Models\Appointment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AppointmentsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Appointment::with(['patient', 'doctor.user', 'specialty'])
            ->get()
            ->map(function ($appointment) {
                return [
                    'ID' => $appointment->id,
                    'Paciente' => $appointment->patient->name ?? 'Sin asignar',
                    'Doctor' => $appointment->doctor->user->name ?? 'Sin asignar',
                    'Especialidad' => $appointment->specialty->name ?? 'Sin asignar',
                    'Fecha' => $appointment->appointment_date,
                    'Estado' => $appointment->status,
                    'Motivo' => $appointment->reason,
                ];
            });
    }

    public function headings(): array
    {
        return ['ID', 'Paciente', 'Doctor', 'Especialidad', 'Fecha', 'Estado', 'Motivo'];
    }
}
