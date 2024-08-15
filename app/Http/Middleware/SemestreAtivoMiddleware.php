<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Semestre;
use App\Models\Orientador;
use App\Models\Academico;
use App\Models\AcademicoTCC;
use App\Models\AcademicoEstagio;
use App\Models\SemestreAcademico;
use App\Models\SemestreOrientador;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Permission;
// use Illuminate\Support\Facades\Artisan;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class SemestreAtivoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // return $next($request);
        // if(auth()->user()->hasRole('Admin')){ return $next($request); }

        $ultimoSemestre = Semestre::all()->last();
        if(session('semestre_id')){ $semestreEmSession = Semestre::where('id', session('semestre_id'))->first(); }

        if(isset($semestreEmSession)){
            if($semestreEmSession != $ultimoSemestre || $ultimoSemestre->data_fim < now() || $ultimoSemestre->data_inicio > now() ){
                return redirect()->route('welcome')->with('error', 'Ação não autorizada, o semestre já foi finalizado.');
            } else if($semestreEmSession == $ultimoSemestre && $ultimoSemestre->data_fim >= now()){
                return $next($request);
            }
            return abort(403, "o midd semestreativo nao prevê tudo");
        // }
        // elseif(!isset($semestreEmSession) && isset($ultimoSemestre)){
        //     $request->session()->put('semestre_id', $ultimoSemestre->id);

        //     return $next($request);
        } else{
            return redirect()->route('welcome')->with('error', 'Sem semestre cadastrado');
        }
    }
}
