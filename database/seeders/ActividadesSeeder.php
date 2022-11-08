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
                'descripcion' => 'Actividad Deportiva en Selección Prenacional',
                'valor_curricular' => 1,
                'estatus_id' => 1
            ],

            [
                'descripcion' => 'Actividad Deportiva en Selección Nacional',
                'valor_curricular' => 2,
                'estatus_id' => 1
            ],

            [
                'descripcion' => 'Actividad Deportiva Local',
                'valor_curricular' => 0.5,
                'estatus_id' => 1
            ],
            [
                'descripcion' => 'Actividad Cultural Local',
                'valor_curricular' => 0.5,
                'estatus_id' => 1
            ],
            [
                'descripcion' => 'Actividad Cultural Etapa Regional',
                'valor_curricular' => 1,
                'estatus_id' => 1
            ],
            [
                'descripcion' => 'Actividad Cultural Etapa Nacional',
                'valor_curricular' => 2,
                'estatus_id' => 1
            ],
            [
                'descripcion' => 'Programa Institucional de Tutorías',
                'valor_curricular' => 1,
                'estatus_id' => 1
            ],
            [
                'descripcion' => 'Participar en el Evento Nacional de
                Ciencias Básicas "Etapa Local"',
                'valor_curricular' => 1,
                'estatus_id' => 1
            ],
            [
                'descripcion' => 'Participar en el Evento Nacional de
                Ciencias Básicas "Etapa Regional"',
                'valor_curricular' => 1,
                'estatus_id' => 1
            ],
            [
                'descripcion' => 'Participar en el Evento Nacional de
                Ciencias Básicas "Etapa Nacional"',
                'valor_curricular' => 1,
                'estatus_id' => 1
            ],
            [
                'descripcion' => 'Participar en el Evento Nacional de
                Innovación Tecnológica "Etapa Local"',
                'valor_curricular' => 1,
                'estatus_id' => 1
            ],
            [
                'descripcion' => 'Participar en el Evento Nacional de
                Innovación Tecnológica "Etapa Regional"',
                'valor_curricular' => 1,
                'estatus_id' => 1
            ],
            [
                'descripcion' => 'Participar en el Evento Nacional de
                Innovación Tecnológica "Etapa Nacional"',
                'valor_curricular' => 2,
                'estatus_id' => 1
            ],
            [
                'descripcion' => 'Participar en el curso Modelo Talento
                Emprendedor',
                'valor_curricular' => 2,
                'estatus_id' => 1
            ],
            [
                'descripcion' => 'Programa de Asesorías Académicas "Grupo de Monitores"',
                'valor_curricular' => 1,
                'estatus_id' => 1
            ],
            [
                'descripcion' => 'Veranos Científicos',
                'valor_curricular' => 2,
                'estatus_id' => 1
            ],
            [
                'descripcion' => 'Estancias de Investigación',
                'valor_curricular' => 2,
                'estatus_id' => 1
            ],
            [
                'descripcion' => 'Expositor en conferencias',
                'valor_curricular' => 1,
                'estatus_id' => 1
            ],
            [
                'descripcion' => 'Ponencias o exposición de carteles y
                trabajos en congresos, foros o simposiums',
                'valor_curricular' => 1,
                'estatus_id' => 1
            ],
            [
                'descripcion' => 'Investigación asociada a un proyecto institucional',
                'valor_curricular' => 2,
                'estatus_id' => 1
            ],
            [
                'descripcion' => 'Construcción de prototipos y desarrollo tecnológico',
                'valor_curricular' => 2,
                'estatus_id' => 1
            ],
            [
                'descripcion' => 'Participación en editoriales',
                'valor_curricular' => 1,
                'estatus_id' => 1
            ],
            [
                'descripcion' => 'Participación en actividades de acreditación, certificación',
                'valor_curricular' => 1,
                'estatus_id' => 1
            ],
            [
                'descripcion' => 'Programas para la conservación del Medio Ambiente',
                'valor_curricular' => 1,
                'estatus_id' => 1
            ],
            [
                'descripcion' => 'Participación en actividades de
                restauración bibliográfica del centro de información',
                'valor_curricular' => 1,
                'estatus_id' => 1
            ],
            [
                'descripcion' => 'Colaboración en eventos Institucionales',
                'valor_curricular' => 1,
                'estatus_id' => 1
            ],
        ];
        DB::table('actividades')->insert($data);
      
    }
}
