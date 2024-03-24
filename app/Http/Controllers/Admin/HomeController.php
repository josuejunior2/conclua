<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orientador;
use App\Models\Solicitacao;

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
        $admin = auth()->guard('admin')->user();
        if($admin->hasRole('Admin')){
            return view('admin.home');
        } elseif($admin->hasRole('Orientador')){
            $orientador = Orientador::where('email', auth()->user()->email)->first();
            $solicitacoes = Solicitacao::where('orientador_id', $orientador->id)->where('status', null)->get();

            return view('orientador.home', ['solicitacoes' => $solicitacoes]);
        } else{
            return abort(403, 'Você não está autenticado ao sistema.');
        }
    }
}
