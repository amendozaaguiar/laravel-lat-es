<?php

namespace Amendozaaguiar\LaravelLatEs\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallLaravelLatEs extends Command
{
    protected $signature = 'laravellates:install';

    protected $description = 'Instala los archivos de traducción de Laravel en Español.';

    public function handle()
    {
        Artisan::call('vendor:publish', ['--provider' => 'Amendozaaguiar\LaravelLatEs\LaravelLatEsServiceProvider']);

        $this->info('Traducciones de Laravel en Español instaladas correctamente.');
    }
}
