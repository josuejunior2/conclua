<?php

namespace App\Http\Controllers;

use App\Models\ModeloDocumento;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ModeloDocumentoRequest;
use App\Http\Requests\ArquivoModeloRequest;
use App\Http\Controllers\ArquivoController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ModeloDocumentoAdminController extends Controller
{
    protected $arquivoController;

    public function __construct(ArquivoController $arquivoController)
    {
        $this->arquivoController = $arquivoController;
        $this->middleware('permission:criar modelo de documento')->only(['create', 'store']);
        $this->middleware('permission:editar modelo de documento')->only(['edit', 'update']);
        $this->middleware('permission:excluir modelo de documento')->only(['destroy']);
    }

    public function index()
    {
        $layout = auth()->guard('admin')->user()->hasRole('Admin') ? 'layouts.admin' : 'layouts.orientador';
        return view('admin.modelo_documento.index', ['modelos' => ModeloDocumento::all(), 'layout' => $layout]);
    }

    public function create()
    {
        return view('admin.modelo_documento.create');
    }

    public function store(ModeloDocumentoRequest $request)
    {
        DB::transaction(function() use($request){   
            $dados = $request->validated();
            $modelo = ModeloDocumento::create($dados);

            if ($request->hasFile('arquivos')) {
                $requestArquivos = new ArquivoModeloRequest($request->only(['arquivos']));
                $this->arquivoController->storeArquivoModelo($requestArquivos, $modelo);
            }
            Log::channel('main')->info('Modelo Documento cadastrado.', ['data' => [$modelo->id], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        });
        return redirect()->route('admin.modelo_documento.index');
    }

    public function edit(ModeloDocumento $modelo)
    {
        return view('admin.modelo_documento.edit', ['modelo' => $modelo]);
    }

    public function update(ModeloDocumentoRequest $request, ModeloDocumento $modelo)
    {
        DB::transaction(function() use($request, $modelo){   
            $dados = $request->validated();
            $modelo->update($dados);

            if ($request->hasFile('arquivos')) {
                $requestArquivos = new ArquivoModeloRequest($request->only(['arquivos']));
                $this->arquivoController->storeArquivoModelo($requestArquivos, $modelo);
            }
            Log::channel('main')->info('Modelo Documento atualizado.', ['data' => [$modelo->id], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        });
        return redirect()->route('admin.modelo_documento.index');
    }

    public function destroy(ModeloDocumento $modelo)
    {
        DB::transaction(function() use($modelo){
            foreach($modelo->arquivos as $arquivo){
                $this->arquivoController->destroyArquivoModelo($arquivo);
            }

            $modelo->delete();
            Log::channel('main')->info('Modelo de documento excluído.', ['data' => [$modelo->id], 'user' => auth()->user()->nome."[".auth()->user()->id."]"]);
        });
        return redirect()->route('admin.modelo_documento.index')->with(['success' => 'Modelo de documento excluído com sucesso.']);
    }
}
