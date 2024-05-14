<?php

namespace App\Http\Controllers;

use App\Models\AcademicoEstagio;
use App\Models\Orientador;
use App\Models\AcademicoTCC;
use App\Models\Academico;
use App\Models\Semestre;
use App\Models\Empresa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request\Request;
use App\Http\Requests\AcademicoRequest;
use Illuminate\Support\Facades\Hash;

class AcademicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $academicos = Academico::all();

        return view('admin.academico.index', ['academicos' => $academicos]);
    }

    /**
     * Utilizado para completar o cadastro do academico: atualizar senha e redirecionar para o create de AcademicoTCC ou AcademicoEstagio
     */
    public function create()
    {
        $user = auth()->user();

        $password = Hash::make($user->password);
        return view('academico.create', ['user' => $user, 'password' => $password]);
    }

    /**
     * Utilizado para completar o cadastro do academico: atualizar senha e redirecionar para o create de AcademicoTCC ou AcademicoEstagio
     */
    public function store(AcademicoRequest $request)
    {
        $academico = Academico::where('email', auth()->user()->email)->first(); // recupera o Academico

        if ($academico) {
            $academico->update([
                'password' => Hash::make($request->input('password')), // atualiza a senha
            ]);

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
    public function show(Academico $academico)
    {
        if(AcademicoTCC::where('academico_id', $academico->id)->exists()){
            $tcc = AcademicoTCC::where('academico_id', $academico->id)->first();
            return view('admin.academico.show', ['academico' => $academico, 'tcc' => $tcc]);
        } else if(AcademicoEstagio::where('academico_id', $academico->id)->exists()){
            $estagio = AcademicoEstagio::with('Empresa')->where('academico_id', $academico->id)->first();
            return view('admin.academico.show', ['academico' => $academico, 'estagio' => $estagio]);
        } else {
            return view('admin.academico.show', ['academico' => $academico]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Academico $academico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AcademicoRequest $request, Academico $academico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
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
