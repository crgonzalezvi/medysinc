<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Specialty;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Patient;
use App\Models\MedicalHistory;
class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();
    
        // Inicializar la variable de citas
        $appointments = collect();
    
        // Si el usuario es un administrador, obtener todas las citas
        if ($user->role_id == 1) { // 1 = Admin
            $appointments = Appointment::with(['patient', 'doctor.user', 'specialty'])
                ->orderBy('appointment_date', 'desc')
                ->get();
        }
        // Si el usuario es un doctor, obtener solo sus citas
        elseif ($user->role_id == 3) { // 3 = Doctor
            $appointments = Appointment::where('doctor_id', $user->doctor->id)
                ->with(['patient', 'doctor.user', 'specialty'])
                ->orderBy('appointment_date', 'desc')
                ->get();
        }
        // Si el usuario es un paciente, obtener solo sus citas
        elseif ($user->role_id == 4) { // 4 = Patient
            $appointments = Appointment::where('patient_id', $user->id)
                ->with(['patient', 'doctor.user', 'specialty'])
                ->orderBy('appointment_date', 'desc')
                ->get();
        }
    
        // Pasar las citas a la vista
        return view('appointments.index', compact('appointments'));
    }

public function confirm(Appointment $appointment)
{
    if (Auth::user()->doctor->id == $appointment->doctor_id) {
        $appointment->update(['status' => 'confirmada']);
        return redirect()->route('appointments.index')->with('success', 'Cita confirmada correctamente.');
    }

    return redirect()->route('appointments.index')->with('error', 'No tienes permiso para confirmar esta cita.');
}

public function cancel(Appointment $appointment)
{
    // Verificar que el doctor solo pueda cancelar sus propias citas
    if (Auth::user()->doctor->id == $appointment->doctor_id) {
        $appointment->update(['status' => 'cancelada']);
        return redirect()->route('appointments.index')->with('success', 'Cita cancelada correctamente.');
    }

    return redirect()->route('appointments.index')->with('error', 'No tienes permiso para cancelar esta cita.');
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialties = Specialty::all();
        return view('appointments.create', compact('specialties'));
    }

    public function showDetails(Appointment $appointment)
    {
        $user = auth()->user();
        if ($appointment->status != 'atendida') {
            return redirect()->route('appointments.index')
                ->with('error', 'Esta cita no ha sido atendida.');
        }
    
        if ($user->role_id == 4) { // Paciente
            $patient = Patient::where('user_id', $user->id)->first();
    
            if (!$patient || $appointment->patient_id != $patient->user_id) {
                abort(403, "No tienes permiso para ver esta cita.");
            }
        } elseif ($user->role_id == 3) { // Doctor
            $doctor = \App\Models\Doctor::where('users_id', $user->id)->first();
    
    if (!$doctor || $appointment->doctor_id != $doctor->id) {
        abort(403, "No puedes ver detalles de una cita que no atendiste.");
    }
}
    
        // Buscar el paciente correctamente usando `user_id`
        $patient = Patient::where('user_id', $appointment->patient_id)->first();
    
        if (!$patient) {
            return redirect()->route('appointments.index')
                ->with('error', 'No se encontró información del paciente.');
        }
    
        $appointmentDate = \Carbon\Carbon::parse($appointment->appointment_date)->toDateString();
    
        $medicalHistory = MedicalHistory::where('patient_id', $patient->id)
            ->where('doctor_id', $appointment->doctor_id)
            ->whereDate('date', $appointmentDate)
            ->first();
    
        if (!$medicalHistory) {
            return redirect()->route('appointments.index')
                ->with('error', 'No se encontró el historial médico para esta cita.');
        }
    
        $patientUser = $patient->user;
    
        return view('appointments.details', compact('appointment', 'medicalHistory', 'patient', 'patientUser'));
    }
    
public function downloadPdf(Appointment $appointment)
{
    if ($appointment->status != 'atendida') {
        return redirect()->route('appointments.index')
            ->with('error', 'Esta cita no ha sido atendida.');
    }

    $patient = Patient::where('user_id', $appointment->patient_id)->first();
    if (!$patient) {
        return redirect()->route('appointments.index')
            ->with('error', 'No se encontró información del paciente.');
    }

    $medicalHistory = MedicalHistory::where('patient_id', $patient->id)
        ->where('doctor_id', $appointment->doctor_id)
        ->whereDate('date', \Carbon\Carbon::parse($appointment->appointment_date)->toDateString())
        ->first();

    if (!$medicalHistory) {
        return redirect()->route('appointments.index')
            ->with('error', 'No se encontró el historial médico para esta cita.');
    }

    
    $patientUser = $patient->user; 

    $pdf = Pdf::loadView('appointments.pdf', compact('appointment', 'medicalHistory', 'patient', 'patientUser'));

    return $pdf->download('detalles-cita-' . $appointment->id . '.pdf');
}


public function store(Request $request)
{
    $request->validate([
        'specialty_id' => 'required|exists:specialties,id',
        'doctor_id' => 'required|exists:doctors,id',
        'appointment_date' => 'required|date|after:today',
        'reason' => 'nullable|string',
    ]);

    $appointmentDate = Carbon::parse($request->input('appointment_date'));

    // Definir el rango de horas permitidas
    $startHour = Carbon::parse($appointmentDate->format('Y-m-d') . ' 08:00:00');
    $endHour = Carbon::parse($appointmentDate->format('Y-m-d') . ' 18:00:00');

    // Validar si la cita está dentro del horario permitido
    if ($appointmentDate->lt($startHour) || $appointmentDate->gt($endHour)) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Las citas solo pueden programarse entre las 8:00 AM y las 6:00 PM.');
    }

    // Definir el rango de tiempo para evitar conflictos con otras citas
    $startTime = $appointmentDate->subMinutes(20);
    $endTime = $appointmentDate->addMinutes(20);

    $existingAppointment = Appointment::where('doctor_id', $request->input('doctor_id'))
        ->whereBetween('appointment_date', [$startTime, $endTime])
        ->exists();

    if ($existingAppointment) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'El doctor ya tiene una cita programada en ese horario. Por favor, elige otro horario.');
    }

    Appointment::create([
        'patient_id' => Auth::id(),
        'doctor_id' => $request->doctor_id,
        'specialty_id' => $request->specialty_id,
        'appointment_date' => $request->appointment_date,
        'status' => 'pendiente',
        'reason' => $request->reason,
    ]);

    return redirect()->route('appointments.create')
        ->with('success', 'Cita solicitada correctamente.');
}

public function showAttendForm(Appointment $appointment)
{
    if (Auth::user()->role_id != 3 || $appointment->doctor_id != Auth::user()->doctor->id) {
        return redirect()->route('appointments.index')
            ->with('error', 'No tienes permiso para atender esta cita.');
    }

    return view('appointments.attend', compact('appointment'));
}

public function storeMedicalHistory(Request $request, Appointment $appointment)
{
    if (Auth::user()->role_id != 3 || $appointment->doctor_id != Auth::user()->doctor->id) {
        return redirect()->route('appointments.index')
            ->with('error', 'No tienes permiso para atender esta cita.');
    }

    $patient = Patient::where('user_id', $appointment->patient_id)->first();
    if (!$patient) {
        return redirect()->route('appointments.index')
            ->with('error', 'El paciente asociado a esta cita no existe.');
    }

    $request->validate([
        'diagnosis' => 'required|string|max:1000',
        'treatment' => 'required|string|max:1000',
    ]);

    MedicalHistory::create([
        'patient_id' => $patient->id, 
        'doctor_id' => $appointment->doctor_id,
        'diagnosis' => $request->input('diagnosis'),
        'treatment' => $request->input('treatment'),
        'date' => $appointment->appointment_date,
    ]);

    $appointment->update(['status' => 'atendida']);

    return redirect()->route('appointments.index')
        ->with('success', 'La cita ha sido atendida y el historial médico se ha guardado correctamente.');
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
