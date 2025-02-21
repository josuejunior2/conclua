<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::firstOrCreate(
            ['email' => 'josuejuniorww@gmail.com'],
            [
            'nome' => 'admin',
            'password' => Hash::make('admin123'),
        ]);
        
        $this->call(
            PerfisEPermissoesSeeder::class,
        );
        // $admin2->assignRole('Admin', 'admin');

        // $admin->assignRole('Admin', 'admin');
    }
}
