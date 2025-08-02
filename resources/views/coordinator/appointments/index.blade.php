@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Gestión de Citas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @foreach($appointments as $appointment)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <strong>Paciente:</strong> {{ $appointment->patient->name ?? 'No disponible' }}<br>
                <strong>Doctor:</strong> {{ $appointment->doctor->user->name ?? 'No disponible' }}<br>
                <strong>Especialidad:</strong> {{ $appointment->specialty->name ?? 'No disponible' }}<br>
                <strong>Fecha:</strong> {{ $appointment->appointment_date }}<br>
                <strong>Estado:</strong> {{ ucfirst($appointment->status) }}<br><br>

                @if($appointment->status == 'pendiente')
                    <form action="{{ route('coordinator.appointments.approve', $appointment->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-success btn-sm">
                            <i class="fas fa-check"></i> Aprobar
                        </button>
                    </form>

                    <form action="{{ route('coordinator.appointments.reject', $appointment->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-danger btn-sm">
                            <i class="fas fa-times"></i> Rechazar
                        </button>
                    </form>
                @else
                    <span class="badge bg-secondary">Ya gestionada</span>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
