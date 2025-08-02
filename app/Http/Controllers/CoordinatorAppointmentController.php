<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class CoordinatorAppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['patient', 'doctor.user', 'specialty'])
            ->orderBy('appointment_date', 'desc')
            ->get();

        return view('coordinator.appointments.index', compact('appointments'));
    }

    public function approve($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'confirmada';
        $appointment->save();

        return back()->with('success', 'Cita aprobada correctamente.');
    }

    public function reject($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'rechazada';
        $appointment->save();

        return back()->with('success', 'Cita rechazada correctamente.');
    }
}
