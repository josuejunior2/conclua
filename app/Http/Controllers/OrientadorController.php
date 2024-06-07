<?php

namespace App\Http\Controllers;

use App\Models\Orientador;
use App\Models\Academico;
use App\Models\Solicitacao;
use App\Models\SemestreOrientador;
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
    /**
     * O método create() está sendo usado para completar o cadastro do Orientador.
     * atualiza-se a senha e os outros campos nullable são preenchidos.
     */
    public function create()
    {
        // dd(auth()->user()->getAllPermissions());
        $orientador = Orientador::where('admin_id', auth()->guard('admin')->user()->id)->first();
        $password = Hash::make($orientador->password);
        $formacoes = Formacao::all();
        $areas = Area::all();
        // dd($orientador);
        return view('orientador.create', ['orientador' => $orientador, 'areas' => $areas, 'formacoes' => $formacoes, 'password' => $password ]);
    }

    /**
     * O método store() está sendo usado para completar o cadastro do Orientador.
     */
    public function store(OrientadorRequest $request, Orientador $orientador)
    {
        $orientador->update($request->validated());

        $orientador->update([
            'password' => Hash::make($request->input('password')),
        ]);
        return redirect()->route('admin.home');
    }

    /**
     * Display the specified resource. FOR GUARD ADMIN
     */
    public function show(Orientador $orientador)
    {
        return view('orientador.show', ['orientador' => $orientador]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orientador $orientador)
    {
        $password = Hash::make($orientador->password);
        $formacoes = Formacao::all();
        $areas = Area::all();
        return view('orientador.edit', ['areas' => $areas, 'formacoes' => $formacoes, 'orientador' => $orientador, 'password' => $password ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrientadorRequest $request, Orientador $orientador)
    {
        $orientador->update($request->validated());

        return redirect()->route('orientador.show', ['orientador' => $orientador]);
    }


}
