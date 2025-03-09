@extends('layouts.app')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@section('content')
<div class="container">
    <h1>Editar Paciente</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('patients.update', $patient->id) }}" method="POST" id="patientForm">
        @csrf
        @method('PUT')

        <h3>Datos del Usuario</h3>

        <div class="form-group">
            <label for="name">Nombre:</label>
            <input id="name" type="text" name="name" value="{{ old('name', $patient->user->name) }}" class="form-control" >
            <small class="text-danger d-none" id="nameError">El nombre es obligatorio.</small>
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input id="email" type="email" name="email" value="{{ old('email', $patient->user->email) }}" class="form-control" >
            <small class="text-danger d-none" id="emailError">Ingrese un correo válido.</small>
        </div>

        <div class="form-group">
            <label for="tipo_documento">Tipo de Documento:</label>
            <select id="tipo_documento" name="tipo_documento" class="form-control" >
                <option value="">Seleccione el tipo de documento</option>
                <option value="CC" {{ old('tipo_documento', $patient->user->tipo_documento) == 'CC' ? 'selected' : '' }}>Cédula de Ciudadanía</option>
                <option value="TI" {{ old('tipo_documento', $patient->user->tipo_documento) == 'TI' ? 'selected' : '' }}>Tarjeta de Identidad</option>
                <option value="CE" {{ old('tipo_documento', $patient->user->tipo_documento) == 'CE' ? 'selected' : '' }}>Cédula de Extranjería</option>
            </select>
            <small class="text-danger d-none" id="tipoDocumentoError">Seleccione un tipo de documento.</small>
        </div>

        <div class="form-group">
            <label for="documento">Documento:</label>
            <input id="documento" type="number" name="documento" value="{{ old('documento', $patient->user->documento) }}" class="form-control" >
            <small class="text-danger d-none" id="documentoError">Ingrese un número válido.</small>
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input id="telefono" type="number" name="telefono" value="{{ old('telefono', $patient->user->telefono) }}" class="form-control" >
            <small class="text-danger d-none" id="telefonoError">Ingrese un número válido.</small>
        </div>

        <hr>
        <h3>Datos del Paciente</h3>

        <div class="form-group">
            <label for="birthdate">Fecha de Nacimiento:</label>
            <input id="birthdate" type="date" name="birthdate" value="{{ old('birthdate', $patient->birthdate) }}" class="form-control" >
            <small class="text-danger d-none" id="birthdateError">Ingrese una fecha válida.</small>
        </div>

        <div class="form-group">
            <label for="gender">Género:</label>
            <select id="gender" name="gender" class="form-control" >
                <option value="">Seleccione un género</option>
                <option value="Masculino" {{ old('gender', $patient->gender) == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="Femenino" {{ old('gender', $patient->gender) == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                <option value="Otro" {{ old('gender', $patient->gender) == 'Otro' ? 'selected' : '' }}>Otro</option>
            </select>
            <small class="text-danger d-none" id="genderError">Seleccione un género.</small>
        </div>

        <div class="form-group">
            <label for="adress">Dirección:</label>
            <input id="adress" type="text" name="adress" value="{{ old('adress', $patient->adress) }}" class="form-control" >
            <small class="text-danger d-none" id="adressError">La dirección es obligatoria.</small>
        </div>

        <br>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('patients.index') }}" class="btn btn-secondary">Volver</a>

        
    </form>
</div>
<!-- Agregar jQuery si no está incluido en Laravel -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Cargar el archivo de scripts correctamente -->
<script src="{{ asset('js/app.js') }}"></script>
@endsection
