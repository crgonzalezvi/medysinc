@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Perfil del Doctor</h1>
    <form id="editDoctorForm" action="{{ route('doctors.update', $doctor->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Nombre -->
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $doctor->user->name ?? '') }}" >
            <small id="nameError" class="text-danger d-none"></small>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $doctor->user->email ?? '') }}" >
            <small id="emailError" class="text-danger d-none"></small>
        </div>

        <!-- Tipo de Documento -->
        <div class="form-group">
            <label for="document_type">Tipo de Documento</label>
            <select id="document_type" class="form-control" name="tipo_documento" >
                <option value="">Seleccione el tipo de documento</option>
                <option value="CC" {{ old('tipo_documento', $doctor->user->tipo_documento ?? '') == 'CC' ? 'selected' : '' }}>Cédula de Ciudadanía (CC)</option>
                <option value="TI" {{ old('tipo_documento', $doctor->user->tipo_documento ?? '') == 'TI' ? 'selected' : '' }}>Tarjeta de Identidad (TI)</option>
                <option value="CE" {{ old('tipo_documento', $doctor->user->tipo_documento ?? '') == 'CE' ? 'selected' : '' }}>Cédula de Extranjería (CE)</option>
            </select>
            <small id="documentTypeError" class="text-danger d-none"></small>
        </div>

        <!-- Documento -->
        <div class="form-group">
            <label for="documento">Documento</label>
            <input type="text" class="form-control" id="documento" name="documento" value="{{ old('documento', $doctor->user->documento ?? '') }}" >
            <small id="documentError" class="text-danger d-none"></small>
        </div>

        <!-- Teléfono -->
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $doctor->user->telefono ?? '') }}" >
            <small id="telefonoError" class="text-danger d-none"></small>
        </div>

        <!-- Especialidad -->
        <div class="form-group">
            <label for="specialties_id">Especialidad</label>
            <select class="form-control" id="specialties_id" name="specialties_id" >
                <option value="">Selecciona una especialidad</option>
                @foreach ($specialties as $specialty)
                    <option value="{{ $specialty->id }}" {{ old('specialties_id', $doctor->specialties_id ?? '') == $specialty->id ? 'selected' : '' }}>
                        {{ $specialty->name }}
                    </option>
                @endforeach
            </select>
            <small id="specialtyError" class="text-danger d-none"></small>
        </div>



        <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
            <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </form>
</div>

<!-- Incluir jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Cargar validaciones -->
<script src="{{ asset('js/doctor-validation.js') }}"></script>
@endsection
