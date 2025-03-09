@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Listado de Roles</h1>
    @if($roles->isEmpty())
        <div class="alert alert-warning" role="alert">
            No hay roles registradas.
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
            @foreach($roles as $role)
            <td>    <strong>{{ $role->id }}</strong></td>
                    <td>{{ $role->name }}</td>

                    <td>
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm">Editar</a>
                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este role?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <div class="d-flex gap-2 mt-3">
        <a href="{{ route('roles.create') }}" class="btn btn-success">Crear un nuevo rol</a>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Volver al Dashboard</a>
    </div>

</div>
@endsection
