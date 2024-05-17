<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semestre;
use App\Models\SemestreAcademico;
use App\Models\SemestreOrientador;
use App\Models\Academico;
use App\Models\AcademicoTCC;
use App\Models\AcademicoEstagio;

class AcademicoAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(session('semestre_id'));
        $todosAcademicos = Academico::all();
        if(session('semestre_id')){
            $estagioSemestre = AcademicoEstagio::where('semestre_id', session('semestre_id'));
            $tccSemestre = AcademicoTCC::where('semestre_id', session('semestre_id'));
            return view('admin.academico.index', ['academicos' => $todosAcademicos, 'estagioSemestre' => $estagioSemestre, 'tccSemestre' => $tccSemestre]);
        }
        // dd($academicosAtivos);
        return view('admin.academico.index', ['academicos' => $todosAcademicos]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Academico $academico)
    {
        if(AcademicoTCC::where('academico_id', $academico->id)->exists()){
            $tccs = AcademicoTCC::where('academico_id', $academico->id)->get();
        } else { $tccs = null; }
        if(AcademicoEstagio::where('academico_id', $academico->id)->exists()){
            $estagios = AcademicoEstagio::with('Empresa')->where('academico_id', $academico->id)->get();
        } else{ $estagios = null; }
        return view('admin.academico.show', ['academico' => $academico, 'estagios' => $estagios, 'tccs' => $tccs]);
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

    /**
     * Cadastra os dados basicos de academicos por tabela excel E oferece opção para ativar junto de importar.
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
            $ativar = $request->input('ativar'); //A ideia aqui é ativar o cadastro dos academicos que acabaram de ser cadastrados SE tiver marcado a opção 'ativar' na view.
            Excel::import(new AcademicosImport($ativar), $arquivo);
            Excel::import(new UsersImport($ativar), $arquivo);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['erro' => 'Erro: Planilha vazia ou dados repetidos.']);
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
     * Desativa o o cadastro do academico
     */
    public function desvincular_academico_tcc(AcademicoTCC $tcc)
    {
        $orientacao = $tcc->Orientacao;
        $orientacao->Solicitacao->status = 0;
        $orientacao->Solicitacao->save();

        $tcc->orientacao_id = null;
        $tcc->save();

        $orientacao->Orientador->disponibilidade += 1;
        $orientacao->Orientador->save();
        $orientacao->delete();
        return redirect()->route('admin.academico.show', ['academico' => $tcc->Academico]);
    }
    /**
     * Desativa o o cadastro do academico
     */
    public function desvincular_academico_estagio(AcademicoEstagio $estagio)
    {
        // dd("oi");
        $orientacao = $estagio->Orientacao;
        $orientacao->Solicitacao->status = 0;
        $orientacao->Solicitacao->save();
        $estagio->orientacao_id = null;
        $estagio->save();

        $orientacao->Orientador->disponibilidade += 1;
        $orientacao->Orientador->save();
        $orientacao->delete();

        return redirect()->route('admin.academico.show', ['academico' => $estagio->Academico]);
    }
}
