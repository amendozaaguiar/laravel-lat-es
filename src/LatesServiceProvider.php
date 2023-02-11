<?php

namespace Amendozaaguiar\Lates;

use Illuminate\Support\ServiceProvider;

class LatesServiceProvider extends ServiceProvider
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
                Commands\InstallLates::class,
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
