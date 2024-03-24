<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Orientador;
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
        // dd(auth()->guard('web')->check());
        if(auth()->guard('admin')->check()){
            $orientador = Orientador::where('email', auth()->guard('admin')->user()->email)->first();
            // dd($orientador);
            if (is_null($orientador)) {
                return $next($request); // se não tiver orientador é que é admin, então pode passar
            } elseif(is_null($orientador->formacao_id) && is_null($orientador->area_id)){
                return redirect()->route('orientador.create'); // se não completou o cadastro, vai completar
            } else {
                return $next($request); // se já completou o cadastro OU é admin, blz, pode passar
            }
        } elseif(auth()->guard('web')->check()){
            $academico = Academico::where('email', auth()->user()->email)->first();

            if ($academico) {
                $tcc = AcademicoTCC::where('academico_id', $academico->id)->exists();
                $estagio = AcademicoEstagio::where('academico_id', $academico->id)->exists();

                if ($tcc || $estagio) {
                    return $next($request);
                }
                else{
                    $semestre = Semestre::where('status', 1)->first();
                    return redirect()->route('academico.create', ['semestre' => $semestre]);
                }
            }
            else {
                return redirect()->route('welcome');
            }
        }

        return abort(404);
    }

}
