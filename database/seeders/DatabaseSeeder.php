<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

       
        $this->call([
            RoleSeeder::class,
            EstatusSeeder::class,
            EstatusSolicitudSeeder::class,
            CarrerasSeeder::class,
            AlumnoSeeder::class,
            DepartamentosSeeder::class,
            PersonalSeeder::class,
            ActividadesSeeder::class,
        ]);

        $alumno = \App\Models\User::create([
            'name' => 'Irving',
            'email' => '19690236@tecvalles.mx',
            'password' => bcrypt('password'),
        ]);
        $alumno->assignRole('alumno');

        $escolares = \App\Models\User::create([
            'name' => 'Escolares',
            'email' => 'escolares@tecvalles.mx',
            'password' => bcrypt('password'),
        ]);
        $escolares->assignRole('escolares');

        $departamento = \App\Models\User::create([
            'name' => 'extraescolares',
            'email' => 'extraescolares@tecvalles.mx',
            'password' => bcrypt('password'),
        ]);
        $departamento->assignRole('departamento');

        $admin = \App\Models\User::create([
            'name' => 'Administrador',
            'email' => 'adriantp098@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');

        \App\Models\Periodo::create([
            'descripcion' => 'Agosto-Diciembre 2022',
            'estatus_id' => 1,
        ]);
    }
}
