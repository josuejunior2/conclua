<?php

namespace App\Http\Controllers;

use App\Models\Semestre;
use App\Models\Academico;
use App\Models\Orientador;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SemestreRequest;
use App\Http\Requests\MudarSemestreRequest;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SemestreController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:visualizar semestre')->only(['index', 'show']);
        $this->middleware('permission:criar semestre')->only(['create', 'store']); 
        $this->middleware('permission:editar semestre')->only(['edit', 'update']); 
        $this->middleware('permission:excluir semestre')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semestres = Semestre::all();
        return view('admin.semestre.index', ['semestres' => $semestres]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.semestre.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SemestreRequest $request)
    {
        DB::transaction(function() use($request){  
            $semestre = Semestre::create($request->validated());
            Log::channel('main')->info('Semestre cadastrado.', ['data' => [$semestre], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        });
        // session()->put('semestre_id', $semestre->id);

        // Orientador::all()->each(function ($orientador){
        //     $orientador->update(['disponibilidade' => null]);
        // });

        return redirect()->route('admin.semestre.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dados = Semestre::find($id);

        return view('admin.semestre.show', ['semestre' => $dados]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Semestre $semestre)
    {
        return view('admin.semestre.edit', ['semestre' => $semestre]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SemestreRequest $request, Semestre $semestre)
    {
        DB::transaction(function() use($request, $semestre){  
            $semestre->update($request->validated());
            Log::channel('main')->info('Semestre editado.', ['data' => [$semestre], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        });

        return redirect()->route('admin.semestre.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Semestre $semestre)
    {
        DB::transaction(function() use($semestre){  
            foreach($semestre->academicosEstagio as $academicoEstagio){
                $academicoEstagio->delete();
            }
            foreach($semestre->academicosTCC as $academicoTCC){
                $academicoTCC->delete();
            }
            $semestre->delete();
            Log::channel('main')->info('Semestre excluído.', ['data' => [$semestre], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        });
        return redirect()->route('admin.semestre.index');
    }
    
    /**
     * Muda de semestre
     */
    public function mudar_semestre(MudarSemestreRequest $request)
    {
        $request->session()->put('semestre_id', $request->validated()['semestre_id']);

        $semestreSession = Semestre::find(session('semestre_id'));

        $verificaDataInicio = now() >= $semestreSession->data_inicio;
        $verificaDataFinal = now() <= $semestreSession->data_fim;

        $validacao = $verificaDataInicio && $verificaDataFinal ? true : false;
        
        $request->session()->put('semestreIsAtivo', $validacao);

        return auth()->guard('web') ? redirect()->route('home') : redirect()->route('admin.home');
    }
}
