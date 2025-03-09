<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Cita</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { color: #2c3e50; }
        .card { border: 1px solid #ddd; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
        .card-header { background-color: #3498db; color: white; padding: 10px; border-radius: 5px 5px 0 0; }
        .card-body { padding: 15px; }
        .btn { display: inline-block; padding: 10px 20px; background-color: #3498db; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>Detalles de la Cita</h1>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Información del Paciente</h5>
        </div>
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $patientUser->name }}</p>
            <p><strong>Tipo de documento:</strong> {{ $patientUser->tipo_documento }}</p>
            <p><strong>Documento:</strong> {{ $patientUser->documento }}</p>
            <p><strong>Teléfono:</strong> {{ $patientUser->telefono }}</p>
            <p><strong>Email:</strong> {{ $patientUser->email }}</p>
            <p><strong>Fecha de nacimiento:</strong> {{ $patient->birthdate }}</p>
            <p><strong>Género:</strong> {{ $patient->gender }}</p>
            <p><strong>Dirección:</strong> {{ $patient->adress }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Información de la Cita</h5>
        </div>
        <div class="card-body">
            <p><strong>Fecha y Hora:</strong> {{ $appointment->appointment_date }}</p>
            <p><strong>Médico:</strong> {{ $appointment->doctor->user->name }}</p>
            <p><strong>Especialidad:</strong> {{ $appointment->specialty->name }}</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Diagnóstico y Tratamiento</h5>
        </div>
        <div class="card-body">
            <p><strong>Diagnóstico:</strong> {{ $medicalHistory->diagnosis }}</p>
            <p><strong>Tratamiento:</strong> {{ $medicalHistory->treatment }}</p>
        </div>
    </div>
</body>
</html>