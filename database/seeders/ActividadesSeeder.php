<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActividadesSeeder extends Seeder
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
                'descripcion' => 'Actividad Cultural Etapa Local',
                'valor_curricular' => 0.5,
                'estatus_id' => 1
            ],

            [
                'descripcion' => 'Actividad Cultural Etapa Regional',
                'valor_curricular' => 1,
                'estatus_id' => 1
            ],

            [
                'descripcion' => 'Actividad Deportiva Etapa Nacional',
                'valor_curricular' => 2,
                'estatus_id' => 1
            ],
        ];
        DB::table('actividades')->insert($data);
      
    }
}
