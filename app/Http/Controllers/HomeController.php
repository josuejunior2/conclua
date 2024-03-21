<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Academico;
use App\Models\Orientador;

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
            $academico = Academico::where('email', auth()->user()->email)->first();

            $orientadorIds = $academico->solicitacoes->pluck('Orientador_id')->values()->toArray();

            $orientadores = Orientador::where('disponibilidade', '>', 0)
                            ->whereNotIn('Orientador_id', $orientadorIds)
                            ->get();

            // dd($academico->solicitacoes->Orientador);

            return view('academico.home', ['orientadores' => $orientadores, 'academico' => $academico]);
        }elseif($user->hasRole('Orientador')){
            return redirect()->route('orientador.home');
        }elseif($user->hasRole('Administrador')){
            return redirect()->route('admin.home');
        }
        return abort(404);
    }
}
