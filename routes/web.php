<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RSpecialtyController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\CoordinatorAppointmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// routes/web.php



Route::get('/', function () {
    return view('index');
});


//Route::resource('doctors', PatientController::class);
Auth::routes();



Route::get('/get-doctors/{specialtyId}', [DoctorController::class, 'getDoctorsBySpecialty']);

Route::get('/autocomplete', [MedicationController::class, 'autocomplete'])->name('autocomplete');


Route::middleware('auth','role:admin')->group(function () {
    //CRUD paciente
    Route::get('patients', [PatientController::class, 'index'])->name('patients.index');
    Route::get('patients/create', [PatientController::class, 'create'])->name('patients.create');
    Route::post('patients', [PatientController::class, 'store'])->name('patients.store');
    Route::get('patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
    Route::put('patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
    Route::patch('patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
    Route::delete('patients/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');
    // Route::get('/patients/{id}/edit', [PatientController::class, 'edit'])->name('patients.edit');
    Route::resource('roles', RoleController::class);
    //CRUD Especialidades
    Route::resource('specialties', SpecialtyController::class);
    //CRUD Doctores
    Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
    Route::get('/doctors/profile', [DoctorController::class, 'show'])->name('doctors.profile');
    Route::get('/doctors/{doctor}/edit', [DoctorController::class, 'edit'])->name('doctors.edit');
    Route::put('/doctors/{doctor}', [DoctorController::class, 'update'])->name('doctors.update');
    Route::get('/doctors/create', [DoctorController::class, 'create'])->name('doctors.create');
    Route::post('/doctors', [DoctorController::class, 'store'])->name('doctors.store');
    Route::delete('/doctors/{doctor}', [DoctorController::class, 'destroy'])->name('doctors.destroy');
    //CRUD Administrador
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    //Dashboard de admin
    Route::get('/admin/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');
    // Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    // Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');

});

// Route::middleware('auth','role:doctor|admin')->group(function () {
//     Route::get('/doctors/profile', [DoctorController::class, 'show'])->name('doctors.profile');
//     Route::put('/doctors/profile', [DoctorController::class, 'update'])->name('doctors.profile.update');
// });

////PACIENTES VER Y PEDIR CITAS-ACTUALIZAR PERFIL/////////////////////
Route::middleware('auth','role:patient')->group(function () {
    Route::get('/patients/profile', [PatientController::class, 'show'])->name('patients.profile');
    // Route::put('/patients/{id}', [PatientController::class, 'update'])->name('patients.update');
    Route::put('/patients/profile/update', [PatientController::class, 'updateProfile'])->name('patients.profile.update');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
});
Route::middleware(['auth', 'role:patient|doctor|admin'])->group(function () {
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/{appointment}/details', [AppointmentController::class, 'showDetails'])
         ->name('appointments.showDetails');

    Route::get('/appointments/{appointment}/download-pdf', [AppointmentController::class, 'downloadPdf'])
    ->name('appointments.downloadPdf');
});
////////DOCTOR CITAS/////////////////////
Route::middleware('auth','role:doctor|admin')->group(function () {
    // Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    // Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    // Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::post('/appointments/{appointment}/confirm', [AppointmentController::class, 'confirm'])->name('appointments.confirm');
    Route::post('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
    //Atender
    Route::get('/appointments/{appointment}/attend', [AppointmentController::class, 'showAttendForm'])->name('appointments.showAttendForm');
    Route::post('/appointments/{appointment}/attend', [AppointmentController::class, 'storeMedicalHistory'])->name('appointments.storeMedicalHistory');
    // Route::get('/appointments/{appointment}/details', [AppointmentController::class, 'showDetails'])
    //     ->name('appointments.showDetails');
 
    //Atender
    Route::get('/appointments/{appointment}/attend', [AppointmentController::class, 'showAttendForm'])->name('appointments.showAttendForm');
    Route::post('/appointments/{appointment}/attend', [AppointmentController::class, 'storeMedicalHistory'])->name('appointments.storeMedicalHistory');
    // Route::get('/appointments/{appointment}/details', [AppointmentController::class, 'showDetails'])
      //  ->name('appointments.showDetails');
    Route::get('/export/appointments', [ExportController::class, 'exportAppointments'])->name('export.appointments');
    Route::get('/export/doctors', [ExportController::class, 'exportDoctors'])->name('export.doctors');
});

/////CRUD especialidad ADMIN REACT///////
Route::middleware('auth','role:admin')->group(function () {
    Route::apiResource('specialty', SpecialtyController::class);
    Route::get('/specialty', [SpecialtyController::class, 'index'])->name('specialties.index');
    Route::post('/specialty', [SpecialtyController::class, 'store'])->name('specialties.store');
    Route::get('/specialty/{id}', [SpecialtyController::class, 'show'])->name('specialties.show');
    Route::put('/specialty/{id}', [SpecialtyController::class, 'update'])->name('specialties.update');
    Route::delete('/specialty/{id}', [SpecialtyController::class, 'destroy'])->name('specialties.destroy');
});

// Route::put('/patients/profile', [PatientController::class, 'update'])->name('patients.profile.update');

Route::middleware(['auth'])->group(function () {
    Route::get('/coordinator/appointments', [CoordinatorAppointmentController::class, 'index'])->name('coordinator.appointments.index');
    Route::post('/coordinator/appointments/{id}/approve', [CoordinatorAppointmentController::class, 'approve'])->name('coordinator.appointments.approve');
    Route::post('/coordinator/appointments/{id}/reject', [CoordinatorAppointmentController::class, 'reject'])->name('coordinator.appointments.reject');
});