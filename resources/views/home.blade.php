@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Bienvenido paciente, ') }} {{ Auth::user()->name }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Elige una opción:</p>

                    <a href="{{ route('appointments.create') }}" class="btn btn-primary">Solicitar Cita</a>
                    
                    <a href="{{ route('patients.profile') }}" class="btn btn-secondary">Actualizar Datos</a> 

                    <a href="{{ route('appointments.index') }}" class="btn btn-primary">Ver mis citas</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
