<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class PerfisEPermissoesSeeder extends Seeder
{
    /**
     * Run the database seeds
     */
    public function run(): void
    {
         // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

         //Criar Papel deo administrador
        $admin = Role::create(['name' => 'Admin', 'guard_name' => 'admin', 'description' => 'Acesso completo ao sistema']);
        $orientador = Role::create(['name' => 'Orientador', 'guard_name' => 'admin', 'description' => 'Acesso completo ao sistema com excessões']);
        $usuario = Role::create(['name' => 'Academico', 'guard_name' => 'web', 'description' => 'Acesso parcial ao sistema']);

        $permissionsAdmin = collect([
            ['guard_name' => 'admin', 'name' => 'CRUD usuarios',  'description' => 'Permite fazer CRUD de todos usuários.'],
            ['guard_name' => 'admin', 'name' => 'configurar semestre',  'description' => 'Permite configurar um semestre.'],
        ]);


        //Orientador
        $permissionsOrientador = collect([
            ['guard_name' => 'admin', 'name' => 'TesteOri',  'description' => 'Permite a criação de atividades.'],
            ['guard_name' => 'admin', 'name' => 'criar atividades',  'description' => 'Permite a criação de atividades.'],
            ['guard_name' => 'admin', 'name' => 'visualizar atividades',  'description' => 'Permite a visualização de atividades.'],
            ['guard_name' => 'admin', 'name' => 'visualizar solicitacoes de orientacao',  'description' => 'Permite a visualização de solicitações de orientação.'],
            ['guard_name' => 'admin', 'name' => 'responder solicitacoes de orientacao',  'description' => 'Permite responder positiva ou negativamente as solicitações de orientação.'],
        ]);// aqui as do orientador (incluindo algumas que o admin tbm terá)

        $permissionsUser = collect([
            ['guard_name' => 'web', 'name' => 'TesteAcad',  'description' => 'Permite a criação de atividades.'],
            ['guard_name' => 'web', 'name' => 'pesquisar orientador',  'description' => 'Permite pesquisar e visualizar orientadores.'],
            ['guard_name' => 'web', 'name' => 'solicitar orientacao',  'description' => 'Permite criar uma solicitação de orientação.'],
        ]);

        $permissionsAdmin->each(function ($item) use ($admin) {
            $permission = Permission::create($item);
            $permission->syncRoles([$admin]);
        });

        $permissionsOrientador->each(function ($item) use ($orientador, $admin) { // sincroniza permissoes do orientador
            $permission = Permission::create($item);
            $permission->syncRoles([$orientador]);
            $permission->syncRoles([$admin]);
        });

        // $permissionsAdminwithdOrientador = $permissionsOrientador->slice(1, 2); // aqui seleciona cada permission que orientador = admin
        // $permissionsAdminwithdOrientador->each(function ($item) use ($admin) {
        //     $permission = Permission::create($item);
        //     $permission->syncRoles([$admin]);
        // });

        $permissionsUser->each(function ($item) use ($usuario) {
            $permission = Permission::create($item);
            $permission->syncRoles([$usuario]);
        });

    }
}
