@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Administrador</h1>

    <form id="editAdminForm" action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Campo oculto para mantener el rol de administrador -->
        <input type="hidden" name="role_id" value="1">

        <!-- Nombre -->
        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" >
            <small id="nameError" class="text-danger d-none"></small>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" >
            <small id="emailError" class="text-danger d-none"></small>
        </div>

        <!-- Tipo de Documento -->
        <div class="form-group">
            <label>Tipo de Documento:</label>
            <select name="tipo_documento" id="document_type" class="form-control" required>
                <option value="CC" {{ $user->tipo_documento == 'CC' ? 'selected' : '' }}>Cédula de Ciudadanía (CC)</option>
                <option value="TI" {{ $user->tipo_documento == 'TI' ? 'selected' : '' }}>Tarjeta de Identidad (TI)</option>
                <option value="CE" {{ $user->tipo_documento == 'CE' ? 'selected' : '' }}>Cédula de Extranjería (CE)</option>
            </select>
            <small id="tipoDocumentoError" class="text-danger d-none"></small>
        </div>

        <!-- Documento -->
        <div class="form-group">
            <label>Documento:</label>
            <input type="number" name="documento" id="documento" class="form-control" value="{{ $user->documento }}" >
            <small id="documentoError" class="text-danger d-none"></small>
        </div>

        <!-- Teléfono -->
        <div class="form-group">
            <label>Teléfono:</label>
            <input type="number" name="telefono" id="telefono" class="form-control" value="{{ $user->telefono }}" >
            <small id="telefonoError" class="text-danger d-none"></small>
        </div>

        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary">Actualizar Administrador</button>

            <a href="{{ route('users.store') }}" class="btn btn-secondary">Volver</a>
        </div>
    </form>
</div>

<!-- Incluir jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Cargar validaciones -->
<script src="{{ asset('js/app.js') }}"></script>

@endsection
