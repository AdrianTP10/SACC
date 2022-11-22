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
                'valor' => 1,
                'estatus_id' => 1,
                'departamento_id' => 1,
            ],

            [
                'descripcion' => 'Actividad Deportiva en Selección Nacional',
                'valor' => 2,
                'estatus_id' => 1,
                'departamento_id' => 1,
            ],

            [
                'descripcion' => 'Actividad Deportiva Local',
                'valor' => 0.5,
                'estatus_id' => 1,
                'departamento_id' => 1,
            ],
            [
                'descripcion' => 'Actividad Cultural Local',
                'valor' => 0.5,
                'estatus_id' => 1,
                'departamento_id' => 1,
            ],
            [
                'descripcion' => 'Actividad Cultural Etapa Regional',
                'valor' => 1,
                'estatus_id' => 1,
                'departamento_id' => 1,
            ],
            [
                'descripcion' => 'Actividad Cultural Etapa Nacional',
                'valor' => 2,
                'estatus_id' => 1,
                'departamento_id' => 1,
            ],
            [
                'descripcion' => 'Programa Institucional de Tutorías',
                'valor' => 1,
                'estatus_id' => 1,
                'departamento_id' => 1,
            ],
            [
                'descripcion' => 'Participar en el Evento Nacional de
                Ciencias Básicas "Etapa Local"',
                'valor' => 1,
                'estatus_id' => 1,
                'departamento_id' => 11,
            ],
            [
                'descripcion' => 'Participar en el Evento Nacional de
                Ciencias Básicas "Etapa Regional"',
                'valor' => 1,
                'estatus_id' => 1,
                'departamento_id' => 11,
            ],
            [
                'descripcion' => 'Participar en el Evento Nacional de
                Ciencias Básicas "Etapa Nacional"',
                'valor' => 1,
                'estatus_id' => 1,
                'departamento_id' => 11,
            ],
            [
                'descripcion' => 'Participar en el Evento Nacional de
                Innovación Tecnológica "Etapa Local"',
                'valor' => 1,
                'estatus_id' => 1,
                'departamento_id' => 2,
            ],
            [
                'descripcion' => 'Participar en el Evento Nacional de
                Innovación Tecnológica "Etapa Regional"',
                'valor' => 1,
                'estatus_id' => 1,
                'departamento_id' => 2,
            ],
            [
                'descripcion' => 'Participar en el Evento Nacional de
                Innovación Tecnológica "Etapa Nacional"',
                'valor' => 2,
                'estatus_id' => 1,
                'departamento_id' => 2,
            ],
            [
                'descripcion' => 'Participar en el curso Modelo Talento
                Emprendedor',
                'valor' => 2,
                'estatus_id' => 1,
                'departamento_id' => 2,
            ],
            [
                'descripcion' => 'Programa de Asesorías Académicas "Grupo de Monitores"',
                'valor' => 1,
                'estatus_id' => 1,
                'departamento_id' => 4,
            ],
            [
                'descripcion' => 'Veranos Científicos',
                'valor' => 2,
                'estatus_id' => 1,
                'departamento_id' => 9,
            ],
            [
                'descripcion' => 'Estancias de Investigación',
                'valor' => 2,
                'estatus_id' => 1,
                'departamento_id' => 13,
            ],
            [
                'descripcion' => 'Expositor en conferencias',
                'valor' => 1,
                'estatus_id' => 1,
                'departamento_id' => 9,
            ],
            [
                'descripcion' => 'Ponencias o exposición de carteles y
                trabajos en congresos, foros o simposiums',
                'valor' => 1,
                'estatus_id' => 1,
                'departamento_id' => 9,
            ],
            [
                'descripcion' => 'Investigación asociada a un proyecto institucional',
                'valor' => 2,
                'estatus_id' => 1,
                'departamento_id' => 11,
            ],
            [
                'descripcion' => 'Construcción de prototipos y desarrollo tecnológico',
                'valor' => 2,
                'estatus_id' => 1,
                'departamento_id' => 9,
            ],
            [
                'descripcion' => 'Participación en editoriales',
                'valor' => 1,
                'estatus_id' => 1,
                'departamento_id' => 3,
            ],
            [
                'descripcion' => 'Participación en actividades de acreditación, certificación',
                'valor' => 1,
                'estatus_id' => 1,
                'departamento_id' => 5,
            ],
            [
                'descripcion' => 'Programas para la conservación del Medio Ambiente',
                'valor' => 1,
                'estatus_id' => 1,
                'departamento_id' => 6,
            ],
            [
                'descripcion' => 'Participación en actividades de
                restauración bibliográfica del centro de información',
                'valor' => 1,
                'estatus_id' => 1,
                'departamento_id' => 12,
            ],
            [
                'descripcion' => 'Colaboración en eventos Institucionales',
                'valor' => 1,
                'estatus_id' => 1,
                'departamento_id' => 10,
            ],
        ];
        DB::table('actividades')->insert($data);
      
    }
}
