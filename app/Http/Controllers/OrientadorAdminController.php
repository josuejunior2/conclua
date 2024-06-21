<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semestre;
use App\Models\SemestreOrientador;
use App\Models\Orientador;
use App\Models\Orientacao;
use App\Models\Admin;
use App\Imports\AdminsImport;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class OrientadorAdminController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todosOrientadores = Orientador::all();
        if(session('semestre_id')){
            $orientacoesSemestre = Orientacao::where('semestre_id', session('semestre_id'));
            return view('admin.orientador.index', ['orientadores' => $todosOrientadores, 'orientacoesSemestre' => $orientacoesSemestre]);
        }
        return view('admin.orientador.index', ['orientadores' => $todosOrientadores]);

    }

    /**
     * Display a listing of the resource.
     */
    public function show(Orientador $orientador)
    {
        // dd($orientador);
        $orientacoes = $orientador->orientacoes->where('semestre_id', session('semestre_id'));
        return view('admin.orientador.show', ['orientador' => $orientador, 'orientacoes' => $orientacoes]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orientador $orientador)
    {
        $orientador->Admin->forceDelete();
        $orientador->forceDelete();

        return redirect()->route('admin.orientador.index');
    }

    /**
     * Cadastra os dados basicos de orientadores por tabela excel E oferece opção para ativar junto de importar.
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
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $arquivo = $request->file('tabela_orientadores');

        try {
            Excel::import(new AdminsImport, $arquivo);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['erro' => 'Erro: Planilha vazia ou dados repetidos.'.$e]);
        }

        // pega cada orientador que acabou de ser cadastrado da tabela admins
        $orientadores = Admin::where('created_at', '>=', now()->subSeconds(3))->get();

        foreach ($orientadores as $orientador) {
            $orientador->assignRole('Orientador');//, 'admin' // assign role em cada orientador que acabou de ser cadastrado na tabela admins
        }

        $nomeOriginal = $arquivo->getClientOriginalName();

        $arquivo->move('uploads', $nomeOriginal);//ta dando errado

        return redirect()->route('admin.orientador.index')->with('success', 'Operação realizada com sucesso!');
    }
}
