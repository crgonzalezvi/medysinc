@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <h2 class="mb-4">Gestionar Agenda</h2>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Información de la cita</h5>
            <p><strong>Paciente:</strong> {{ $appointment->patient->name }}</p>
            <p><strong>Doctor:</strong> {{ $appointment->doctor->user->name }}</p>
            <p><strong>Especialidad:</strong> {{ $appointment->specialty->name }}</p>
            <p><strong>Fecha tentativa:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y h:i A') }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-light">
            <strong>Seleccionar Fecha y Hora Definitiva</strong>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('coordinator.appointments.schedule', $appointment->id) }}">
                @csrf
                <div class="mb-3">
                    <label for="scheduled_date" class="form-label">Fecha y hora definitiva</label>
                    <input type="datetime-local" name="scheduled_date" id="scheduled_date" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-check"></i> Confirmar cita
                </button>
                <a href="{{ route('coordinator.appointments.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-light">
            <strong>Citas ya asignadas para {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}</strong>
        </div>
        <div class="card-body">
            @if ($otrasCitas->isEmpty())
                <p class="text-muted">No hay otras citas para este doctor en esta fecha.</p>
            @else
                <ul class="list-group">
                    @foreach ($otrasCitas as $cita)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ \Carbon\Carbon::parse($cita->appointment_date)->format('h:i A') }} 
                            — {{ $cita->patient->name ?? 'Paciente desconocido' }}
                            <span class="badge bg-{{ 
                                $cita->status === 'confirmada' ? 'success' : 
                                ($cita->status === 'pendiente' ? 'warning text-dark' : 'secondary') }}">
                                {{ ucfirst($cita->status) }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
