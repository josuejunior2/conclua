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

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('empresa.create', ['empresas' => Empresa::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmpresaRequest $request)
    {
        DB::transaction(function() use($request, &$empresa){    
            $empresa = Empresa::where('cnpj', $request->validated()['cnpj'])->exists() ? Empresa::where('cnpj', $request->validated()['cnpj'])->first() : Empresa::create($request->validated());
        });
        $academico = Academico::where('user_id', auth()->user()->id)->first();

        return redirect()->route('academicoEstagio.create', ['empresa' => $empresa, 'academico' => $academico]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        //
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
        DB::transaction(function() use($request, $estagio, $empresa){
            $novaEmpresa = Empresa::where('cnpj', $request->validated()['cnpj'])->exists() ? Empresa::where('cnpj', $request->validated()['cnpj'])->first() : Empresa::create($request->validated());
            $estagio->update(['empresa_id' => $novaEmpresa->id]);
            $estagio->save();
        });
        return redirect()->route('home'); // o redirecionamento aqui ta paia, n sei se ta mudando na solicitacao, ou se vai ser em outro lugar...
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        //
    }
}
