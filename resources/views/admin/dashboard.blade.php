@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Panel de Administración</h1>

    <div class="row">
        <!-- Tarjetas de navegación -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Crear Doctor</h5>
                    <p class="card-text">Registra un nuevo doctor en el sistema.</p>
                    <a href="{{ route('doctors.index') }}" class="btn btn-primary">
                        <i class="fas fa-user-md"></i> Ir a Crear Doctor
                    </a>
                </div>
            </div>
        </div>


        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Crear Administrador</h5>
                    <p class="card-text">Registra un nuevo administrador en el sistema.</p>
                    <a href="{{ route('users.index') }}" class="btn btn-primary">
                        <i class="fas fa-user-injured"></i> Ir a Crear Administrador
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Crear Especialidad</h5>
                    <p class="card-text">Registra una nueva especialidad médica.</p>
                    <a href="{{ route('specialties.index') }}" class="btn btn-primary">
                        <i class="fas fa-stethoscope"></i> Ir a Crear Especialidad
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ver Citas</h5>
                    <p class="card-text">Revisa y gestiona las citas programadas.</p>
                    <a href="{{ route('appointments.index') }}" class="btn btn-primary">
                        <i class="fas fa-calendar-alt"></i> Ir a Ver Citas
                    </a>
                </div>
            </div>
        </div>



        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Crear Pacientes</h5>
                    <p class="card-text">Revisa la lista de pacientes registrados.</p>
                    <a href="{{ route('patients.index') }}" class="btn btn-primary">
                        <i class="fas fa-user-injured"></i> Ir a Ver Pacientes
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Crear Roles</h5>
                    <p class="card-text">Revisa la lista de roles registrados.</p>
                    <a href="{{ route('roles.index') }}" class="btn btn-primary">
                        <i class="fas fa-user-injured"></i> Ir a Ver Roles
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Exportas Citas</h5>
                    <p class="card-text">Revisa todas las citas</p>
                    <a href="{{ route('export.appointments') }}" class="btn btn-success">
                        <i class="fas fa-file-excel"></i> Exportar Citas
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Exportar Datos de Doctores</h5>
                    <p class="card-text">Revisa los datos de los Doctores.</p>
                    <a href="{{ route('export.doctors') }}" class="btn btn-success">
                        <i class="fas fa-file-excel"></i> Exportar Doctores
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Exportar Citas</h5>
                <p class="card-text">Descarga un archivo Excel con todas las citas registradas.</p>
                <a href="{{ route('export.appointments') }}" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Descargar Citas
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Exportar Doctores</h5>
                <p class="card-text">Descarga un archivo Excel con la lista de doctores y sus citas atendidas.</p>
                <a href="{{ route('export.doctors') }}" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Descargar Doctores
                </a>
            </div> --}}

    <!-- Sección de Gráficos -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Doctores con más citas atendidas</h5>
                </div>
                <div class="card-body">
                    @if($topDoctors->isEmpty())
                        <p>No hay datos disponibles para los doctores.</p>
                    @else
                        <canvas id="topDoctorChart"></canvas>
                    @endif
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Especialidades más usadas</h5>
                </div>
                <div class="card-body">
                    @if($topSpecialties->isEmpty())
                        <p>No hay datos disponibles para las especialidades.</p>
                    @else
                        <canvas id="topSpecialtyChart"></canvas>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Incluir Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let canvasDoctor = document.getElementById('topDoctorChart');
        let canvasSpecialty = document.getElementById('topSpecialtyChart');

        console.log("Canvas de doctores:", canvasDoctor);
        console.log("Canvas de especialidades:", canvasSpecialty);

        let doctorLabels = {!! json_encode($topDoctors->pluck('name')) !!};
        let doctorData = {!! json_encode($topDoctors->pluck('total_citas')) !!};

        let specialtyLabels = {!! json_encode($topSpecialties->pluck('name')) !!};
        let specialtyData = {!! json_encode($topSpecialties->pluck('total_citas')) !!};

        console.log("Datos de doctores:", doctorLabels, doctorData);
        console.log("Datos de especialidades:", specialtyLabels, specialtyData);

        if (canvasDoctor && doctorLabels.length > 0) {
            new Chart(canvasDoctor, {
                type: 'bar',
                data: {
                    labels: doctorLabels,
                    datasets: [{
                        label: 'Citas atendidas',
                        data: doctorData,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        }

        if (canvasSpecialty && specialtyLabels.length > 0) {
            new Chart(canvasSpecialty, {
                type: 'bar',
                data: {
                    labels: specialtyLabels,
                    datasets: [{
                        label: 'Citas atendidas',
                        data: specialtyData,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        }
    });
</script>
@endsection
