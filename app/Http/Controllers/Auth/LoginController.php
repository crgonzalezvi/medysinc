<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Anhskohbo\NoCaptcha\Facades\NoCaptcha;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/patients/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

     protected function redirectTo()
     {
         if (Auth::check()) {
             $user = Auth::user();
 
             // Verificar el ID del rol del usuario
             switch ($user->role_id) {
                 case 1: // Admin
                     return '/admin/dashboard';
                 case 3: // Doctor
                     return '/appointments';
                 case 4: // Paciente
                     return '/home';
                 default:
                     return '/home'; // Redirección por defecto
             }
         }
 
         return '/home';
     }

     public function login(Request $request)
     {
         $request->validate([
             'email' => 'required|email',
             'password' => 'required',
            //  'g-recaptcha-response' => 'required|captcha',
         ]);
     
         if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
             $user = Auth::user();
     
             // Verificar el ID del rol del usuario
             switch ($user->role_id) {
                 case 1: // Admin
                     return redirect()->intended('/admin/dashboard');
                 case 3: // Doctor
                     return redirect()->intended('/appointments');
                 case 4: // Paciente
                     return redirect()->intended('/home');
                 default:
                     return redirect()->intended('/home'); // Redirección por defecto
             }
         }
     
         return back()->withErrors(['email' => 'Credenciales incorrectas']);
     }
     

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
