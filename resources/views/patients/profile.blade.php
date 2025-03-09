@extends('layouts.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container">
    <h1>Perfil del Paciente</h1>
    <form method="POST" action="{{ route('patients.profile.update') }}" id="patientProfileForm">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
            <!-- Contenedor de error para Nombre -->
            <small id="nameError" class="text-danger d-none"></small>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
            <!-- Contenedor de error para Email -->
            <small id="emailError" class="text-danger d-none"></small>
        </div>
        <br>
        <div class="form-group">
            <div class="col-md-6">
                <label for="document_type">Tipo de Documento</label>
                <select id="document_type" class="form-control @error('tipo_documento') is-invalid @enderror" name="tipo_documento">
                    <option value="">Seleccione el tipo de documento</option>
                    <option value="CC">Cédula de Ciudadanía (CC)</option>
                    <option value="TI">Tarjeta de Identidad (TI)</option>
                    <option value="CE">Cédula de Extranjería (CE)</option>
                </select>
                @error('tipo_documento')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <!-- Contenedor de error para Tipo de Documento -->
                <small id="documentTypeError" class="text-danger d-none"></small>
            </div>
        </div>

        <div class="form-group">
            <label for="documento">Documento</label>
            <input type="text" class="form-control" id="documento" name="documento" value="{{ $user->documento }}">
            <!-- Contenedor de error para Documento -->
            <small id="documentoError" class="text-danger d-none"></small>
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $user->telefono }}">
            <!-- Contenedor de error para Teléfono -->
            <small id="telefonoError" class="text-danger d-none"></small>
        </div>

        <div class="form-group">
            <label for="birthdate">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{ $patient->birthdate }}">
            <!-- Contenedor de error para Fecha de Nacimiento -->
            <small id="birthdateError" class="text-danger d-none"></small>
        </div>

        <div class="form-group">
            <label for="gender">Género</label>
            <select class="form-control" id="gender" name="gender">
                <option value="">Seleccione un género</option>
                <option value="Masculino" {{ $patient->gender == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="Femenino" {{ $patient->gender == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                <option value="Otro" {{ $patient->gender == 'Otro' ? 'selected' : '' }}>Otro</option>
            </select>
            <!-- Contenedor de error para Género -->
            <small id="genderError" class="text-danger d-none"></small>
        </div>

        <div class="form-group">
            <label for="adress">Dirección</label>
            <input type="text" class="form-control" id="adress" name="adress" value="{{ $patient->adress }}">
            <!-- Contenedor de error para Dirección -->
            <small id="adressError" class="text-danger d-none"></small>
        </div>
        <br>

        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
            <a href="{{ url('/home') }}" class="btn btn-secondary">Volver </a>
        </div>
    </form>
</div>

<!-- jQuery se carga de forma global o en el layout; asegúrate de incluir tu JS de validación en tu app.js -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
@endsection
