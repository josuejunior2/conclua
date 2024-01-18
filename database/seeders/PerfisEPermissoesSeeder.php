<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;  

class PerfisEPermissoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Reset cached roles and permissions
         app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

         //Criar Papel deo administrador
         $admin = Role::create(['name' => 'Administrador', 'guard_name' => 'admin', 'description' => 'Acesso completo ao sistema']);
         $orientador = Role::create(['name' => 'Orientador', 'guard_name' => 'admin', 'description' => 'Acesso completo ao sistema']);
         $usuario = Role::create(['name' => 'Usuario', 'guard_name' => 'web', 'description' => 'Acesso completo ao sistema']);
         
        $permissions = collect([
            ['guard_name' => 'admin', 'name' => 'listar usuarios',  'description' => 'Permite visualizar a listagem de usuários'],
        ]);
        // $permissionsUsuario = collect([
        //     ['guard_name' => 'web', 'name' => 'listar usuarios',  'description' => 'Permite visualizar a listagem de usuários'],
        // ]);

        //Orientador
        $permissionsOrientador = collect([
            ['guard_name' => 'admin', 'name' => 'listar usuarios',  'description' => 'Permite visualizar a listagem de usuários'],
        ]);// aqui as do adm + orientador


        $permissions->each(function ($item) use ($orientador, $admin) {
            $permission = Permission::create($item);
            $permission->syncRoles([$orientador]);
            $permission->syncRoles([$admin]);
        });
        $permissions->each(function ($item) use ($admin) {
            $permission = Permission::create($item);
            $permission->syncRoles([$admin]);
        });
    }
}
