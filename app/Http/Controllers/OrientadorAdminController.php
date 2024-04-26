<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semestre;
use App\Models\SemestreOrientador;
use App\Models\Orientador;
use App\Models\Orientacao;

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
     * Remove the specified resource from storage.
     */
    public function destroy(Orientador $Orientador) // Não coloquei o softDeletes, talvez deva colocar depois
    {
        if($Orientador){ $Orientador->delete(); }
        $Orientador->delete();
        return redirect()->route('admin.listar.orientadores');
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
            // Redireciona de volta com os erros
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $arquivo = $request->file('tabela_orientadores');

        try {
            $ativar = $request->input('ativar');//A ideia aqui é ativar o cadastro dos orientadores no semestre em ativo SE tiver marcado a opção 'ativar' na view.
            Excel::import(new OrientadoresImport($ativar), $arquivo);
            Excel::import(new AdminsImport($ativar), $arquivo);
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

        $arquivo->move('/uploads', $nomeOriginal);//ta dando errado

        return redirect()->route('admin.orientador.index')->with('success', 'Operação realizada com sucesso!');
    }
    /**
     * Ativa o cadastro do Orientador no semestre que está ATIVO
     */
    public function ativar_orientador(Orientador $orientador)
    {
        if(is_null(app('semestreAtivo'))){ return redirect()->route('admin.academico.index')->withErrors('Cadastre e/ou ative um semestre para poder ativar o cadastro do orientador.'); }
        SemestreOrientador::create([
            'semestre_id' => app('semestreAtivo')->id,
            'orientador_id' => $orientador->id,
        ]);

        return redirect()->route('admin.orientador.index');
    }

    /**
     * Desativa o o cadastro do orientador no semestre que está ATIVO
     */
    public function desativar_orientador(Orientador $orientador)
    {
        SemestreOrientador::where('orientador_id', $orientador->id)->delete();

        return redirect()->route('admin.orientador.index');
    }
}
