<?php

namespace App\Exports;

use App\Models\Doctor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DoctorsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Doctor::with('user', 'specialty')
            ->get()
            ->map(function ($doctor) {
                return [
                    'ID' => $doctor->id,
                    'Nombre' => $doctor->user->name ?? 'Sin asignar',
                    'Especialidad' => $doctor->specialty->name ?? 'Sin asignar',
                    'Citas Atendidas' => $doctor->appointments()->where('status', 'Atendida')->count(),
                ];
            });
    }

    public function headings(): array
    {
        return ['ID', 'Nombre', 'Especialidad', 'Citas Atendidas'];
    }
}
