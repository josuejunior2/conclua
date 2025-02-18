<?php

namespace App\Http\Controllers;

use App\Models\ModeloDocumento;
use App\Models\Academico;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModeloDocumentoAcademicoController extends Controller
{
    /**academico_tcc_id
     * Display a listing of the resource.academico_estagio_id
     */
    public function index()
    {
        $academico = Academico::where('user_id', auth()->user()->id)->first();
        $orientacao = !empty($academico->OrientacaoAtual()) ? $academico->OrientacaoAtual() : null;
        if($orientacao){
            if(!empty($orientacao->academico_estagio_id)){
                $modelos = ModeloDocumento::whereNot('modalidade', "tcc")->orWhereNull('modalidade')->get();
            } elseif(!empty($orientacao->academico_tcc_id)){
                $modelos = ModeloDocumento::whereNot('modalidade', "estagio")->orWhereNull('modalidade')->get();
            }
        } else{
            $modelos = ModeloDocumento::all();
        }
        return view('academico.modelo_documento.index', ['modelos' => $modelos, 'orientacao' => $orientacao]);
    }
}
