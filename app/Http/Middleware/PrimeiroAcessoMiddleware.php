<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\OrientadorGeral;
use App\Models\Academico;
use App\Models\AcademicoEstagio;
use App\Models\AcademicoTCC;

class PrimeiroAcessoMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $orientador = OrientadorGeral::where('email', auth()->user()->email)->first();
        $academico = Academico::where('email', auth()->user()->email)->first();

        if ($orientador && !$orientador->formacao_id && !$orientador->area_id) {
            return redirect()->route('orientadorgeral.create');
        }
        elseif ($academico) {
            $tcc = AcademicoTCC::where('academico_id', $academico->id)->exists();
            $estagio = AcademicoEstagio::where('academico_id', $academico->id)->exists();

            if ($tcc) {
                return $next($request);
            }
            elseif ($estagio) {
                return $next($request);
            }
            else{
                return redirect()->route('academico.create');
            }
        }

        return $next($request);
    }

}
