@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Lista de Doctores</h1>
    <a href="{{ route('doctors.create') }}" class="btn btn-primary mb-3">Agregar Doctor</a>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mb-3">Volver al Dashboard</a>

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
                <th>Email</th>
                <th>Especialidad</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($doctors as $doctor)
                <tr>
                    <td>{{ $doctor->id }}</td>
                    <td>{{ $doctor->user->name }}</td>
                    <td>{{ $doctor->user->email }}</td>
                    <td>{{ $doctor->specialty->name }}</td>
                    <td>{{ $doctor->user->telefono }}</td>
                    <td>
                        <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este doctor?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
