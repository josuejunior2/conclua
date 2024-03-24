<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Academico;
use App\Models\Orientador;
use App\Models\Solicitacao;
use App\Models\Semestre;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        if($user->hasRole('Academico')){
            // ----------------------PRIMEIRO CASO: O ACADEMICO AINDA NAO TEM ORIENTADOR (pergunta futura: o academico pode fazer orientacao e estagio ao mesmo tempo? nao)

            // dd($this->middleware('semestre_ativo'));
            $academico = Academico::where('email', auth()->user()->email)->first();

            $orientadorIds = $academico->solicitacoes->pluck('orientador_id')->values()->toArray();

            $orientadores = Orientador::where('disponibilidade', '>', 0)
                            ->whereNotIn('id', $orientadorIds)
                            ->get();

            $semestre = Semestre::where('status', 1)->first();
            // dd($semestre);

            return view('academico.home', ['orientadores' => $orientadores, 'academico' => $academico, 'semestre' => $semestre]);
        }
        return abort(404);
    }
}
