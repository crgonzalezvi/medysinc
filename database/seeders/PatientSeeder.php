<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = [
            [
                'user_id' => 4,
                'birthdate' => Carbon::parse('1985-03-15'),
                'gender' => 'Femenino',
                'adress' => 'Calle 123, Manizales, Colombia',
            ],
            [
                'user_id' => 8,
                'birthdate' => Carbon::parse('1987-05-25'),
                'gender' => 'Masculino',
                'adress' => 'Avenida 456, Manizales, Colombia',
            ],
            [
                'user_id' => 12,
                'birthdate' => Carbon::parse('1992-07-22'),
                'gender' => 'Masculino',
                'adress' => 'Calle Secundaria, Medellin, Colombia',
            ],
            [
                'user_id' => 16,
                'birthdate' => Carbon::parse('1988-11-30'),
                'gender' => 'Masculino',
                'adress' => 'Avenuser_ida Principal, Medellin, Colombia',
            ],
            [
                'user_id' => 20,
                'birthdate' => Carbon::parse('1990-09-10'),
                'gender' => 'Masculino',
                'adress' => 'Calle Central, Bogota, Colombia',
            ],
            [
                'user_id' => 24,
                'birthdate' => Carbon::parse('1986-02-17'),
                'gender' => 'Masculino',
                'adress' => 'Calle Mayor, Cali, Colombia',
            ],
            [
                'user_id' => 28,
                'birthdate' => Carbon::parse('1989-08-05'),
                'gender' => 'Masculino',
                'adress' => 'Calle Menor, Pereira, Colombia',
            ],
            [
                'user_id' => 30,
                'birthdate' => Carbon::parse('1993-01-10'),
                'gender' => 'Femenino',
                'adress' => 'Calle 11, Bogotá, Colombia',
            ],
            [
                'user_id' => 31,
                'birthdate' => Carbon::parse('1985-06-30'),
                'gender' => 'Femenino',
                'adress' => 'Calle 5, Barranquilla, Colombia',
            ],
            [
                'user_id' => 32,
                'birthdate' => Carbon::parse('1987-11-25'),
                'gender' => 'Masculino',
                'adress' => 'Carrera 10, Medellín, Colombia',
            ],
            [
                'user_id' => 33,
                'birthdate' => Carbon::parse('1991-08-15'),
                'gender' => 'Masculino',
                'adress' => 'Avenida 9, Cali, Colombia',
            ],
            ['user_id' => 34,'birthdate' => Carbon::parse('1989-05-07'),'gender' => 'Masculino','adress' => 'Calle Nueva, Cartagena, Colombia',],
            ['user_id' => 35,'birthdate' => Carbon::parse('1992-09-12'),'gender' => 'Femenino','adress' => 'Calle 4, Bucaramanga, Colombia',],
            ['user_id' => 36,'birthdate' => Carbon::parse('1986-03-25'),'gender' => 'Masculino','adress' => 'Calle 2, Bogotá, Colombia',],
            ['user_id' => 37,'birthdate' => Carbon::parse('1990-04-19'),'gender' => 'Femenino','adress' => 'Calle 3, Medellín, Colombia',],
            ['user_id' => 38,'birthdate' => Carbon::parse('1988-10-10'),'gender' => 'Masculino','adress' => 'Carrera 15, Cúcuta, Colombia',],
            ['user_id' => 39,'birthdate' => Carbon::parse('1991-12-28'),'gender' => 'Masculino','adress' => 'Avenuser_ida 25, Pasto, Colombia',],
            ['user_id' => 40,'birthdate' => Carbon::parse('1987-01-18'),'gender' => 'Femenino','adress' => 'Calle 18, Armenia, Colombia',],
            ['user_id' => 41,'birthdate' => Carbon::parse('1985-07-13'),'gender' => 'Masculino','adress' => 'Carrera 7, Pereira, Colombia',],
            ['user_id' => 42,'birthdate' => Carbon::parse('1992-04-04'),'gender' => 'Masculino','adress' => 'Calle 22, Bogotá, Colombia',],
            ['user_id' => 43,'birthdate' => Carbon::parse('1987-09-08'),'gender' => 'Femenino','adress' => 'Avenuser_ida 13, Bucaramanga, Colombia',],
            ['user_id' => 44,'birthdate' => Carbon::parse('1988-12-05'),'gender' => 'Masculino','adress' => 'Calle 33, Barranquilla, Colombia',],
            ['user_id' => 45,'birthdate' => Carbon::parse('1990-03-20'),'gender' => 'Femenino','address' => 'Calle 10, Bogotá, Colombia'],
            ['user_id' => 46, 'birthdate' => Carbon::parse('1985-07-14'), 'gender' => 'Masculino', 'address' => 'Avenuser_ida 5, Medellín, Colombia'],
            ['user_id' => 47, 'birthdate' => Carbon::parse('1993-11-02'), 'gender' => 'Femenino', 'address' => 'Carrera 12, Cali, Colombia'],
            ['user_id' => 48, 'birthdate' => Carbon::parse('1987-09-18'), 'gender' => 'Masculino', 'address' => 'Calle 8, Barranquilla, Colombia'],
            ['user_id' => 49, 'birthdate' => Carbon::parse('1991-06-25'), 'gender' => 'Femenino', 'address' => 'Avenuser_ida 7, Cartagena, Colombia'],
            ['user_id' => 50, 'birthdate' => Carbon::parse('1984-12-30'), 'gender' => 'Masculino', 'address' => 'Calle 3, Bucaramanga, Colombia'],
            ['user_id' => 51, 'birthdate' => Carbon::parse('1995-02-10'), 'gender' => 'Femenino', 'address' => 'Carrera 15, Pereira, Colombia'],
            ['user_id' => 52, 'birthdate' => Carbon::parse('1988-05-22'), 'gender' => 'Masculino', 'address' => 'Calle 1, Santa Marta, Colombia'],
            ['user_id' => 53, 'birthdate' => Carbon::parse('1990-08-19'), 'gender' => 'Femenino', 'address' => 'Avenuser_ida 20, Manizales, Colombia'],
            ['user_id' => 54, 'birthdate' => Carbon::parse('1986-04-12'), 'gender' => 'Masculino', 'address' => 'Carrera 8, Villavicencio, Colombia'],
            ['user_id' => 55, 'birthdate' => Carbon::parse('1994-10-07'), 'gender' => 'Femenino', 'address' => 'Calle 25, Cúcuta, Colombia'],
            ['user_id' => 56, 'birthdate' => Carbon::parse('1989-07-30'), 'gender' => 'Masculino', 'address' => 'Avenuser_ida 14, Ibagué, Colombia'],
            ['user_id' => 57, 'birthdate' => Carbon::parse('1996-01-03'), 'gender' => 'Femenino', 'address' => 'Calle 9, Pasto, Colombia'],
            ['user_id' => 58, 'birthdate' => Carbon::parse('1985-11-15'), 'gender' => 'Masculino', 'address' => 'Carrera 6, Popayán, Colombia'],
            ['user_id' => 59, 'birthdate' => Carbon::parse('1992-09-05'), 'gender' => 'Femenino', 'address' => 'Calle 17, Neiva, Colombia'],
        ];


        DB::table('patients')->insert($patients);
    }
}
