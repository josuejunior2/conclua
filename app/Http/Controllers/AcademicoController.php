<?php

namespace App\Http\Controllers;

use App\Models\AcademicoEstagio;
use App\Models\Orientador;
use App\Models\AcademicoTCC;
use App\Models\Academico;
use App\Models\Semestre;
use App\Models\User;
use App\Models\Empresa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request\Request;
use App\Http\Requests\AcademicoRequest;
use App\Http\Requests\AcademicoUpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AcademicoController extends Controller
{
        //if(!$semestre->isAtual()){  // EXEMPLO DE THIAGO
        //    return back()->with('');
        //}
    /**
     * Utilizado para completar o cadastro do academico: atualizar senha e redirecionar para o create de AcademicoTCC ou AcademicoEstagio
     */
    public function create()
    {
        $user = auth()->user();
        return view('academico.create', ['user' => $user]);
    }

    /**
     * Utilizado para completar o cadastro do academico: atualizar senha e redirecionar para o create de AcademicoTCC ou AcademicoEstagio
     */
    public function store(AcademicoRequest $request)
    {
        $academico = Academico::where('user_id', auth()->user()->id)->first(); // recupera o Academico

        if ($academico) {
            $academico->User->update([
                'password' => Hash::make($request->input('password')), // atualiza a senha
            ]);
            Log::channel('main')->info('Acadêmico alterou a senha, primeiro acesso.', ['data' => [$academico], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);

            if($request->input('modalidade') == 0){
                return redirect()->route('empresa.create');
            }
            elseif($request->input('modalidade') == 1){
                return redirect()->route('academicoTCC.create', ['academico' => $academico]);
            }
        }

        return abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $academico = $user->Academico;
        if(AcademicoTCC::where('academico_id', $academico->id)->where('semestre_id', session('semestre_id'))->exists()){
            $tcc = AcademicoTCC::where('academico_id', $academico->id)->where('semestre_id', session('semestre_id'))->first();
            return view('academico.show', ['academico' => $academico, 'tcc' => $tcc]);
        } else if(AcademicoEstagio::where('academico_id', $academico->id)->where('semestre_id', session('semestre_id'))->exists()){
            $estagio = AcademicoEstagio::with('Empresa')->where('academico_id', $academico->id)->where('semestre_id', session('semestre_id'))->first();
            return view('academico.show', ['academico' => $academico, 'estagio' => $estagio]);
        } else {
            return view('academico.show', ['academico' => $academico]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Academico $academico)
    {
        return view('academico.edit', ['academico' => $academico]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AcademicoUpdateRequest $request, Academico $academico)
    {
        $dados = $request->validated();
        $dados['password'] = Hash::make($dados['password']);
        $academico->User->update($dados);
        Log::channel('main')->info('Acadêmico editado, editou seus dados.', ['data' => [$academico], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        return redirect()->route('academico.show', ['user' => $academico->User]);
    }

    /**
     * Remove the specified resource from storage. // NAO TA SENDO USADO ////////////////////////////////////
     */
    public function destroy(Academico $academico)
    {
        if(AcademicoTCC::where('academico_id', $academico->id)->exists()){

            AcademicoTCC::where('academico_id', $academico->id)->delete();
            $academico->delete();

        } else if(AcademicoEstagio::where('academico_id', $academico->id)->exists()){

            AcademicoEstagio::where('academico_id', $academico->id)->delete();
            $academico->delete();
        } else {
            $academico->delete();
        }
        return redirect()->route('academico.index');
    }
}
