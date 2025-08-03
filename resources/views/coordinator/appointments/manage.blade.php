@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Gestionar Agenda de la Cita #{{ $appointment->id }}</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <p><strong>Paciente:</strong> {{ $appointment->patient->name ?? 'No disponible' }}</p>
            <p><strong>Doctor:</strong> {{ $appointment->doctor->user->name ?? 'No disponible' }}</p>
            <p><strong>Especialidad:</strong> {{ $appointment->specialty->name ?? 'No disponible' }}</p>
            <p><strong>Fecha tentativa solicitada:</strong> 
                {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y h:i A') }}
            </p>

            <form action="{{ route('coordinator.appointments.schedule', $appointment->id) }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label for="scheduled_date"><strong>Fecha y hora definitiva a asignar:</strong></label>
                    <input type="datetime-local" name="scheduled_date" id="scheduled_date" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="fas fa-calendar-check"></i> Confirmar Cita
                </button>
                <a href="{{ route('coordinator.appointments.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
