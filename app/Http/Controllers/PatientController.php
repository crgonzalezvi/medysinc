<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Patient;
use App\Models\User;

class PatientController extends Controller
{
    
    public function index(Request $request)
    {
        $search = $request->input('search');

        $patients = Patient::whereHas('user', function ($query) use ($search) {
            $query->where('name', 'like', "%$search%")
                  ->orWhere('documento', 'like', "%$search%");
        })->get();
    
        return view('patients.index', compact('patients'));
    }

    
    public function create()
    {
        return view('patients.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'tipo_documento' => 'required|string|max:2',
            'documento' => 'required|integer|unique:users,documento',
            'telefono' => 'required|numeric',
            'birthdate' => 'required|date',
            'gender' => 'required|in:Masculino,Femenino,Otro',
            'adress' => 'required|string|max:255',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'tipo_documento' => $request->tipo_documento,
            'documento' => $request->documento,
            'telefono' => $request->telefono,
            'password' => Hash::make($request->password),
        ]);

        $user->patient()->create([
            'birthdate' => $request->birthdate,
            'gender' => $request->gender,
            'adress' => $request->adress,
        ]);

        return redirect()->route('patients.index')->with('success', 'Paciente creado correctamente.');
    }

    
    public function show()
    {
        $user = Auth::user();
        $patient = $user->patient;
        return view('patients.profile', compact('user', 'patient'));
    }

    
    public function edit($id)
    {
        $patient = Patient::with('user')->findOrFail($id);
        $user = $patient->user;
        
        if (auth()->user()->role_id !== 1) {
            return redirect()->route('home')->with('error', 'No tienes permisos para editar este paciente.');
        }

        return view('patients.edit', compact('patient', 'user'));
    }

   
    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $user = $patient->user;
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'documento' => 'required|numeric|unique:users,documento,' . $user->id,
            'telefono' => 'required|numeric',
            'birthdate' => 'required|date',
            'gender' => 'required',
            'adress' => 'required|string|max:255',
        ]);

        if (auth()->user()->role_id !== 1 && auth()->user()->id !== $user->id) {
            return redirect()->route('home')->with('error', 'No tienes permisos para actualizar este paciente.');
        }

        $user->update($request->only(['name', 'email', 'documento', 'telefono']));
        $patient->update($request->only(['birthdate', 'gender', 'adress']));

        return redirect()->route('patients.index')->with('success', 'Paciente actualizado correctamente.');
    }

    
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'tipo_documento' => 'required|string',
            'documento' => 'required|numeric|unique:users,documento,' . $user->id,
            'telefono' => 'required|numeric',
            'birthdate' => 'required|date',
            'gender' => 'required|string',
            'adress' => 'required|string|max:255',
        ]);

        $user->update($request->only(['name', 'email', 'tipo_documento', 'documento', 'telefono']));
        $user->patient->update($request->only(['birthdate', 'gender', 'adress']));

        return redirect()->back()->with('success', 'Perfil actualizado correctamente.');
    }

    
    public function profile()
    {
        $user = auth()->user();
        $patient = $user->patient;

        if (!$patient) {
            return redirect()->route('home')->with('error', 'No tienes un perfil de paciente.');
        }

        return view('patients.profile', compact('user', 'patient'));
    }

    
    public function destroy($id)
    {
        $patient = Patient::with('user')->findOrFail($id);
        $patient->user->delete();
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Paciente eliminado correctamente.');
    }
}