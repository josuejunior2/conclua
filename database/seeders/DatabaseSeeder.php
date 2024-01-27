<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $user = Admin::create( [
            'name' => 'admin',
            'email' => 'josuejuniorww@gmail.com',
            'password' => 'admin123',
        ]);


        $this->call(
            PerfisEPermissoesSeeder::class,
        );

        $user->assignRole('Admin', 'admin');

    }
}
