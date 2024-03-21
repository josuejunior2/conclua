<?php

namespace App\Http\Controllers;

use App\Models\Orientador;
use App\Models\Academico;
use App\Models\Solicitacao;
use App\Models\User;
use App\Models\Area;
use App\Models\Formacao;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OrientadorRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OrientadorController extends Controller
{
    public function __construct(){
        $this->middleware(function ($request, $next) {
            if (auth()->guard('web')->check() || auth()->guard('admin')->check()) {
                return $next($request);
            }

            abort(403, 'Não autorizado.');
        });
    }

    /**
     *  Tela Home do Orientador
     */
    public function home()
    {
        $orientador = Orientador::where('email', auth()->user()->email)->first();
        $solicitacoes = Solicitacao::where('Orientador_id', $orientador->id)->get();
        // dd($solicitacoes);

        return view('orientador.home', ['solicitacoes' => $solicitacoes]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orientadores = Orientador::with('Formacao', 'Area')->get();
        return view('orientador.index', ['orientadores' => $orientadores]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orientador = Orientador::where('email', auth()->guard('admin')->user()->email)->first();
        // dd($orientador);
        if (is_null($orientador)) {
            return redirect()->route('admin.home'); // se não tiver orientador é que é admin, então pode ir pra home
        } elseif(is_null($orientador->formacao_id) && is_null($orientador->area_id)){
            $formacoes = Formacao::all();
            $areas = Area::all();
            $user = auth()->user();
            return view('orientador.create', ['user' => $user, 'areas' => $areas, 'formacoes' => $formacoes ]);
        } else {
            return redirect()->route('admin.home'); // se já completou o cadastro OU é admin, vai pra home
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrientadorRequest $request)
    {
        $Orientador = Orientador::where('email', auth()->guard('admin')->user()->email)->first();

        if ($Orientador) {
            $Orientador->update($request->validated());

            $Orientador->update([
                'password' => Hash::make($request->input('password')),
            ]);

            return redirect()->route('orientador.create', ['Orientador_id' => $Orientador->id]);
        }

        return abort(404);
    }

    /**
     * Display the specified resource. FOR GUARD ADMIN
     */
    public function show(Orientador $Orientador)
    {
        $layouts = 'layouts.admin';
        $orientador = Orientador::where('Orientador_id', $Orientador->id)->first();

        return view('orientador.Orientador.show', ['Orientador' => $Orientador, 'orientador' => $orientador, 'layouts' => $layouts]);
    }

    /**
     * Display the specified resource. FOR GUARD WEB
     */
    public function show_web(Orientador $Orientador, Academico $academico)
    {
        $layouts = 'layouts.app';

        return view('orientador.Orientador.show', ['Orientador' => $Orientador, 'academico' => $academico, 'layouts' => $layouts]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orientador $Orientador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orientador $Orientador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orientador $Orientador) // Não coloquei o softDeletes, talvez deva colocar depois
    {
        if($Orientador){ $Orientador->delete(); }
        $Orientador->delete();
        return redirect()->route('admin.listar.orientadores');
    }

    /**
     * metodo post para o orientador aceitar a solicitação
     */
    public function aceitar_solicitacao(Solicitacao $solicitacao)
    {
        if($solicitacao->Academico->AcademicoTCC){
            $solicitacao->Academico->AcademicoTCC->Orientador_id = $solicitacao->Orientador_id;
            $solicitacao->Academico->AcademicoTCC->save();

            $solicitacao->status = 1; // status de aprovada
            $solicitacao->save();

            $outras = Solicitacao::whereNot('id', $solicitacao->id);
            foreach($outras as $o){
                $o->status = 0;
                $o->save();
            }

            return redirect()->route('orientador.home');
        } elseif($solicitacao->Academico->AcademicoEstagio){
            $solicitacao->Academico->AcademicoEstagio->Orientador_id = $solicitacao->Orientador_id;
            $solicitacao->Academico->AcademicoEstagio->save();
            $outras = Solicitacao::whereNot('id', $solicitacao->id);
            $outras->delete();
            return redirect()->route('orientador.home');
        } else{
            return back();
        }

    }

    /**
     * metodo post para o orientador rejeitar a solicitação
     */
    public function rejeitar_solicitacao($id)
    {
        // excluo a solicitação? status de rejeitada pra mostrar pro academico?

        $solicitacao->delete();
        return redirect()->route('orientador.home');

    }
}
