<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Orientador;
use App\Models\Academico;
use App\Models\AcademicoTCC;
use App\Models\AcademicoEstagio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Imports\OrientadoresImport;
use App\Imports\AcademicosImport;
use App\Imports\AdminsImport;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    public function __construct(){
        $this->middleware(function ($request, $next) {
            if (auth()->guard('admin')->check()) {
                return $next($request);
            }

            abort(403, 'Não autorizado.');
        });
    }
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
            Excel::import(new OrientadoresImport, $arquivo);
            Excel::import(new AdminsImport, $arquivo);
            // Seu código para importar e processar o arquivo aqui
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['erro' => 'Erro: Planilha vazia ou dados repetidos.'.$e]);
        }

        // pega cada orientador que acabou de ser cadastrado da tabela admins
        $orientadores = Admin::where('created_at', '>=', now()->subSeconds(3))->get();

        foreach ($orientadores as $orientador) {
            $orientador->assignRole('Orientador');//, 'admin' // assign role em cada orientador que acabou de ser cadastrado na tabela admins
        }

        $nomeOriginal = $arquivo->getClientOriginalName();

        $arquivo->move('/uploads', $nomeOriginal);//ta dando errado

        return redirect()->route('admin.orientador.index')->with('success', 'Operação realizada com sucesso!');
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

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['erro' => 'Erro: Planilha vazia ou dados repetidos.'.$e]);
        }

        $usuarios = User::where('created_at', '>=', now()->subSeconds(3))->get();

        foreach ($usuarios as $usuario) {
            $usuario->assignRole('Academico');
        }

        $nomeOriginal = $arquivo->getClientOriginalName();

        $arquivo->move('/uploads', $nomeOriginal);// ta dando errado, ver depois

        return redirect()->route('admin.academico.index')->with('success', 'Operação realizada com sucesso!');
    }
    /**
     * Ativa o cadastro do Orientador
     */
    public function ativar_orientador(Orientador $orientador)
    {
        $orientador->update(['status' => 1]);

        return redirect()->route('admin.orientador.index');
    }

    /**
     * Desativa o o cadastro do orientador
     */
    public function desativar_orientador(Orientador $orientador)
    {
        $orientador->update(['status' => 0]);

        return redirect()->route('admin.orientador.index');
    }
    /**
     * Ativa o cadastro do Academico
     */
    public function ativar_academico(Academico $academico)
    {
        $academico->update(['status' => 1]);

        return redirect()->route('admin.academico.index');
    }

    /**
     * Desativa o o cadastro do academico
     */
    public function desativar_academico(Academico $academico)
    {
        $academico->update(['status' => 0]);

        return redirect()->route('admin.academico.index');
    }
}
