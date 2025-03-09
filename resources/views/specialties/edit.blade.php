@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Especialidad</h1>
    <form action="{{ route('specialties.update', $specialty->id) }}" method="POST" id="specialtyForm">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $specialty->name ?? '') }}">
            <!-- Contenedor para mostrar el error del campo "Nombre" -->
            <small id="nameError" class="text-danger d-none"></small>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Actualizar Especialidad</button>
    </form>
    <br>
    <div>
        <a href="{{ route('specialties.index') }}" class="btn btn-secondary">Volver al listado</a>
    </div>
</div>
<!-- Incluir jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Cargar el archivo de scripts correctamente -->
<script src="{{ asset('js/app.js') }}"></script>
@endsection
