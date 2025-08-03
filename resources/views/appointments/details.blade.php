@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalles de la Cita</h1>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">Información del Paciente</h5>
        </div>
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $patientUser->name }}</p>
            <p><strong>Tipo de documento:</strong> {{ $patientUser->tipo_documento }}</p>
            <p><strong>Documento:</strong> {{ $patientUser->documento }}</p>
            <p><strong>Teléfono:</strong> {{ $patientUser->telefono }}</p>
            <p><strong>Email:</strong> {{ $patientUser->email }}</p>
            <p><strong>Fecha de nacimiento:</strong> {{ $patient->birthdate }}</p>
            <p><strong>Género:</strong> {{ $patient->gender }}</p>
            <p><strong>Dirección:</strong> {{ $patient->adress }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">Información de la Cita</h5>
        </div>
        <div class="card-body">
            {{-- <p><strong>Fecha y Hora:</strong> {{ $appointment->appointment_date }}</p> --}}
            <p><strong>Fecha y Hora asignada:</strong> 
    {{ $appointment->scheduled_date 
        ? \Carbon\Carbon::parse($appointment->scheduled_date)->format('d/m/Y h:i A') 
        : \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y h:i A') }}
</p>

            <p><strong>Médico:</strong> {{ $appointment->doctor->user->name }}</p>
            <p><strong>Especialidad:</strong> {{ $appointment->specialty->name }}</p>
        </div>
    </div>

    @if ($medicalHistory)
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Diagnóstico y Tratamiento</h5>
            </div>
            <div class="card-body">
                <p><strong>Diagnóstico:</strong> {{ $medicalHistory->diagnosis }}</p>
                <p><strong>Tratamiento:</strong> {{ $medicalHistory->treatment }}</p>
            </div>
        </div>
    @else
        <div class="alert alert-warning">
            No se encontró información de diagnóstico y tratamiento para esta cita.
        </div>
    @endif

    <a href="{{ route('appointments.index') }}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Volver a la lista de citas
    </a>

    <a href="{{ route('appointments.downloadPdf', $appointment->id) }}" class="btn btn-danger">
        <i class="fas fa-file-pdf"></i> Descargar PDF
    </a>
    
</div>
@endsection
