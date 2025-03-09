@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Listado de Especialidades</h1>
    @if($specialties->isEmpty())
        <div class="alert alert-warning" role="alert">
            No hay especialidades registradas.
        </div>
    @endif
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($specialties as $specialty)
            <td>    <strong>{{ $specialty->id }}</strong></td>
                    <td>{{ $specialty->name }}</td>

                    <td>
                        <a href="{{ route('specialties.edit', $specialty->id) }}" class="btn btn-primary btn-sm">Editar</a>
                        <form action="{{ route('specialties.destroy', $specialty->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta especialidad?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center gap-3 mt-4">

        <a href="{{ route('specialties.create') }}" class="btn btn-success">Crear Nueva Especialidad</a>
        <a href="http://localhost:5174/" class="btn btn-info">Ir a Vista React</a>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Volver al Dashboard</a>
    </div>


</div>
@endsection
