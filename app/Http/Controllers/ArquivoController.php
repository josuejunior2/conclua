<?php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DownloadArquivoAuxiliarRequest;
use Illuminate\Support\Facades\Response;

class ArquivoController extends Controller
{ 
    /**
     * Remove the specified resource from storage.
     */
    public function downloadArquivo(DownloadArquivoAuxiliarRequest $request)
    {
        $caminho = $request->validated()['caminho'];
        $filePath = public_path($caminho);
        return Response::download($filePath);
    }
}
