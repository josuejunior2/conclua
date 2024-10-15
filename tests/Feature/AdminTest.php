<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use App\Models\Admin;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('db:seed', ['--class' => 'PerfisEPermissoesSeeder']);

        $this->admin = Admin::create([
            'nome' => 'Testildo',
            'email' => 'test@email.com',
            'password' => bcrypt('admin123')
        ]);
        $this->admin->assignRole('Admin', 'admin');
        $this->actingAs($this->admin);
        $this->withoutMiddleware();
    }

    public function test_post_orientador(): void
    {
        $response = $this->post('/admin/orientador', [
            'nome' => 'Ian Thiago',
            'email' => 'ianthiago@example.com',
            'masp' => '1045612'
        ]);

        $this->assertDatabaseHas('admins', [
            'email' => 'ianthiago@example.com',
        ]);

        $response->assertStatus(302);
    }

    public function test_post_academico(): void
    {
        $response = $this->post('/admin/academico', [
            'nome' => 'Ana Maria',
            'email' => 'anamaria@example.com',
            'matricula' => '100099888'
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'anamaria@example.com',
        ]);

        $response->assertStatus(302);
    }
}
