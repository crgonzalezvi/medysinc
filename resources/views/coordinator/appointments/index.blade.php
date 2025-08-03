@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Gestión de Citas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('coordinator.appointments.index') }}" class="mb-4 row">
        <div class="col-md-4">
            <input type="text" name="search_patient" class="form-control" placeholder="Buscar paciente por cédula o nombre" value="{{ request('search_patient') }}">
        </div>

        <div class="col-md-4">
            <select name="doctor_id" class="form-control">
                <option value="">-- Filtrar por Doctor --</option>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ request('doctor_id') == $doctor->id ? 'selected' : '' }}>
                        {{ $doctor->user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Filtrar</button>
            <a href="{{ route('coordinator.appointments.index') }}" class="btn btn-secondary">Limpiar</a>
        </div>
    </form>

    @foreach($appointments as $appointment)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <strong>Paciente:</strong> {{ $appointment->patient->name ?? 'No disponible' }}<br>
                <strong>Doctor:</strong> {{ $appointment->doctor->user->name ?? 'No disponible' }}<br>
                <strong>Especialidad:</strong> {{ $appointment->specialty->name ?? 'No disponible' }}<br>
                <strong>Fecha tentativa:</strong>
{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y h:i A') }}<br>

<strong>Fecha definitiva:</strong>
@if ($appointment->scheduled_date)
    {{ \Carbon\Carbon::parse($appointment->scheduled_date)->format('d/m/Y h:i A') }}
@else
    <span class="text-muted">Aún no asignada</span>
@endif
<br>
                <strong>Estado:</strong> 
                <span class="badge 
                    @if($appointment->status == 'pendiente') bg-warning text-dark
                    @elseif($appointment->status == 'confirmada') bg-success
                    @elseif($appointment->status == 'cancelada') bg-danger
                    @elseif($appointment->status == 'atendida') bg-info
                    @else bg-secondary
                    @endif">
                    {{ ucfirst($appointment->status) }}
                </span>
                <br><br>

                @if($appointment->status == 'pendiente')
                    <a href="{{ route('coordinator.appointments.manage', $appointment->id) }}" class="btn btn-sm btn-warning">
                        <i class="fas fa-calendar-alt"></i> Gestionar agenda
                    </a>
                @else
                    <span class="text-muted">Ya gestionada</span>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
