<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Academico;
use App\Models\AcademicoEstagio;
use App\Models\Semestre;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EmpresaRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmpresaController extends Controller
{

    /**
     * Rota em que o academico vai ver a view para cadastrar a empresa no primeiro acesso do semestre.
     */
    public function create()
    {
        return view('empresa.create', ['empresas' => Empresa::all()]);
    }

    /**
     * Rota em que o academico vai cadastrar a empresa no primeiro acesso do semestre.
     */
    public function store(EmpresaRequest $request)
    {
        DB::transaction(function() use($request, &$empresa){ 
            if(Empresa::where('cnpj', $request->validated()['cnpj'])->exists()){
                $empresa = Empresa::where('cnpj', $request->validated()['cnpj'])->first();
                Log::channel('main')->info('Empresa selecionada, primeiro acesso.', ['data' => [$empresa], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
            }else{
                $empresa = Empresa::create($request->validated());
                Log::channel('main')->info('Empresa cadastrada, primeiro acesso.', ['data' => [$empresa], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
            } 
        });
        $academico = Academico::where('user_id', auth()->user()->id)->first();

        return redirect()->route('academicoEstagio.create', ['empresa' => $empresa, 'academico' => $academico]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function alteraEmpresa(Empresa $empresa, AcademicoEstagio $estagio)
    {
        return view('empresa.altera', ['empresa' => $empresa, 'empresas' => Empresa::all(), 'estagio' => $estagio]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function alteraEmpresaPost(EmpresaRequest $request, Empresa $empresa, AcademicoEstagio $estagio)
    {
        DB::transaction(function() use($request, $estagio, &$novaEmpresa){
            $novaEmpresa = Empresa::where('cnpj', $request->validated()['cnpj'])->exists() ? Empresa::where('cnpj', $request->validated()['cnpj'])->first() : Empresa::create($request->validated());
            $estagio->update(['empresa_id' => $novaEmpresa->id]);
            $estagio->save();
            Log::channel('main')->info('Empresa alterada.', ['data' => [$estagio, $novaEmpresa], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        });
        if($empresa->id != $novaEmpresa) return redirect()->route('academicoEstagio.edit', ['academicoEstagio' => $estagio]);
        return redirect()->back(); // o redirecionamento aqui ta paia, n sei se ta mudando na solicitacao, ou se vai ser em outro lugar...
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function verificaCnpj(Request $request)
    {
        $pesquisa = Empresa::where('cnpj', $request->cnpj)->first();
        $exists = false;
        if(!empty($pesquisa)){
            $exists = $pesquisa->cnpj != $request->cnpjAtual ? true : false;
        }
        return response()->json([
            'exists' => $exists
        ]);
    }
}
