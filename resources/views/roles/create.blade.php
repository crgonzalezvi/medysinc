@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Nuevo Rol</h1>

    <form id="createRoleForm" method="POST" action="{{ route('roles.store') }}">
        @csrf

        <!-- Nombre del Rol -->
        <div class="form-group">
            <label for="name">Nombre del Rol</label>
            <input type="text" class="form-control" id="name" name="name" >
            <small id="nameError" class="text-danger d-none"></small>
        </div>

        <br>
        <button type="submit" class="btn btn-primary">Guardar Rol</button>
    </form>

    <br>
    <div>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Volver al listado</a>
    </div>
</div>

<!-- Incluir jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Cargar validaciones -->
<script src="{{ asset('js/role-validation.js') }}"></script>
@endsection
