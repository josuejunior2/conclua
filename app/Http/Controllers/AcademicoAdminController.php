<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orientacao;
use App\Models\Academico;
use App\Models\User;
use App\Models\AcademicoTCC;
use App\Models\AcademicoEstagio;
use Illuminate\Support\Facades\Validator;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\AdminStoreAcademicoRequest;
use App\Http\Requests\AdminUpdateAcademicoRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AcademicoAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todosAcademicos = Academico::withTrashed()->get();
        if(session('semestre_id')){
            $estagioSemestre = AcademicoEstagio::where('semestre_id', session('semestre_id'));
            $tccSemestre = AcademicoTCC::where('semestre_id', session('semestre_id'));
            return view('admin.academico.index', ['academicos' => $todosAcademicos, 'estagioSemestre' => $estagioSemestre, 'tccSemestre' => $tccSemestre]);
        }
        
        return view('admin.academico.index', ['academicos' => $todosAcademicos]);
    }
    
    /**
     * Display the specified resource.
     */
    public function create()
    {
        $this->middleware('permission:criar academico');
        return view('admin.academico.create');
    }

    /**
     * Utilizado para completar o cadastro do academico: atualizar senha e redirecionar para o create de AcademicoTCC ou AcademicoEstagio
     */
    public function store(AdminStoreAcademicoRequest $request)
    {
        $this->middleware('permission:criar academico');
        $dados = $request->validated();
        
        DB::transaction(function() use($dados, &$academico){       
            $user = User::create(
                [
                'nome'     => $dados['nome'],
                'email'    => $dados['email'],
                'password' => Hash::make($dados['matricula']),
                ]
            );
            $academico = Academico::create(
                [
                    'user_id'   => $user->id,
                    'matricula' => $dados['matricula'],
                ]
            );
            $user->assignRole('Academico');
        });
        return redirect()->route('admin.academico.show', ['academico' => $academico]);
    }
    
    /**
     * Display the specified resource.
     */
    public function edit(Academico $academico)
    {
        $this->middleware('permission:editar academico');
        return view('admin.academico.edit', ['academico' => $academico]);
    }

    /**
     * Utilizado para completar o cadastro do academico: atualizar senha e redirecionar para o create de AcademicoTCC ou AcademicoEstagio
     */
    public function update(AdminUpdateAcademicoRequest $request, Academico $academico)
    {
        $this->middleware('permission:editar academico');
        $dados = $request->validated();
        
        DB::transaction(function() use($dados, &$academico){       
            $academico->User->update(
                [
                'nome'     => $dados['nome'],
                'email'    => $dados['email'],
                'password'    => $dados['password'] ?? $academico->User->password,
                ]
            );
            $academico->update(
                [
                    'matricula' => $dados['matricula'],
                ]
            );
        });
        return redirect()->route('admin.academico.show', ['academico' => $academico]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Academico $academico)
    {
        $this->middleware('permission:visualizar academico');
        return view('admin.academico.show', [
            'academico' => $academico, 
            'estagio' => $academico->getEstagioAtual(), 
            'tcc' => $academico->getTccAtual(), 
            'solicitacoes' => $academico->getSolicitacoesAtual()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->middleware('permission:excluir academico');

        DB::transaction(function() use($id){
            $academico = Academico::withTrashed()->findOrFail($id);
            if($academico->trashed()){
                $academico->restore();
                $academico->UserTrashed->restore();
            }
            else {
                $academico->delete();
                $academico->UserTrashed->delete();
            }
        });
        // if(AcademicoTCC::where('academico_id', $academico->id)->exists()){

        //     $user = $academico->User;
        //     $academico->academicosTCC()->delete();
        //     $academico->delete();
        //     $user->delete();

        // } else if(AcademicoEstagio::where('academico_id', $academico->id)->exists()){

        //     $user = $academico->User;
        //     $academico->academicosEstagio()->delete();
        //     $academico->delete();
        //     $user->delete();
        // } else {
        //     $user = $academico->User;
        //     $academico->delete();
        //     $user->delete();
        // }
        return redirect()->route('admin.academico.index');
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
            $import = new UsersImport();
            $users = Excel::import($import, $arquivo);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['erro' => 'Erro: Planilha vazia ou dados repetidos. ']);
        }

        $usuarios = User::whereIn('id', $import->insertedIds)->get();


        foreach ($usuarios as $usuario) {
            $usuario->assignRole('Academico');
        }

        $nomeOriginal = $arquivo->getClientOriginalName();

        $arquivo->move('uploads', $nomeOriginal);// ta dando errado, ver depois

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
    
    /**
     * Remove the specified resource from storage.
     */
    public function downloadModeloPlanilha()
    {
        $filePath = public_path('files/modelo_importacao_academico.xlsx');
        return Response::download($filePath);
    }
}
