<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class EstatusSolicitudSeeder extends Seeder
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
                'descripcion' => 'Registrado'
            ],

            [
                'descripcion' => 'Aceptado'
            ],

            [
                'descripcion' => 'Acreditado'
            ],
            [
                'descripcion' => 'No valido'
            ]
        ];
        DB::table('estatus_solicitud')->insert($data);
    }
}
