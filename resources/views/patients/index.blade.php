@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Lista de Pacientes</h1>
    {{-- Busqueda --}}
    <form action="{{ route('patients.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" id="search" placeholder="Buscar paciente..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>


    <div class="d-flex gap-2 mb-3">
        <a href="{{ route('patients.create') }}" class="btn btn-success">Registrar Paciente</a>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Volver al Dashboard</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo Documento</th>
                <th>Documento</th>
                <th>Género</th>
                <th>Fecha de Nacimiento</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($patients as $patient)
                <tr>
                    <td>{{ $patient->id }}</td>
                    <td>{{ $patient->user->name }}</td>
                    <td>{{ $patient->user->tipo_documento }}</td>
                    <td>{{ $patient->user->documento }}</td>
                    <td>{{ $patient->gender }}</td>
                    <td>{{ $patient->birthdate }}</td>
                    <td>{{ $patient->adress }}</td>
                    <td>{{ $patient->user->telefono }}</td>
                    <td>
                        <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-primary btn-sm">Editar</a>
                        <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No se encontraron pacientes.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
