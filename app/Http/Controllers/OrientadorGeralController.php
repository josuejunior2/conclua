<?php

namespace App\Http\Controllers;

use App\Models\OrientadorGeral;
use App\Models\User;
use App\Models\Area;
use App\Models\Formacao;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

class OrientadorGeralController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd("aaa");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $formacoes = Formacao::all();
        $areas = Area::all();
        $user = auth()->user();
        return view('complete.orientadorGeral.create', ['user' => $user, 'areas' => $areas, 'formacoes' => $formacoes ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $regras = [
            'nomeOrientador' => 'required|min:10|max:60',
            'emailOrientador' => 'required|min:16|max:40|email',
            'maspOrientador' => 'required|digits:7',
            'formacao_id' => 'required',
            'area_id' => 'required',
        ];
        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido.',
            'nomeOrientador.min' => 'O campo nome deve ter no mínimo 10 caracteres.',
            'nomeOrientador.max' => 'O campo nome deve ter no máximo 60 caracteres.',
            'emailOrientador.min' => 'O campo email deve ter no mínimo 16 caracteres.',
            'emailOrientador.max' => 'O campo email deve ter no máximo 40 caracteres.',
            'emailOrientador.email' => 'O campo email deve ser preenchido com um endereço de email.',
            'maspOrientador.digits' => 'O campo MASP deve ter 7 caracteres numéricos.',
        ];
        $request->validate($regras, $feedback);
        $orientadorGeral = OrientadorGeral::create($request->all('maspOrientador', 'senhaOrientador', 'nomeOrientador', 'emailOrientador', 'formacao_id', 'area_id'));
        $id = $orientadorGeral->id;
        return redirect()->route('orientador.create', ['orientadorgeral_id' => $id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(OrientadorGeral $orientadorGeral)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrientadorGeral $orientadorGeral)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrientadorGeral $orientadorGeral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrientadorGeral $orientadorGeral)
    {
        //
    }
}
