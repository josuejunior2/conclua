<?php

namespace App\Providers;

use App\Models\Semestre;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Facades\View::composer('*', function ($view) {
            $view->with('semestres', Semestre::all());
            $view->with('semestreIsAtual', !empty(Semestre::all()->last()) ? Semestre::all()->last()->id == session('semestre_id') : false);
            $view->with('semestreSession', session('semestre_id'));
        });
    }
}
