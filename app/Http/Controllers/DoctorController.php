<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\User;

class DoctorController extends Controller
{
    /**
     * Muestra una lista de todos los doctores.
     */
    public function index()
    {
        $doctors = Doctor::with('user', 'specialty')->get();
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Muestra el perfil de un doctor específico.
     */
    public function show(Doctor $doctor)
    {
        $specialties = Specialty::all();
        return view('doctors.profile', compact('doctor', 'specialties'));
    }

    /**
     * Muestra el formulario para editar un doctor específico.
     */
    // public function edit(Doctor $doctor)
    // {
    //     $specialties = Specialty::all();
    //     return view('doctors.profile', compact('doctor', 'specialties'));
    // }

    public function edit($id)
{
    $doctor = Doctor::with('user')->findOrFail($id);

    $specialties = Specialty::all();

    return view('doctors.profile', compact('doctor', 'specialties'));
}

    /**
     * Actualiza los datos de un doctor específico.
     */
    public function update(Request $request, Doctor $doctor)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $doctor->user->id,
        'tipo_documento' => 'required|string|max:255',
        'documento' => 'required|integer|unique:users,documento,' . $doctor->user->id,
        'telefono' => 'required|integer',
        'specialties_id' => 'required|integer|exists:specialties,id',
    ]);

    $doctor->user->update([
        'name' => $request->name,
        'email' => $request->email,
        'tipo_documento' => $request->tipo_documento,
        'documento' => $request->documento,
        'telefono' => $request->telefono,
    ]);

    $doctor->update([
        'specialties_id' => $request->specialties_id,
    ]);

    return redirect()->route('doctors.index')->with('success', 'Doctor actualizado correctamente.');
}

    /**
     * Muestra el formulario para crear un nuevo doctor.
     */
    public function create()
    {
        $specialties = Specialty::all();
        return view('doctors.create', compact('specialties'));
    }

    /**
     * Almacena un nuevo doctor en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'tipo_documento' => 'required|string|max:255',
            'documento' => 'required|integer|unique:users',
            'telefono' => 'required|integer',
            'specialties_id' => 'required|integer|exists:specialties,id',
        ]);

        // Crear el usuario asociado al doctor
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'tipo_documento' => $request->tipo_documento,
            'documento' => $request->documento,
            'telefono' => $request->telefono,
            'role_id' => 3,
        ]);

        Doctor::create([
            'users_id' => $user->id,
            'specialties_id' => $request->specialties_id,
        ]);

        return redirect()->route('doctors.index')->with('success', 'Doctor creado correctamente.');
    }

    /**
     * Elimina un doctor específico.
     */
    public function destroy(Doctor $doctor)
    {
        $user = $doctor->user;

       $doctor->delete();

    if ($user) {
        $user->delete();
    }

    return redirect()->route('doctors.index')->with('success', 'Doctor eliminado correctamente.');
    }

    public function getDoctorsBySpecialty($specialtyId)
{
    $doctors = Doctor::with('user')->where('specialties_id', $specialtyId)->get();
    return response()->json($doctors);
}

}
