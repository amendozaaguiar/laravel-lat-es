<?php

use Amendozaaguiar\LaravelLatEs\LaravelLatEsServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;

// ─── ServiceProvider ─────────────────────────────────────────────────────────

it('el ServiceProvider se registra correctamente', function () {
    $providers = array_keys($this->app->getLoadedProviders());

    expect($providers)->toContain(LaravelLatEsServiceProvider::class);
});

it('registra los archivos publicables con el tag laravel-lat-es-lang', function () {
    $paths = ServiceProvider::pathsToPublish(
        LaravelLatEsServiceProvider::class,
        'laravel-lat-es-lang'
    );

    expect($paths)->not->toBeEmpty();

    $source = array_key_first($paths);
    expect(is_dir($source))->toBeTrue("El directorio fuente no existe: {$source}");
});

// ─── Comando Artisan ─────────────────────────────────────────────────────────

it('el comando laravellates:install existe', function () {
    expect(array_keys(Artisan::all()))->toContain('laravellates:install');
});

it('el comando laravellates:install publica los archivos', function () {
    $destination = lang_path('es');

    // Limpia destino antes de probar
    if (is_dir($destination)) {
        array_map('unlink', glob("{$destination}/*.php"));
        rmdir($destination);
    }

    Artisan::call('laravellates:install');

    expect(is_dir($destination))->toBeTrue('El directorio lang/es no fue creado');

    foreach (['auth', 'pagination', 'passwords', 'validation'] as $file) {
        expect(file_exists("{$destination}/{$file}.php"))
            ->toBeTrue("Falta el archivo {$file}.php después de instalar");
    }
});
