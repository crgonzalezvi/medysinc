@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Gestionar Agenda para la Cita #{{ $appointment->id }}</h2>

    <p><strong>Paciente:</strong> {{ $appointment->patient->name }}</p>
    <p><strong>Doctor:</strong> {{ $appointment->doctor->user->name }}</p>
    <p><strong>Especialidad:</strong> {{ $appointment->specialty->name }}</p>

    <form action="{{ route('coordinator.appointments.schedule', $appointment->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="appointment_date">Nueva Fecha y Hora:</label>
            <input type="datetime-local" name="appointment_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Confirmar cita</button>
        <a href="{{ route('coordinator.appointments.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
</div>
@endsection
