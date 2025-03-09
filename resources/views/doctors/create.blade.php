@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Registrar un Nuevo Doctor</h1>

    <form id="doctorForm" method="POST" action="{{ route('doctors.store') }}">
        @csrf

        <!-- Nombre -->
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" >
            <small id="nameError" class="text-danger d-none"></small>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" >
            <small id="emailError" class="text-danger d-none"></small>
        </div>

        <!-- Contraseña -->
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" >
            <small id="passwordError" class="text-danger d-none"></small>
        </div>

        <!-- Confirmar Contraseña -->
        <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" >
            <small id="confirmPasswordError" class="text-danger d-none"></small>
        </div>

        <!-- Tipo de Documento -->
        <div class="form-group">
            <label for="document_type">Tipo de Documento</label>
            <select id="document_type" class="form-control" name="tipo_documento" >
                <option value="">Seleccione el tipo de documento</option>
                <option value="CC">Cédula de Ciudadanía (CC)</option>
                <option value="TI">Tarjeta de Identidad (TI)</option>
                <option value="CE">Cédula de Extranjería (CE)</option>
            </select>
            <small id="tipoDocumentoError" class="text-danger d-none"></small>
        </div>

        <!-- Documento -->
        <div class="form-group">
            <label for="documento">Documento</label>
            <input type="text" class="form-control" id="documento" name="documento" >

            <small id="documentoError" class="text-danger d-none"></small>
        </div>

        <!-- Teléfono -->
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" >
            <small id="telefonoError" class="text-danger d-none"></small>
        </div>

        <!-- Especialidad -->
        <div class="form-group">
            <label for="specialties_id">Especialidad</label>
            <select class="form-control" id="specialties_id" name="specialties_id" >
                <option value="">Seleccione una especialidad</option>
                @foreach($specialties as $specialty)
                    <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                @endforeach
            </select>
            <small id="specialtyError" class="text-danger d-none"></small>
        </div>

        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary">Registrar Doctor</button>
            <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Volver</a>
        </div>


    </form>
</div>

<!-- Incluir el archivo de validaciones -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Cargar el archivo de scripts correctamente -->
<script src="{{ asset('js/app.js') }}"></script>

@endsection
