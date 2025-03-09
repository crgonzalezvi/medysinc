@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Nuevo Administrador</h1>

    <form id="adminForm" action="{{ route('users.store') }}" method="POST">
        @csrf

        <!-- Campo oculto para rol de administrador -->
        <input type="hidden" name="role_id" value="1">

        <!-- Nombre -->
        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="name" id="name" class="form-control" >
            <small id="nameError" class="text-danger d-none"></small>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" id="email" class="form-control" >
            <small id="emailError" class="text-danger d-none"></small>
        </div>

        <!-- Tipo de Documento -->
        <div class="mb-4">
            <label for="document_type" class="form-label">Tipo de Documento</label>
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
            <label>Documento:</label>
            <input type="number" name="documento" id="documento" class="form-control" >
            <small id="documentoError" class="text-danger d-none"></small>
        </div>

        <!-- Teléfono -->
        <div class="form-group">
            <label>Teléfono:</label>
            <input type="number" name="telefono" id="telefono" class="form-control" >
            <small id="telefonoError" class="text-danger d-none"></small>
        </div>

        <!-- Contraseña -->
        <div class="form-group">
            <label>Contraseña:</label>
            <input type="password" name="password" id="password" class="form-control" >
            <small id="passwordError" class="text-danger d-none"></small>
        </div>

        <!-- Confirmar Contraseña -->
        <div class="form-group">
            <label>Confirmar Contraseña:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" >
            <small id="confirmPasswordError" class="text-danger d-none"></small>
        </div>


        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary">Crear Administrador</button>

            <a href="{{ route('users.store') }}" class="btn btn-secondary">Volver</a>
        </div>
    </form>
</div>

<!-- Incluir jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Cargar el archivo de validaciones -->
<script src="{{ asset('js/app.js') }}"></script>

@endsection

