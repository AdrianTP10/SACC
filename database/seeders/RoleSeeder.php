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

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'alumno']);
        $role1->givePermissionTo('solicitud.index');
        $role1->givePermissionTo('solicitud.create');
        $role1->givePermissionTo('actividad.index');
 
        $role2 = Role::create(['name' => 'escolares']);
        $role2->givePermissionTo('solicitud.index');
        $role2->givePermissionTo('solicitud.create');
        $role2->givePermissionTo('solicitud.edit');
        $role2->givePermissionTo('solicitud.destroy');
    }
}
