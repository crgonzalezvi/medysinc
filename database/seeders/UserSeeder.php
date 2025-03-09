<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Admin', 'email' => 'admin@medisync.com', 'password' => Hash::make(' '), 'role_id' => 1, 'tipo_documento' => 'CC', 'documento' => 10000001, 'telefono' => 3000000001],
            ['name' => 'Juan Pérez', 'email' => 'juan@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 2, 'tipo_documento' => 'CC', 'documento' => 10000002, 'telefono' => 3000000002],
            ['name' => 'Ana Gómez', 'email' => 'ana@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 3, 'tipo_documento' => 'CC', 'documento' => 10000003, 'telefono' => 3000000003],
            ['name' => 'María Galvez', 'email' => 'maris@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 10000004, 'telefono' => 3000000004],

            ['name' => 'María Rodríguez', 'email' => 'maria@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 1, 'tipo_documento' => 'CC', 'documento' => 10000005, 'telefono' => 3000000005],
            ['name' => 'Pedro Sánchez', 'email' => 'pedro@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 2, 'tipo_documento' => 'CC', 'documento' => 10000006, 'telefono' => 3000000006],
            ['name' => 'Laura Fernández', 'email' => 'laura@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 3, 'tipo_documento' => 'CC', 'documento' => 10000007, 'telefono' => 3000000007],
            ['name' => 'David Jiménez', 'email' => 'david@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 10000008, 'telefono' => 3000000008],
            ['name' => 'Elena Castro', 'email' => 'elena@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 1, 'tipo_documento' => 'CC', 'documento' => 10000009, 'telefono' => 3000000009],
            ['name' => 'Ricardo Torres', 'email' => 'ricardo@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 2, 'tipo_documento' => 'CC', 'documento' => 10000010, 'telefono' => 3000000010],
            ['name' => 'Sofía Ramírez', 'email' => 'sofia@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 3, 'tipo_documento' => 'CC', 'documento' => 10000011, 'telefono' => 3000000011],
            ['name' => 'Gabriel Ortega', 'email' => 'gabriel@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 10000012, 'telefono' => 3000000012],
            ['name' => 'Patricia Herrera', 'email' => 'patricia@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 1, 'tipo_documento' => 'CC', 'documento' => 10000013, 'telefono' => 3000000013],
            ['name' => 'Alejandro Díaz', 'email' => 'alejandro@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 2, 'tipo_documento' => 'CC', 'documento' => 10000014, 'telefono' => 3000000014],
            ['name' => 'Fernanda Ruiz', 'email' => 'fernanda@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 3, 'tipo_documento' => 'CC', 'documento' => 10000015, 'telefono' => 3000000015],
            ['name' => 'Roberto Castro', 'email' => 'roberto@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 10000016, 'telefono' => 3000000016],
            ['name' => 'Natalia Vargas', 'email' => 'natalia@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 1, 'tipo_documento' => 'CC', 'documento' => 10000017, 'telefono' => 3000000017],
            ['name' => 'Javier Guzmán', 'email' => 'javier@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 2, 'tipo_documento' => 'CC', 'documento' => 10000018, 'telefono' => 3000000018],
            ['name' => 'Mónica Flores', 'email' => 'monica@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 3, 'tipo_documento' => 'CC', 'documento' => 10000019, 'telefono' => 3000000019],
            ['name' => 'Daniel Espinoza', 'email' => 'daniel@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 10000020, 'telefono' => 3000000020],

            ['name' => 'Silvia Mendoza', 'email' => 'silvia@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 1, 'tipo_documento' => 'CC', 'documento' => 10000021, 'telefono' => 3000000021],
            ['name' => 'Esteban Morales', 'email' => 'esteban@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 2, 'tipo_documento' => 'CC', 'documento' => 10000022, 'telefono' => 3000000022],
            ['name' => 'Gloria Castro', 'email' => 'gloria@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 3, 'tipo_documento' => 'CC', 'documento' => 10000023, 'telefono' => 3000000023],
            ['name' => 'Francisco Paredes', 'email' => 'francisco@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 10000024, 'telefono' => 3000000024],
            ['name' => 'Carmen Ríos', 'email' => 'carmen@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 1, 'tipo_documento' => 'CC', 'documento' => 10000025, 'telefono' => 3000000025],
            ['name' => 'Raúl Vargas', 'email' => 'raul@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 2, 'tipo_documento' => 'CC', 'documento' => 10000026, 'telefono' => 3000000026],
            ['name' => 'Verónica León', 'email' => 'veronica@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 3, 'tipo_documento' => 'CC', 'documento' => 10000027, 'telefono' => 3000000027],
            ['name' => 'Héctor Álvarez', 'email' => 'hector@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 10000028, 'telefono' => 3000000028],
            ['name' => 'Beatriz Figueroa', 'email' => 'beatriz@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 1, 'tipo_documento' => 'CC', 'documento' => 10000029, 'telefono' => 3000000029],
            ['name' => 'Ana Martínez', 'email' => 'ana.martinez@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 10000030, 'telefono' => 3000000030],
            ['name' => 'Carlos López', 'email' => 'carlos.lopez@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 10000031, 'telefono' => 3000000031],
            ['name' => 'Beatriz García', 'email' => 'beatriz.garcia@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 10000032, 'telefono' => 3000000032],
            ['name' => 'José Rodríguez', 'email' => 'jose.rodriguez@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 10000033, 'telefono' => 3000000033],
            ['name' => 'Marta Fernández', 'email' => 'marta.fernandez@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 10000034, 'telefono' => 3000000034],
            ['name' => 'David Sánchez', 'email' => 'david.sanchez@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 10000035, 'telefono' => 3000000035],
            ['name' => 'Claudia Pérez', 'email' => 'claudia.perez@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 10000036, 'telefono' => 3000000036],
            ['name' => 'Ricardo Díaz', 'email' => 'ricardo.diaz@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 10000037, 'telefono' => 3000000037],
            ['name' => 'Lorena Torres', 'email' => 'lorena.torres@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 10000038, 'telefono' => 3000000038],
            ['name' => 'Pedro Gómez', 'email' => 'pedro.gomez@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 10000039, 'telefono' => 3000000039],
            ['name' => 'Isabel Castro', 'email' => 'isabel.castro@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 10000040, 'telefono' => 3000000040],


                ['name' => 'Luis Ramírez', 'email' => 'luis.ramirez@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 1001234567, 'telefono' => 3001234567],
                ['name' => 'Verónica Jiménez', 'email' => 'veronica.jimenez@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 1001234568, 'telefono' => 3001234568],
                ['name' => 'Antonio González', 'email' => 'antonio.gonzalez@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 1001234569, 'telefono' => 3001234569],
                ['name' => 'Patricia Ruiz', 'email' => 'patricia.ruiz@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 1001234570, 'telefono' => 3001234570],
                ['name' => 'Andrea Ruiz', 'email' => 'andrea.ruiz@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 1001234571, 'telefono' => 3001234571],
                ['name' => 'Carlos Gómez', 'email' => 'carlos.gomez@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 1001234572, 'telefono' => 3001234572],
                ['name' => 'Andrea Torres', 'email' => 'andrea.torres@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 1001234573, 'telefono' => 3001234573],
                ['name' => 'Fernando López', 'email' => 'fernando.lopez@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 1001234574, 'telefono' => 3001234574],
                ['name' => 'Camila Sánchez', 'email' => 'camila.sanchez@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 1001234575, 'telefono' => 3001234575],
                ['name' => 'Jorge Ramírez', 'email' => 'jorge.ramirez@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 1001234576, 'telefono' => 3001234576],
                ['name' => 'Luisa Castro', 'email' => 'luisa.castro@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 1001234577, 'telefono' => 3001234577],
                ['name' => 'Esteban Herrera', 'email' => 'esteban.herrera@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 1001234578, 'telefono' => 3001234578],
                ['name' => 'Natalia Vargas', 'email' => 'natalia.vargas@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 1001234579, 'telefono' => 3001234579],
                ['name' => 'Ricardo Paredes', 'email' => 'ricardo.paredes@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 1001234580, 'telefono' => 3001234580],
                ['name' => 'Sofía Méndez', 'email' => 'sofia.mendez@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 1001234581, 'telefono' => 3001234581],
                ['name' => 'Martín Ríos', 'email' => 'martin.rios@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 1001234582, 'telefono' => 3001234582],
                ['name' => 'Gabriela Ortega', 'email' => 'gabriela.ortega@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 1001234583, 'telefono' => 3001234583],
                ['name' => 'David Guzmán', 'email' => 'david.guzman@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 1001234584, 'telefono' => 3001234584],
            ['name' => 'Elena Fernández', 'email' => 'elena.fernandez@medisync.com', 'password' => Hash::make('password123'), 'role_id' => 4, 'tipo_documento' => 'CC', 'documento' => 1001234585, 'telefono' => 3001234585],



        ];

        DB::table('users')->insert($users);
    }
}
