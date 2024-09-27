<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Http\Requests\EmpresaRequest;
use App\Models\Academico;
use App\Models\AcademicoEstagio;
use Illuminate\Support\Facades\DB;

class EmpresaAdminController extends Controller
{
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
        $this->middleware('permission:criar empresa');
        return view('admin.empresa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmpresaRequest $request)
    {
        $this->middleware('permission:criar empresa');
        DB::transaction(function() use($request, &$empresa){    
            $empresa = Empresa::create($request->validated());
        });

        return redirect()->route('admin.empresa.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        $this->middleware('permission:visualizar empresa');
        return view('admin.empresa.show', ['empresa' => $empresa]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        $this->middleware('permission:editar empresa');
        return view('admin.empresa.edit', ['empresa' => $empresa]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmpresaRequest $request, Empresa $empresa)
    {
        $this->middleware('permission:editar empresa');
        DB::transaction(function() use($request, &$empresa){    
            $empresa->update($request->validated());
        });

        return redirect()->route('admin.empresa.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        $this->middleware('permission:excluir empresa');
        DB::transaction(function() use($empresa){    
            $empresa->delete();
        });

        return redirect()->route('admin.empresa.index');
    }
}
