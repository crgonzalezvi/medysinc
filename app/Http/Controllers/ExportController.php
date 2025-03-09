<?php

namespace App\Http\Controllers;

use App\Exports\AppointmentsExport;
use App\Exports\DoctorsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportAppointments()
    {
        return Excel::download(new AppointmentsExport, 'citas.xlsx');
    }

    public function exportDoctors()
    {
        return Excel::download(new DoctorsExport, 'doctores.xlsx');
    }
}
