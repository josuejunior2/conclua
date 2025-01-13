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
        if (config('app.env') === 'production') { 
            $this->app['request']->server->set('HTTPS', true);
        }

        Facades\View::composer('*', function ($view) {
            $view->with('semestres', Semestre::all());
        });
    }
}
