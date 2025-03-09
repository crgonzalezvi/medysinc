<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();

        if ($users->isEmpty()) {
            return view('users.index', ['message' => 'No hay usuarios disponibles']);
        }

        return view('users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function destroy($id)
    {
    $user = User::findOrFail($id);

    $user->delete();

    return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }

    public function update(Request $request, $id)
    {
        // Validar los datos
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role_id' => 'nullable|exists:roles,id', // Hacemos role_id opcional
            'tipo_documento' => 'required|string',
            'documento' => 'required|numeric',
            'telefono' => 'required|numeric',
        ]);
    
        // Buscar el usuario
        $user = User::findOrFail($id);
    
        // Actualizar datos
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'tipo_documento' => $request->input('tipo_documento'),
            'documento' => $request->input('documento'),
            'telefono' => $request->input('telefono'),
        ]);
    
        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

public function create()
{
    // Obtener los roles disponibles
    $roles = Role::all();
    return view('users.create', compact('roles'));
}


public function store(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'tipo_documento' => 'required|string',
        'documento' => 'required|integer|unique:users,documento',
        'telefono' => 'required|integer',
        'password' => 'required|string|min:6|confirmed',  // `confirmed` requiere un campo de confirmación como `password_confirmation`
        'role_id' => 'required|exists:roles,id', // Verificar que el rol sea válido
    ]);

    // Crear el nuevo usuario con el rol seleccionado
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'tipo_documento' => $request->tipo_documento,
        'documento' => $request->documento,
        'telefono' => $request->telefono,
        'password' => bcrypt($request->password),  // Encriptamos la contraseña
        'role_id' => $request->role_id, // Usar el role_id seleccionado
    ]);
    

    // Redirigir a la lista de usuarios con un mensaje de éxito
    return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
}

public function dashboard()
{
    if (Auth::user()->role_id != 1) {
        return redirect()->route('home')->with('error', 'No tienes permiso para acceder a esta página.');
    }

    $topDoctors = DB::table('appointments')
        ->join('doctors', 'appointments.doctor_id', '=', 'doctors.id')
        ->join('users', 'doctors.users_id', '=', 'users.id')
        ->select('users.name', DB::raw('COUNT(appointments.id) as total_citas'))
        ->where('appointments.status', 'atendida')
        ->groupBy('doctors.id', 'users.name')
        ->orderByDesc('total_citas')
        ->get();

    $topSpecialties = DB::table('appointments')
        ->join('specialties', 'appointments.specialty_id', '=', 'specialties.id')
        ->select('specialties.name', DB::raw('COUNT(appointments.id) as total_citas'))
        ->groupBy('specialties.id', 'specialties.name')
        ->orderByDesc('total_citas')
        ->get();

    return view('admin.dashboard', compact('topDoctors', 'topSpecialties'));
}
}
