<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Area;
use App\Models\Formacao;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'nome' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $user = Admin::create( [
            'nome' => 'admin',
            'email' => 'josuejuniorww@gmail.com',
            'password' => 'admin123',
        ]);
        $formacao = Formacao::create([
            'nome' => 'Administração'
        ]);
        $area = Area::create([
            'nome' => 'Marketing'
        ]);


        $this->call(
            PerfisEPermissoesSeeder::class,
        );

        $user->assignRole('Admin', 'admin');

    }
}
