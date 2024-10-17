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
        $admin = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'admin', 'description' => 'Acesso completo ao sistema']);
        $orientador = Role::firstOrCreate(['name' => 'Orientador', 'guard_name' => 'admin', 'description' => 'Acesso completo ao sistema com excessões']);
        $usuario = Role::firstOrCreate(['name' => 'Academico', 'guard_name' => 'web', 'description' => 'Acesso parcial ao sistema']);

        $permissionsAdmin = collect([
            ['guard_name' => 'admin', 'name' => 'CRUD usuarios',  'description' => 'Permite fazer CRUD de todos usuários.'],
            ['guard_name' => 'admin', 'name' => 'configurar semestre',  'description' => 'Permite configurar um semestre.'],
            ['guard_name' => 'admin', 'name' => 'configurar perfil',  'description' => 'Permite configurar perfis e permissoes dos usuários.'],
            ['guard_name' => 'admin', 'name' => 'desvincular academico',  'description' => 'Permite desvincular um academico de seu orientador.'],
            
            ['guard_name' => 'admin', 'name' => 'visualizar academico',  'description' => 'Permite visualizar academico.'],
            ['guard_name' => 'admin', 'name' => 'criar academico',  'description' => 'Permite criar academico.'],
            ['guard_name' => 'admin', 'name' => 'editar academico',  'description' => 'Permite editar academico.'],
            ['guard_name' => 'admin', 'name' => 'excluir academico',  'description' => 'Permite excluir academico.'],
            ['guard_name' => 'admin', 'name' => 'avaliar academico',  'description' => 'Permite avaliar academico.'],
            
            ['guard_name' => 'admin', 'name' => 'visualizar orientador',  'description' => 'Permite visualizar orientador.'],
            ['guard_name' => 'admin', 'name' => 'criar orientador',  'description' => 'Permite criar orientador.'],
            ['guard_name' => 'admin', 'name' => 'editar orientador',  'description' => 'Permite editar orientador.'],
            ['guard_name' => 'admin', 'name' => 'excluir orientador',  'description' => 'Permite excluir orientador.'],
            ['guard_name' => 'admin', 'name' => 'avaliar orientador',  'description' => 'Permite avaliar orientador.'],
            
            ['guard_name' => 'admin', 'name' => 'visualizar semestre',  'description' => 'Permite visualizar semestre.'],
            ['guard_name' => 'admin', 'name' => 'criar semestre',  'description' => 'Permite criar semestre.'],
            ['guard_name' => 'admin', 'name' => 'editar semestre',  'description' => 'Permite editar semestre.'],
            ['guard_name' => 'admin', 'name' => 'excluir semestre',  'description' => 'Permite excluir semestre.'],
            
            ['guard_name' => 'admin', 'name' => 'visualizar atividades',  'description' => 'Permite a visualização de atividades.'],
            
            ['guard_name' => 'admin', 'name' => 'visualizar empresa',  'description' => 'Permite visualizar empresa.'],
            ['guard_name' => 'admin', 'name' => 'criar empresa',  'description' => 'Permite criar empresa.'],
            ['guard_name' => 'admin', 'name' => 'editar empresa',  'description' => 'Permite editar empresa.'],
            ['guard_name' => 'admin', 'name' => 'excluir empresa',  'description' => 'Permite excluir empresa.'],
            
            ['guard_name' => 'admin', 'name' => 'criar admin',  'description' => 'Permite criar admin.'],
            ['guard_name' => 'admin', 'name' => 'editar admin',  'description' => 'Permite editar admin.'],
            ['guard_name' => 'admin', 'name' => 'excluir admin',  'description' => 'Permite excluir admin.'],
            ['guard_name' => 'admin', 'name' => 'avaliar admin',  'description' => 'Permite avaliar admin.'],
            ['guard_name' => 'admin', 'name' => 'assinala perfil admin',  'description' => 'Permite assinalar perfil a admin.'],
        ]);


        //Orientador
        $permissionsOrientador = collect([
            ['guard_name' => 'admin', 'name' => 'criar atividades',  'description' => 'Permite a criação de atividades.'],
            ['guard_name' => 'admin', 'name' => 'visualizar atividades',  'description' => 'Permite a visualização de atividades.'],
            ['guard_name' => 'admin', 'name' => 'visualizar solicitacoes de orientacao',  'description' => 'Permite a visualização de solicitações de orientação.'],
            ['guard_name' => 'admin', 'name' => 'responder solicitacoes de orientacao',  'description' => 'Permite responder positiva ou negativamente as solicitações de orientação.'],
            ['guard_name' => 'admin', 'name' => 'criar atividade',  'description' => 'Permite criar atividade.'],
            ['guard_name' => 'admin', 'name' => 'editar atividade',  'description' => 'Permite editar atividade.'],
            ['guard_name' => 'admin', 'name' => 'excluir atividade',  'description' => 'Permite excluir atividade.'],
            ['guard_name' => 'admin', 'name' => 'avaliar atividade',  'description' => 'Permite avaliar atividade.'],

            ['guard_name' => 'admin', 'name' => 'criar comentario',  'description' => 'Permite comentar na atividade.'],
            ['guard_name' => 'admin', 'name' => 'excluir comentario',  'description' => 'Permite excluir comentário da atividade.'],
            ['guard_name' => 'admin', 'name' => 'editar comentario',  'description' => 'Permite editar comentário da atividade.'],
        ]);// aqui as do orientador (incluindo algumas que o admin tbm terá)

        $permissionsUser = collect([
            ['guard_name' => 'web', 'name' => 'pesquisar orientador',  'description' => 'Permite pesquisar e visualizar orientadores.'],
            ['guard_name' => 'web', 'name' => 'solicitar orientacao',  'description' => 'Permite criar uma solicitação de orientação.'],
            ['guard_name' => 'web', 'name' => 'adicionar arquivo submissao',  'description' => 'Permite adicionar arquivo submissão já realizada.'],
            ['guard_name' => 'web', 'name' => 'excluir arquivo submissao',  'description' => 'Permite excluir arquivo da submissão.'],
            ['guard_name' => 'web', 'name' => 'excluir submissao',  'description' => 'Permite excluir submissao.'],
            
            ['guard_name' => 'web', 'name' => 'criar comentario',  'description' => 'Permite comentar na atividade.'],
            ['guard_name' => 'web', 'name' => 'excluir comentario',  'description' => 'Permite excluir comentário da atividade.'],
            ['guard_name' => 'web', 'name' => 'editar comentario',  'description' => 'Permite editar comentário da atividade.'],
        ]);

        $permissionsAdmin->each(function ($item) use ($admin) {
            $permission = Permission::firstOrCreate($item);
            $admin->givePermissionTo($permission);
            $permission->assignRole($admin);
        });

        $permissionsOrientador->each(function ($item) use ($orientador) { // sincroniza permissoes do orientador
            $permission = Permission::firstOrCreate($item);
            $orientador->givePermissionTo($permission);
            $permission->assignRole($orientador);
        });

        // $permissionsAdminwithdOrientador = $permissionsOrientador->slice(1, 2); // aqui seleciona cada permission que orientador = admin
        // $permissionsAdminwithdOrientador->each(function ($item) use ($admin) {
        //     $permission = Permission::create($item);
        //     $permission->syncRoles([$admin]);
        // });

        $permissionsUser->each(function ($item) use ($usuario) {
            $permission = Permission::firstOrCreate($item);
            $usuario->givePermissionTo($permission);
            $permission->assignRole($usuario);
        });

    }
}
