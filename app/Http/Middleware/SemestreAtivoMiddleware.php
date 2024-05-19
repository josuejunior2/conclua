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
        if(auth()->user()->hasRole('Admin')){ return $next($request); }

        $semestreAtual = Semestre::all()->last();
        if(session('semestre_id')){ $semestreEmSession = Semestre::where('id', session('semestre_id'))->first(); }
        if(isset($semestreEmSession)){
            if($semestreEmSession != $semestreAtual || $semestreAtual->data_fim->format('d/m/Y') < now()->format('d/m/Y')){ // na regra do form request de semestre eu devo criar uma regra pra não criar semestre sem que a data_fim do anterior não tenha chegado
                if(auth()->guard('web')->check()){
                    auth()->guard('web')->user()->revokePermissionTo(Permission::where('name', 'permissao de escrita academico')->first());
                }
                if(auth()->guard('admin')->check()){
                    auth()->guard('admin')->user()->revokePermissionTo(Permission::where('name', 'permissao de escrita orientador')->first());

                    // dd(auth()->guard('admin')->user()->hasPermissionTo('permissao de escrita orientador'));
                }
                return $next($request);
            } else if($semestreEmSession == $semestreAtual && $semestreAtual->data_fim->format('d/m/Y') >= now()->format('d/m/Y')){
                if(auth()->guard('web')->check()){
                    auth()->guard('web')->user()->givePermissionTo(Permission::where('name', 'permissao de escrita academico')->first());
                }
                if(auth()->guard('admin')->check()){
                    auth()->guard('admin')->user()->givePermissionTo(Permission::where('name', 'permissao de escrita orientador')->first());
                }
                return $next($request);
            }
            return abort(403, "o midd semestreativo nao prevê tudo");
        } else{
            return redirect()->route('welcome')->with('error', 'Sem semestre cadastrado');
        }
    }
}
