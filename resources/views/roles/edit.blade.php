@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Role</h1>
    <form action="{{ route('roles.update', $role->id) }}" method="POST" id="roleForm">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $role->name ?? '') }}">
            <!-- Contenedor para mostrar el error del campo "Nombre" -->
            <small id="nameError" class="text-danger d-none"></small>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Actualizar Role</button>
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
