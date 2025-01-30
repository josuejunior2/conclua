<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Http\Requests\EmpresaRequest;
use App\Models\Academico;
use App\Models\AcademicoEstagio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmpresaAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:visualizar empresa')->only(['index', 'show']);
        $this->middleware('permission:criar empresa')->only(['create', 'store']);
        $this->middleware('permission:editar empresa')->only(['edit', 'update']);
        $this->middleware('permission:excluir empresa')->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.empresa.index', ['empresas' => Empresa::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.empresa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmpresaRequest $request)
    {
        DB::transaction(function() use($request, &$empresa){    
            $empresa = Empresa::create($request->validated());
            Log::channel('main')->info('Empresa cadastrada.', ['data' => [$empresa], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        });

        return redirect()->route('admin.empresa.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        return view('admin.empresa.show', ['empresa' => $empresa]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        return view('admin.empresa.edit', ['empresa' => $empresa]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmpresaRequest $request, Empresa $empresa)
    {
        DB::transaction(function() use($request, &$empresa){    
            $empresa->update($request->validated());
            Log::channel('main')->info('Empresa editada.', ['data' => [$empresa], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        });

        return redirect()->route('admin.empresa.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        DB::transaction(function() use($empresa){    
            $empresa->delete();
            Log::channel('main')->info('Empresa excluída.', ['data' => [$empresa], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        });

        return redirect()->route('admin.empresa.index');
    }
}
