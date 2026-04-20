<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'administrador']);

        Permission::create(['name' => 'registrar-usuario']);
        Permission::create(['name' => 'consultar-listado-usuarios']);
        Permission::create(['name' => 'cambiar-estatus-usuario']);

        Permission::create(['name' => 'registrar-rol']);
        Permission::create(['name' => 'consultar-listado-roles']);

        $role = Role::findByName('administrador');

        $role->givePermissionTo('registrar-usuario');
        $role->givePermissionTo('consultar-listado-usuarios');
        $role->givePermissionTo('cambiar-estatus-usuario');

        $role->givePermissionTo('registrar-rol');
        $role->givePermissionTo('consultar-listado-roles');

        $adminUser = Usuario::firstOrCreate(
            ['email' => 'admin@mail.com'], 
            
            [ 
                'nombre' => 'Admin',
                'primer_apellido' => 'Admin',
                'segundo_apellido' => 'Admin',
                'curp' => 'AAAA000000AAAAAA00',
                'password' => bcrypt('password'),
            ]
        );

        $adminUser->assignRole('administrador');

        Role::firstOrCreate(['name' => 'organizador']);
        Role::firstOrCreate(['name' => 'asistente']);

        $organizadorUser = Usuario::firstOrCreate(
            ['email' => 'organizador@mail.com'], 

            [ 
                'nombre' => 'Organizador',
                'primer_apellido' => 'Organizador',
                'segundo_apellido' => 'Organizador',
                'curp' => 'ORGA000000AAAAAA00',
                'password' => bcrypt('password'),
            ]
        );
        $organizadorUser->assignRole('organizador');

        $asistenteUser = Usuario::firstOrCreate(
            ['email' => 'asistente@mail.com'],
            [
                'nombre' => 'Asistente',
                'primer_apellido' => 'Asistente',
                'segundo_apellido' => 'Asistente',
                'curp' => 'ASIS000000AAAAAA00',
                'password' => bcrypt('password'),
            ]
        );
        $asistenteUser->assignRole('asistente');




    }
}
