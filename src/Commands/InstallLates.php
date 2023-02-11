<?php

namespace Amendozaaguiar\Lates\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallLates extends Command
{
    protected $signature = 'lates:install';
    protected $description = 'Instala los archivos de traducción de Laravel en Español.';

    public function handle()
    {
        Artisan::call('vendor:publish', ['--provider' => 'Amendozaaguiar\Lates\LatesServiceProvider']);

        $this->info('Traducciones de Laravel en Español instaladas correctamente.');
    }
}
