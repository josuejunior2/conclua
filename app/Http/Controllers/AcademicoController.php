<?php

namespace App\Http\Controllers;

use App\Models\AcademicoEstagio;
use App\Models\OrientadorGeral;
use App\Models\Orientador;
use App\Models\AcademicoTCC;
use App\Models\Academico;
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
        // ----------------------PRIMEIRO CASO: O ACADEMICO AINDA NAO TEM ORIENTADOR (pergunta futura: o academico pode fazer orientacao e estagio ao mesmo tempo? nao)
        $academico = Academico::where('email', auth()->user()->email)->first();
        // dd($academico); // aqui eu peguei Orientador ao invés de OrientadorGeral pq eu preciso ver quem tem disponibilidade
        $orientadores = Orientador::where('disponibilidade', '>', 0)->get();
        // dd($orientadores[1]->OrientadorGeral);
        return view('academico.index', ['orientadores' => $orientadores, 'academico' => $academico]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        return view('academico.create', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AcademicoRequest $request)
    {
        $academico = Academico::where('email', auth()->user()->email)->first();

        if ($academico) {
            $academico->update([
                'password' => Hash::make($request->input('password')),
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
        $tcc = AcademicoTCC::where('academico_id', $academico->id)->exists();
        $estagio = AcademicoEstagio::where('academico_id', $academico->id)->exists();

        if($tcc){
            $especifico = AcademicoTCC::where('academico_id', $academico->id)->first();
            $modalidade = 'TCC';
        } else if($estagio){
            $modalidade = 'Estagio';
            $especifico = AcademicoEstagio::with('Empresa')->where('academico_id', $academico->id)->first();
        } else {
            $modalidade = 'N/A';
            $especifico = 'Cadastro incompleto';
            return view('academico.show', ['academico' => $academico, 'modalidade' => $modalidade]);
        }

        return view('academico.show', ['academico' => $academico, 'especifico' => $especifico, 'modalidade' => $modalidade]);
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
    public function update(Request $request, Academico $academico)
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
        return redirect()->route('admin.listar.academicos');
    }
}
