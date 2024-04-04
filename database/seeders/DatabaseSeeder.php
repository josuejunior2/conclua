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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'nome' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $uuid = Str::uuid()->toString();
        $user1 = User::create([
            'id' => $uuid,
            'nome' => 'Thiago Ian Cesar',
            'email' => 'thiago@gmail.com',
            'password' => 'admin123',
        ]);
        $uuid = Str::uuid()->toString();
        $academico1 = Academico::create([
            'id' => $uuid,
            'nome' => 'Thiago Ian Cesar',
            'email' => 'thiago@gmail.com',
            'password' => 'admin123',
            'matricula' => '100087456',
            'status' => 0,
        ]);
        $uuid = Str::uuid()->toString();
        $user2 = User::create([
            'id' => $uuid,
            'nome' => 'Ian Thiago Hadrien',
            'email' => 'ian@gmail.com',
            'password' => 'admin123',
        ]);
        $uuid = Str::uuid()->toString();
        $academico2 = Academico::create([
            'id' => $uuid,
            'nome' => 'Ian Thiago Hadrien',
            'email' => 'ian@gmail.com',
            'password' => 'admin123',
            'matricula' => '100087654',
            'status' => 0,
        ]);
        $uuid = Str::uuid()->toString();
        $oriadmin1 = Admin::create([
            'id' => $uuid,
            'nome' => 'Rene Veloso',
            'email' => 'rene@gmail.com',
            'password' => 'admin123',
        ]);
        $uuid = Str::uuid()->toString();
        $orientador1 = Orientador::create([
            'id' => $uuid,
            'nome' => 'Rene Veloso',
            'email' => 'rene@gmail.com',
            'password' => 'admin123',
            'masp' => '1032654',
            'status' => 0,
        ]);

        $uuid = Str::uuid()->toString();
        $oriadmin2 = Admin::create([
            'id' => $uuid,
            'nome' => 'Eduardo Diniz',
            'email' => 'edu@gmail.com',
            'password' => 'admin123',
        ]);
        $uuid = Str::uuid()->toString();
        $orientador2 = Orientador::create([
            'id' => $uuid,
            'nome' => 'Eduardo Diniz',
            'email' => 'edu@gmail.com',
            'password' => 'admin123',
            'masp' => '1032655',
            'status' => 0,
        ]);

        $uuid = Str::uuid()->toString();
        $user = Admin::create( [
            'id' => $uuid,
            'nome' => 'admin',
            'email' => 'josuejuniorww@gmail.com',
            'password' => 'admin123',
        ]);
        $uuid = Str::uuid()->toString();
        $formacao = Formacao::create([
            'id' => $uuid,
            'nome' => 'Administração'
        ]);
        $uuid = Str::uuid()->toString();
        $area = Area::create([
            'id' => $uuid,
            'nome' => 'Marketing'
        ]);


        $this->call(
            PerfisEPermissoesSeeder::class,
        );

        $user->assignRole('Admin', 'admin');
        $user1->assignRole('Academico');
        $user2->assignRole('Academico');
        $oriadmin1->assignRole('Orientador');
        $oriadmin2->assignRole('Orientador');

    }
}
