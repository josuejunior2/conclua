<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Atividade;

class AtividadeAcademicoController extends Controller
{
    public function show(Atividade $atividade)
    {
        return view('academico.atividade.show', ['atividade' => $atividade]);
    }
}
