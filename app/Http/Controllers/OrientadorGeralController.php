<?php

namespace App\Http\Controllers;

use App\Models\OrientadorGeral;
use App\Models\Orientador;
use App\Models\Academico;
use App\Models\Solicitacao;
use App\Models\User;
use App\Models\Area;
use App\Models\Formacao;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OrientadorGeralRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OrientadorGeralController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orientador = OrientadorGeral::where('email', auth()->user()->email)->first();
        $solicitacoes = Solicitacao::where('orientadorGeral_id', $orientador->id)->get();
        // dd($solicitacoes);

        return view('orientador.orientadorGeral.index', ['solicitacoes' => $solicitacoes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $orientador = OrientadorGeral::where('email', auth()->guard('admin')->user()->email)->first();
        // dd($orientador);
        if (is_null($orientador)) {
            return redirect()->route('admin.home'); // se não tiver orientador é que é admin, então pode ir pra home
        } elseif(is_null($orientador->formacao_id) && is_null($orientador->area_id)){
            $formacoes = Formacao::all();
            $areas = Area::all();
            $user = auth()->user();
            return view('orientador.orientadorGeral.create', ['user' => $user, 'areas' => $areas, 'formacoes' => $formacoes ]);
        } else {
            return redirect()->route('admin.home'); // se já completou o cadastro OU é admin, vai pra home
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrientadorGeralRequest $request)
    {
        $orientadorGeral = OrientadorGeral::where('email', auth()->guard('admin')->user()->email)->first();

        if ($orientadorGeral) {
            $orientadorGeral->update($request->validated());

            $orientadorGeral->update([
                'password' => Hash::make($request->input('password')),
            ]);

            return redirect()->route('orientador.create', ['orientadorgeral_id' => $orientadorGeral->id]);
        }

        return abort(404);
    }

    /**
     * Display the specified resource. FOR GUARD ADMIN
     */
    public function show(OrientadorGeral $orientadorgeral)
    {
        $layouts = 'layouts.admin';
        $orientador = Orientador::where('orientadorGeral_id', $orientadorgeral->id)->first();

        return view('orientador.orientadorGeral.show', ['orientadorgeral' => $orientadorgeral, 'orientador' => $orientador, 'layouts' => $layouts]);
    }

    /**
     * Display the specified resource. FOR GUARD WEB
     */
    public function show_web(OrientadorGeral $orientadorgeral, Academico $academico)
    {
        $layouts = 'layouts.app';

        return view('orientador.orientadorGeral.show', ['orientadorgeral' => $orientadorgeral, 'academico' => $academico, 'layouts' => $layouts]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrientadorGeral $orientadorgeral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrientadorGeral $orientadorgeral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrientadorGeral $orientadorgeral) // Não coloquei o softDeletes, talvez deva colocar depois
    {
        if($orientadorgeral->Especifico){ $orientadorgeral->Especifico->delete(); }
        $orientadorgeral->delete();
        return redirect()->route('admin.listar.orientadores');
    }
}
