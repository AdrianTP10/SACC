<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nombre' => 'Departamento de Ciencias Básicas',
                'jefe_id' => 1
            ],

            [
                'nombre' => 'Departamento de Actividades Extraescolares',
                'jefe_id' => 2
            ],

            [
                'nombre' => 'Departamento Económico Administrativo',
                'jefe_id' => 3
            ],
            [
                'nombre' => 'Departamento de Comunicación y Difusión',
                'jefe_id' => 4
            ],
            [
                'nombre' => 'Centro de Información',
                'jefe_id' => 5
            ],
            [
                'nombre' => 'División de Estudios Profesionales',
                'jefe_id' => 6
            ],
            [
                'nombre' => 'Oficina de Investigación',
                'jefe_id' => 7
            ],
            [
                'nombre' => 'Departamento de Gestión Tecnológica y Vinculación',
                'jefe_id' => 8
            ],
            [
                'nombre' => 'Departamento de Ingenierías',
                'jefe_id' => 9
            ],
            [
                'nombre' => 'Desarrollo Académico',
                'jefe_id' => 10
            ],
        ];
        DB::table('departamentos')->insert($data);
    }
}
