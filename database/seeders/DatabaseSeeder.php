<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Area;
use App\Models\User;
use App\Models\Formacao;
use App\Models\Academico;
use App\Models\Orientador;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $admin = Admin::create( [
        //     'nome' => 'admin',
        //     'email' => 'josuejuniorww@gmail.com',
        //     'password' => 'admin123',
        // ]);
        
        // $formacao = Formacao::create([
        //     'nome' => 'Administração'
        // ]);
        
        // $area = Area::create([
        //     'nome' => 'Marketing'
        // ]);

        
        // $admin2 = Admin::create( [
        //     'nome' => 'june admin',
        //     'email' => 'juneAdm@email.com',
        //     'password' => 'admin123',
        // ]);
        
        $this->call(
            PerfisEPermissoesSeeder::class,
        );
        // $admin2->assignRole('Admin', 'admin');

        // $admin->assignRole('Admin', 'admin');
    }
}
