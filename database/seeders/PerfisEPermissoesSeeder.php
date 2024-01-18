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

        $permissionsAdmin = collect([ // olhar casos de uso
            ['guard_name' => 'admin', 'name' => 'listar usuarios',  'description' => 'Permite visualizar a listagem de usuários'],
        ]);
        // $permissionsUsuario = collect([
        //     ['guard_name' => 'web', 'name' => 'listar usuarios',  'description' => 'Permite visualizar a listagem de usuários'],
        // ]);

        //Orientador
        $permissionsOrientador = collect([
            ['guard_name' => 'admin', 'name' => 'criar atividades',  'description' => 'Permite a criação de atividades.'],
            ['guard_name' => 'admin', 'name' => 'visualizar atividades',  'description' => 'Permite a visualização de atividades.'],
            ['guard_name' => 'admin', 'name' => 'visualizar solicitacoes de orientacao',  'description' => 'Permite a visualização de solicitações de orientação.'],
            ['guard_name' => 'admin', 'name' => 'responder solicitacoes de orientacao',  'description' => 'Permite responder positiva ou negativamente as solicitações de orientação.'],
        ]);// aqui as do adm + orientador


        $permissionsOrientador->each(function ($item) use ($orientador, $admin) { // sincroniza permissoes do orientador
            $permission = Permission::create($item);
            $permission->syncRoles([$orientador]);
        });

        $permissionsAdminandOrientador = $permissionsOrientador->slice(1, 2); // aqui seleciona cada permission que orientador = admin
        $permissionsAdminandOrientador->each(function ($item) use ($admin) {
            $permission = Permission::create($item);
            $permission->syncRoles([$admin]);
        });

        $permissions->each(function ($item) use ($admin) {
            $permission = Permission::create($item);
            $permission->syncRoles([$admin]);
        });
    }
}
