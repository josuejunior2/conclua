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
        });

        $this->app->singleton('semestreAtivo', function () {  // para que o semestreAtivo possa ser acessado em qualquer lugar
            return session('semestre_id');     // por meio de app('semestreAtivo');
        });

    }
}
