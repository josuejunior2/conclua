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
        // $user1 = User::create([
        //     'nome' => 'Thiago Ian Cesar',
        //     'email' => 'thiago@gmail.com',
        //     'password' => 'admin123',
        // ]);
        // $academico1 = Academico::create([
        //     'user_id' => $user1->id,
        //     'matricula' => '100087456',
        // ]);
        
        // $user2 = User::create([
        //     'nome' => 'Ian Thiago Hadrien',
        //     'email' => 'ian@gmail.com',
        //     'password' => 'admin123',
        // ]);
        
        // $academico2 = Academico::create([
        //     'user_id' => $user2->id,
        //     'matricula' => '100087654',
        // ]);
        
        // $oriadmin1 = Admin::create([
        //     'nome' => 'Rene Veloso',
        //     'email' => 'rene@gmail.com',
        //     'password' => 'admin123',
        // ]);
        
        // $orientador1 = Orientador::create([
        //     'admin_id' => $oriadmin1->id,
        //     'masp' => '1032654',
        // ]);

        
        // $oriadmin2 = Admin::create([
        //     'nome' => 'Eduardo Diniz',
        //     'email' => 'edu@gmail.com',
        //     'password' => 'admin123',
        // ]);
        
        // $orientador2 = Orientador::create([
        //     'admin_id' => $oriadmin2->id,
        //     'masp' => '1032655',
        // ]);

        
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
        // $admin3 = Admin::create( [
        //     'nome' => 'samuel admin',
        //     'email' => 'samuelAdm@email.com',
        //     'password' => 'admin123',
        // ]);
        $admin4 = Admin::create( [
            'nome' => 'Leo admin',
            'email' => 'leoAdm@email.com',
            'password' => 'admin123',
        ]);
        
        $this->call(
            PerfisEPermissoesSeeder::class,
        );
        // $admin2->assignRole('Admin', 'admin');
        // $admin3->assignRole('Admin', 'admin');
        $admin4->assignRole('Admin', 'admin');

        // $admin->assignRole('Admin', 'admin');
        // $user1->assignRole('Academico');
        // $user2->assignRole('Academico');
        // $oriadmin1->assignRole('Orientador');
        // $oriadmin2->assignRole('Orientador');


    }
}
