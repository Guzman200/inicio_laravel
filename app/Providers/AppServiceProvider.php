<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

       
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale('es'); // o setlocale(LC_TIME,'es_ES.utf8');
        Carbon::setlocale(LC_ALL,'es_ES.utf8');
        setlocale(LC_ALL, 'es_MX', 'es', 'ES', 'es_MX.utf8');
    }
}
