<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\User;
use App\Models\Academico;
use App\Models\AcademicoTCC;

class VinculacaoTest extends TestCase
{
    use RefreshDatabase;

    protected $academico;
    protected $orientador;
    protected $orientacao;
    /**
     * A basic feature test example.
     */
    public function test_academico_solicita(): void
    {
        // $user = User::factory()->create();
        // $this->academico = Academico::create([
        //     'user_id' => $user->id,
        //     'matricula' => '100055555'
        // ]);
        // $user->assignRole('Academico');

        // $this->actingAs($user);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
