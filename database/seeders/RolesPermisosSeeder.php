<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermisosSeeder extends Seeder
{
    public function run(): void
    {

        $rolAdmin = Role::firstOrCreate(['name' => 'administrador']);
        $rolOrganizador = Role::firstOrCreate(['name' => 'organizador']);
        $rolAsistente = Role::firstOrCreate(['name' => 'asistente']);


        Permission::firstOrCreate(['name' => 'registrar-usuario']);
        Permission::firstOrCreate(['name' => 'consultar-listado-usuarios']);
        Permission::firstOrCreate(['name' => 'cambiar-estatus-usuario']);
        Permission::firstOrCreate(['name' => 'registrar-rol']);
        Permission::firstOrCreate(['name' => 'consultar-listado-roles']);


        Permission::firstOrCreate(['name' => 'ver-eventos']); 
        Permission::firstOrCreate(['name' => 'crear-eventos']);
        Permission::firstOrCreate(['name' => 'editar-eventos']);
        Permission::firstOrCreate(['name' => 'borrar-eventos']);
        Permission::firstOrCreate(['name' => 'pasar-asistencia']);

        $permisosAsistente = [
            'inscribirse-eventos',
            'cancelar-inscripcion',
            'ver-mis-inscripciones'
        ];

        foreach ($permisosAsistente as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }


        $permisosParaAdmin = Permission::whereNotIn('name', $permisosAsistente)->get();
        $rolAdmin->syncPermissions($permisosParaAdmin);

        
        $rolOrganizador->syncPermissions([
            'ver-eventos',
            'crear-eventos',
            'editar-eventos',
            'borrar-eventos',
            'pasar-asistencia'
        ]);

        
        $rolAsistente->syncPermissions($permisosAsistente);

        
        
        // Admin
        Usuario::updateOrCreate(
            ['email' => 'admin@mail.com'], 
            [ 
                'nombre' => 'Admin',
                'primer_apellido' => 'General',
                'segundo_apellido' => 'Sistema',
                'curp' => 'AAAA000000AAAAAA00',
                'password' => bcrypt('password'),
            ]
        )->assignRole('administrador');

        // Organizador
        Usuario::updateOrCreate(
            ['email' => 'organizador@mail.com'], 
            [ 
                'nombre' => 'Paco',
                'primer_apellido' => 'Organizador',
                'segundo_apellido' => 'DGTIC',
                'curp' => 'ORGA000000AAAAAA00',
                'password' => bcrypt('password'),
            ]
        )->assignRole('organizador');

        // Asistente
        Usuario::updateOrCreate(
            ['email' => 'asistente@mail.com'],
            [
                'nombre' => 'Luis',
                'primer_apellido' => 'Asistente',
                'segundo_apellido' => 'Pruebas',
                'curp' => 'ASIS000000AAAAAA00',
                'password' => bcrypt('password'),
            ]
        )->assignRole('asistente');
    }
}