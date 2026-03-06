<?php

use Amendozaaguiar\LaravelLatEs\LaravelLatEsServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Yaml\Yaml;

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

// ─── Laravel Boost ───────────────────────────────────────────────────────────

it('el directorio de boost existe', function () {
    $path = __DIR__ . '/../../resources/boost';
    expect(is_dir($path))->toBeTrue();
});

it('existe la guideline de boost', function () {
    $path = __DIR__ . '/../../resources/boost/guidelines/core.blade.php';
    expect(file_exists($path))->toBeTrue();
    expect(file_get_contents($path))->not->toBeEmpty();
});

it('la guideline menciona el comando laravellates:install', function () {
    $content = file_get_contents(__DIR__ . '/../../resources/boost/guidelines/core.blade.php');
    expect($content)->toContain('laravellates:install');
});

it('existe la skill de boost', function () {
    $path = __DIR__ . '/../../resources/boost/skills/laravel-lat-es/skill.blade.php';
    expect(file_exists($path))->toBeTrue();
    expect(file_get_contents($path))->not->toBeEmpty();
});

it('la skill tiene frontmatter YAML válido con name y description', function () {
    $content = file_get_contents(__DIR__ . '/../../resources/boost/skills/laravel-lat-es/skill.blade.php');

    preg_match('/^---\n(.+?)\n---/s', $content, $matches);
    expect($matches)->not->toBeEmpty('La skill no tiene frontmatter YAML');

    $yaml = Yaml::parse($matches[1]);
    expect($yaml)->toHaveKeys(['name', 'description']);
    expect($yaml['name'])->toBe('laravel-lat-es');
    expect($yaml['description'])->toBeString()->not->toBeEmpty();
});

it('la skill documenta los cuatro archivos de traducción', function () {
    $content = file_get_contents(__DIR__ . '/../../resources/boost/skills/laravel-lat-es/skill.blade.php');

    foreach (['auth.php', 'pagination.php', 'passwords.php', 'validation.php'] as $file) {
        expect($content)->toContain($file);
    }
});

it('la skill documenta el uso del helper __()', function () {
    $content = file_get_contents(__DIR__ . '/../../resources/boost/skills/laravel-lat-es/skill.blade.php');
    expect($content)->toContain("__('");
});
