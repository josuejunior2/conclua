<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semestre;
use App\Models\Role;
use App\Models\SemestreOrientador;
use App\Models\Orientador;
use App\Models\Orientacao;
use App\Models\Admin;
use App\Imports\AdminsImport;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\AdminStoreOrientadorRequest;
use App\Http\Requests\AdminUpdateOrientadorRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class OrientadorAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:visualizar orientador')->only(['index', 'show']);
        $this->middleware('permission:criar orientador')->only(['create', 'store', 'import_orientadores', 'downloadModeloPlanilha']); 
        $this->middleware('permission:editar orientador')->only(['edit', 'update']); 
        $this->middleware('permission:excluir orientador')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todosOrientadores = Orientador::withTrashed()->get();
        if(session('semestre_id')){
            $orientacoesSemestre = Orientacao::where('semestre_id', session('semestre_id'));
            return view('admin.orientador.index', ['orientadores' => $todosOrientadores, 'orientacoesSemestre' => $orientacoesSemestre]);
        }
        return view('admin.orientador.index', ['orientadores' => $todosOrientadores]);

    }

    /**
     * Display the specified resource.
     */
    public function create()
    {
        return view('admin.orientador.create');
    }

    /**
     * Utilizado para completar o cadastro do academico: atualizar senha e redirecionar para o create de AcademicoTCC ou AcademicoEstagio
     */
    public function store(AdminStoreOrientadorRequest $request)
    {
        $dados = $request->validated();
        
        DB::transaction(function() use($dados, &$orientador){       
            $user = Admin::create(
                [
                'nome'     => $dados['nome'],
                'email'    => $dados['email'],
                'password' => Hash::make($dados['masp']),
                ]
            );
            $orientador = Orientador::create(
                [
                    'admin_id'   => $user->id,
                    'masp' => $dados['masp'],
                ]
            );
            $user->assignRole('Orientador');
            Log::channel('main')->info('Orientador cadastrado.', ['data' => [$orientador, $user], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        });
        return redirect()->route('admin.orientador.show', ['orientador' => $orientador]);
    }
    
    /**
     * Display the specified resource.
     */
    public function edit(Orientador $orientador)
    {
        return view('admin.orientador.edit', ['orientador' => $orientador, 'roles' => Role::where('guard_name', 'admin')->where('name', 'Orientador')->get()]);
    }

    /**
     * Utilizado para completar o cadastro do academico: atualizar senha e redirecionar para o create de AcademicoTCC ou AcademicoEstagio
     */
    public function update(AdminUpdateOrientadorRequest $request, Orientador $orientador)
    {
        $dados = $request->validated();
        
        DB::transaction(function() use($dados, &$orientador){       
            $orientador->Admin->update(
                [
                'nome'     => $dados['nome'],
                'email'    => $dados['email'],
                'password'    => $dados['password'] ?? $orientador->Admin->password,
                ]
            );
            $orientador->update(
                [
                    'masp' => $dados['masp'],
                ]
            );
            $orientador->Admin->syncRoles($dados['perfil']);
            Log::channel('main')->info('Orientador editado.', ['data' => [$orientador, $dados['perfil']], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        });
        return redirect()->route('admin.orientador.show', ['orientador' => $orientador]);
    }

    /**
     * Display a listing of the resource.
     */
    public function show(Orientador $orientador)
    {
        $orientacoes = $orientador->orientacoes()->where('semestre_id', session('semestre_id'))->get();
        return view('admin.orientador.show', ['orientador' => $orientador, 'orientacoes' => $orientacoes]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {        
        DB::transaction(function() use($id){
            $orientador = Orientador::withTrashed()->findOrFail($id);
            if($orientador->trashed()){
                $orientador->restore();
                $orientador->AdminTrashed->restore();
                Log::channel('main')->info('Orientador desbloqueado.', ['data' => [$orientador], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
            }
            else {
                $orientador->delete();
                $orientador->AdminTrashed->delete();
                Log::channel('main')->info('Orientador bloqueado.', ['data' => [$orientador], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
            }
        });

        return redirect()->route('admin.orientador.index');
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
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $arquivo = $request->file('tabela_orientadores');

        try {
            $import = new AdminsImport;
            Excel::import($import, $arquivo);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
        
        DB::transaction(function() use($arquivo, $import){
            // pega cada orientador que acabou de ser cadastrado da tabela admins
            $orientadores = Admin::whereIn('id', $import->insertedIds)->get();

            foreach ($orientadores as $orientador) {
                $orientador->assignRole('Orientador');//, 'admin' // assign role em cada orientador que acabou de ser cadastrado na tabela admins
            }

            $nomeOriginal = $arquivo->getClientOriginalName();
            $periodoAnoSemestre = Semestre::find(session('semestre_id'))->periodoAno() ?? "semestre_indefinido";
            $caminho = 'uploads/planilhas_importacao/'.$periodoAnoSemestre."/orientadores";
            Storage::disk('public')->putFileAs($caminho, $arquivo, $nomeOriginal);
            
            Log::channel('main')->info('Importação de orientadores feita.', ['data' => [$arquivo], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        });

        return redirect()->route('admin.orientador.index')->with('success', 'Operação realizada com sucesso!');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function downloadModeloPlanilha()
    {
        $filePath = public_path('files/modelo_importacao_orientador.xlsx');
        return Response::download($filePath);
    }
}
