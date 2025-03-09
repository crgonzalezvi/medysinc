@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">Solicitar una Cita</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- IMPORTANTE: id="appointmentForm" para que tu JS lo reconozca --}}
    <form action="{{ route('appointments.store') }}" method="POST" id="appointmentForm">
        @csrf

        <div class="mb-3">
            <label for="specialty" class="form-label">Especialidad:</label>
            <select name="specialty_id" id="specialty" class="form-control" >
                <option value="">Seleccione una especialidad</option>
                @foreach($specialties as $specialty)
                    <option value="{{ $specialty->id }}" {{ old('specialty_id') == $specialty->id ? 'selected' : '' }}>
                        {{ $specialty->name }}
                    </option>
                @endforeach
            </select>
            {{-- Contenedor para el mensaje de error de Especialidad --}}
            <small id="specialtyError" class="text-danger d-none"></small>
        </div>

        <div class="mb-3">
            <label for="doctor" class="form-label">Doctor:</label>
            <select name="doctor_id" id="doctor" class="form-control" >
                <option value="">Seleccione un doctor</option>
            </select>
            {{-- Contenedor para el mensaje de error de Doctor --}}
            <small id="doctorError" class="text-danger d-none"></small>
        </div>

        <div class="mb-3">
            <label for="appointment_date" class="form-label">Fecha y Hora:</label>
            <input type="datetime-local" name="appointment_date" id="appointment_date" class="form-control"
                   value="{{ old('appointment_date') }}" >
            {{-- Contenedor para el mensaje de error de Fecha y Hora --}}
            <small id="appointmentDateError" class="text-danger d-none"></small>
        </div>

        <div class="mb-3">
            <label for="reason" class="form-label">Motivo de la cita:</label>
            <textarea name="reason" id="reason" class="form-control">{{ old('reason') }}</textarea>
            {{-- Contenedor para el mensaje de error de Motivo --}}
            <small id="reasonError" class="text-danger d-none"></small>
        </div>


        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary">Solicitar Cita</button>
        <a href="{{ url('/home') }}" class="btn btn-secondary">Volver </a>
        </div>
    </form>
</div>

{{-- Este script maneja la carga dinámica de doctores al cambiar la especialidad --}}
<script>
    document.getElementById('specialty').addEventListener('change', function() {
        let specialtyId = this.value;
        let doctorSelect = document.getElementById('doctor');

        doctorSelect.innerHTML = '<option value="">Cargando...</option>';

        fetch(`/get-doctors/${specialtyId}`)
            .then(response => response.json())
            .then(data => {
                doctorSelect.innerHTML = '<option value="">Seleccione un doctor</option>';

                data.forEach(doctor => {
                    let option = document.createElement("option");
                    option.value = doctor.id;
                    option.textContent = doctor.user.name;
                    doctorSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error al cargar los doctores:', error);
                doctorSelect.innerHTML = '<option value="">Error al cargar los doctores</option>';
            });
    });
</script>
<!-- Incluir jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Cargar el archivo de validaciones -->
<script src="{{ asset('js/app.js') }}"></script>
@endsection
