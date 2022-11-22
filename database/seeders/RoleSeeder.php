<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'solicitud.index']);
        Permission::create(['name' => 'solicitud.create']);
        Permission::create(['name' => 'solicitud.edit']);
        Permission::create(['name' => 'solicitud.show']);
        Permission::create(['name' => 'solicitud.destroy']);

        Permission::create(['name' => 'actividad.index']);
        Permission::create(['name' => 'actividad.create']);
        Permission::create(['name' => 'actividad.edit']);
        Permission::create(['name' => 'actividad.destroy']);
        
        Permission::create(['name' => 'alumno.index']);
        Permission::create(['name' => 'alumno.create']);
        Permission::create(['name' => 'alumno.edit']);
        Permission::create(['name' => 'alumno.destroy']);

        Permission::create(['name' => 'personal.index']);
        Permission::create(['name' => 'personal.create']);
        Permission::create(['name' => 'personal.edit']);
        Permission::create(['name' => 'personal.destroy']);

        Permission::create(['name' => 'departamento.index']);
        Permission::create(['name' => 'departamento.create']);
        Permission::create(['name' => 'departamento.edit']);
        Permission::create(['name' => 'departamento.destroy']);

        Permission::create(['name' => 'periodo.index']);
        Permission::create(['name' => 'periodo.create']);
        Permission::create(['name' => 'periodo.edit']);
        Permission::create(['name' => 'periodo.destroy']);


        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'alumno']);
        $role1->givePermissionTo('solicitud.show');
        $role1->givePermissionTo('solicitud.create');
        $role1->givePermissionTo('actividad.index');
 
        $role2 = Role::create(['name' => 'escolares']);
        $role2->givePermissionTo('solicitud.index');
        $role2->givePermissionTo('solicitud.create');
        $role2->givePermissionTo('solicitud.edit');
        $role2->givePermissionTo('solicitud.destroy');
        $role2->givePermissionTo('personal.index');
        $role2->givePermissionTo('personal.create');
        $role2->givePermissionTo('personal.edit');
        $role2->givePermissionTo('departamento.index');
        $role2->givePermissionTo('departamento.create');
        $role2->givePermissionTo('departamento.edit');
        $role2->givePermissionTo('periodo.index');
        $role2->givePermissionTo('periodo.create');
        $role2->givePermissionTo('periodo.edit');
        $role2->givePermissionTo('actividad.index');
        $role2->givePermissionTo('actividad.create');
        $role2->givePermissionTo('actividad.edit');
        $role2->givePermissionTo('alumno.index');
        $role2->givePermissionTo('alumno.create');
        $role2->givePermissionTo('alumno.edit');
        

        $role3 = Role::create(['name' => 'departamento']);
        $role3->givePermissionTo('solicitud.index');
        $role3->givePermissionTo('solicitud.create');
        $role3->givePermissionTo('solicitud.edit');
        $role3->givePermissionTo('solicitud.destroy');
        $role3->givePermissionTo('periodo.index');
        $role3->givePermissionTo('personal.index');
        $role3->givePermissionTo('actividad.index');
        $role3->givePermissionTo('actividad.create');
        $role3->givePermissionTo('actividad.edit');

        
        

        $role4 = Role::create(['name' => 'admin']);
        $role4->givePermissionTo('solicitud.index');
        $role4->givePermissionTo('solicitud.create');
        $role4->givePermissionTo('solicitud.edit');
        $role4->givePermissionTo('solicitud.destroy');
        $role4->givePermissionTo('alumno.index');
        $role4->givePermissionTo('alumno.create');
        $role4->givePermissionTo('alumno.edit');
        $role4->givePermissionTo('alumno.destroy');
        $role4->givePermissionTo('departamento.index');
        $role4->givePermissionTo('departamento.create');
        $role4->givePermissionTo('departamento.edit');
        $role4->givePermissionTo('departamento.destroy');
    }
}
