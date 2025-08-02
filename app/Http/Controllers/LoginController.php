<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Esta propiedad ya no se usa porque vamos a usar el método redirectTo()
    // protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirige al usuario según su rol después del login
     */
    protected function redirectTo()
    {
        $role = auth()->user()->role_id;

        return match ($role) {
            1 => route('admin.dashboard'),
            3 => route('appointments.index'),
            4 => '/home',
            5 => route('coordinator.appointments.index'),
            default => '/',
        };
    }
}
