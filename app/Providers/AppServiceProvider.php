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
            $view->with('semestreAtivo', Semestre::where('status', 1)->first());
        });

        $this->app->singleton('semestreAtivo', function () {  // para que o semestreAtivo possa ser acessado em qualquer lugar
            return Semestre::where('status', 1)->first();     // por meio de app('semestreAtivo');
        });

    }
}
