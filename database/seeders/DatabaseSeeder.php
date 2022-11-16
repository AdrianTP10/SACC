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
            PersonalSeeder::class,
            EstatusSeeder::class,
            EstatusSolicitudSeeder::class,
            ActividadesSeeder::class,
            CarrerasSeeder::class,
            AlumnoSeeder::class,
            DepartamentosSeeder::class,
        ]);

        $alumno = \App\Models\User::create([
            'name' => 'Irving',
            'email' => 'adriantp098@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $alumno->assignRole('alumno');
    }
}
