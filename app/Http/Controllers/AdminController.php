<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\OrientadorGeral;
use App\Models\Orientador;
use App\Models\Academico;
use App\Models\AcademicoTCC;
use App\Models\AcademicoEstagio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Imports\OrientadoresGeralImport;
use App\Imports\AcademicosImport;
use App\Imports\AdminsImport;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
    /**
     * Cadastra os dados basicos de orientadores por tabela excel.
     */
    public function import_orientadores(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tabela_orientadores' => 'required|mimes:xlsx', // |max:2048', // coloco um máximo??
        ], [
            'tabela_orientadores.required' => 'Por favor, selecione um arquivo.',
            'tabela_orientadores.mimes' => 'O arquivo deve ter a extensão .xlsx.',
            //'tabela_orientadores.max' => 'O tamanho máximo do arquivo é 2048 KB.',
        ]);

        if ($validator->fails()) {
            // Redireciona de volta com os erros
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $arquivo = $request->file('tabela_orientadores');

        try {
            Excel::import(new OrientadoresGeralImport, $arquivo);
            Excel::import(new AdminsImport, $arquivo);
            // Seu código para importar e processar o arquivo aqui
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['erro' => 'Erro: Planilha vazia ou dados repetidos.']);
        }

        // pega cada orientador que acabou de ser cadastrado da tabela admins
        $orientadores = Admin::where('created_at', '>=', now()->subSeconds(3))->get();

        foreach ($orientadores as $orientador) {
            $orientador->assignRole('Orientador');//, 'admin' // assign role em cada orientador que acabou de ser cadastrado na tabela admins
        }

        $nomeOriginal = $arquivo->getClientOriginalName();

        $arquivo->move('/uploads', $nomeOriginal);

        return redirect()->route('admin.listar.orientadores')->with('success', 'Operação realizada com sucesso!');
    }
    /**
     * Cadastra os dados basicos de academicos por tabela excel.
     */
    public function import_academicos(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tabela_academicos' => 'required|mimes:xlsx', // |max:2048', // coloco um máximo??
        ], [
            'tabela_academicos.required' => 'Por favor, selecione um arquivo.',
            'tabela_academicos.mimes' => 'O arquivo deve ter a extensão .xlsx.',
            //'tabela_orientadores.max' => 'O tamanho máximo do arquivo é 2048 KB.',
        ]);

        if ($validator->fails()) {
            // Redireciona de volta com os erros
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $arquivo = $request->file('tabela_academicos');

        try {
            Excel::import(new AcademicosImport, $arquivo);
            Excel::import(new UsersImport, $arquivo);
            // Seu código para importar e processar o arquivo aqui
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['erro' => 'Erro: Planilha vazia ou dados repetidos.']);
        }

        $usuarios = User::where('created_at', '>=', now()->subSeconds(3))->get();

        foreach ($usuarios as $usuario) {
            $usuario->assignRole('Academico');
        }

        $nomeOriginal = $arquivo->getClientOriginalName();

        $arquivo->move('/uploads', $nomeOriginal);

        return redirect()->route('admin.listar.academicos')->with('success', 'Operação realizada com sucesso!');
    }

     /**
     *   Lista todos os orientadores.
     */
    public function listar_orientadores()
    {
        $especificos = Orientador::with('OrientadorGeral')->get();
        $orientadores = OrientadorGeral::with('Formacao', 'Area')->get();
        return view('admin.listar-orientadores', ['orientadores' => $orientadores, 'especificos' => $especificos]);
    }

 /**
     *   Lista todos os academicos.
     */
    public function listar_academicos()
    {
        $academicos = Academico::all();
        $tcc = AcademicoTCC::all();
        $estagio = AcademicoEstagio::all();

        return view('admin.listar-academicos', ['academicos' => $academicos, 'tcc' => $tcc, 'estagio' => $estagio]);
    }
}
