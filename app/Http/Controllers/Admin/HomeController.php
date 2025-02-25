<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orientador;
use App\Models\Orientacao;
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
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // dd(session('semestre_id'));
        $admin = auth()->guard('admin')->user();
        if($admin->hasRole('Orientador')){
            $orientador = $admin->Orientador;
            $solicitacoes = Solicitacao::where('orientador_id', $orientador->id)->where('status', null)->get();
            $orientacoes = $orientador->orientacoes->where('semestre_id', session('semestre_id'));

            return view('orientador.home', ['orientador' => $orientador, 'solicitacoes' => $solicitacoes, 'orientacoes' => $orientacoes]);
        } elseif($admin->roles->where('guard_name', 'admin')){
            $semestres = Semestre::all();
            return view('admin.home', ['semestres' => $semestres, 'solicitacoes' => Solicitacao::getSolicitacoesAtuaisView(), 'orientadores' => Orientador::withoutTrashed()->get(), 'orientacoes' => Orientacao::getSolicitacoesAtuaisView()]);
        } else{
            return abort(403, 'Você não está autenticado ao sistema.');
        }
    }
}
