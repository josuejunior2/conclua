<?php

namespace App\Http\Controllers;

use App\Models\Atividade;
use App\Models\Arquivo;
use App\Models\Orientacao;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\AtividadeRequest;
use App\Http\Requests\AvaliarAtividadeRequest;
use Illuminate\Database\Eloquent\Builder;

class AtividadeAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $atividades = Atividade::where('orientacao.semestre_id', session('semestre_id'))->get();
        $atividades = Atividade::whereHas('orientacao', function (Builder $query) {
            $query->where('orientacoes.semestre_id', session('semestre_id'));
        })->get();

        return view('admin.atividade.index', ['atividades' => $atividades]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Atividade $atividade)
    {
        return view('admin.atividade.show', ['atividade' => $atividade]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Atividade $atividade)
    {
        if($atividade->SubmissaoAtividade) $atividade->SubmissaoAtividade->forceDelete();
        $atividade->forceDelete();
        return redirect()->route('admin.atividade.index');
    }
}
