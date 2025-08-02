<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Carbon\Carbon;

class CoordinatorAppointmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::with(['patient', 'doctor.user', 'specialty'])
            ->orderBy('appointment_date', 'desc');

        // Filtro por paciente
        if ($request->filled('search_patient')) {
            $search = $request->search_patient;

            $query->whereHas('patient', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('documento', 'like', "%$search%");
            });
        }

        // Filtro por doctor
        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->doctor_id);
        }

        $appointments = $query->get();

        $doctors = \App\Models\Doctor::with('user')->get();

        return view('coordinator.appointments.index', compact('appointments', 'doctors'));
    }

    public function manage($id)
    {
        $appointment = Appointment::with(['patient', 'doctor.user', 'specialty'])->findOrFail($id);

        if ($appointment->status !== 'pendiente') {
            return redirect()->route('coordinator.appointments.index')
                ->with('error', 'Esta cita ya ha sido gestionada.');
        }

        return view('coordinator.appointments.manage', compact('appointment'));
    }

    public function approve(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        if ($appointment->status !== 'pendiente') {
            return redirect()->route('coordinator.appointments.index')
                ->with('error', 'Esta cita ya fue gestionada.');
        }

        $request->validate([
            'appointment_date' => 'required|date|after:now',
        ]);

        $appointmentDate = Carbon::parse($request->appointment_date);

        // Rango permitido: 08:00 a 18:00
        $startHour = $appointmentDate->copy()->setTime(8, 0);
        $endHour = $appointmentDate->copy()->setTime(18, 0);

        if ($appointmentDate->lt($startHour) || $appointmentDate->gt($endHour)) {
            return back()->withInput()->with('error', 'La cita debe programarse entre las 08:00 y las 18:00.');
        }

        $appointment->update([
            'appointment_date' => $appointmentDate,
            'status' => 'confirmada',
        ]);

        return redirect()->route('coordinator.appointments.index')
            ->with('success', 'La cita fue confirmada exitosamente con la nueva fecha.');
    }

    public function reject($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'rechazada';
        $appointment->save();

        return back()->with('success', 'Cita rechazada correctamente.');
    }
}
