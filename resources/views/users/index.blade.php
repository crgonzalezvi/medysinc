@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Listado de Administradores</h1>

    @if($users->where('role_id', 1)->isEmpty())
        <div class="alert alert-warning">
            No hay administradores registrados.
        </div>
    @else
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Documento</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users->where('role_id', 1) as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->documento }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro de eliminar este administrador?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif


    <div class="text-center mt-3">
        <a href="{{ route('users.create') }}" class="btn btn-success">Crear Nuevo Administrador</a>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Volver al Dashboard</a>
    </div>
</div>
@endsection
