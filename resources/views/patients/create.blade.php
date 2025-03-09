@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm" style="border: none; border-radius: 10px;">
                <div class="card-header bg-white text-center py-4" style="border-bottom: 1px solid #e0e0e0;">
                    <h3 class="mb-0" style="font-weight: 600; color: #007BFF;">{{ __('Registrar Nuevo Paciente') }}</h3>
                </div>

                <div class="card-body px-5 py-4">
                    <form method="POST" action="{{ route('patients.store') }}" id="patientForm">
                        @csrf

                        <!-- Nombre -->
                        <div class="mb-4">
                            <label for="name" class="form-label">Nombre</label>
                            <input id="name" type="text" class="form-control" name="name" >
                            <small class="text-danger d-none" id="nameError">El nombre es obligatorio.</small>
                        </div>

                        <!-- Correo Electrónico -->
                        <div class="mb-4">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input id="email" type="email" class="form-control" name="email" >
                            <small class="text-danger d-none" id="emailError">Ingrese un correo válido.</small>
                        </div>

                        <!-- Tipo de Documento -->
                        <div class="mb-4">
                            <label for="tipo_documento" class="form-label">Tipo de Documento</label>
                            <select id="tipo_documento" class="form-control" name="tipo_documento" >
                                <option value="">Seleccione el tipo de documento</option>
                                <option value="CC">Cédula de Ciudadanía</option>
                                <option value="TI">Tarjeta de Identidad</option>
                                <option value="CE">Cédula de Extranjería</option>
                            </select>
                            <small class="text-danger d-none" id="tipoDocumentoError">Seleccione un tipo de documento.</small>
                        </div>

                        <!-- Número de Documento -->
                        <div class="mb-4">
                            <label for="documento" class="form-label">Número de Documento</label>
                            <input id="documento" type="number" class="form-control" name="documento" >
                            <small id="documentoError" class="text-danger d-none"></small>
                        </div>

                        <!-- Teléfono -->
                        <div class="mb-4">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input id="telefono" type="number" class="form-control" name="telefono" >
                            <small id="telefonoError" class="text-danger d-none"></small>
                        </div>

                        <!-- Fecha de Nacimiento -->
                        <div class="mb-4">
                            <label for="birthdate" class="form-label">Fecha de Nacimiento</label>
                            <input id="birthdate" type="date" class="form-control" name="birthdate" >
                            <small class="text-danger d-none" id="birthdateError">Ingrese una fecha válida.</small>
                        </div>

                        <!-- Género -->
                        <div class="mb-4">
                            <label for="gender" class="form-label">Género</label>
                            <select id="gender" class="form-control" name="gender" >
                                <option value="">Seleccione un género</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Otro">Otro</option>
                            </select>
                            <small class="text-danger d-none" id="genderError">Seleccione un género.</small>
                        </div>

                        <!-- Dirección -->
                        <div class="mb-4">
                            <label for="adress" class="form-label">Dirección</label>
                            <input id="adress" type="text" class="form-control" name="adress" >
                            <small class="text-danger d-none" id="adressError">La dirección es obligatoria.</small>
                        </div>

                        <!-- Contraseña -->
                        <div class="mb-4">
                            <label for="password" class="form-label">Contraseña</label>
                            <input id="password" type="password" class="form-control" name="password" >
                            <small class="text-danger d-none" id="passwordError">Mínimo 6 caracteres.</small>
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div class="mb-4">
                            <label for="password-confirm" class="form-label">Confirmar Contraseña</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                            <small class="text-danger d-none" id="confirmPasswordError">Las contraseñas no coinciden.</small>
                        </div>

                        <!-- Botón de Registro -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary">Registrar Paciente</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Cargar el archivo de scripts correctamente -->
<script src="{{ asset('js/app.js') }}"></script>
@endsection
