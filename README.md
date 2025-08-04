# MediSync

![Laravel](https://img.shields.io/badge/Laravel-10.x-red)
![PHP](https://img.shields.io/badge/PHP-8.1+-blue)
![License](https://img.shields.io/badge/license-MIT-green)

MediSync es una plataforma web desarrollada en Laravel que permite gestionar de forma integral las citas médicas de una institución. Ofrece funcionalidades avanzadas para pacientes, médicos, coordinadores y administradores, integrando validación de agendas, historial médico, filtros por especialidad y videollamadas médicas.

# Funcionalidades principales

- Registro y autenticación con roles: administrador, médico, paciente y coordinador.
- Solicitud de citas con fecha tentativa por parte del paciente.
- Asignación definitiva de citas por parte del coordinador.
- Validación automática para evitar traslapes de citas en rangos de 30 minutos por doctor.
- Historial médico con diagnóstico y tratamiento.
- Autocompletado de medicamentos usando la API pública de CIMA (AEMPS).
- Visualización de contraindicaciones mediante integración externa.
- Videollamadas médicas usando [Jitsi Meet](https://jitsi.org/).
- Paneles filtrables y paginados.
- Sistema multilenguaje con paginación en español.

# Requisitos del sistema

- PHP >= 8.1
- Composer
- MySQL o MariaDB
- Node.js y NPM (opcional para compilar assets)
- Laravel 10.x

# Instalación

1. Clona el repositorio:

git clone https://github.com/tuusuario/medisync.git
cd medisync

2. Instalación dependencias de PHP

composer install

3. Copiar y configurar el archivo .env
- Creación de .env
php artisan key:generate

4. Configutación de base de datos en .env

# Sugeridos

DB_DATABASE=medisync
DB_USERNAME=root
DB_PASSWORD=

5. Ejecutar migracioens y seeders
php artisan migrate --seed

6. Compilación de assets
npm install && npm run dev

7. Inicio del servidor
php artisan serve

Desarrollado con ❤️ por Cristian.

