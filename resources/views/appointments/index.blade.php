@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Listado de Citas</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($appointments->isEmpty())
        <div class="alert alert-info" role="alert">
            No tienes citas programadas.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover table-bordered shadow-sm">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Paciente</th>
                        <th scope="col">Doctor</th>
                        <th scope="col">Especialidad</th>
                        <th scope="col">Fecha y Hora</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->id }}</td>
                            <td>{{ $appointment->patient->name ?? 'Sin paciente' }}</td>
                            <td>{{ $appointment->doctor->user->name ?? 'Sin doctor' }}</td>
                            <td>{{ $appointment->specialty->name ?? 'Sin especialidad' }}</td>
                            <td>
    @if ($appointment->scheduled_date)
        {{ \Carbon\Carbon::parse($appointment->scheduled_date)->format('d/m/Y h:i A') }}
        <span class="badge bg-success ms-1">Definitiva</span>
    @else
        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y h:i A') }}
        <span class="badge bg-warning text-dark ms-1">Tentativa</span>
    @endif
</td>
                            <td>
                                <span class="badge
                                    @if ($appointment->status == 'pendiente') badge-warning text-black
                                    @elseif ($appointment->status == 'confirmada') badge-success text-black
                                    @elseif ($appointment->status == 'atendida') badge-info text-black
                                    @elseif ($appointment->status == 'cancelada') badge-danger text-black
                                    @else badge-secondary text-black
                                    @endif">
                                    {{ $appointment->status }}
                                </span>
                            </td>
                            <td>
                                @if (Auth::user()->role_id == 4) {{-- Paciente --}}
                                    @if ($appointment->status == 'pendiente')
                                        <button class="btn btn-sm btn-warning text-black" disabled>
                                            <i class="fas fa-hourglass-half"></i> En trámite
                                        </button>
                                    @elseif ($appointment->status == 'confirmada' || $appointment->status == 'atendida')
                                        <a href="{{ route('appointments.showDetails', $appointment->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> Ver detalles
                                        </a>
                                    @endif
                                @endif
                                @if (Auth::user()->role_id == 3 && $appointment->status == 'confirmada')
                                    <a href="{{ route('appointments.showAttendForm', $appointment->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-user-md"></i> Atender
                                    </a>
                                @elseif (Auth::user()->role_id == 3 && $appointment->status == 'atendida')
                                    <a href="{{ route('appointments.showDetails', $appointment->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Ver detalles
                                    </a>
                                @endif
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- Botón para volver dapendiendo del rol --}}
    @if (Auth::user()->role_id == 1)
        <div class=" mt-4">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Volver al Dashboard</a>
        </div>
    @endif
    @if (Auth::user()->role_id == 4)
        <div class=" mt-4">
            <a href="{{ url('/home') }}" class="btn btn-secondary">Volver </a>
        </div>
    @endif
    @if (Auth::user()->role_id == 3)
        <div class=" mt-4">
            <a href="{{ url('/') }}" class="btn btn-secondary"> Volver </a>
        </div>
    @endif

</div>
@endsection
