<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Semestre;
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
        if(Semestre::where('status', 1)->exists()){
            return $next($request);
        } else {
            return abort(403, 'Semestre ainda não configurado. Entre em contato com o responsável pelo sistema.');
        }
    }
}
