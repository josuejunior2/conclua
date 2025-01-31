<?php

namespace App\Http\Controllers;

use App\Models\Orientador;
use App\Models\Academico;
use App\Models\Solicitacao;
use App\Models\SubArea;
use App\Models\OrientadorSubArea;
use App\Models\Admin;
use App\Models\Orientacao;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OrientadorRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AvaliacaoFinalRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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
        // dd($orientador);
        return view('orientador.create', ['orientador' => $orientador, 'password' => $password, 'subAreas' => SubArea::all()]);
    }

    /**
     * O método store() está sendo usado para completar o cadastro do Orientador.
     */
    public function store(OrientadorRequest $request, Orientador $orientador)
    {
        $dados = $request->validated();
        
        DB::transaction(function() use($orientador, $dados){ 
            $orientador->update($dados);

            $orientador->Admin->update([
                'password' => Hash::make($dados['password']),
            ]);

            foreach($dados['sub_areas'] as $subArea){
                OrientadorSubArea::create(['orientador_id' => $orientador->id, 'sub_area_id' => $subArea]);
            }

            Log::channel('main')->info('Orientador completou o cadastro, primeiro acesso.', ['data' => [$orientador], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        });
        return redirect()->route('admin.home');
    }

    /**
     * Display the specified resource. FOR GUARD ADMIN
     */
    public function show(Admin $orientador)
    {
        return view('orientador.show', ['admin' => $orientador]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orientador $orientador)
    {
        $orientacoes = $orientador->orientacoes->where('semestre_id', session('semestre_id'));
        return view('orientador.edit', ['orientador' => $orientador, 'orientacoes' => $orientacoes, 'subAreas' => SubArea::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrientadorRequest $request, Orientador $orientador)
    {
        $dados = $request->validated();
        DB::transaction(function() use($orientador, $dados){ 
            if(is_null($dados['password'])){
                $dados['password'] = $orientador->Admin->password;
            } else{
                $orientador->Admin->update(['password' => Hash::make($dados['password'])]);
            }

            OrientadorSubArea::where('orientador_id', $orientador->id)->delete();
            foreach($dados['sub_areas'] as $subArea){
                OrientadorSubArea::create(['orientador_id' => $orientador->id, 'sub_area_id' => $subArea]);
            }
    
            $orientador->update($dados);
            Log::channel('main')->info('Orientador editado, editou seus dados.', ['data' => [$orientador], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        });

        return redirect()->route('orientador.show', ['orientador' => $orientador->Admin]);
    }


    /**
     * Display the specified resource. FOR GUARD ADMIN
     */
    public function showAcademico(Academico $academico)
    {
        $orientacao = Orientacao::where('semestre_id', session('semestre_id'))
            ->where('orientador_id', auth()->guard('admin')->user()->Orientador->id)
            ->where('academico_id', $academico->id)->first();
            // dd($orientacao);

        $solicitacoes = $academico->solicitacoes->where('semestre_id', session('semestre_id'))->where('orientador_id', auth()->guard('admin')->user()->Orientador->id);
        return view('orientador.academico.show', ['academico' => $academico, 'orientacao' => $orientacao, 'solicitacoes' => $solicitacoes]);
    }
    

    /**
     * Display the specified resource. FOR GUARD ADMIN
     */
    public function avaliar(AvaliacaoFinalRequest $request, Orientacao $orientacao)
    {
        $orientacao->update($request->validated());
        Log::channel('main')->info('Orientador fez avaliação final.', ['data' => [$orientacao], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        return redirect()->back()->with(['success' => 'Avaliação final registrada com sucesso!']);
    }
}
