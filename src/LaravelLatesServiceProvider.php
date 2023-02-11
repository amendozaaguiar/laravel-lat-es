<?php

namespace Amendozaaguiar\LaravelLatEs;

use Illuminate\Support\ServiceProvider;

class LaravelLatEsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/../resources/lang' => base_path('/lang'),], 'lang');

        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\InstallLaravelLatEs::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
