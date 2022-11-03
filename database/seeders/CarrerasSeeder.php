<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarrerasSeeder extends Seeder
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
                'nombre' => 'Ingenieria en Sistemas Computacionales',
            ],

            [
                'nombre' => 'Ingenieria Industrial'
            ],

            [
                'nombre' => 'Ingenieria en Gestión Empresarial'
            ],
            [
                'nombre' => 'Ingenieria en Industrias Alimentarias'
            ],
            [
                'nombre' => 'Ingenieria Ambiental'
            ],
            [
                'nombre' => 'Ingenieria en Agronomía'
            ]
        ];
        DB::table('carreras')->insert($data);
    }
}
